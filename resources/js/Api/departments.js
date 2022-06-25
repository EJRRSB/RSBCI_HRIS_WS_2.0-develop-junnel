import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useDepartments() {
  const departments = ref([]);
  const department = ref([]);
  const errors = ref('')

  const postDepartments = async (data) => {
    errors.value = ''
    try {
      // let response = await axios.post(config.apiURL + 'departments', data, { "headers": config.headers });
      let response = await axios.post('/api/v1/'+ 'departments', data, { "headers": config.headers });
      departments.value = response;
    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }
  }

  const getDepartments = async () => {
    // let response = await axios.get(config.apiURL + 'departments', { "headers": config.headers });
    let response = await axios.get('/api/v1/' + 'departments', { "headers": config.headers }); 
    departments.value = response.data.data;  
  }

  const getDepartment = async (id) => {
    // let response = await axios.get(config.apiURL + 'departments/' + id, { "headers": config.headers });
    let response = await axios.get('/api/v1/' + 'departments/' + id, { "headers": config.headers });
    department.value = response.data;
    console.log(department.value)
  }

  const getDepartmentsList = async () => {
    let response = await axios.get('/api/v1/' + 'departments', { "headers": config.headers });
    console.log(response)
    let newLocations = {}
    let data = response.data.data;
    for (let item in data) {
      newLocations[data[item].id] = data[item].department_name;
    }
    departments.value = newLocations;
    console.log(departments.value)
  }

  const putDepartment = async (id, data) => {
    errors.value = ''
    try {
      // let response = await axios.put(config.apiURL + 'departments/' + id, data, { "headers": config.headers });
      let response = await axios.put('/api/v1/' + 'departments/' + id, data, { "headers": config.headers });
      departments.value = response;
    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }
  }

  const deleteDepartment = async (id) => {
    try {
      // let response = await axios.delete(config.apiURL + 'departments/' + id, { "headers": config.headers });
      let response = await axios.delete('/api/v1/'+ 'departments/' + id, { "headers": config.headers });
      console.log(response)
      console.log(departments.value);
    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }



    //department.value = response.data;
  }



  return {
    postDepartments, deleteDepartment, getDepartments, getDepartment, getDepartmentsList, putDepartment, deleteDepartment, errors, departments, department
  }
}