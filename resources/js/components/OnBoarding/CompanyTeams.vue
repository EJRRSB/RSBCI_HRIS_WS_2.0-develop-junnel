<template>
  <div id="company-locations" class="onboarding-form-frame">
    <div class="onboarding-progress-bar">
      <img src="assets/images/bar-5.svg" />
    </div>

    <div class="onboarding-form-container">
      <div class="form-titlebar">
        <div style="width: 25%"></div>
        <h3 style="width: 50%">Company Teams</h3>
        <div class="add-container" @click="openAddTeamForm">
          <img src="assets/images/add-white-icon.svg" />
          <h5>Add Teams</h5>
        </div>
      </div>

      <div class="form-content-add" v-if="showForm">
        <InputSelect
          :options="companies"
          label="Company"
          :isRequired="true"
          placeHolder="Select Company"
          v-model:value="form.company_id"
          :key="form.company_id"
          :errorMessage="data_errors.company_id"
        />
        <InputSelect
          :options="divisions"
          label="Division"
          placeHolder="Select Division"
          v-model:value="form.division_id"
          :key="form.division_id"
          :errorMessage="data_errors.division_id"
        />
        <InputSelect
          :options="departments"
          label="Department"
          placeHolder="Select Department"
          v-model:value="form.department_id"
          :key="form.department_id"
          :errorMessage="data_errors.department_id"
        />
        <InputText
          label="Team Name"
          :isRequired="true"
          placeHolder="Enter Team Name"
          v-model:value="form.team_name"
          :key="form.team_name"
          :errorMessage="data_errors.team_name"
        />

        <InputSelect
          :options="locations"
          label="Location"
          placeHolder="Select Location"
          v-model:value="form.location_id"
          :key="form.location_id"
          :errorMessage="data_errors.location_id"
        />

        <div class="button-container">
          <button v-if="isAddForm" class="blue-btn" @click.prevent="resetForm">
            Clear
          </button>
          <button v-if="isAddForm" class="save-btn" @click.prevent="storeTeam">
            Save
          </button>
          <button v-else class="save-btn" @click.prevent="updateTeams">
            Update
          </button>
        </div>
      </div>

      <div class="table-titlebar">
        <h3>Saved Teams</h3>
      </div>

      <div class="table-content-onboarding">
        <Loading message="Data Loading" :isLarge="false" v-show="!showTable" />
        <table
          class="saved-table"
          border="0"
          cellspacing="0"
          cellpadding="10px"
          v-show="showTable"
        >
          <tbody>
            <tr class="table-labels">
              <td>Team Name</td>
              <td>Team Code</td>
              <td>Location Code</td>
              <td>Actions</td>
            </tr>

            <tr v-for="row in teams" v-bind:key="row.id">
              <td>{{ row.team_name }}</td>
              <td>{{ row.team_code }}</td>
              <td v-if="row.location">{{ row.location.location_code }}</td>
              <td v-else></td>
              <td class="table-cell-actions">
                <div class="table-edit" @click="editTeams(row.id)">EDIT</div>
                <div
                  class="table-delete"
                  @click="showDeleteConfirmation(row.id, row.team_name)"
                >
                  DELETE
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="saved-button-row">
          <div>
            <button
              id="locations-back"
              class="back-btn"
              @click="$emit('prevPage')"
            >
              Back
            </button>
          </div>
          <div>
            <!-- <button class="skip-btn" @click="$emit('skip')">
              Skip For Now
            </button> -->
            <button
              class="next-btn"
              @click="showConfirmationDoneModal = !showConfirmationDoneModal"
            >
              Done
            </button>
          </div>
        </div>
      </div>
    </div>
    <ConfirmationModal
      v-if="showConfirmationModal"
      :id="teamDeleteName"
      @confirm="confirmDeleteTeam"
      @closeModal="showConfirmationModal = !showConfirmationModal"
    />

    <ConfirmationModal
      v-if="showConfirmationDoneModal"
      message="This will end the company onboarding."
      yesButtonLabel="Confirm"
      @confirm="$emit('nextPage')"
      @closeModal="showConfirmationDoneModal = !showConfirmationDoneModal"
    />
    
    <LoaderModal v-if="isShowed"/>
  </div>
</template>

