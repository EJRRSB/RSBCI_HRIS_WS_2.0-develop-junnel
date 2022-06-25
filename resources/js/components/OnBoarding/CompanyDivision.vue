<template>
  <div id="company-locations" class="onboarding-form-frame">
    <div class="onboarding-progress-bar">
      <img src="assets/images/bar-3.svg" />
    </div>

    <div class="onboarding-form-container">
      <div class="form-titlebar">
        <div style="width: 25%"></div>
        <h3 style="width: 50%">Company Divisions</h3>
        <div class="add-container" @click="openAddDivisionForm">
          <img src="assets/images/add-white-icon.svg" />
          <h5>Add Division</h5>
        </div>
      </div>
      <Transition name="slide">
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
          <InputText
            label="Division Name"
            :isRequired="true"
            placeHolder="Enter Division Name"
            v-model:value="form.division_name"
            :key="form.division_name"
            :errorMessage="data_errors.division_name"
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
            <button
              v-if="isAddForm"
              class="blue-btn"
              @click.prevent="resetForm"
            >
              Clear
            </button>
            <button
              v-if="isAddForm"
              class="save-btn"
              @click.prevent="storeDivisions"
            >
              Save
            </button>
            <button v-else class="save-btn" @click.prevent="updateLocation">
              Update
            </button>
          </div>
        </div>
      </Transition>
      <div class="table-titlebar">
        <h3>Saved Divisions</h3>
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
              <td>Division Name</td>
              <td>Division Code</td>
              <td>Location Code</td>
              <td>Actions</td>
            </tr>

            <tr v-for="row in divisions" v-bind:key="row.id">
              <td>{{ row.division_name }}</td>
              <td>{{ row.division_code }}</td>
              <td v-if="row.location">{{ row.location.location_code }}</td>
              <td v-else></td>
              <td class="table-cell-actions">
                <div class="table-edit" @click="editDivisions(row.id)">
                  EDIT
                </div>
                <div
                  class="table-delete"
                  @click="showDeleteConfirmation(row.id, row.division_name)"
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
            <button
              class="skip-btn"
              @click="showConfirmationDoneModal = !showConfirmationDoneModal"
            >
              Skip For Now
            </button>
            <button class="next-btn" @click="$emit('nextPage')">Next</button>
          </div>
        </div>
      </div>
    </div>
    <ConfirmationModal
      v-if="showConfirmationModal"
      :id="divisionDeleteName"
      @confirm="confirmDeleteLocation"
      @closeModal="showConfirmationModal = !showConfirmationModal"
    />
    <ConfirmationModal
      v-if="showConfirmationDoneModal"
      message="You are about to skip the company onboarding process."
      yesButtonLabel="Confirm"
      @confirm="$emit('skip')"
      @closeModal="showConfirmationDoneModal = !showConfirmationDoneModal"
    />
    
    <LoaderModal v-if="isShowed"/>
  </div>
</template>

<script>
import LoaderModal from '../../components/Forms/LoaderModal.vue'
import InputText from "../../components/Forms/InputText.vue";
import InputSelect from "../../components/Forms/InputSelect.vue";
import useLocations from "../../Api/locations";
import useDivisions from "../../Api/divisions";
import useCompanies from "../../Api/companies";
import Toasts from "../../components/Notifs/Toasts.vue";
import ConfirmationModal from "../../components/Notifs/ConfirmationModal.vue"; 
import Loading from '../../components/Loading.vue' 
import { onBeforeMount, reactive, ref, watch, watchEffect } from 'vue'
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
      postDivisions,
      getDivision,
      getDivisions,
      divisions,
      division,
      putDivision,
      deleteDivision,
      errors,
    } = useDivisions()
    const showForm = ref(false)
    const isAddForm = ref(true)
    const divisionID = ref('') //Reference for Updating Division
    const divisionDeleteID = ref('') //Reference for Deleting Division
    const divisionDeleteName = ref('') //Reference for Deleting Division
    const showConfirmationModal = ref(false)
    const showTable = ref(false)
    const showConfirmationDoneModal = ref(false)
    const form = reactive({
      company_id: '',
      location_id: '',
      division_name: '',
    })

    //Error Message
    const data_errors = reactive({
      company_id: '',
      location_id: '',
      division_name: '',
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
    //Reset Form
    const resetErrorData = () => {
      data_errors.company_id = ''
      data_errors.location_id = ''
      data_errors.division_name = ''
    }

    const resetForm = () => {
      resetErrorData()
      form.company_id = ''
      form.location_id = ''
      form.division_name = ''
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

    //Add Form Button
    const openAddDivisionForm = () => {
      //If Form is at Edit state make it on Add form state
      form.company_id = props.currentCompanyID
      if (!showForm.value) {
        if (!isAddForm.value) {
          showForm.value = false
          isAddForm.value = true
        }
        form.division_name = ''
        form.location_id = ''
        showForm.value = true
      } else {
        showForm.value = false
      }
    }

    
    const isShowed = ref(false) // modal


    //Post Divisions
    const storeDivisions = async () => {
      isShowed.value = true; // modal show
      await postDivisions(form)
      if (divisions.value.status == 200) {
        context.emit('showToast')
        openAddDivisionForm()
        showDivisions()
      }
      isShowed.value = false; // modal close  
    }

    // Show Divisions
    const showDivisions = async () => {
      isShowed.value = true; // modal show
      //Can Add Loading Here
      showTable.value = false
      await getDivisions()
      showTable.value = true
      isShowed.value = false; // modal close  
    }

    //Get Divisions
    onBeforeMount(showDivisions)

    //Edit Location
    const editDivisions = async (id) => {
      isShowed.value = true; // modal show
      showForm.value = false
      isAddForm.value = false
      getDivision(id)
      isShowed.value = false; // modal close  
    }

    const updateLocation = async () => {
      isShowed.value = true; // modal show
      await putDivision(divisionID.value, form)
      if (divisions.value.status == 200) {
        context.emit('showToast')
        openAddDivisionForm()
        await showDivisions()
      }
      isShowed.value = false; // modal close  
    }

    watch(division, () => {
      divisionID.value = division.value.id
      form.company_id = division.value.company_id
      if (division.value.location) {
        form.location_id = division.value.location_id
      } else {
        form.location_id = ''
      }
      form.division_name = division.value.division_name
      showForm.value = true
    })

    //Delete Location
    const showDeleteConfirmation = (id, name) => {
      divisionDeleteID.value = id
      divisionDeleteName.value = name
      showConfirmationModal.value = true
    }
    const confirmDeleteLocation = async () => {
      isShowed.value = true; // modal show
      showTable.value = false
      showConfirmationModal.value = false
      await deleteDivision(divisionDeleteID.value)
      await getDivisions()
      context.emit('showToast')
      showForm.value = false
      showTable.value = true
      isShowed.value = false; // modal close  
    }

    return {
      isShowed,
      divisions,
      companies,
      locations,
      form,
      storeDivisions,
      editDivisions,
      updateLocation,
      showDeleteConfirmation,
      isAddForm,
      openAddDivisionForm,
      showConfirmationModal,
      showForm,
      divisionDeleteID,
      confirmDeleteLocation,
      data_errors,
      divisionDeleteName,
      showTable,
      showConfirmationDoneModal,
      resetForm,
    }
  },
}
</script>
<style></style>
