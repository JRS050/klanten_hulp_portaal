import {createRouter, createWebHistory} from 'vue-router';
import { loginRoutes } from '../login/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...loginRoutes],
});