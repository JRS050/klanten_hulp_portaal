<script setup lang="ts">

    import { deleteRequest } from '../services/http';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    const logout = async () =>{
        await deleteRequest('/logout');
        await router.push({ name: 'login'});
        location.reload();
    }
</script>
<template>
    <button @click="logout">Logout</button>
</template>