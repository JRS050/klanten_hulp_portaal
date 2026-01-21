import { computed } from 'vue';
import { getRequest } from '../services/http';

export const adminAuth = computed (() => getRequest('/admin-access'));
