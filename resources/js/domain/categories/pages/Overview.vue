<script setup lang="ts">
    import Logout from '../../../components/Logout.vue';
    import Navigation from '../../../components/Navigation.vue';
    import { categoryStore } from '../store';

    categoryStore.actions.getAll();

    const categories = categoryStore.getters.all;

    const deleteCategory = async (id) => {
        await categoryStore.actions.delete(id);
    };
</script>
<template>
    <Logout/>

    <Navigation/>

    <h2>Categories overview</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.title }}</td>
                    <td>
                        <RouterLink :to="{name: 'editCategorie', params: {id: category.id}}">Edit</RouterLink>
                        <button @click="deleteCategory(category.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>