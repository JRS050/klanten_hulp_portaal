<script setup lang="ts">
    import {ref} from 'vue';
    import errorMessage from '../../../services/error/errorMessage.vue';
    import Logout from '../../../components/Logout.vue';
    import Navigation from '../../../components/Navigation.vue';
    import AdminNavigation from '../../../components/AdminNavigation.vue';
    import { usersStore } from '../store';

    usersStore.actions.getAll();
    const users = usersStore.getters.all;

    const deleteUser = async (id) =>{
        await usersStore.actions.delete(id);
    }

</script>
<template>
    <Logout/>

    <Navigation/>

    <AdminNavigation/>

    <h2>Users overview</h2>

    <errorMessage/>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users">
                <td>{{ user.id }} </td>
                <td>{{ user.name }} </td>
                <td>{{ user.email }} </td>
                <td v-if="user.admin_status == 1">Admin </td>
                <td v-else>User</td>
                <td><RouterLink :to="{name:'editUser', params:{id: user.id}}">Edit</RouterLink>
                    <button @click="deleteUser(user.id)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>   