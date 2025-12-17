<script setup lang="ts">
    import Form from '../components/Form.vue';
    import { categoryStore } from '../store';
    import { useRouter } from 'vue-router';
    import { ref } from 'vue';
    import Navigation from '../../../components/Navigation.vue';
import AdminNavigation from '../../../components/AdminNavigation.vue';

    const router = useRouter();

    const addCategory = async (data) => {
        await categoryStore.actions.create(data);
        router.push({name: 'categories'});
    };

    const category = ref({
        title:'',
    });

    const handleSubmit = async (data) => {
        addCategory(data);
    };

</script>
<template>
    <Navigation/>
    <AdminNavigation/>
    <h2>New category</h2>
    <Form :category="category" @submit="handleSubmit"/>
</template>