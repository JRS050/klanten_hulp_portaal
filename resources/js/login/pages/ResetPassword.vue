<script setup lang="ts">
    import { ref } from 'vue';
    import { useRouter, useRoute } from 'vue-router';
    import { postRequest } from '../../services/http';
    import errorMessage from '../../services/error/errorMessage.vue';

    const router = useRouter();
    const route = useRoute();

    let token = route.params.token;
    console.log(route.params);
    const form = ref({
        password:'',
        password_confirmation:'',
        token: token,
    });

    const resetPassword = async () =>{
        await postRequest(`/reset-password/$token`, form.value)
        
        router.push({ name: 'login'});
    };
</script>
<template>
    <errorMessage/>
    <form @submit.prevent="resetPassword">
        <label for="password">New Password:</label>
        <input type="password" name="password" v-model="form.password" required>
      
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" v-model="form.password_confirmation" required>
        <button type="submit">Reset Password</button>
    </form>
</template>