import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue';
import Posts from '../views/Posts.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/posts",
      name: "posts",
      component: Posts
    }
  ]
})

export default router
