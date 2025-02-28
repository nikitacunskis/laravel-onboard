<template>
    <button @click="handleLogout">Logout</button>
</template>
  
<script setup>
    import api from '@/utils/api'
    import { useRouter } from 'vue-router'
    
    const router = useRouter()
    
    const handleLogout = async () => {
        try {
            await api.post('/logout', {}, {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            })
            localStorage.removeItem('token')
            window.location.reload()
        } catch (err) {
            console.error('Logout error:', err.response?.data || err.message)
        }
    }
</script>
  
<style scoped>
    button {
        padding: 0.5rem 1rem;
        cursor: pointer;
    }
</style>
  