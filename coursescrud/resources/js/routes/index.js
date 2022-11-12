import { createRouter, createWebHistory } from "vue-router";

import CoursesIndex from '../components/courses/Index.vue'

const routes = [
    {
        path: '/',
        component:CoursesIndex
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
