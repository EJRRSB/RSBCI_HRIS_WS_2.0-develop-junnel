import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useEmployees() {
    const employees = ref([]);
    const employee = ref([]);
    const errors = ref('')

    const postEmployee = async(data) => {
        errors.value = ''
        try {

            let response = await axios.post( 'api/v1/employee', data);
            // let response = await axios.post(config.apiURL + 'employee', data);

            if (response.data.errors) {
                errors.value = response.data.errors
            } else {
                employees.value = response;
            }
            if (response.data.data) {
                window.location.href = '/success'
            }

        } catch (e) {

            console.log(e);
        }
    }

    const getEmployees = async(status) => {
        let response;
        if (status === 0) {
            response = await axios.get('/api/v1/employee-list');
        } else {
            response = await axios.get('/api/v1/employee-list/' + status);
        }

        employees.value = response;
        console.log(response);
    }

    const activateEmployee = async(id) => {
        let response = await axios.post('/api/v1/update-status/' + id + '/1');
        employee.value = response;
    
    }

    const declineEmployee = async(id) => {
        let response = await axios.post('/api/v1/update-status/' + id + '/3');
        employee.value = response;
    }

    //   const getDivision = async (id) => {
    //     let response = await axios.get(config.baseURL + 'divisions/' + id, { "headers": config.headers });
    //     division.value = response.data;
    //     console.log(division.value)
    //   }

    //   const getDivisionsList = async () => {
    //     let response = await axios.get(config.baseURL + 'divisions', { "headers": config.headers });
    //     console.log(response)
    //     let newLocations = {}
    //     let data = response.data.data;
    //     for (let item in data) {
    //       newLocations[data[item].id] = data[item].division_name;
    //     }
    //     divisions.value = newLocations;
    //     console.log(divisions.value)
    //   }


    //   const putDivision = async (id, data) => {
    //     errors.value = ''
    //     try {
    //       let response = await axios.put(config.baseURL + 'divisions/' + id, data, { "headers": config.headers });
    //       divisions.value = response;

    //     } catch (e) {
    //       errors.value = e.response.data;
    //       console.log(errors.value);
    //     }
    //   }

    //   const deleteDivision = async (id) => {
    //     try {
    //       let response = await axios.delete(config.baseURL + 'divisions/' + id, { "headers": config.headers });
    //       console.log(response)
    //       console.log(divisions.value);
    //     } catch (e) {
    //       errors.value = e.response.data;
    //       console.log(errors.value);
    //     }



    //     //division.value = response.data;
    //   }



    return {
        postEmployee,
        getEmployees,
        activateEmployee,
        declineEmployee,
        errors,
        employees,
        employee
    }
}