<script setup lang="ts">
    import { ref } from 'vue';
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


    categoryStore.actions.getAll();

    const formPurpose = [
        "Admin Update",
    ]

    console.log(Status);
    const route = useRoute();

    console.log(ticketStore);

    ticketStore.actions.getAll();

    const ticket = ticketStore.getters.getById(route.params.id);

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

    answerStore.actions.getAll();

    const answers = answerStore.getters.getByIds(ticket.value.answers_ids);

    const answer = ref({
        body: '',
        ticket_id: route.params.id,
    });

    const postAnswer = async (data) => {
        await answerStore.actions.create(data);
        // Clear the form after submission
        answer.value.body = '';
    };

</script>
<template>


    <Logout/>

    <Navigation/>

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
        <Form :answer="answer" @submit="postAnswer"/>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Answers</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="answer in answers" :key="answer.id">
                    <td>{{ answer.body }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>