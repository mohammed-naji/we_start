<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <div>
    <header>
      <router-link class="logo" to="/">Products Filter </router-link>
      <nav>
          <RouterLink activeClass="current" to="/">Home</RouterLink>
          <RouterLink activeClass="current" to="/products">Products</RouterLink>
        </nav>
    </header>
    <RouterView />
  </div>
</template>