
import { createRouter , createWebHistory } from "vue-router";
import notFound from '../components/NotFound.vue';
import register from '../components/auth/Register.vue';
import login from '../components/auth/Login.vue';
import home from '../components/home/Index.vue';
import catogryIndex from '../components/catogries/Index.vue';
import catogryForm from '../components/catogries/Form.vue';
import catogryArchieve from '../components/catogries/Archieved.vue';
import taskIndex from '../components/tasks/Index.vue';
import taskForm from '../components/tasks/Form.vue';
import taskArchieve from '../components/tasks/Archieved.vue';
const routes =[
    {
        path : '/',
        name : 'home',
        component : home
    },
    {
        path:'/:pathMatch(.*)*',
        name : 'notfound',
        component : notFound
    },
    {
        path : '/register',
        name : 'register',
        component : register
    },
{
    path:'/login',
    name:'login',
    component : login
},
{
    path:'/catogries',
    name:'catogries',
    component : catogryIndex
},
{
    path: '/category/create',
    name: 'create-category',
    component: catogryForm,
  },

  {
    path: '/category/edit/:id',
    name: 'edit-category',
    component: catogryForm,
  },
  {
    path: '/category/archieve',
    name: 'category-archieve',
    component: catogryArchieve
  },
{
  path:'/tasks',
  name:'tasks',
  component : taskIndex
},
{
  path: '/task/create',
  name: 'create-task',
  component: taskForm,
},

{
  path: '/task/edit/:id',
  name: 'edit-task',
  component: taskForm,
},
{
  path: '/task/archieve',
  name: 'task-archieve',
  component: taskArchieve
}
]

const router =  createRouter({
    history: createWebHistory(),
    routes
})

export  default router
