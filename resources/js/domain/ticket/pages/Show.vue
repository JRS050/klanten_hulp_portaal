<script setup lang="ts">
    import { ref } from 'vue';
    import Logout from '../../../components/Logout.vue';
    import Navigation from '../../../components/Navigation.vue';
    import { ticketStore } from '../store';
    import { useRoute } from 'vue-router';
    import { getRequest } from '../../../services/http';
    import Form2 from '../components/Form2.vue';
    import { categoryStore } from '../../categories/store';
    import errorMessage from '../../../services/error/errorMessage.vue';
    import { noteStore } from '../../notes/store';
    import Overview from '../../answers/pages/Overview.vue';
    import NotesOverview from '../../notes/pages/NotesOverview.vue';
import AdminNavigation from '../../../components/AdminNavigation.vue';

    ticketStore.actions.getAll();
    categoryStore.actions.getAll();

    const adminAccess = ref();

    async function checkAdminAccess() {
        try {
            const response = await getRequest('/admin-access');
            adminAccess.value = response.data;
            console.log(adminAccess.value);
            return response;
        } catch (error) {
            console.error('Admin access check failed:', error);
            return error;
        }
    }

    checkAdminAccess();
    

    const formPurpose = [
        "Admin Update",
    ]
    const route = useRoute();

    const ticket = ticketStore.getters.getById(route.params.id);
    console.log(ticket.value);

    const user = ref();
    const error = ref();

    async function fetchUserData(){
        try {
            const response = await getRequest('/me');
            user.value = response.data;
            console.log('User Data:', response.data);
        return response.data;
   
        } catch (error) {
            console.error('Error fetching user data:', error);
            return error;
        }
    }

    fetchUserData();

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

    <div v-if="adminAccess==1">
        <AdminNavigation/>
    </div>

    <errorMessage/>

    <div>
        <table v-if="ticket">
            <thead>
                <tr>
                    <th>Title:{{ ticket.title }}</th>
                    <th>
                        Categories:{{ categoryStore.getters.getByIds(ticket.category_ids).value.map(c => c.title).join(', ') }}
                        <br></br>
                        Status:{{ ticket.status }}
                    </th>
                    <td v-if="adminAccess==1">
                        <Form2 :ticket="ticket" :purpose="formPurpose[0]" @submit="handleSubmit" />
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
    <br></br>
    <!-- Answers section -->
    <div v-if="ticket">
        <Overview :answers_id="ticket.answers_ids" :ticket_id="Number(route.params.id)"/>
    </div>

    <!-- Notes section -->
    <div v-if="ticket && adminAccess==1">
        <NotesOverview :notes_id="ticket.notes_ids" :ticket_id="Number(route.params.id)"/>
    </div> 
</template>