import { createRouter , createWebHistory } from "vue-router";
import catogryIndex from '../components/catogries/Index.vue'
import notFound from '../components/NotFound.vue'
import register from '../components/auth/Register.vue'
import login from '../components/auth/Login.vue'
const routes =[
    {
        path : '/',
        name : 'register',
        component : register
    },
{
    path:'/:pathMatch(.*)*',
    name : 'notfound',
    component : notFound
},
{
    path : '/',
    name : 'register',
    component : register
},
{
    path:'/login',
    name:'login',
    component : login
}
]

const router =  createRouter({
    history: createWebHistory(),
    routes
})

export  default router
