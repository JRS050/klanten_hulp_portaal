<script setup lang="ts">
    import { computed, onMounted, ref } from 'vue';
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

    const answers_ids = ticket.value.answers_ids;

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
     
    <!-- <div>
        <h3>Post an answer</h3>
        <Form :answer="answer" @submit="handleSubmitAnswer"/>
    </div>
    <div>
        <table v-if="answers.length > 0">
            <thead>
                <tr>
                    <th>Answers</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="answer in answers" :key="answer.id">
                    <td>{{ answer.body }}</td>
                    <td><RouterLink :to="{name:'editAnswer', params:{id: answer.id}}">Edit</RouterLink></td>
                </tr>
            </tbody>
        </table>
    </div> -->
    <!-- Notes section -->
    <!-- <div>
        <h3>Notes</h3>
        <NotesForm :note="note" @submit="handleSubmitNote"/>
        <table v-if="notes.length > 0">
            <thead>
                <tr>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="note in notes" :key="note.id">
                    <td>{{ note.body }}</td>
                    <td><RouterLink :to="{name:'editNote', params:{id: note.id}}">Edit</RouterLink></td>
                    <td><button @click="deleteNote(note.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div> -->
</template>