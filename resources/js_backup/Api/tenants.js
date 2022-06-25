import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useTenants() {
    const tenant = ref([]);
    const errors = ref('')


    const getTenant = async() => {
        let response = await axios.get(config.baseURL + 'landlords/clients', { "headers": config.headers });
        tenant.value = response.data;
    }
    return {
        getTenant,
        errors,
        tenant
    }
}