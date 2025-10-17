<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import errorMessage from '../../services/error/errorMessage.vue';
import { getRequest, postRequest } from '../../services/http';

const router = useRouter();

const form = ref({
    email:'',
    password:''
});


const login = async () =>{
    await getRequest('/sanctum/csrf-cookie')

    await postRequest('/auth', form.value)
    
    router.push({ name: 'myTickets'});
};

</script>

<template>
    <button @click="router.push({ name: 'register'});">Registration page</button>
    <br>
    <errorMessage />
    <br>
    <form @submit.prevent="login">
        <label>Email:</label>
        <input v-model="form.email" required type="text"></input>
        <label>Password:</label>
        <input v-model="form.password" required type="password"></input>
        <button type="submit">Login</button>
    </form>

    <button @click="router.push({ name: 'forgot-password'});">Forgot password?</button>
</template>