<script setup lang="ts">
    import { ref } from 'vue';
    import Logout from '../../../components/Logout.vue';
    import Navigation from '../../../components/Navigation.vue';
    import { ticketStore } from '../store';
    import { useRoute, useRouter } from 'vue-router';
    import { getRequest } from '../../../services/http';

    const route = useRoute();
    ticketStore.actions.getAll();

    const ticket = ticketStore.getters.getById(route.params.id);
    console.log(ticket.value);

    const user = ref();
    const error = ref();
    const form = ref({...ticket});

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

    //assign admin to ticket
    const updateTicket = async (id,data) => {
        await ticketStore.actions.update(id, data);
    };

    const handleSubmit = async (data) => {
        await updateTicket(route.params.id, data);
    }

</script>
<template>


    <Logout/>

    <Navigation/>

    <div>
        <table>
            <tr>
                <th>Title:{{ ticket.title }}</th>

                <td v-if="user.admin_status === 1">
                    <form @submit.prevent="handleSubmit(ticket.id)">
                        <select required name="admin_id" id="admin_id" v-model="form">
                            <option v-for="admin in admin_list" :value="admin.id">{{ admin.name }}</option>

                        </select>
                        <button type="submit">Assign</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    {{ ticket.body }}
                </td>
            </tr>
        </table>
    </div>
</template>