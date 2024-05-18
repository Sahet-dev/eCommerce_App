import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../components/views/Dashboard.vue";
import Login from "../components/views/Login.vue";
import ResetPassword from "../components/views/ResetPassword.vue";
import RequestPassword from "../components/views/RequestPassword.vue";
import AppLayout from "../components/AppLayout.vue";

const routes = [
    {
        path: "/app",
        name: "app",
        component: AppLayout,
        children:[
            {
                path: "dashboard",
                name: "app.dashboard",
                component: Dashboard
            },
{
                path: "products",
                name: "app.products",
                component: Dashboard
            },
{
                path: "users",
                name: "app.users",
                component: Dashboard
            },
{
                path: "reports",
                name: "app.reports",
                component: Dashboard
            },
        ]
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
