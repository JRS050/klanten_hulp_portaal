<script setup lang="ts">
    import { ref } from 'vue';
    import Logout from '../../../components/Logout.vue';
    import Navigation from '../../../components/Navigation.vue';
    import { ticketStore } from '../store';
    import { useRoute, useRouter } from 'vue-router';
    import { getRequest, putRequest } from '../../../services/http';
    import { Status } from '../status';

    console.log(Status);
    const route = useRoute();


    ticketStore.actions.getAll();

    const ticket = ticketStore.getters.getById(route.params.id);

    const user = ref();
    const error = ref();
    const assigned_to = ref(0);
    const ticketStatus = ref(0);

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

    const assign = async () => {        
        await putRequest(`/tickets/${route.params.id}/assign`, {assigned_to: assigned_to.value});
    };

    const updateStatus = async () => {
        await putRequest(`/tickets/${route.params.id}/status`, {status: ticketStatus.value});
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

                    <td>
                        <form @submit.prevent="updateStatus">
                            <select required name="status" id="status" v-model="ticketStatus">
                                <option v-for="status in Status" :value="status">{{ status }}</option>
                            </select>
                            <button type="submit">Update Status</button>
                        </form>
                    </td>
                    <!-- <td v-else>Ticket Status: {{ ticket.status }}</td> -->

                    <td>
                        <form @submit.prevent="assign">
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