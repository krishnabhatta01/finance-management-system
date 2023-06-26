import DashboardLayout from "../layouts/DashboardLayout.vue";
import UsersPage from "../pages/users/UsersPage.vue";
import Dashboard from "../pages/Dashboard.vue";
import UserForm from "../pages/users/UserForm.vue";
import AccountPage from "../pages/account/AccountPage.vue";

import logLayout from "../layouts/logLayout.vue";
import login from "../pages/login.vue";
import register from "../pages/register.vue";

const routes = [
    {
        path: "/",
        component: DashboardLayout,
        children: [
            {
                path: "",
                component: Dashboard,
            },
            {
                path: "/users",
                component: UsersPage,
            },
            {
                path: "/users/save",
                component: UserForm,
            },
            {
                path: "/users/save/:id",
                component: UserForm,
            },
            {
                path: "/account",
                component: AccountPage,
            },
        ],
    },

    {
        path: "/main",
        component: logLayout,
        children: [
            {
                path: "login",
                component: login,
            },
            {
                path: "register",
                component: register,
            },
        ],
    },
];
export default routes;
