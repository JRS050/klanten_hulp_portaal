<script setup lang="ts">
    import Form from '../components/Form.vue';
    import { ticketStore } from '../store';
    import { useRouter } from 'vue-router';
    import { ref } from 'vue';
    import Navigation from '../../../components/Navigation.vue';

    const router = useRouter();

    const addTicket = async (data) => {
        await ticketStore.actions.create(data);
        router.push({name: 'books.overview'});
    };

    const ticket = ref({
        title:'',
        body:'',
        status:'pending',

    });

    const handleSubmit = async (data) => {
        addTicket(data);
    };

</script>
<template>
    <Navigation/>

    <h2>New ticket</h2>
    <Form :ticket="ticket" @submit="handleSubmit"/>
</template>