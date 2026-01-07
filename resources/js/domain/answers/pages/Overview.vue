<script setup lang="ts">
    import { ref } from 'vue';
    import Form from '../../answers/components/Form.vue';
    import { answerStore } from '../../answers/store';

    const props = defineProps({ answers_id: Array, ticket_id: Number})
    const answers_id = ref(props.answers_id);
    answerStore.actions.getAll();

    console.log(answers_id.value);

    const answers = answerStore.getters.getByIds(answers_id.value);

    const answer = ref({
        body: '',
        ticket_id: props.ticket_id,
    });

    const handleSubmit = async (data) => {
        console.log(data);
        await answerStore.actions.create(data);
        answer.value.body = '';
    }

</script>
<template>
    <div>
        <h3>Post an answer</h3>
        <Form :answer="answer" @submit="handleSubmit"/>
    </div>
    <div>
        <table v-if="answers.length">
            <thead>
                <tr>
                    <th>Answers</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="answer in answers" :key="answer.id">
                    <td>{{ answer.body }}</td>
                    <td><RouterLink :to="{name:'editAnswer', params:{id: Number(answer.id)}}">Edit</RouterLink></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>