<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>

<div>
  <!-- <router-view></router-view>
  <router-view/>
  <RouterView></RouterView> -->

  <header>
    <nav>
      <div class="logo">
        <router-link to="/">BlogSystem</router-link>
      </div>

      <div class="menu">
        <ul>
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/posts">Posts</router-link></li>
        </ul>
      </div>
    </nav>
  </header>
  <RouterView />
</div>

</template>