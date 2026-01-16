import './bootstrap';
import { createApp } from "vue";
import App from "./App.vue";
import { router } from './router';

    async function fetchUserData(){
        try {
            const response = await getRequest('/me');
            user.value = response.data;
            console.log('User Data:', response.data);
        return response.data;
   
        } catch (error) {
            console.error('Error fetching user data:', error);
            return error;
        }
    }

    fetchUserData()
const app = createApp(App);
app.use(router);
app.mount("#app");