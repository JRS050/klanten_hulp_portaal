<script setup lang="ts">
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const form = ref({
    email:'',
    password:''
});


const login = async () =>{
    await axios.get('/sanctum/csrf-cookie')

    await axios.post('/api/auth', form.value)
    
    router.push({ name: 'me'});
};

</script>

<template>
    <form @submit.prevent="login">
        <label>Email:</label>
        <input v-model="form.email" required type="text"></input>
        <label>Password:</label>
        <input v-model="form.password" required type="password"></input>
        <button type="submit">Login</button>
    </form>
</template>