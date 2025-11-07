<script setup lang="ts">
    import { ref } from 'vue';
    import { useRouter } from 'vue-router';
    import { postRequest } from '../../../services/http';
    import errorMessage from '../../../services/error/errorMessage.vue';

    const router = useRouter();

    const form = ref({
        name:'',
        email:'',
        password:'',
        admin_status:false,
    });

    const register = async () =>{
        await postRequest('/register', form.value)
        
        router.push({ name: 'login'});
    };
</script>
<template>
    <errorMessage />
    <button @click="router.push({ name: 'login'});">Login page</button>
    <form @submit.prevent="register">
        <label>Name:</label>
        <input v-model="form.name" required type="text"></input>
        <label>Email:</label>
        <input v-model="form.email" required type="text"></input>
        <label>Password:</label>
        <input v-model="form.password" required type="password"></input>
        <button type="submit">Register</button>
    </form>
</template>