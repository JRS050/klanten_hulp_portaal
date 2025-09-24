import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import User from './pages/User.vue';

export const loginRoutes =[
    { path:'/login', component: Login, name: 'login'},
    { path:'/me', component: User, name: 'me'},
    { path:'/register', component: Register, name: 'register'}
];