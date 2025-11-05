<script setup lang="ts">
    import { ticketStore } from '../store';
    import errorMessage from '../../../services/error/errorMessage.vue';
    import Logout from '../../../components/Logout.vue';
    import { computed, ref } from 'vue';
import Navigation from '../../../components/Navigation.vue';
import { getRequest } from '../../../services/http';

    ticketStore.actions.getAll();
    const tickets = ticketStore.getters.all;
    const deleteTicket = async (id) => {
        await ticketStore.actions.delete(id);
    }

    const user = ref();
    const error = ref();
    const form = ref();

    const fetchUserData = async () => {
        try {
            const response = await getRequest('/me');
            user.value = response.data;
            console.log('User Data:', response.data);
        return response.data;
   
        } catch (error) {
            console.error('Error fetching user data:', error);
            return error;
        }
    };

    fetchUserData()

</script>
<template>

    <Logout/>

    <Navigation/>

    <h2>Own tickets overview</h2>

    <errorMessage/>

    <table bordered>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
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
                <td>{{ ticket.status }}</td>
                <td>{{ ticket.user_id }}</td>
                <td>{{ ticket.created_at }}</td>
                <td>{{ ticket.updated_at }}</td>
                <td>{{ ticket.assigned_to }}</td>
                <td>
                    <RouterLink :to="{name:'editTicket', params:{id: ticket.id}}">Edit</RouterLink><br>
                    <RouterLink :to="{name:'ticketInfo', params:{id: ticket.id}}">More Info</RouterLink><br>
                    <button @click="deleteTicket(ticket.id)">Delete</button>
                </td>
                <td v-if="user.admin_status === 1">
                    <form @submit.prevent="assignAdmin(ticket.id)">

                        <button type="submit">Assign</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</template>