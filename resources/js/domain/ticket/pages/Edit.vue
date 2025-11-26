<script setup lang="ts">
    import { useRoute, useRouter } from 'vue-router';
    import Form from '../components/Form.vue';
    import { ticketStore } from '../store';
import Navigation from '../../../components/Navigation.vue';

    const route = useRoute();
    const router = useRouter();

    const formPurpose = [
        "TicketEdit",
    ]

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

        <Navigation/>
    <h2>Ticket bewerken</h2>
    <Form v-if="ticket" :ticket="ticket" @submit="handleSubmit" />
</template>