import Login from './pages/Login.vue';
import User from './pages/User.vue';

export const loginRoutes =[
    { path:'/login', component: Login, name: 'login'},
    { path:'/me', component: User, name: 'me'}
];