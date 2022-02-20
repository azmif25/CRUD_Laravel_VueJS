// Import Vue Router
import { createRouter, createWebHistory } from 'vue-router'

// Define a Router
const routes =[
    {
        path: '/',
        name: 'post.index',
        component: () => import(/* webpackChunnkName: "post.index" */ '@/views/post/Index.vue')
    },
    {
        path: '/',
        name: 'post.create',
        component: () => import(/* webpackChunnkName: "post.create" */ '@/views/post/Create.vue')
    },
    {
        path: '/',
        name: 'post.edit',
        component: () => import(/* webpackChunnkName: "post.edit" */ '@/views/post/Edit.vue')
    }
]

// Create Router
const router = createRouter({
    history: createWebHistory(),
    routes // Config Routes
})

export default router