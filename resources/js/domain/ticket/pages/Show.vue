<script setup lang="ts">
    import { computed, onMounted, ref } from 'vue';
    import Logout from '../../../components/Logout.vue';
    import Navigation from '../../../components/Navigation.vue';
    import { ticketStore } from '../store';
    import { useRoute } from 'vue-router';
    import { getRequest } from '../../../services/http';
    import { Status } from '../status';
    import Form2 from '../components/Form2.vue';
    import Form from '../../answers/components/Form.vue';
    import { categoryStore } from '../../categories/store';
    import { answerStore } from '../../answers/store';
    import errorMessage from '../../../services/error/errorMessage.vue';
    import { noteStore } from '../../notes/store';
    import NotesForm from '../../notes/components/NotesForm.vue';

    ticketStore.actions.getAll();
    categoryStore.actions.getAll();
    answerStore.actions.getAll();
    noteStore.actions.getAll();
    

    const formPurpose = [
        "Admin Update",
    ]
    const route = useRoute();

    const ticket = ticketStore.getters.getById(route.params.id);

    const answers = answerStore.getters.getByIds(ticket.value.answers_ids);

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

    //Answer logic

    const answer = ref({
        body: '',
        ticket_id: route.params.id,
    });

    const postAnswer = async (data) => {
        await answerStore.actions.create(data);
        answer.value.body = '';
    };

    const handleSubmitAnswer = async (data) => {
        await postAnswer(data);
    };

    //Notes logic

    const notes = noteStore.getters.getByIds(ticket.value.notes_ids);

    const note = ref({
        body: '',
        ticket_id: route.params.id,
    });

    const postNote = async (data) => {
        await noteStore.actions.create(data);
        note.value = {
        body: '',
        ticket_id: route.params.id,
    }
    };

    const handleSubmitNote = async (data) => {
        await postNote(data);
    };

    const deleteNote = async (id) => {
        await noteStore.actions.delete(id);
    };

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
    <div>
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
    </div>
    <!-- Notes section -->
    <div>
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
    </div>
</template>