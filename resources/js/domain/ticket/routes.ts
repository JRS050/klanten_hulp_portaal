import Create from './pages/Create.vue';
import Overview from './pages/Overview.vue';

export const ticketRoutes = [
    {path:'/myTickets', component: Overview, name:'myTickets'},
    {path:'/newTicket', component: Create, name:'newTicket'},
];