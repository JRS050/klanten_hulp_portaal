<script setup lang="ts">


    const handleSubmit = async (data) => {
        await updateStatus(route.params.id, data);
    }
</script>
<template>
    <form @submit.prevent="handleSubmit(ticket.status)">
            <select required name="status" id="status" v-model="ticket.status">
                <option v-for="status in Status" :value="Status">{{ ticket.status }}</option>
            </select>
        <button type="submit">Update Status</button>
    </form>
</template>