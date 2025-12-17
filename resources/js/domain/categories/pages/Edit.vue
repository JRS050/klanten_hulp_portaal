<script setup lang="ts">
    import { useRoute, useRouter } from 'vue-router';
    import Form from '../components/Form.vue';
    import { categoryStore } from '../store';
import Navigation from '../../../components/Navigation.vue';
import AdminNavigation from '../../../components/AdminNavigation.vue';

    const route = useRoute();
    const router = useRouter();

    const category = categoryStore.getters.getById(route.params.id);

    const updateCategory = async (id,data) => {
        await categoryStore.actions.update(id, data);
    };

    const handleSubmit = async (data) => {
        await updateCategory(route.params.id, data);
        router.push({name: 'categories'});
    }
</script>
<template>

     <Navigation/>
     <AdminNavigation/>
    <h2>Edit category</h2>
    <Form v-if="category" :category="category" @submit="handleSubmit" />
</template>