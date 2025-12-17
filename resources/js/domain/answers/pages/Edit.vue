<script lang="ts"  setup>
    import Navigation from '../../../components/Navigation.vue';
    import { useRoute, useRouter } from 'vue-router';
    import Form from '../components/Form.vue';
    import { answerStore } from '../store';

    const route = useRoute();
    const router = useRouter();

    answerStore.actions.getAll();

    const answer = answerStore.getters.getById(route.params.id);

    const updateAnswer = async (id,data) => {
        await answerStore.actions.update(id, data);
    };

    const handleSubmit = async (data) => {
        await updateAnswer(route.params.id, data);
        history.back();
    }
</script>
<template>

    <Navigation/>
    
    <h2>Answer bewerken</h2>
    <Form v-if="answer" :answer="answer" @submit="handleSubmit" />
</template>