<script setup lang="ts">
    import { ref } from 'vue';
    import  errorMessage from '../../../services/error/errorMessage.vue';
    import FormError from '../../../services/error/FormError.vue';
import { categoryStore } from '../../categories/store';

    categoryStore.actions.getAll();
    const categories = categoryStore.getters.all;

    const props = defineProps({ ticket: Object });

    const category_id = ref('');

    const emit = defineEmits(['submit']);

    const form = ref({ ...props.ticket, category_id});

    const handleSubmit = () => emit('submit', form.value);
</script>
<template>


    <errorMessage />

    <form @submit.prevent="handleSubmit">

        <p>Title</p>
        <input v-model="form.title" type="text"></input>
        <br>
        <p>Description</p>
        <textarea v-model="form.body" ></textarea>
        <br>
        <p v-if="categories">Categories</p>
            <select v-model="form.category_id" multiple>
                <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
            </select>
            <!-- <div v-for="category in categories" :key="category.id">
                <label>
                    <input type="checkbox" :value="category.id" v-model="form.category_id">
                    {{ category.title }}
                </label>
            </div> -->
            <br>
        <button type="submit">Post ticket</button>
    </form>
</template>