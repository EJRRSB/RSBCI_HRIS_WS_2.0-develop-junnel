import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useUsers() {
    const users = ref([]);
    const _username = ref([]);
    const _email = ref([]);
    const errors = ref('');
    // const storeCompany = async(data) => {

    //     errors.value = ''
    //     try {
    //         let response = await axios.post(config.baseURL + 'companies', data, { "headers": config.headersFileUpload });
    //         companies.value = response;
    //     } catch (e) {
    //         errors.value = e.response.data;
    //         console.log(e.response.data);
    //     }
    // }
    // const getCompaniesName = async() => {
    //     let response = await axios.get(config.baseURL + 'companies', { "headers": config.headers });
    //     let newCompanies = {}
    //     let data = response.data.data
    //     for (let item in data) {
    //         newCompanies[data[item].id] = data[item].company_name;
    //     }
    //     companies.value = newCompanies;
    // }

    // const putCompany = async(id, data) => {
    //     errors.value = ''


    //     try {
    //         let response = await axios.put(config.baseURL + 'companies/' + id, data, { "headers": config.headersFileUpload });
    //         companies.value = response;

    //     } catch (e) {
    //         errors.value = e.response.data;
    //     }
    // }

    const validateWorkEmail = async(work_email_address) => {
        let response = await axios.post(config.apiURL + 'validate/work_email_address/', { 'work_email_address': work_email_address }, { "headers": config.headers });
        console.log("EMAIL RESPONE");
        console.log(response)
        _email.value = response;

    }

    const validateUsername = async(uname) => {
        let response = await axios.post(config.apiURL + 'validate/username/', { 'username': uname }, { "headers": config.headers });
        _username.value = response;
        console.log(response);

    }




    return {
        validateWorkEmail,
        validateUsername,
        _username,
        users,
        _email,
        errors
    }
}