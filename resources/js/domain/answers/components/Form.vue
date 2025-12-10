<script setup lang="ts">
    import { ref } from 'vue';
    import  errorMessage from '../../../services/error/errorMessage.vue';
    import FormError from '../../../services/error/FormError.vue';

    const props = defineProps({ answer: Object });
    const emit = defineEmits(['submit']);
    const form = ref({ ...props.answer });
    const handleSubmit = () => emit('submit', form.value);
</script>
<template>
    <errorMessage />
    <form @submit.prevent="handleSubmit">

        <p>Body</p>
        <textarea v-model="form.body"></textarea>
        <br>
        <input type="hidden" v-model="form.ticket_id" />
        <button type="submit">Post Answer</button>
    </form>
</template>