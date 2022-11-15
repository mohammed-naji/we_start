import { createRouter, createWebHistory } from "vue-router";

import CoursesIndex from '../components/courses/Index.vue'
import CoursesNew from '../components/courses/New.vue'
import CoursesEdit from '../components/courses/Edit.vue'
import notFound from '../components/404.vue'

const routes = [
    {
        path: '/',
        component:CoursesIndex
    },
    {
        path: '/course/new',
        name: 'addNew',
        component:CoursesNew
    },
    {
        path: '/course/:id/edit',
        component:CoursesEdit,
        props: true
    },
    {
        path: '/:any(.*)',
        component:notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
