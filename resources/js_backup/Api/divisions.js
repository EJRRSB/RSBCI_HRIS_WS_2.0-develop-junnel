import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useDivisions() {
  const divisions = ref([]);
  const division = ref([]);
  const errors = ref('')

  const postDivisions = async (data) => {
    errors.value = ''
    try {
      let response = await axios.post(config.baseURL + 'divisions', data, { "headers": config.headers });
      divisions.value = response;
    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }
  }

  const getDivisions = async () => {
    let response = await axios.get(config.baseURL + 'divisions', { "headers": config.headers });
    divisions.value = response.data.data;
  }

  const getDivision = async (id) => {
    let response = await axios.get(config.baseURL + 'divisions/' + id, { "headers": config.headers });
    division.value = response.data;
    console.log(division.value)
  }

  const getDivisionsList = async () => {
    let response = await axios.get(config.baseURL + 'divisions', { "headers": config.headers });
    console.log(response)
    let newLocations = {}
    let data = response.data.data;
    for (let item in data) {
      newLocations[data[item].id] = data[item].division_name;
    }
    divisions.value = newLocations;
    console.log(divisions.value)
  }


  const putDivision = async (id, data) => {
    errors.value = ''
    try {
      let response = await axios.put(config.baseURL + 'divisions/' + id, data, { "headers": config.headers });
      divisions.value = response;

    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }
  }

  const deleteDivision = async (id) => {
    try {
      let response = await axios.delete(config.baseURL + 'divisions/' + id, { "headers": config.headers });
      console.log(response)
      console.log(divisions.value);
    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }



    //division.value = response.data;
  }



  return {
    postDivisions, getDivisions, getDivision, getDivisionsList, putDivision, deleteDivision, errors, divisions, division
  }
}