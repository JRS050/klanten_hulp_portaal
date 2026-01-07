import Edit from "./pages/Edit.vue";
import Overview from "./pages/Overview.vue";

export const usersRoutes = [
    {path:'/users', component: Overview, name:'usersOverview'},
    {path:'/users/:id/edit', component: Edit, name:'editUser'},
];