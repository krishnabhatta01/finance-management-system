import DashboardLayout from "../layouts/DashboardLayout.vue";
import UsersPage from "../pages/users/UsersPage.vue";
import Dashboard from "../pages/Dashboard.vue";
import UserForm from "../pages/users/UserForm.vue";
import AccountPage from "../pages/account/AccountPage.vue";

import logLayout from "../layouts/logLayout.vue";
import login from "../pages/login.vue";
import Register from "../pages/register.vue";
import Roles from '../pages/roles/RolePage.vue';
import Permissions from '../pages/permissions/PermissionsPage.vue';
import RoleForm from '../pages/roles/RoleForm.vue';
import PermissionsForm from'../pages/permissions/PermissionsForm.vue'

const routes = [
    {
        path: "/dashboard",
        component: DashboardLayout,
        children: [
            {
                path: "main",
                component: Dashboard,
            },
            {
                path: "users",
                component: UsersPage,
            },
            {
                path: "users/save",
                component: UserForm,
            },
            {
                path: "users/save/:id",
                component: UserForm,
            },
            {
                path: "account",
                component: AccountPage,
            },
            {
                path: "roles",
                component: Roles,
            },
            {
                path: "roles/save",
                component: RoleForm,
            },
            {
                path: "permissions",
                component: Permissions,
            },
            {
                path: "permissions/save",
                component: PermissionsForm,
            },
        ],
    },

    {
        path: "/",
        component: logLayout,
        children: [
            {
                path: "",
                component: login,
            },
            {
                path: "register",
                component: Register,
            },
        ],
    },
];
export default routes;
