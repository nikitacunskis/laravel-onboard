<script setup>
  import { permissionsState } from '@/store/permissions'
  import { RouterLink, RouterView } from 'vue-router'
  import Logout from '@/views/auth/Logout.vue'

</script>

<template>
  <div class="layout">
    <header class="header">
      <h1>Basic template</h1>
    </header>
    <aside class="sidebar">
      <nav>
        <ul>
          <li><RouterLink to="/" v-if="permissionsState.permissions.includes('home')">Home</RouterLink></li>
          <li><RouterLink to="/login" v-if="permissionsState.permissions.includes('login')">Login</RouterLink></li>
          <li><RouterLink to="/register" v-if="permissionsState.permissions.includes('register')">Register</RouterLink></li>
          <li><RouterLink to="/profile" v-if="permissionsState.permissions.includes('profile')">Profile</RouterLink></li>
          <li><Logout v-if="permissionsState.permissions.includes('logout')" /></li>
        </ul>
      </nav>
    </aside>
    <main class="main-content">
      <RouterView />
    </main>
    <footer class="footer">
      <p>&copy; 2025</p>
    </footer>
  </div>
</template>


<style scoped>
.layout {
  display: grid;
  grid-template-areas:
    "header header"
    "sidebar main"
    "footer footer";
  grid-template-columns: 25vh 1fr;
  grid-template-rows: auto 1fr auto;
  min-height: 100vh;
  width: 100vw;
  min-width: 100vw;
  margin: 0 auto;
  max-width: 1200px;
  box-sizing: border-box;
}

/* Header styles */
.header {
  grid-area: header;
  background-color: #333;
  color: #fff;
  padding: 1rem;
}

/* Sidebar styles */
.sidebar {
  grid-area: sidebar;
  background-color: #ffffff;
  padding: 1rem;
}

/* Main content styles */
.main-content {
  grid-area: main;
  padding: 1rem;
}

/* Footer styles */
.footer {
  grid-area: footer;
  background-color: #333;
  color: #fff;
  padding: 1rem;
  text-align: center;
}

/* Optional: styling for navigation links */
.sidebar nav ul {
  list-style: none;
  padding: 0;
}

.sidebar nav li {
  margin-bottom: 0.5rem;
}

.sidebar nav a {
  text-decoration: none;
}

.error {
  color: red;
  margin-bottom: 1rem;
}
</style>