import { config } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
export default function useTeams() {
  const teams = ref([]);
  const team = ref([]);
  const errors = ref('')

  const postTeams = async (data) => {
    errors.value = ''
    try {
      // let response = await axios.post(config.apiURL + 'teams', data, { "headers": config.headers });
      let response = await axios.post('/api/v1/' + 'teams', data, { "headers": config.headers });
      teams.value = response;
      console.log(teams.value)
    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }
  }

  const getTeams = async () => {
    // let response = await axios.get(config.apiURL + 'teams', { "headers": config.headers });
    let response = await axios.get('/api/v1/' + 'teams', { "headers": config.headers });
    teams.value = response.data.data;
  }

  const getTeam = async (id) => {
    // let response = await axios.get(config.apiURL + 'teams/' + id, { "headers": config.headers });
    let response = await axios.get('/api/v1/' + 'teams/' + id, { "headers": config.headers });
    team.value = response.data;
    console.log(team.value)
  }

  const putTeam = async (id, data) => {
    errors.value = ''
    try {
      // let response = await axios.put(config.apiURL + 'teams/' + id, data, { "headers": config.headers });
      let response = await axios.put('/api/v1/' + 'teams/' + id, data, { "headers": config.headers });
      teams.value = response;
    } catch (e) {
      errors.value = e.response.data;
      console.log(errors.value);
    }
  }

  const deleteTeam = async (id) => {
    try {
      // let response = await axios.delete(config.apiURL + 'teams/' + id, { "headers": config.headers });
      let response = await axios.delete('/api/v1/' + 'teams/' + id, { "headers": config.headers });
     
    } catch (e) {
      errors.value = e.response.data;
    }



    //department.value = response.data;
  }



  return {
    postTeams, deleteTeam, getTeams, getTeam, putTeam, deleteTeam, errors, teams, team
  }
}