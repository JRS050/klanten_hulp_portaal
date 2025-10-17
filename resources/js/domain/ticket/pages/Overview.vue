<script setup lang="ts">
    import { ticketStore } from '../store';
    import errorMessage from '../../../services/error/errorMessage.vue';
    import Logout from '../../../components/Logout.vue';

    ticketStore.actions.getAll();
    const tickets = ticketStore.getters.all;
    

</script>
<template>

    <Logout/>

    <h2>Own tickets overview</h2>

    <errorMessage/>

    <table>
        <thead>
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
        </thead>
        <tbody>
        <tr v-for="ticket in tickets" :key="ticket.id">
            <td>{{ ticket.id }}</td>
            <td>{{ ticket.title }}</td>
            <!-- <td>{{ ticket }}</td> -->
            <td>{{ ticket.status }}</td>
            <td>{{ ticket.user_id }}</td>
            <td>{{ ticket.created_at }}</td>
            <td>{{ ticket.updated_at }}</td>
            <td>{{ ticket.assigned_to }}</td>
        </tr>
        </tbody>
    </table>
</template>