<script setup lang="ts">
    import { ref } from 'vue';
    import Logout from '../../../components/Logout.vue';
    import Navigation from '../../../components/Navigation.vue';
    import { ticketStore } from '../store';
    import { useRoute, useRouter } from 'vue-router';
    import { getRequest, putRequest } from '../../../services/http';

    const route = useRoute();
    ticketStore.actions.getAll();

    const ticket = ticketStore.getters.getById(route.params.id);
    console.log(ticket.value);

    const user = ref();
    const error = ref();
    const assigned_to = ref(ticket.value.assigned_to);

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

    fetchUserData()

    //get list of admins
    const admin_list = ref();

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
    //assign admin to ticket
    // const updateTicket = async (id,data) => {
    //     await ticketStore.actions.update(id, data);
    // };

    const assign = async (id,data) => {
        console.log('Assigning ticket with data:', data);
        await putRequest(`/tickets/${id}/assign`, data);
    };

    const handleSubmit = async (data) => {
        await assign(route.params.id, data);
    }

</script>
<template>


    <Logout/>

    <Navigation/>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Title:{{ ticket.title }}</th>
                    <th>Ticket Status: {{ ticket.status }}</th>
                    <td v-if="user.admin_status === 1">
                        <form @submit.prevent="handleSubmit(assigned_to)">
                            <select required name="assigned_to" id="assigned_to" v-model="assigned_to">
                                <option v-for="admin in admin_list" :value="admin.id">{{ admin.name }}</option>

                            </select>
                            <button type="submit">Assign</button>
                        </form>
                    </td>
                </tr>
            </thead>
            <tr>
                <td>
                    {{ ticket.body }}
                </td>
            </tr>
        </table>
    </div>
</template>