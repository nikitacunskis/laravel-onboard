<template>
    <div class="login">
        <h2>Login</h2>
        <form @submit.prevent="handleLogin">
            <input type="email" placeholder="Email" v-model="email" required /> <br>
            <input type="password" placeholder="Password" v-model="password" required /> <br>
            <button type="submit">Login</button>
        </form>
        <p v-if="error" class="error">{{ error }}</p>
    </div>
</template>
  
<script setup>
    import { onMounted, ref } from 'vue'
    import api from '@/utils/api'
    import { useRouter } from 'vue-router'

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
    const email = ref('')
    const password = ref('')
    const error = ref(null)
    const router = useRouter()
    
    const handleLogin = async () => {
        error.value = null
        try {
            const response = await api.post('/login', { email: email.value, password: password.value })
            const token = response.data.access_token
            localStorage.setItem('token', token)
            window.location.reload()
        } catch (err) {
            error.value = err.response?.data?.message || 'Login failed'
            console.error('Login error:', err.response?.data || err.message)
        }
    }

    onMounted(() => {
        if (!props.permissions.includes('login')) {
            router.push({ name: 'profile' })
        }
    })
</script>
  
<style scoped>
    .error {
        color: red;
        margin-top: 0.5rem;
    }
</style>
  