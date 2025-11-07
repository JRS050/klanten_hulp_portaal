<script setup lang="ts">
    import { ref } from 'vue';
    import { useRouter } from 'vue-router';
    import { postRequest } from '../../../services/http';
    import errorMessage from '../../../services/error/errorMessage.vue';

    const router = useRouter();

    const form = ref({
        email:'',
    });

    const sendResetLink = async() =>{
        await postRequest('/forgot-password', form.value)
        router.push({ name: 'login'})
    };
</script>
<template>
    <errorMessage />
    <button @click="router.push({ name: 'login'});">Login page</button><br>
    
    <form @submit.prevent="sendResetLink">
        <label>Email:</label>
        <input v-model="form.email" required type="email"></input>
        
        <button type="submit">Send reset link</button>
    </form>
</template>