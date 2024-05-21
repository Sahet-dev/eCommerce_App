import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../components/views/Dashboard.vue";
import Login from "../components/views/Login.vue";
import ResetPassword from "../components/views/ResetPassword.vue";
import RequestPassword from "../components/views/RequestPassword.vue";
import AppLayout from "../components/AppLayout.vue";
import Products from "../components/views/Products.vue";
import store from "../store/index.js";
import NotFound from "../components/views/NotFound.vue";

const routes = [
    {
        path: "/app",
        name: "app",
        component: AppLayout,
        meta: { requiresAuth: true },
        children:[
            {
                path: "dashboard",
                name: "app.dashboard",
                component: Dashboard
            },
{
                path: "products",
                name: "app.products",
                component: Products
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
        meta: {
            requiresGuest: true
        },
        component: Login
    },{
        path: "/reset/:token",
        name: "reset",
        meta: {
            requiresGuest: true
        },
        component: ResetPassword
    },
    {
        path: "/request-password",
        name: "requestPassword",
        meta: {
            requiresGuest: true
        },
        component: RequestPassword
    },
{
        path: "/:pathMatch(.*)*",
        name: "notfound",

        component: NotFound
    },

]
const router = createRouter({
    history : createWebHistory(),

    routes
})


router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({name: 'login'})
    }else if(to.meta.requiresGuest && store.state.user.token){
        next({name: 'app.dashboard'})
    }else {
        next()
    }
})
export default router
