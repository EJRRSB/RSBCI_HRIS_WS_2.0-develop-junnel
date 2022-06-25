import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useLocations() {
  const locations = ref([]);
  const location = ref([]);
  const errors = ref('')

  const postLocations = async (data) => {
    errors.value = ''
    try {
      // let response = await axios.post(config.apiURL + 'locations', data, { "headers": config.headers }); 
      let response = await axios.post('/api/v1/' + 'locations', data, { "headers": config.headers }); 
      locations.value = response;

      console.log(locations.value);
    } catch (e) {
      errors.value = e.response.data;
    }
  }

  const getLocations = async () => {
    // let response = await axios.get(config.apiURL + 'locations', { "headers": config.headers });
    let response = await axios.get('/api/v1/'+ 'locations', { "headers": config.headers });
    locations.value = response.data.data;
  }

  const getLocation = async (id) => {
    // let response = await axios.get(config.apiURL + 'locations/' + id, { "headers": config.headers });
    let response = await axios.get('/api/v1/' + 'locations/' + id, { "headers": config.headers });
    location.value = response.data;
  }

  const getLocationsList = async () => {
    // let response = await axios.get(config.apiURL + 'locations', { "headers": config.headers });
    let response = await axios.get('/api/v1/'+ 'locations', { "headers": config.headers });
    console.log(response)
    let newLocations = {}
    let data = response.data.data;
    for (let item in data) {
      newLocations[data[item].id] = data[item].location_code + " - " + data[item].street_address + " " + data[item].city + " " + data[item].province;
    }
    locations.value = newLocations;
    console.log(locations.value)
  }

  const putLocations = async (id, data) => {
    errors.value = ''
    try {
      // let response = await axios.put(config.apiURL + 'locations/' + id, data, { "headers": config.headers });
      let response = await axios.put('/api/v1/' + 'locations/' + id, data, { "headers": config.headers });

      locations.value = response;
    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }
  }

  const deleteLocation = async (id) => {
    try {
      // let response = await axios.delete(config.apiURL + 'locations/' + id, { "headers": config.headers });
      let response = await axios.delete('/api/v1/' + 'locations/' + id, { "headers": config.headers });
      console.log(response)
      locations.value = response.data.data;
    } catch (e) {
      errors.value = e.response.data;
    }

  }



  return {
    postLocations, getLocations, getLocation, getLocationsList, putLocations, deleteLocation, errors, locations, location
  }
}