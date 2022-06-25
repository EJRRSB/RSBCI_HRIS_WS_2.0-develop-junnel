<template>
  <div id="company-information" class="onboarding-form-frame">
    <div class="onboarding-progress-bar">
      <img src="assets/images/bar-1.svg" />
    </div>
    <form
      v-on:submit.prevent
      id="company-form"
      class="onboarding-form-container"
    >
      <div class="form-titlebar">
        <h3>Company Information</h3>
      </div>
      <div class="form-content">
        <InputText
          label="Company Name"
          :isRequired="true"
          :errorMessage="data_errors.company_name"
          placeHolder="Enter Company Name"
          v-model:value="data_form.company_name"
        />

        <InputText
          label="Doing Business As"
          placeHolder="Enter DBA"
          v-model:value="data_form.doing_business_as"
          :errorMessage="data_errors.doing_business_as"
        />

        <InputSelect
          :options="optionsVal"
          label="Industry / Sector"
          placeHolder="Select Industry/Sector"
          :errorMessage="data_errors.industry"
          v-model:value="data_form.industry"
        />

        <InputText
          label="Company Website"
          type="url"
          placeHolder="Enter Company Website URL"
          v-model:value="data_form.company_website_url"
          :errorMessage="data_errors.company_website_url"
        />

        <InputText
          label="Business Phone No."
          placeHolder="Business Phone No."
          v-model:value="data_form.business_phone_number"
          :errorMessage="data_errors.business_phone_number"
        />

        <InputText
          label="TIN"
          v-model:value="data_form.tin"
          placeHolder="Enter Company TIN"
          :errorMessage="data_errors.tin"
          maxlength="12"
        />

        <!-- <InputText label="Company Code" /> -->
        <InputFile
          v-model:value="data_form.company_logo_url"
          label="Company Logo"
          v-model:errorMessage="data_errors.company_logo_url"
        />

        <div class="company-info-btns">
          <button
            class="skip-btn"
            @click="showConfirmationDoneModal = !showConfirmationDoneModal"
          >
            Skip For Now
          </button>
          <button
            v-if="!isUpdate"
            class="next-btn"
            @click.prevent="storeCompanies"
          >
            Save
          </button>
          <button
            v-if="isUpdate"
            class="next-btn"
            @click.prevent="
              showUpdateConfirmationModal = !showUpdateConfirmationModal
            "
          >
            Update
          </button>
          <button
            v-if="isUpdate"
            class="next-btn right-button"
            @click="$emit('nextPage')"
          >
            Next
          </button>
        </div>
      </div>
    </form>
    <ConfirmationModal
      v-if="showConfirmationDoneModal"
      message="You are about to skip the company onboarding process."
      yesButtonLabel="Confirm"
      @confirm="$emit('skip')"
      @closeModal="showConfirmationDoneModal = !showConfirmationDoneModal"
    />

    <ConfirmationModal
      v-if="showUpdateConfirmationModal"
      message="Are you sure you want to update this Company Information?"
      yesButtonLabel="Confirm"
      @confirm="updateCompanies"
      @closeModal="showUpdateConfirmationModal = !showUpdateConfirmationModal"
    />
    
    <LoaderModal v-if="isShowed"/>
  </div>
</template>

<script setup></script>

<script>
import LoaderModal from '../../components/Forms/LoaderModal.vue'
import InputText from '../../components/Forms/InputText.vue'
import InputFile from '../../components/Forms/InputFile.vue'
import InputSelect from '../../components/Forms/InputSelect.vue'
import industries from '../../JSON/industries.json'
import ConfirmationModal from '../../components/Notifs/ConfirmationModal.vue'
import { onBeforeMount, reactive, ref, watch } from 'vue'
import useCompanies from '../../Api/companies'

export default {
  components: {
    LoaderModal,
    InputText,
    InputFile,
    InputSelect,
    ConfirmationModal,
  },
  emits: ['nextPage', 'prevPage', 'skip', 'update:currentCompanyID'],
  props: {
    currentCompanyID: [Number, String],
  },
  setup(props, { emit }) {
    const isUpdate = ref(false)
    const optionsVal = ref(industries.industries)
    const currentCompanyID = ref(null)
    const showConfirmationDoneModal = ref(false)
    const showUpdateConfirmationModal = ref(false)

    const data_form = reactive({
      company_name: '',
      doing_business_as: '',
      industry: '',
      company_website_url: '',
      business_phone_number: '',
      tin: '',
      company_logo_url: '',
    })
    const { storeCompany, putCompany, companies, errors } = useCompanies()
    //Error Message
    const data_errors = reactive({
      company_name: '',
      doing_business_as: '',
      industry: '',
      company_website_url: '',
      business_phone_number: '',
      tin: '',
      company_logo_url: '',
    })
    //Catch Errors
    watch(errors, () => {
      //Reset Value First
      resetFormValue()
      //Assign Errors 
      for (let item in errors.value.errors) {
        data_errors[item] = errors.value.errors[item]
      }
      showUpdateConfirmationModal.value = false
    })

    const resetFormValue = () => {
      data_errors.company_name = ''
      data_errors.doing_business_as = ''
      data_errors.industry = ''
      data_errors.company_website_url = ''
      data_errors.business_phone_number = ''
      data_errors.tin = ''
      data_errors.company_logo_url = ''
    }

    const nextPage = (isSucc) => {
      emit('nextPage', isSucc)
    }

    
    const isShowed = ref(false) // modal
    
    const storeCompanies = async () => {
      isShowed.value = true; // modal show
      // modal open
      for (let item in errors.value.errors) {
        data_errors[item] = ''
      }

      var form_data = new FormData()
      var items = data_form
      for (var key in items) {
        if (items[key]) {
          form_data.append(key, items[key])
        }
      }
      await storeCompany(form_data)
      if (companies.value.status == 200) {
        currentCompanyID.value = companies.value.data.id
        console.log(companies.value.data)
        emit('update:currentCompanyID', currentCompanyID.value)

        nextPage(true)
        isUpdate.value = true
        companies.value.status = ''
      }
      isShowed.value = false; // modal close    
    }

    const updateCompanies = async () => {
      isShowed.value = true; // modal show
      for (let item in errors.value.errors) {
        data_errors[item] = ''
      }
      var form_data = new FormData()
      var items = data_form

      for (var key in items) {
        if (items[key]) {
          form_data.append(key, items[key])
        }
      }
      form_data.append(key, items[key])

      form_data.append('id', currentCompanyID.value)

      await storeCompany(form_data)
      if (companies.value.status == 200) {
        showUpdateConfirmationModal.value = false
        emit('showToast')
        companies.value.status = ''
      }
      isShowed.value = false; // modal close    
    }

    return {
      isShowed,
      storeCompanies,
      updateCompanies,
      optionsVal,
      data_form,
      nextPage,
      data_errors,
      isUpdate,
      showConfirmationDoneModal,
      showUpdateConfirmationModal,
    }
  },
}
</script>
<style lang="sass" scoped>
#company-logo
  visibility: hidden

.right-button
  margin-left: 10px
</style>
>
