import { getRequest } from '../services/http';

export const adminAuth = async () => {
        await getRequest('/admin-access');
};
