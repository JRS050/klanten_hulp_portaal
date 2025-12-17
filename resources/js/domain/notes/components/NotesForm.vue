<script setup lang="ts">
    import { ref } from 'vue';
    import errorMessage from '../../../services/error/errorMessage.vue';
    import FormError from '../../../services/error/FormError.vue';

    const props = defineProps({ note: Object});

    const emit = defineEmits(['submit']);

    const form = ref({ ...props.note });

    const handleSubmit = () => emit('submit', form.value);
</script>
<template>
    <errorMessage />

    <form @submit.prevent="handleSubmit">

        <p>Note</p>
        <textarea v-model="form.body"></textarea>
        <br>

        <button type="submit">Submit</button>
    </form>
</template>