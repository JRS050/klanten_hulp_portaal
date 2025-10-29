<script setup lang="ts">
    import Logout from '../../../components/Logout.vue';
import Navigation from '../../../components/Navigation.vue';
import { ticketStore } from '../store';
    import { useRoute } from 'vue-router';

    const route = useRoute();
    ticketStore.actions.getAll();

    const ticket = ticketStore.getters.getById(route.params.id);
    console.log(ticket.value);
</script>
<template>


    <Logout/>

    <Navigation/>

    <div>
        <table>
            <tr>
                <th>Title:{{ ticket.title }}</th>
            </tr>
            <tr>
                <td>
                    {{ ticket.body }}
                </td>
            </tr>
        </table>
    </div>
</template>