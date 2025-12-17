<script lang="ts" setup>
    import { useRoute, useRouter } from 'vue-router';
    import { noteStore } from '../store';
import Navigation from '../../../components/Navigation.vue';
import NotesForm from '../components/NotesForm.vue';

    const route = useRoute();
    const router = useRouter();

    const note = noteStore.getters.getById(route.params.id);

    const updateNote = async (id,data) => {
        await noteStore.actions.update(id, data);
    };

    const handleSubmit = async (data) => {
        await updateNote(route.params.id, data);
        router.push({name: 'myNotes'});
    }
</script>
<template>
    <Navigation />
    <h2>Edit note</h2>
    <NotesForm v-if="note" :note="note" @submit="handleSubmit" />
</template>