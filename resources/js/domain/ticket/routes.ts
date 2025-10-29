import Create from './pages/Create.vue';
import Edit from './pages/Edit.vue';
import Overview from './pages/Overview.vue';
import Show from './pages/Show.vue';

export const ticketRoutes = [
    {path:'/myTickets', component: Overview, name:'myTickets'},
    {path:'/newTicket', component: Create, name:'newTicket'},
    {path:'/myTickets/:id/edit', component: Edit, name:'editTicket'},
    {path:'/myTickets/:id/show', component: Show, name:'ticketInfo'},
];