<script setup lang="ts">
    import { ref } from 'vue';
    import { noteStore } from '../store';
    import NotesForm from '../components/NotesForm.vue';

    const props = defineProps({ notes_id:Array, ticket_id: Number});
    const notes_ids = ref(props.notes_id);
    noteStore.actions.getAll();

    const notes = noteStore.getters.getByIds(notes_ids.value);

    const note = ref({
        body: '',
        ticket_id: props.ticket_id,
    });

    const handleSubmit = async (data) => {
        await noteStore.actions.create(data);
        note.value.body = ''
    };

    const deleteNote = async (id) => {
        await noteStore.actions.delete(id);
    };

</script>
<template>
    <div>
        <h3>Post a note</h3>
        <NotesForm :note="note" @submit="handleSubmit"/>
    </div>
    <table v-if="notes.length">
        <thead>
            <tr>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="note in notes" :key="note.id">
                <td>{{ note.body }}</td>
                <td><RouterLink :to="{name:'editNote', params:{id: Number(note.id)}}">Edit</RouterLink></td>
                <td><button @click="deleteNote(note.id)">Delete</button></td>
            </tr>
        </tbody>
    </table>
</template>