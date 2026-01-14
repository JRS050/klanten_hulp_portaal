<script setup lang="ts">
    import { ref } from 'vue';
    import  errorMessage from '../../../services/error/errorMessage.vue';
    import FormError from '../../../services/error/FormError.vue';
    const props = defineProps({ user: Object });
    const emit = defineEmits(['submit']);
    const form = ref({ ...props.user });
    const handleSubmit = () => emit('submit', form.value);
</script>
<template>
    <errorMessage />

    <form @submit.prevent="handleSubmit">

        <p>Username</p>
        <input v-model="form.name" type="text"></input>
        <br>
        <p>Email</p>
        <input v-model="form.email" type="email"></input>
        <br>
        <button type="submit">Update user</button>
    </form>
</template>