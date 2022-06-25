<template>
  <div id="company-locations" class="onboarding-form-frame">
    <div class="onboarding-progress-bar">
      <img src="assets/images/bar-4.svg" />
    </div>

    <div class="onboarding-form-container">
      <div class="form-titlebar">
        <div style="width: 25%"></div>
        <h3 style="width: 50%">Company Departments</h3>
        <div class="add-container" @click="openAddDivisionForm">
          <img src="assets/images/add-white-icon.svg" />
          <h5>Add Department</h5>
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
        <InputText
          label="Department Name"
          :isRequired="true"
          placeHolder="Enter Department Name"
          v-model:value="form.department_name"
          :key="form.department_name"
          :errorMessage="data_errors.department_name"
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
          <button
            v-if="isAddForm"
            class="save-btn"
            @click.prevent="storeDeparment"
          >
            Save
          </button>
          <button v-else class="save-btn" @click.prevent="updateDepartments">
            Update
          </button>
        </div>
      </div>

      <div class="table-titlebar">
        <h3>Saved Departments</h3>
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
              <td>Department Name</td>
              <td>Department Code</td>
              <td>Location Code</td>
              <td>Actions</td>
            </tr>

            <tr v-for="row in departments" v-bind:key="row.id">
              <td>{{ row.department_name }}</td>
              <td>{{ row.department_code }}</td>
              <td v-if="row.location">{{ row.location.location_code }}</td>
              <td v-else></td>
              <td class="table-cell-actions">
                <div class="table-edit" @click="editDeparments(row.id)">
                  EDIT
                </div>
                <div
                  class="table-delete"
                  @click="showDeleteConfirmation(row.id, row.department_name)"
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
      :id="departmentDeleteName"
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
import useDepartments from "../../Api/departments";
import Toasts from "../../components/Notifs/Toasts.vue";
import ConfirmationModal from "../../components/Notifs/ConfirmationModal.vue";
import Loading from '../../components/Loading.vue'
import { onBeforeMount, reactive, ref, watch } from 'vue'
export default {
  components: {
    LoaderModal,
    InputText,
    InputSelect,
    Toasts,
    ConfirmationModal,
    Loading,
  },
  emits: ['nextPage', 'prevPage', 'skip'],
  props: {
    currentCompanyID: [Number, String],
  },
  setup(props, context) {
    const {
      postDepartments,
      getDepartment,
      getDepartments,
      departments,
      department,
      putDepartment,
      deleteDepartment,
      errors,
    } = useDepartments()
    const showForm = ref(false)
    const isAddForm = ref(true)
    const showToast = ref(false)
    const departmentID = ref('') //Reference for Updating Location
    const departmentDeleteID = ref('') //Reference for Deleting Location
    const departmentDeleteName = ref('') //Reference for Deleting Location
    const showConfirmationModal = ref(false)
    const showTable = ref(false)
    const showConfirmationDoneModal = ref(false)

    const form = reactive({
      company_id: '',
      location_id: '',
      division_id: '',
      department_name: '',
    })
    //Error Message
    const data_errors = reactive({
      company_id: '',
      location_id: '',
      division_id: '',
      department_name: '',
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
      data_errors.division_id = ''
      data_errors.department_name = ''
    }

    //Reset Form Errors
    const resetForm = () => {
      resetErrorData()
      form.company_id = ''
      form.location_id = ''
      form.division_id = ''
      form.department_name = ''
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

    //Add Form Button
    const openAddDivisionForm = () => {
      form.company_id = props.currentCompanyID

      //If Form is at Edit state make it on Add form state
      if (!showForm.value) {
        if (!isAddForm.value) {
          showForm.value = false
          isAddForm.value = true
        }
        form.division_id = ''
        form.department_name = ''
        form.location_id = ''
        showForm.value = true
      } else {
        showForm.value = false
      }
    }

    
    const isShowed = ref(false) // modal


    //Post Department
    const storeDeparment = async () => {
      isShowed.value = true; // modal show
      await postDepartments(form)
      if (departments.value.status == 200) {
        context.emit('showToast')
        openAddDivisionForm()
        showDepartments()
      }
      isShowed.value = false; // modal close  
    }

    //Show Departments
    const showDepartments = async () => {
      isShowed.value = true; // modal show
      //Can Add Loading Here
      showTable.value = false
      await getDepartments()
      showTable.value = true
      isShowed.value = false; // modal close  
    }

    //Get Department
    onBeforeMount(showDepartments)

    //Edit Department
    const editDeparments = async (id) => {
      isShowed.value = true; // modal show
      showForm.value = false
      isAddForm.value = false
      await getDepartment(id)
      isShowed.value = false; // modal close  
    }

    const updateDepartments = async () => {
      isShowed.value = true; // modal show
      await putDepartment(departmentID.value, form)
      if (departments.value.status == 200) {
        context.emit('showToast')
        openAddDivisionForm()
        showDepartments()
      }
      isShowed.value = false; // modal close  
    }

    //Delete Department
    const showDeleteConfirmation = (id, name) => {
      departmentDeleteID.value = id
      departmentDeleteName.value = name
      showConfirmationModal.value = true
    }
    const confirmDeleteLocation = async () => {
      isShowed.value = true; // modal show
      showTable.value = false
      showConfirmationModal.value = false
      await deleteDepartment(departmentDeleteID.value)
      await getDepartments()
      context.emit('showToast')
      showForm.value = false
      showTable.value = true
      isShowed.value = false; // modal close 
    }

    watch(department, () => {
      departmentID.value = department.value.id
      form.company_id = department.value.company_id
      if (department.value.division) {
        form.division_id = department.value.division_id
      } else {
        form.division_id = ''
      }
      if (department.value.location) {
        form.location_id = department.value.location_id
      } else {
        form.location_id = ''
      }
      form.department_name = department.value.department_name
      showForm.value = true
    })

    return {
      isShowed,
      departments,
      divisions,
      companies,
      locations,
      form,
      storeDeparment,
      editDeparments,
      updateDepartments,
      showDeleteConfirmation,
      isAddForm,
      openAddDivisionForm,
      showConfirmationModal,
      showForm,
      departmentDeleteID,
      confirmDeleteLocation,
      data_errors,
      departmentDeleteName,
      showTable,
      showConfirmationDoneModal,
      resetForm,
    }
  },
}
</script>
<style></style>