<script>
import LoaderModal from '../../components/Forms/LoaderModal.vue'
import InputText from '../../components/Forms/InputText.vue'
import InputSelect from '../../components/Forms/InputSelect.vue'
import useLocations from '../../Api/locations'
import useDivisions from '../../Api/divisions'
import useCompanies from '../../Api/companies'
import useDepartments from '../../Api/departments'
import useTeams from '../../Api/teams'
import Toasts from '../../components/Notifs/Toasts.vue'
import ConfirmationModal from '../../components/Notifs/ConfirmationModal.vue'
import { onBeforeMount, reactive, ref, watch, watchEffect } from 'vue'
import Loading from '../../components/Loading.vue'
export default {
  components: {
    LoaderModal,
    InputText,
    InputSelect,
    Toasts,
    ConfirmationModal,
    Loading,
  },
  props: {
    currentCompanyID: [Number, String],
  },
  emits: ['nextPage', 'prevPage', 'skip'],
  setup(props, context) {
    const {
      postTeams,
      getTeam,
      getTeams,
      teams,
      team,
      putTeam,
      deleteTeam,
      errors,
    } = useTeams()
    const showForm = ref(false)
    const isAddForm = ref(true)
    const showToast = ref(false)
    const teamID = ref('') //Reference for Updating Team
    const teamDeleteID = ref('') //Reference for Deleting Team
    const teamDeleteName = ref('') //Reference for Deleting Team
    const showConfirmationModal = ref(false)
    const showConfirmationDoneModal = ref(false)
    const showTable = ref(false)

    const form = reactive({
      company_id: '',
      location_id: '',
      division_id: '',
      department_id: '',
      team_name: '',
    })
    //Error Message
    const data_errors = reactive({
      company_id: '',
      location_id: '',
      division_id: '',
      department_id: '',
      team_name: '',
    })
    //Catch Errors
    watch(errors, () => {
      //Reset Value First
      resetErrorData()
      //Assign Errors
      for (let item in errors.value.errors) {
        data_errors[item] = errors.value.errors[item]
      }
    })
    //Reset Errors Form
    const resetErrorData = () => {
      data_errors.company_id = ''
      data_errors.location_id = ''
      data_errors.division_id = ''
      data_errors.team_name = ''
      data_errors.department_id = ''
    }

    //Reset Form
    const resetForm = () => {
      resetErrorData()
      form.company_id = ''
      form.location_id = ''
      form.division_id = ''
      form.team_name = ''
      form.department_id = ''
    }

    //Get Companies
    const { getCompaniesName, companies } = useCompanies()
    onBeforeMount(getCompaniesName)
    onBeforeMount(() => {
      form.company_id = props.currentCompanyID
    })

    //Get Locations
    const { getLocationsList, locations } = useLocations()
    onBeforeMount(getLocationsList)

    //Get Divisions
    const { getDivisionsList, divisions } = useDivisions()
    onBeforeMount(getDivisionsList)

    //Get Departments
    const { getDepartmentsList, departments } = useDepartments()
    onBeforeMount(getDepartmentsList)

    //Add Form Button
    const openAddTeamForm = () => {
      form.company_id = props.currentCompanyID
      //If Form is at Edit state make it on Add form state
      if (!showForm.value) {
        if (!isAddForm.value) {
          showForm.value = false
          isAddForm.value = true
        }
        form.location_id = ''
        form.division_id = ''
        form.department_id = ''
        form.team_name = ''
        showForm.value = true
      } else {
        showForm.value = false
      }
    }

    //Get Teams
    onBeforeMount(getTeams)


    const isShowed = ref(false) // modal

    //Post Locations
    const storeTeam = async () => {
      isShowed.value = true; // modal show
      await postTeams(form)
      if (teams.value.status == 200) {
        context.emit('showToast')
        openAddTeamForm()
        showTeams()
      }
      isShowed.value = false; // modal close  
    }

    //Show Teams
    const showTeams = async () => {
      isShowed.value = true; // modal show
      //Can Add Loading Here
      showTable.value = false
      await getTeams()
      showTable.value = true
      isShowed.value = false; // modal close  
    }

    //Get Teams
    onBeforeMount(showTeams)

    //Edit Location
    const editTeams = async (id) => {
      isShowed.value = true; // modal show
      showForm.value = false
      isAddForm.value = false
      await getTeam(id)
      isShowed.value = false; // modal close  
    }

    //Update
    const updateTeams = async () => {
      isShowed.value = true; // modal show
      await putTeam(teamID.value, form)
      if (teams.value.status == 200) {
        context.emit('showToast')
        openAddTeamForm()
        showTeams()
      }
      isShowed.value = false; // modal close  
    }

    watch(team, () => {
      teamID.value = team.value.id
      form.company_id = team.value.company_id
      if (team.value.division) {
        form.division_id = team.value.division_id
      } else {
        form.division_id = ''
      }
      if (team.value.location) {
        form.location_id = team.value.location_id
      } else {
        form.location_id = ''
      }
      if (team.value.department) {
        form.department_id = team.value.department_id
      } else {
        form.department_id = ''
      }

      form.team_name = team.value.team_name
      showForm.value = true
    })

    //Delete Locations
    const showDeleteConfirmation = (id, name) => {
      teamDeleteID.value = id
      teamDeleteName.value = name
      showConfirmationModal.value = true
    }
    const confirmDeleteTeam = async () => {
      isShowed.value = true; // modal show
      showTable.value = false
      showConfirmationModal.value = false
      await deleteTeam(teamDeleteID.value)
      await getTeams()
      context.emit('showToast')
      showForm.value = false
      showTable.value = true
      isShowed.value = false; // modal close  
    }

    return {
      isShowed,
      team,
      teams,
      departments,
      divisions,
      companies,
      locations,
      form,
      storeTeam,
      editTeams,
      updateTeams,
      showDeleteConfirmation,
      isAddForm,
      openAddTeamForm,
      showConfirmationModal,
      showForm,
      teamDeleteID,
      confirmDeleteTeam,
      data_errors,
      teamDeleteName,
      showTable,
      showConfirmationDoneModal,
      resetForm,
    }
  },
}
</script>
<style></style>
