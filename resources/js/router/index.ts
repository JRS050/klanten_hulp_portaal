import {createRouter, createWebHistory} from 'vue-router';
import { loginRoutes } from '../login/routes';
import { ticketRoutes } from '../domain/ticket/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...loginRoutes,...ticketRoutes]
});