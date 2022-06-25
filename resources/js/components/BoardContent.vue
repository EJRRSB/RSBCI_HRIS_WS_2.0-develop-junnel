<template>
  <div class="board-content2">
    <component
      v-if="page == 0"
      v-bind:is="componentsList[0]"
      @nextPage="nextPage"
      @prevPage="prevPage"
      @skip="skipForNow"
      @showToast="showToast"
    />
    <component
      v-if="page == 1"
      v-bind:is="componentsList[1]"
      @nextPage="nextPage"
      @prevPage="prevPage"
      @skip="skipForNow"
      @showToast="showToast"
    />
    <component
      :key="numberOfCompanies"
      v-show="page == 2"
      v-bind:is="componentsList[2]"
      @nextPage="nextPage"
      @prevPage="prevPage"
      @skip="skipForNow"
      @showToast="showToast"
      v-model:currentCompanyID="currentCompanyID"
    />
    <component
      v-if="page == 3"
      v-bind:is="componentsList[3]"
      @nextPage="nextPage"
      @prevPage="prevPage"
      @skip="skipForNow"
      @showToast="showToast"
    />
    <component
      v-if="page == 4"
      v-bind:is="componentsList[4]"
      @nextPage="nextPage"
      @prevPage="prevPage"
      @skip="skipForNow"
      @showToast="showToast"
      :currentCompanyID="currentCompanyID"
    />
    <component
      v-if="page == 5"
      v-bind:is="componentsList[5]"
      @nextPage="nextPage"
      @prevPage="prevPage"
      @skip="skipForNow"
      @showToast="showToast"
      :currentCompanyID="currentCompanyID"
    />
    <component
      v-if="page == 6"
      v-bind:is="componentsList[6]"
      @nextPage="nextPage"
      @prevPage="prevPage"
      @skip="skipForNow"
      @showToast="showToast"
      :currentCompanyID="currentCompanyID"
    />
    <component
      v-if="page == 7"
      v-bind:is="componentsList[7]"
      @nextPage="nextPage"
      @prevPage="prevPage"
      @addAnother="addAnother"
      @skip="skipForNow"
      @showToast="showToast"
    />

    <Toasts
      :showToast="toastVisible"
      :title="toastTitle"
      type="notif-success"
    />
  </div>
</template>

<script>
import { shallowRef, ref } from 'vue'
import CompanyTeams from '../components/OnBoarding/CompanyTeams.vue'
import CompanyDepartments from '../components/OnBoarding/CompanyDepartments.vue'
import CompanyDivision from '../components/OnBoarding/CompanyDivision.vue'
import CompanyLocation from '../components/OnBoarding/CompanyLocation.vue'
import CompanyInformation from '../components/OnBoarding/CompanyInformation.vue'
import OnBoardingMessage from '../components/OnBoarding/OnBoardingMessage.vue'
import PostCompletion from '../components/OnBoarding/PostCompletion.vue'
import Toasts from '../components/Notifs/Toasts.vue'
import Intro from '../components/OnBoarding/Intro.vue'
export default {
  components: {
    Toasts,
  },
  setup() {
    const toastVisible = ref(false)
    const toastTitle = ref('')
    const currentCompanyID = ref()
    const componentsList = shallowRef([
      Intro,
      OnBoardingMessage,
      CompanyInformation,
      CompanyLocation,
      CompanyDivision,
      CompanyDepartments,
      CompanyTeams,
      PostCompletion,
    ])

    const page = ref(0)

    function showToast(message = '') {
      if (toastVisible.value) {
        toastVisible.value = false
      }
      toastVisible.value = true
      if (!message) {
        toastTitle.value = message
      }

      setTimeout(() => (toastVisible.value = false), 2000)
    }
    function nextPage(isSucc = false) {
      if (isSucc) {
        showToast()
      }
      page.value++
    }
    function prevPage() {
      page.value--
    }

    //Reset Company Form
    const numberOfCompanies = ref(0)
    function addAnother() {
      numberOfCompanies.value++
      page.value = 2
    }
    function skipForNow() {
      page.value = 7
    }
    return {
      nextPage,
      prevPage,
      addAnother,
      numberOfCompanies,
      skipForNow,
      page,
      componentsList,
      toastVisible,
      toastTitle,
      showToast,
      currentCompanyID,
    }
  },
}
</script>
<style lang="scss" scope>


button { // ELTOn
  font-family: "Noto Sans", sans-serif;
  font-weight: 600;
  font-size: 1em;
  height: 40px;
  min-width: 100px;
  border: none;
  outline: none;
  padding: 0 25px;
  color: white;
  border-radius: 5px;
  cursor: pointer;
  background-color: #6060605e;
}

button:hover { // ELTOn
  opacity: 0.85;
}

.button-container {
  display: flex;
  justify-content: flex-end;
  width: 600px;
  margin-top: 10px;
}

.button-container button {
  margin-left: 10px;
}

.board-content2 {
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height: calc(100vh - 120px);
  height: auto;
  align-items: center;
  justify-content: center;
  padding: 0 30px;
  overflow-x: hidden;
}

.intro-box {
  height: 680px;
  width: 680px;
  background-color: white;
  border-radius: 5px;
  padding: 40px 100px 20px 100px;
  z-index: 1;
}

#company-onboarding-welcome {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 20px;
}

