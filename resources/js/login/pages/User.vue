<script setup lang="ts">
import {  ref } from 'vue';
import { deleteRequest, getRequest } from '../../services/http';
import { useRouter } from 'vue-router';

const user = ref();
const error = ref();

const router = useRouter();

const fetchUserData = async () => {
  try {
    const response = await getRequest('/me');
    user.value = response.data;
    console.log('User Data:', response.data);
    return response.data;
   
  } catch (error) {
    console.error('Error fetching user data:', error);
    return error;
  }
};


const logout = async () =>{
  await deleteRequest('/logout');

  router.push({ name: 'login'});
}

</script>
<template>
  <button @click="fetchUserData">Fetch logged user data</button>
      <p v-if="user">{{ user }}</p><br></br>
  <button @click="logout">Logout</button>
</template>