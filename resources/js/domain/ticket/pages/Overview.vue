<script setup lang="ts">
    import { ticketStore } from '../store';
    import errorMessage from '../../../services/error/errorMessage.vue';
    import Logout from '../../../components/Logout.vue';
    import { computed } from 'vue';
import Navigation from '../../../components/Navigation.vue';

    ticketStore.actions.getAll();
    const tickets = ticketStore.getters.all;


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
            </tr>
        </tbody>
    </table>
</template>