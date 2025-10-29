<script setup lang="ts">
    import { useRoute, useRouter } from 'vue-router';
    import Form from '../components/Form.vue';
    import { ticketStore } from '../store';

    const route = useRoute();
    const router = useRouter();

    const ticket = ticketStore.getters.getById(route.params.id);

    const updateTicket = async (id,data) => {
        await ticketStore.actions.update(id, data);
    };

    const handleSubmit = async (data) => {
        await updateTicket(route.params.id, data);
        router.push({name: 'myTickets'});
    }
</script>

<template>
    <h2>Ticket bewerken</h2>
    <Form v-if="ticket" :ticket="ticket" @submit="handleSubmit" />
</template>