#company-onboarding-welcome .array-logo {
  width: 250px;
  margin-bottom: 40px;
}

#welcome-form {
  margin-bottom: 95px;
  min-width: 380px;
  border-bottom: none;
}

#welcome-form td {
  border-bottom: none;
}

#welcome-button {
  background-color: #92c156;
  width: 200px;
}

#company-onboarding-post-completion {
  display: flex;

  flex-direction: column;
  align-items: center;
  text-align: center;
}

#onboarding-intro-image {
  height: 320px;
  margin-bottom: 60px;
}

#post-completion-image {
  height: 320px;
  margin-bottom: 70px;
}

#intro-button {
  background-color: #92c156;
  width: 200px;
}

.intro-box h1 {
  font-family: 'Source Sans Pro', sans-serif;
  font-weight: 700;
  color: #6f499b;
  margin-bottom: 20px;
}

.intro-box h4 {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 600;
  color: #606060;
  margin-bottom: 40px;
}

#company-onboarding-intro {
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.td-label {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 600;
  font-size: 1.1em;
  color: #008dba;
}

.td-content {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 500;
  font-size: 1.1em;
  color: #606060;
}

.onboarding-progress-bar {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 140px;
  width: 1000px;
  background-color: white;
  margin-bottom: 20px;
  border-radius: 5px;
  img {
    width: 600px;
    padding-top: 15px;
  }
}

.onboarding-form-container {
  display: flex;
  flex-direction: column;
  width: 1000px;
  height: auto;
  background-color: white;
}

.required {
  content: '*';
  color: #cc3333;
  padding-left: 4px;
}
.label {
  display: flex;
}
.form-titlebar {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
  width: 100%;
  background-color: #008dba;
  text-align: center;
  font-family: 'Noto Sans', sans-serif;
  font-weight: 600;
  font-size: 1.1em;
  color: white;
}

.add-container {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  height: 100%;
  width: 25%;
}
.add-container h5 {
  cursor: pointer;
}

.add-container img {
  margin-right: 10px;
  padding: 5px;
  width: 25px;
  background-color: orange;
  border-radius: 2.5px;
  cursor: pointer;
}
.form-content-add {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: auto;
  width: 100%;
  padding: 30px 0;
  background-color: white;
  transition: all 0.5s linear;
}

form .text-field:invalid {
  border: solid 2px #f34336;
}

.form-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: auto;
  width: 100%;
  padding: 30px 0;
  background-color: white;
}

.company-info-btns {
  display: flex;
  justify-content: flex-end;
  width: 600px;
  margin-top: 20px;
}

.field-row h4 {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 700;
  font-size: 1.1em;
  color: #008dba;
}

.table-titlebar {
  display: flex;
  align-items: center;
  height: 50px;
  width: 100%;
  background-color: #606060;
  padding-left: 40px;
}

.table-titlebar h3 {
  font-family: 'Source Sans Pro', sans-serif;
  font-weight: 600;
  font-size: 1.3em;
  color: white;
}

.table-content-onboarding {
  display: flex;
  flex-direction: column;
  padding: 30px 40px;
}

.saved-table {
  width: 100%;
}

td {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 500;
  font-size: 1em;
  color: #606060;
}

.table-labels td {
  border-bottom: 2px solid #6f499b;
  font-family: 'Noto Sans', sans-serif;
  font-weight: 700;
  font-size: 1em;
  color: #6f499b;
}

.table-cell-actions {
  display: flex;
  flex-direction: row;
}

tr {
  border-bottom: 2px solid red;
}

td {
  border-bottom: 1px solid #a9a9a9;
}

.table-edit,
.table-delete {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 700;
  font-size: 1em;
  color: #008ebb;
  cursor: pointer;
  padding-right: 10px;
}

.table-delete {
  color: #f34336;
}

.saved-button-row {
  display: flex;
  justify-content: space-between;
  width: inherit;
  flex-direction: row;
  padding-top: 30px;
}

.back-btn {
  background-color: #f24336;
}

.skip-btn {
  background-color: #24a7aa;
  margin-right: 10px;
}
.save-btn {
  background-color: #92c156;
}
.blue-btn {
  background-color: #24a7aa;
}

.next-btn {
  background-color: #92c156;
}

/* Global CSS*/

.bottom-button-row {
  display: flex;
  flex-direction: row;
}

.bluegreen-btn {
  background-color: #24a7aa;
}

.purple-btn {
  background-color: #6f499b;
}

.green-btn {
  background-color: #92c156;
}

.btn-mright {
  margin-right: 10px;
}

input {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 500;
  font-size: 1em;
  color: #606060;
}
select {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 500;
  font-size: 1.1em;
  color: #606060;
  background: white;
}

option {
  font-size: 1em;
  font-family: 'Noto Sans', sans-serif;
}

.col-2 {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  height: inherit;
}

h1,
h2,
h3 {
  font-family: 'Source Sans Pro', sans-serif;
  padding: 0;
  margin: 0;
}

h4,
h5,
h6 {
  font-family: 'Noto Sans', sans-serif;
  padding: 0;
  margin: 0;
}

p {
  font-family: 'Noto Sans', sans-serif;
  font-weight: 500;
  font-size: 1 em;
  color: #606060;
  padding: 0;
  margin: 0;
}

.error-field {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.error-message {
  width: 65%;
}
</style>
