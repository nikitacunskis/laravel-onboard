<script setup>
    import api from '@/utils/api'
    import { ref, onMounted, computed } from 'vue'
    import { useRouter } from 'vue-router'
    import Table from '@/components/Table.vue'

    const props = defineProps({
        error: {
            type: String,
            required: false,
            default: null,
        },
        permissions: {
            type: Array,
            required: false,
            default: null,
        },
    })

    const router = useRouter()
    const users = ref([]);
    const error = ref(null);
        
    const getOrder = async () => {
        error.value = null
        try {
            const response = await api.get('/orders')
            users.value = response.data.data
        } catch (err) {
            error.value = err.response?.data?.message || 'Login failed'
            console.error('Login error:', err.response?.data || err.message)
        }
    }

    const filteredUsers = computed(() => {
        return Array.isArray(users.value) && users.value.length ? users.value.map(user => ({
            id: user.id,
            name: user.name,
            orders_count: user.orders_count,
        })) : []
    })

    onMounted(() => {
        if (!props.permissions.includes('orders_list')) {
            router.push({ name: 'home' })
        }
        getOrder()
    })
</script>
<template>
    <span class="error"> {{ error }}</span>
    <Table :data="filteredUsers" :headers="['id', 'name', 'orders count']" />
</template>