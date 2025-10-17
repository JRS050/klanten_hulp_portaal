<script setup lang="ts">
import {  ref } from 'vue';
import { getRequest } from '../../services/http';
import Logout from '../../components/Logout.vue';

const user = ref();
const error = ref();

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

</script>
<template>
  <button @click="fetchUserData">Fetch logged user data</button>
      <p v-if="user">{{ user }}</p><br></br>
  <Logout/>
</template>