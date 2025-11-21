import Overview from "./pages/Overview.vue";
import Create from "./pages/Create.vue";
import Edit from "./pages/Edit.vue";

export const categoriesRoutes = [
    {path:'/categories', component: Overview, name:'categories'},
    {path:'/newCategory', component: Create, name:'newCategory'},
    {path:'/myCategories/:id/edit', component: Edit, name:'editCategorie'},
];