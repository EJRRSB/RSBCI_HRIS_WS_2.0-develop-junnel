<template>
  <div id="company-locations" class="onboarding-form-frame">
    <div class="onboarding-progress-bar">
      <img src="assets/images/bar-2.svg" />
    </div>

    <div class="onboarding-form-container">
      <div class="form-titlebar">
        <div style="width: 25%"></div>
        <h3 style="width: 50%">Company Locations</h3>
        <div class="add-container" @click="opeAddLocationForm">
          <img src="assets/images/add-white-icon.svg" />
          <h5>Add Location</h5>
        </div>
      </div>

      <div class="form-content-add" v-if="showForm">
        <InputText
          label="Location Code"
          placeHolder="Enter Location Code"
          v-model:value="form.location_code"
          :isRequired="true"
          :key="form.location_code"
          :errorMessage="data_errors.location_code"
        />
        <CountrySelect
          :options="optionsCountries"
          label="Country"
          :isRequired="true"
          placeHolder="Enter Country"
          v-model:value="form.country"
          :key="form.country"
          :errorMessage="data_errors.country"
        />
        <InputText
          label="Province"
          :isRequired="true"
          placeHolder="Enter Province"
          v-model:value="form.province"
          :key="form.province"
          :errorMessage="data_errors.province"
        />
        <InputText
          label="City / Municipality"
          :isRequired="true"
          placeHolder="Enter City / Municipality"
          v-model:value="form.city"
          :key="form.city"
          :errorMessage="data_errors.city"
        />
        <InputText
          label="Unit/Bldg./Street"
          :isRequired="true"
          placeHolder="Enter Unit/Bldg./Street"
          v-model:value="form.street_address"
          :key="form.street_address"
          :errorMessage="data_errors.street_address"
        />
        <InputText
          label="Zip Code"
          :isRequired="true"
          placeHolder="Enter Zip Code"
          v-model:value="form.zip_code"
          :key="form.zip_code"
          :errorMessage="data_errors.zip_code"
        />

        <div class="button-container">
          <button v-if="isAddForm" class="blue-btn" @click.prevent="resetForm" >
            Clear
          </button>
          <button
            v-if="isAddForm"
            class="save-btn"
            @click.prevent="storeLocations"
          >
            Save
          </button>
          <button v-else class="save-btn" @click.prevent="updateLocation">
            Update
          </button>
        </div>
      </div>

      <div class="table-titlebar">
        <h3>Saved Locations</h3>
      </div>

      <div class="table-content-onboarding">
        <Loading message="Data Loading" :isLarge="false" v-show="!showTable" />
        <table
          class="saved-table"
          cellspacing="0"
          cellpadding="10px"
          v-show="showTable"
        >
          <tbody>
            <tr class="table-labels">
              <td>Street Address</td>
              <td>City</td>
              <td>Location Code</td>
              <td>Actions</td>
            </tr>

            <tr v-for="row in locations" v-bind:key="row.id">
              <td>{{ row.street_address }}</td>
              <td>{{ row.city }}</td>
              <td>{{ row.location_code }}</td>
              <td class="table-cell-actions">
                <div class="table-edit" @click="editLocation(row.id)">EDIT</div>
                <div
                  class="table-delete"
                  @click="showDeleteConfirmation(row.id, row.street_address)"
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
      :id="locationDeleteName"
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
import InputText from '../../components/Forms/InputText.vue'
import useLocations from '../../Api/locations'
import Toasts from '../../components/Notifs/Toasts.vue'
import CountrySelect from '../../components/Forms/CountrySelect.vue'
import countries from '../../JSON//countries.json'
import ConfirmationModal from '../../components/Notifs/ConfirmationModal.vue'
import Loading from '../../components/Loading.vue'
import { onBeforeMount, reactive, ref, watch, watchEffect } from 'vue'
export default {
  components: {
    LoaderModal,
    InputText,
    Toasts,
    ConfirmationModal,
    CountrySelect,
    Loading,
  },
  emits: ['nextPage', 'prevPage', 'showToast', 'skip'],
  setup(props, context) {
    const {
      postLocations,
      getLocations,
      getLocation,
      putLocations,
      deleteLocation,
      locations,
      location,
      errors,
    } = useLocations()
    const showForm = ref(false)
    const isAddForm = ref(true)
    const locationID = ref('') //Reference for Updating Location
    const locationDeleteID = ref('') //Reference for Deleting Location
    const locationDeleteName = ref('') //Reference for Deleting Location
    const optionsCountries = ref(countries)
    const showConfirmationModal = ref(false)
    const showTable = ref(false)
    const showConfirmationDoneModal = ref(false)

    const form = reactive({
      location_code: '',
      country: '',
      province: '',
      city: '',
      street_address: '',
      zip_code: '',
    })

    //Error Mesages
    const data_errors = reactive({
      location_code: '',
      country: '',
      province: '',
      city: '',
      street_address: '',
      zip_code: '',
    })
    //Watch for errors
    watch(errors, () => {
      //Reset Value First
      resetErrorData()
      //Assign Errors
      for (let item in errors.value.errors) {
        data_errors[item] = errors.value.errors[item]
      }
    })

    const resetErrorData = () => {
      data_errors.location_code = ''
      data_errors.country = ''
      data_errors.province = ''
      data_errors.city = ''
      data_errors.street_address = ''
      data_errors.zip_code = ''
    }

    //Add Form Button
    const opeAddLocationForm = () => {
      //If Form is at Edit state make it on Add form state
      resetForm()
      if (!showForm.value) {
        if (!isAddForm.value) {
          showForm.value = false
          isAddForm.value = true
        }
        showForm.value = true
      } else {
        showForm.value = false
      }
    }

    //Form Reset Value
    const resetForm = () => {
      resetErrorData()
      form.location_code = ''
      form.country = ''
      form.province = ''
      form.city = ''
      form.street_address = ''
      form.zip_code = ''
    }

    //Get Locations
    onBeforeMount(getLocations)
    
    const isShowed = ref(false) // modal

    //Post Locations
    const storeLocations = async () => {
      isShowed.value = true; // modal show
      await postLocations(form)
      console.log(locations.value.status)
      if (locations.value.status == 200) {
        opeAddLocationForm()
        context.emit('showToast')
        showLocations()
      }
      isShowed.value = false; // modal close   
    }

    //Show Locations
    const showLocations = async () => {
      isShowed.value = true; // modal show
      //Can Add Loading Here
      showTable.value = false
      await getLocations()
      showTable.value = true
      isShowed.value = false; // modal close  
    }

    //Edit Location Form
    const editLocation = async (id) => {
      isShowed.value = true; // modal show
      resetErrorData()
      showForm.value = false
      isAddForm.value = false
      await getLocation(id)
      isShowed.value = false; // modal close 
    }
    const updateLocation = async () => {
      isShowed.value = true; // modal show
      await putLocations(locationID.value, form)
      if (locations.value.status == 200) {
        context.emit('showToast')
        opeAddLocationForm()
        showLocations()
      }
      isShowed.value = false; // modal close 
    }

    //Get Locations
    onBeforeMount(showLocations)

    watch(location, () => {
      console.log(location.value)
      locationID.value = location.value.id
      form.location_code = location.value.location_code
      form.country = location.value.country
      form.province = location.value.province
      form.city = location.value.city
      form.street_address = location.value.street_address
      form.zip_code = location.value.zip_code
      showForm.value = true
    })

    //Delete Location
    const showDeleteConfirmation = (id, name) => {
      locationDeleteID.value = id
      locationDeleteName.value = name
      showConfirmationModal.value = true
    }
    const confirmDeleteLocation = async () => {
      isShowed.value = true; // modal show
      showTable.value = false
      showConfirmationModal.value = false
      await deleteLocation(locationDeleteID.value)
      await getLocations()
      context.emit('showToast')
      showForm.value = false
      showTable.value = true
      isShowed.value = false; // modal close 
    }

    return {
      isShowed,
      locations,
      form,
      storeLocations,
      editLocation,
      updateLocation,
      showDeleteConfirmation,
      isAddForm,
      opeAddLocationForm,
      showConfirmationModal,
      showForm,
      locationDeleteID,
      confirmDeleteLocation,
      data_errors,
      locationDeleteName,
      optionsCountries,
      showTable,
      showConfirmationDoneModal,
      resetForm,
    }
  },
}
</script>
<style lang="sass" scoped></style>
