import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../components/views/Dashboard.vue";
import Login from "../components/views/Login.vue";
import ResetPassword from "../components/views/ResetPassword.vue";
import RequestPassword from "../components/views/RequestPassword.vue";

const routes = [
    {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard
    },
    {
        path: "/login",
        name: "login",
        component: Login
    },{
        path: "/reset/:token",
        name: "reset",
        component: ResetPassword
    },
    {
        path: "/request-password",
        name: "requestPassword",
        component: RequestPassword
    },
]
const router = createRouter({
    history : createWebHistory(),

    routes
})

export default router
