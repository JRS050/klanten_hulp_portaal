<script setup lang="ts">
    import { ticketStore } from '../store';
    import errorMessage from '../../../services/error/errorMessage.vue';

    ticketStore.actions.getAll();
    const tickets = ticketStore.getters.all;
    

</script>
<template>
    <h2>Own tickets overview</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Categories</th>
            <th>Status</th>
            <th>Created by</th>
            <th>Created on</th>
            <th>Last update</th>
            <th>Assigned to</th>
        </tr>
        <tr v-for="ticket in tickets" :key="ticket.id">
            <td>{{ ticket.id }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ ticket }}</td>
            <td>{{ ticket.status }}</td>
            <td>{{ ticket.user_id }}</td>
            <td>{{ ticket.created_at }}</td>
            <td>{{ ticket.updated_at }}</td>
            <td>{{ ticket.assigned_to }}</td>
        </tr>
    </table>
</template>