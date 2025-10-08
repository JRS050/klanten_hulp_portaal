import ForgotPassword from './pages/ForgotPassword.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import User from './pages/User.vue';
import ResetPassword from './pages/ResetPassword.vue';

export const loginRoutes =[
    { path:'/', component: Login, name: 'login'},
    { path:'/me', component: User, name: 'me'},
    { path:'/register', component: Register, name: 'register'},
    { path:'/reset-password/:token', component: ResetPassword, name:'password.reset'},
    { path:'/forgot-password', component: ForgotPassword, name: 'forgot-password'},
];