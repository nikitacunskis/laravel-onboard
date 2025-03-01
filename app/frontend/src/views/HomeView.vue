<script setup>
  import { onMounted } from 'vue';
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
  const router = useRouter()
  
  onMounted(() => {
      if (!props.permissions.includes('home')) {
          router.push({ name: '404' })
      }
  })
</script>

<template>
  <main>
    {{ props.error }}
    Home page 
  </main>
</template>
