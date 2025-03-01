<template>
    <div class="profile">
      <h2>User Profile</h2>
      <div v-if="error" class="error">{{ error }}</div>
      <div v-if="loading">Loading profile...</div>
      <div v-if="profile && !loading">
        <p><strong>Name:</strong> {{ profile.name }}</p>
        <p><strong>Email:</strong> {{ profile.email }}</p>
        <p><strong>Group:</strong> {{ profile.group.name }}</p>
      </div>
    </div>
  </template>
  
<script setup>
    import { ref, onMounted } from 'vue'
    import { useRouter } from 'vue-router'
    import api from '@/utils/api'
    
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
    const profile = ref(null)
    const loading = ref(true)
    const error = ref(null)
    const router = useRouter()
    
    const getProfile = async () => {
        try {
            const token = localStorage.getItem('token')

            if (!token) {
                router.push({ name: 'Login' })
                return;
            }

            api.setHeader('Authorization', `Bearer ${token}`);
            const response = await api.get('/profile')
            profile.value = response.data
        } catch (err) {
            error.value = err.response?.data?.message || 'Error fetching profile'
            console.error('Profile fetch error:', err.response?.data || err.message)
        } finally {
            loading.value = false
        }
    }
    
    onMounted(() => {
        if (!props.permissions.includes('profile')) {
            router.push({ name: 'login' })
        }
        getProfile()
    })
</script>
  
<style scoped>
    .profile {
        max-width: 600px;
        margin: 2rem auto;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .error {
        color: red;
        margin-bottom: 1rem;
    }
</style>
  