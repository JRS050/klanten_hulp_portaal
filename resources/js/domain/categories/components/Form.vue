<script setup lang="ts">
    import { ref } from 'vue';
    import  errorMessage from '../../../services/error/errorMessage.vue';
    import FormError from '../../../services/error/FormError.vue';

    

    const props = defineProps({ category: Object });

    const emit = defineEmits(['submit']);

    const form = ref({ ...props.category });

    const handleSubmit = () => emit('submit', form.value);
</script>
<template>


    <errorMessage />

    <form @submit.prevent="handleSubmit">

        <p>Title</p>
        <input v-model="form.title" type="text"></input>
        <br>

        <button type="submit">Submit</button>
    </form>
</template>