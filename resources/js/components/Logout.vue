<script setup lang="ts">

    import { deleteRequest } from '../services/http';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    const logout = async () =>{
        await deleteRequest('/logout');
        router.push({ name: 'login'});
    }
</script>
<template>
    <button @click="logout">Logout</button>
</template>