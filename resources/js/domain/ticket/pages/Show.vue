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

    ticketStore.actions.getAll();
    categoryStore.actions.getAll();
    noteStore.actions.getAll();
    

    const formPurpose = [
        "Admin Update",
    ]
    const route = useRoute();

    const ticket = ticketStore.getters.getById(route.params.id);
    console.log(ticket.value);

    const answers_ids = ref(ticket.value.answers_ids);

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
                    <td>
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
        <Overview :answers_id="answers_ids" :ticket_id="Number(route.params.id)"/>
    </div>

    <!-- Notes section -->
    <div v-if="ticket">
        <NotesOverview :notes_id="ticket.notes_ids" :ticket_id="Number(route.params.id)"/>
    </div> 
</template>