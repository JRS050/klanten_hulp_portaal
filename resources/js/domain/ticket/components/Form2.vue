<script setup lang="ts">
    import { ref } from 'vue';
    import  errorMessage from '../../../services/error/errorMessage.vue';
    import FormError from '../../../services/error/FormError.vue';
    import { Status } from '../status';
    import { getRequest } from '../../../services/http';
    import { categoryStore } from '../../categories/store';

    const admin_list = ref();
    const categories = categoryStore.getters.all;
    console.log(categories);

    const props = defineProps({ 
        ticket: Object ,
        purpose : String,
    });

    //purposes: TicketEdit => Title and description enabled
    //          AAdmin Update => Admin and status selection enabled


    const form = ref({ ...props.ticket});

    console.log(form.value);

    const fetchAdminList = async () => {
        try {
            const response = await getRequest('/admin-list');
            admin_list.value = response.data.admins;
            console.log('Admin List:', response.data);
        return response.data;
   
        } catch (error) {
            console.error('Error fetching admin list:', error);
            return error;
        }
    };

    fetchAdminList();
    

    const emit = defineEmits(['submit']);

    const handleSubmit = () => emit('submit', form.value);

</script>
<template>


    <errorMessage />

    <form @submit.prevent="handleSubmit">
        <div v-if="purpose === 'TicketEdit'">
            <p>Title</p>
            <input v-model="form.title" type="text"></input>
            <br>
            <p>Description</p>
            <textarea v-model="form.body"></textarea>
            <br>
            <p>Category</p>
            <select v-model="form.category_id">
                <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
            </select>
            <br>
        </div>

        <div v-if="purpose === 'Admin Update'">
            <p>Admin</p>
            <select v-model="form.assigned_to">
                <option v-for="admin in admin_list" :value="admin.id">{{ admin.name }}</option>
            </select>
            <br>
            <p>Status</p>
            <select v-model="form.status">
                <option v-for="status in Status" :value="status">{{ status }}</option>
            </select>
        </div>
        

        <button type="submit">Update</button>
    </form>
</template>