<script setup lang="ts">
    import { ticketStore } from '../store';
    import errorMessage from '../../../services/error/errorMessage.vue';
    import Logout from '../../../components/Logout.vue';
    import Navigation from '../../../components/Navigation.vue';
    import { categoryStore } from '../../categories/store';
    import AdminNavigation from '../../../components/AdminNavigation.vue';
    import { adminAuth } from '../../../components/AdminAuth';
import { ref } from 'vue';

    const adminAccess = ref();

    async function checkAdminAccess() {
        try {
            const response = await adminAuth();
            adminAccess.value = response;
            return response;
        } catch (error) {
            console.error('Admin access check failed:', error);
            return error;
        }
    }

    checkAdminAccess();



    ticketStore.actions.getAll();
    const tickets = ticketStore.getters.all;

    categoryStore.actions.getAll();

    const deleteTicket = async (id) => {
        await ticketStore.actions.delete(id);
    }

</script>
<template>

    <Logout/>

    <Navigation/>

    <AdminNavigation/>
    
    

    <h2>Own tickets overview</h2>

    <errorMessage/>

    <table bordered>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Categories</th>
                <th>Status</th>
                <th>Created by</th>
                <th>Created on</th>
                <th>Last update</th>
                <th>Assigned to</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="ticket in tickets">
                <td>{{ ticket.id }}</td>
                <td>{{ ticket.title }}</td>
                <td>{{ ticket.body }}</td>
                <td>
                    {{ categoryStore.getters.getByIds(ticket.category_ids).value.map(c => c.title).join(', ') }}    
                </td>
                <td>{{ ticket.status }}</td>
                <td>{{ ticket.user_id }}</td>
                <td>{{ ticket.created_at }}</td>
                <td>{{ ticket.updated_at }}</td>
                <td>{{ ticket.assigned_to }}</td>
                <td>
                    <RouterLink :to="{name:'editTicket', params:{id: ticket.id}}">Edit</RouterLink><br>
                    <!-- Add json response from back end to route parameters below -->
                    <RouterLink :to="{name:'ticketInfo', params:{id: ticket.id}}">More Info</RouterLink><br>
                    <button @click="deleteTicket(ticket.id)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>