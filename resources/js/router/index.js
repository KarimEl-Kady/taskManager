import { createRouter, createWebHistory } from "vue-router";
import notFound from "../components/NotFound.vue";
import register from "../components/auth/Register.vue";
import login from "../components/auth/Login.vue";
import home from "../components/home/Index.vue";
import catogryIndex from "../components/catogries/Index.vue";
import catogryForm from "../components/catogries/Form.vue";
import catogryArchieve from "../components/catogries/Archieved.vue";
import taskIndex from "../components/tasks/Index.vue";
import taskForm from "../components/tasks/Form.vue";
import taskArchieve from "../components/tasks/Archieved.vue";
const routes = [
    {
        path: "/register",
        name: "register",
        component: register,
    },
    {
        path: "/login",
        name: "login",
        component: login,
    },
    {
        path: "/:pathMatch(.*)*",
        name: "notfound",
        component: notFound,
    },
    {
        path: "/",
        name: "home",
        component: home,
        meta: { requiresAuth: true },
    },
    {
        path: "/catogries",
        name: "catogries",
        component: catogryIndex,
        meta: { requiresAuth: true },
    },
    {
        path: "/category/create",
        name: "create-category",
        component: catogryForm,
        meta: { requiresAuth: true },
    },

    {
        path: "/category/edit/:id",
        name: "edit-category",
        component: catogryForm,
        meta: { requiresAuth: true },
    },
    {
        path: "/category/archieve",
        name: "category-archieve",
        component: catogryArchieve,
        meta: { requiresAuth: true },
    },
    {
        path: "/tasks",
        name: "tasks",
        component: taskIndex,
        meta: { requiresAuth: true },
    },
    {
        path: "/task/create",
        name: "create-task",
        component: taskForm,
        meta: { requiresAuth: true },
    },

    {
        path: "/task/edit/:id",
        name: "edit-task",
        component: taskForm,
        meta: { requiresAuth: true },
    },
    {
        path: "/task/archieve",
        name: "task-archieve",
        component: taskArchieve,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("auth_token");

    if (to.meta.requiresAuth && !token) {
        next({ name: "login" });
    } else if (to.meta.guest && token) {
        next({ name: "home" });
    } else {
        next();
    }
});

export default router;
