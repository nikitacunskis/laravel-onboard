<template>
    <div class="register">
        <h2>Register</h2>
        <form @submit.prevent="handleRegister">
            <input type="text" placeholder="Name" v-model="name" required /> <br>
            <input type="email" placeholder="Email" v-model="email" required /> <br>
            <input type="password" placeholder="Password" v-model="password" required /> <br>
            <input type="password" placeholder="Confirm Password" v-model="password_confirmation" required /> <br>
            <button type="submit">Register</button>
        </form>
        <p v-if="error" class="error">{{ error }}</p>
    </div>
</template>
  
<script setup>
    import { ref, onMounted } from 'vue'
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
    const name = ref('')
    const email = ref('')
    const password = ref('')
    const password_confirmation = ref('')
    const error = ref(null)
    const router = useRouter()
    
    const handleRegister = async () => {
        error.value = null
        try {
            const response = await api.post('/register', {
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: password_confirmation.value,
            })
            const token = response.data.access_token
            localStorage.setItem('token', token)
            window.location.reload()
        } catch (err) {
            error.value = err.response?.data?.message || 'Registration failed'
            console.error('Registration error:', err.response?.data || err.message)
        }
    }

    onMounted(() => {
        if (!props.permissions.includes('login')) {
            router.push({ name: 'Profile' })
        }
    })
</script>
  
<style scoped>
    .error {
        color: red;
        margin-top: 0.5rem;
    }
</style>
  