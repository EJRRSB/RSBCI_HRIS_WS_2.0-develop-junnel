<template>
  <div class="intro-box">
    <div id="company-onboarding-welcome">
      <img class="array-logo" src="assets/images/array-logo.svg" />
      <h1>Welcome to our system!</h1>
      <h4>Here is a summary of your availed services.</h4>
      <table
        id="welcome-form"
        width="auto"
        border="0"
        cellspacing="5"
        cellpadding="10"
      >
        <tbody>
          <tr>
            <td class="td-label">Company Name</td>
            <td class="td-content">{{ tenant.company_name }}</td>
          </tr>
          <tr>
            <td class="td-label">Account Owner</td>
            <td class="td-content">
              {{ tenant.first_name }} {{ tenant.last_name }}
            </td>
          </tr>
          <tr>
            <td class="td-label">Subscription Type</td>
            <td class="td-content">HRIS, Payroll</td>
          </tr>
          <tr>
            <td class="td-label">Number of Users</td>
            <td class="td-content">{{ tenant.company_size }}</td>
          </tr>
        </tbody>
      </table>
      <button id="welcome-button" class="button" @click="$emit('nextPage')">
        Confirm
      </button>
    </div>
  </div>
</template>

<script>
import { defineEmits } from 'vue'
import useTenants from '../../Api/tenants'
import { onBeforeMount } from 'vue'
const emit = defineEmits(['nextPage', 'prevPage'])
export default {
  setup() {
    const { getTenant, tenant } = useTenants()

    //Get Tenant Info
    onBeforeMount(getTenant)
    return { tenant }
  },
}
</script>

<style lang="scss" scoped></style>
