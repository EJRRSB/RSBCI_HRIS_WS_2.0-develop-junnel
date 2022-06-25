import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useCompanies() {
    const companies = ref([]);
    const errors = ref('')
    const storeCompany = async(data) => {

        errors.value = ''
        try {
            // let response = await axios.post(config.apiURL + 'companies', data, { "headers": config.headersFileUpload });
            let response = await axios.post('/api/v1/' + 'companies', data, { "headers": config.headersFileUpload });
            // if(response.data.errors){ 
            //     errors.value = response.data;
            // }else{ 
                companies.value = response;    
                console.log('FLAG 1');
                console.log(response.data);
            // }
        } catch (e) {
            errors.value = e.response.data; 
            console.log(e.response.data);
        }
    }
    const getCompaniesName = async() => {
        // let response = await axios.get(config.apiURL + 'companies', { "headers": config.headers });
        let response = await axios.get('/api/v1/' + 'companies', { "headers": config.headers });
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
            // let response = await axios.put(config.apiURL + 'companies/' + id, data, { "headers": config.headersFileUpload });
            // let response = await axios.put('/api/v1/' + 'companies/' + id, data, { "headers": config.headersFileUpload });
            companies.value = response;

        } catch (e) {
            errors.value = e.response.data;
        }
    }

    const getCompanyCode = async(company_code) => {
        // let response = await axios.post(config.apiURL + 'validate/company_code/', { 'company_code': company_code }, { "headers": config.headers });
        let response = await axios.post('/api/v1/' + 'validate/company_code/', { 'company_code': company_code }, { "headers": config.headers });
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