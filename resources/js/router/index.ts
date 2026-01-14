import {createRouter, createWebHistory} from 'vue-router';
import { ticketRoutes } from '../domain/ticket/routes';
import { loginRoutes } from '../domain/login/routes';
import { categoriesRoutes } from '../domain/categories/routes';
import { answersRoutes } from '../domain/answers/routes';
import { notesRoutes } from '../domain/notes/routes';
import { usersRoutes } from '../domain/users/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...loginRoutes,...ticketRoutes,...categoriesRoutes,...answersRoutes,...notesRoutes,...usersRoutes],
});