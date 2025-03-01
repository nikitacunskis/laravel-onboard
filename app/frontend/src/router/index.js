import { createRouter, createWebHistory } from 'vue-router'
import api from '@/utils/api'
import { permissionsState } from '@/store/permissions'

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('../views/HomeView.vue'),
    props: route => ({
      permissions: route.meta.permissions,
      error: route.meta.error
    })
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/auth/Login.vue'),
    props: route => ({
      permissions: route.meta.permissions,
      error: route.meta.error
    })
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('../views/auth/Register.vue'),
    props: route => ({
      permissions: route.meta.permissions,
      error: route.meta.error
    })
  },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('../views/auth/Profile.vue'),
    props: route => ({
      permissions: route.meta.permissions,
      error: route.meta.error
    })
  },
  {
    path: '/orders',
    name: 'orders',
    component: () => import('../views/OrdersView.vue'),
    props: route => ({
      permissions: route.meta.permissions,
      error: route.meta.error
    })
  },
  {
    path: '/users',
    name: 'users',
    component: () => import('../views/UsersView.vue'),
    props: route => ({
      permissions: route.meta.permissions,
      error: route.meta.error
    })
  },
  {
    path: '/404',
    name: '404',
    component: () => import('../views/404.vue'),
    props: route => ({
      permissions: route.meta.permissions,
      error: route.meta.error
    })
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from, next) => {
  try {
    const response = await api.get('/permissions')
    permissionsState.permissions = response.data
    permissionsState.error = null
    to.meta.permissions = response.data
    to.meta.error = null
  } catch (err) {
    permissionsState.error = err.response?.data?.message || 'Unknown error'
    permissionsState.permissions = []
    to.meta.error = permissionsState.error
    to.meta.permissions = []
  }
  next()
})

export default router
