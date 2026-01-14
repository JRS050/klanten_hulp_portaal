<script setup lang="ts">
    import { useRoute, useRouter } from 'vue-router';
    import { usersStore } from '../store';
    import Navigation from '../../../components/Navigation.vue';
    import AdminNavigation from '../../../components/AdminNavigation.vue';
    import Form from '../components/Form.vue';

    const route = useRoute();
    const router = useRouter();

    const user = usersStore.getters.getById(route.params.id);

    const updateUser = async (id,data) => {
        await usersStore.actions.update(id, data);
    };

    const handleSubmit = async (data) => {
        await updateUser(route.params.id, data);
        router.back();
    }
</script>
<template>
    <Navigation />
    <AdminNavigation />
    <h2>Edit user</h2>
    <Form v-if="user" :user="user" @submit="handleSubmit" />
</template>