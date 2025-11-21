import {createRouter, createWebHistory} from 'vue-router';
import { ticketRoutes } from '../domain/ticket/routes';
import { loginRoutes } from '../domain/login/routes';
import { categoriesRoutes } from '../domain/categories/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...loginRoutes,...ticketRoutes,...categoriesRoutes]
});