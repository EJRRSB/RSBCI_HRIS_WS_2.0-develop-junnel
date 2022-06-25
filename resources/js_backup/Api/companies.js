import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useCompanies() {
    const companies = ref([]);
    const errors = ref('')
    const storeCompany = async(data) => {

        errors.value = ''
        try {
            let response = await axios.post(config.baseURL + 'companies', data, { "headers": config.headersFileUpload });
            companies.value = response;
        } catch (e) {
            errors.value = e.response.data;
            console.log(e.response.data);
        }
    }
    const getCompaniesName = async() => {
        let response = await axios.get(config.baseURL + 'companies', { "headers": config.headers });
        let newCompanies = {}
        let data = response.data.data
        for (let item in data) {
            newCompanies[data[item].id] = data[item].company_name;
        }
        companies.value = newCompanies;
    }

    const putCompany = async(id, data) => {
        errors.value = ''


        try {
            let response = await axios.put(config.baseURL + 'companies/' + id, data, { "headers": config.headersFileUpload });
            companies.value = response;

        } catch (e) {
            errors.value = e.response.data;
        }
    }

    const getCompanyCode = async(company_code) => {
        let response = await axios.post(config.apiURL + 'validate/company_code/', { 'company_code': company_code }, { "headers": config.headers });
        companies.value = response;

    }


    return {
        companies,
        storeCompany,
        putCompany,
        getCompaniesName,
        getCompanyCode,
        errors
    }
}