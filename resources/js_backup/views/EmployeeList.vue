<template>
    <MainTemplate>
        <!-- Board Area -->
        <div class="board">
            <!-- Breadcrumb -->
            <div class="breadcrumb-container">
                <a href="index.html">Array Company</a>
                <h4>&nbsp; &#92; &nbsp;</h4>
                <a href="https://jmg.rsbcidevteam.tech//employee_management/"
                    >Employee Management</a
                >
                <h4>&nbsp; &#92; &nbsp;</h4>
                <a href="index.html" id="breadcrumb-active"
                    >Employee Registrants List</a
                >
            </div>

            <!-- Board Content -->
            <div class="board-content">
                <div class="filter-button-row">
                    <div class="filter-search">
                        <input type="text" />
                        <div class="filter-search-btn">
                            <img src="assets/images/search-white-icon.svg" />
                        </div>
                    </div>
                    <div class="row-2">
                        <!-- <button class="bulk-add-btn green-btn">
                            Bulk Upload Employees
                        </button>
                        <button class="detailed-add-btn green-btn">
                            Detailed Add Employee
                        </button>
                        <button class="quick-add-btn green-btn">
                            Quick Add Employees
                        </button> -->
                    </div>
                </div>

                <div class="employee-list-container">
                    <div class="status-filter">
                        <div
                            @click="activeTab = 0"
                            :class="
                                activeTab === 0
                                    ? 'status-filter-nav-active'
                                    : ''
                            "
                            class="status-filter-nav bg-status-lgrey"
                        >
                            All Status
                        </div>
                        <div
                            @click="activeTab = 1"
                            :class="
                                activeTab === 1
                                    ? 'status-filter-nav-active'
                                    : ''
                            "
                            class="status-filter-nav bg-status-lgrey"
                        >
                            Activated
                        </div>
                        <div
                            @click="activeTab = 3"
                            :class="
                                activeTab === 3
                                    ? 'status-filter-nav-active'
                                    : ''
                            "
                            class="status-filter-nav bg-status-dgrey"
                        >
                            Declined
                        </div>
                        <div
                            @click="activeTab = 4"
                            :class="
                                activeTab === 4
                                    ? 'status-filter-nav-active'
                                    : ''
                            "
                            class="status-filter-nav bg-status-lgrey"
                        >
                            Pending
                        </div>
                    </div>

                    <div class="table-content">
                        <table
                            class="saved-table"
                            border="0"
                            cellspacing="0"
                            cellpadding="0"
                        >
                            <tbody>
                                <tr class="table-labels">
                                    <td class="table-first-column"></td>
                                    <td>Employee No</td>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>Work Email</td>
                                    <td>Username</td>
                                    <td>Status</td>
                                    <td>Date Registered</td>
                                    <td class="table-last-column">Actions</td>
                                </tr>
                                <tr>
                                    <td colspan="10" v-if="isLoading">
                                        <Loading
                                            :isLarge="false"
                                            style="margin-top: 20px"
                                        />
                                    </td>
                                </tr>

                                <tr
                                    v-for="employee in employee_list.data.data"
                                    :key="employee.id"
                                    v-show="!isLoading"
                                >
                                    <td class="table-first-column">
                                        <img
                                            class="table-photo"
                                            :src="[
                                                employee.status == 1
                                                    ? 'assets/images/regrsitrant-activated.svg'
                                                    : employee.status == 3
                                                    ? 'assets/images/regrsitrant-declined.svg'
                                                    : 'assets/images/regrsitrant-pending.svg',
                                            ]"
                                        />
                                    </td>
                                    <td>{{ employee.employee_no }}</td>
                                    <td>{{ employee.first_name }}</td>
                                    <td>{{ employee.last_name }}</td>
                                    <td>{{ employee.work_email_address }}</td>
                                    <td>{{ employee.username }}</td>
                                    <td>{{ employee.status_description }}</td>
                                    <td>{{ employee.created_at }}</td>
                                    <td class="table-last-column">
                                        <!-- <img
                                            class="table-icon"
                                            src="assets/images/table-view-icon.svg"
                                        /> -->
                                        <img
                                            v-if="
                                                employee.status == 4 ||
                                                employee.status == 3
                                            "
                                            class="table-icon"
                                            src="assets/images/activate-icon.svg"
                                            @click="
                                                showActivationConfirmationModal(
                                                    employee.id,
                                                    employee.last_name +
                                                        ', ' +
                                                        employee.first_name
                                                )
                                            "
                                        />
                                        <img
                                            v-else
                                            class="table-icon"
                                            src="assets/images/activate-disabled.svg"
                                        />
                                        <img
                                            v-if="
                                                employee.status == 4 ||
                                                employee.status == 1
                                            "
                                            class="table-icon"
                                            src="assets/images/decline-icon.svg"
                                            @click="
                                                showDeclinenConfirmationModal(
                                                    employee.id,
                                                    employee.last_name +
                                                        ', ' +
                                                        employee.first_name
                                                )
                                            "
                                        />
                                        <img
                                            v-else
                                            class="table-icon"
                                            src="assets/images/decline-disabled.svg"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <ConfirmationModal
            v-if="showActivationModalConfirmation"
            message="Are you sure you want to activate this employee?"
            yesButtonLabel="Confirm"
            :id="modal_message"
            @confirm="confirmActivateEmployee"
            @closeModal="
                showActivationModalConfirmation =
                    !showActivationModalConfirmation
            "
        />

        <ConfirmationModal
            v-if="showDeclineModalConfirmation"
            message="Are you sure you want to decline this employee?"
            yesButtonLabel="Confirm"
            :id="modal_message"
            @confirm="confirmDeclineEmployee"
            @closeModal="
                showDeclineModalConfirmation = !showDeclineModalConfirmation
            "
        />
    </MainTemplate>
</template>

<script>
import MainTemplate from "../components/MainTemplate.vue";
import useEmployees from "../Api/employee";
import ConfirmationModal from "../components/Notifs/ConfirmationModal.vue";
import Loading from "../components/Loading.vue";
import {
    onBeforeMount,
    reactive,
    ref,
    watch,
    watchEffect,
} from "@vue/runtime-core";
import useEmployee from "../Api/employee";
export default {
    components: { MainTemplate, ConfirmationModal, Loading },
    setup() {
        //Tabs Ref
        const activeTab = ref(0);

        const {
            activateEmployee,
            declineEmployee,
            employees,
            employee,
            getEmployees,
        } = useEmployee();
        //Modals
        const employee_id = ref();
        const modal_message = ref();

        //Activate Employee
        const showActivationModalConfirmation = ref(false);

        const confirmActivateEmployee = async () => {
            await activateEmployee(employee_id.value);
            showActivationModalConfirmation.value = false;
        };
        const showActivationConfirmationModal = (id, message) => {
            showActivationModalConfirmation.value = true;
            employee_id.value = id;
            modal_message.value = message;
        };

        //Decline Employee
        const showDeclineModalConfirmation = ref(false);

        const confirmDeclineEmployee = async () => {
            await declineEmployee(employee_id.value);
            if (employees.value.data.data) {
                await getEmployees();
            }
            showDeclineModalConfirmation.value = false;
        };
        const showDeclinenConfirmationModal = (id, message) => {
            showDeclineModalConfirmation.value = true;
            employee_id.value = id;
            modal_message.value = message;
        };

        const employee_list = ref();
        const isLoading = ref(false);
        watchEffect(async () => {
            isLoading.value = true;
            await getEmployees(activeTab.value);
        });
        watch(employee, async () => {
            isLoading.value = true;
            await getEmployees(activeTab.value);
        });
        watch(employees, () => {
            employee_list.value = employees.value.data;
            isLoading.value = false;
        });

        return {
            employee_list,
            employee_id,
            modal_message,
            showActivationModalConfirmation,
            showActivationConfirmationModal,
            confirmActivateEmployee,
            showDeclineModalConfirmation,
            confirmDeclineEmployee,
            showDeclinenConfirmationModal,
            activeTab,
            isLoading,
        };
    },
};
</script>

<style scoped>
.board {
    background: #ffffffd2;
    height: 100%;
    widows: 100%;
    font-family: "Noto Sans";
}
.board-content {
    display: flex;
    flex-direction: column;
    width: 100%;
    min-height: calc(100vh - 120px);
    height: auto;
    align-items: center;
    padding: 0 30px;
    overflow-x: hidden;
}

.column-flex {
    display: flex;
    direction: row;
}

.filter-row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
}

.filter-row select {
    width: 20vw;
    border-radius: 5px;
    outline: none;
    border: solid 2px #a9a9a9;
}

.filter-search {
    height: 36px;
    display: flex;
    flex-direction: row;
    align-content: center;
    align-items: center;
}

.filter-search input {
    border-radius: 5px 0px 0px 5px;
    height: 36px;
    width: 20vw;
    outline: none;
    border: solid 2px #a9a9a9;
    border-right: none;
    padding-left: 10px;
}

.filter-search input:hover {
    border-radius: 5px 0px 0px 5px;
    border: solid 2px #6f499b;
    border-right: none;
}

.filter-search-btn {
    height: 36px;
    width: 36px;
    display: flex;
    align-content: center;
    align-items: center;
    justify-content: center;
    background-color: #6f499b;
    border-radius: 0px 5px 5px 0px;
    cursor: pointer;
}

.filter-search-btn img {
    height: 20px;
    width: 20px;
}

.filter-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100px;
    height: 30px;
    background-color: #6f499b;
    border-radius: 5px;
    font-family: "Noto Sans";
    color: #ffffff;
    cursor: pointer;
}

.filter-btn:hover {
    opacity: 0.85;
}

.filter-button-row {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.detailed-add-btn {
    margin-left: 20px;
}

.quick-add-btn {
    margin-left: 20px;
}

.employee-list-container {
    margin-top: 20px;
    width: 100%;
}

.form-titlebar {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    height: 50px;
    width: 100%;
    background-color: #008dba;
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    color: white;
}

.field-row {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    width: 660px;
    margin: 10px 0px;
}

.field-error {
    justify-content: flex-start;
    margin: 0;
}

.company-info-btns {
    display: flex;
    justify-content: flex-end;
    width: 600px;
    margin-top: 20px;
}

.text-field {
    height: 38px;
    width: 65%;
    border: solid 2px #a9a9a9;
    border-radius: 5px;
    outline: none;
    padding-left: 10px;
}

.text-field:focus {
    border: solid 2px #6f499b;
}

.text-field-disabled {
    height: 38px;
    width: 65%;
    border: solid 2px #a9a9a9;
    background-color: #efefef;
    border-radius: 5px;
    outline: none;
    padding-left: 10px;
    cursor: not-allowed;
}

.onboarding-form-select {
    height: 38px;
    width: 65%;
    border: solid 2px #a9a9a9;
    border-radius: 5px;
    outline: none;
    padding-left: 10px;
    font-family: "Noto Sans", sans-serif;
    font-weight: 500;
    font-size: 1em;
}

.field-row h4 {
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    color: #008dba;
}

.field-row h5 {
    font-family: "Noto Sans", sans-serif;
    font-weight: 700;
    font-size: 1.1em;
    color: #6f499b;
}

.save-btn {
    background-color: #92c156;
}

.status-filter {
    display: flex;
    flex-direction: row;
}

.status-filter-nav {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    height: 40px;
    width: 160px;
    border-radius: 5px 5px 0px 0px;
    font-family: "Noto Sans", sans-serif;
    font-size: 1em;
    font-weight: 600;
    color: #6f499b;
    cursor: pointer;
}

.bg-status-dgrey {
    background-color: #cecece;
}

.bg-status-lgrey {
    background-color: #dddddd;
}

.status-filter-nav-active {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    height: 40px;
    width: 160px;
    background-color: #6f499b;
    border-radius: 5px 5px 0px 0px;
    font-size: 1em;
    font-weight: 600;
    color: #ffffff;
    cursor: pointer;
}

.status-filter-nav:hover {
    background-color: #6f499b;
    font-size: 1em;
    font-weight: 600;
    color: #ffffff;
}

.table-titlebar {
    display: flex;
    align-items: center;
    height: 50px;
    width: 100%;
    background-color: #606060;
}

.table-titlebar h3 {
    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
    font-size: 1.3em;
    color: #008ebb;
}

.table-content {
    display: flex;
    flex-direction: column;
    background-color: white;
}

td {
    font-family: "Noto Sans", sans-serif;
    font-weight: 500;
    font-size: 0.9em;
    color: #606060;
    border-bottom: 1px solid #a9a9a9;
    height: 80px;
    width: auto;
}

.table-labels td {
    font-weight: 700;
    font-size: 0.9em;
    background-color: #008ebb;
    color: #ffffff;
    height: 60px;
    border-bottom: none;
    width: auto;
}

.table-photo {
    width: 50px;
    height: 50px;
    border-radius: 5px;
}
.table-icon {
    height: 30px;
    cursor: pointer;
    margin-right: 10px;
}

.table-first-column {
    padding-left: 30px;
    padding-right: 30px;
    width: 100px;
}

.table-last-column {
    display: flex;
    align-items: center;
    padding: 0;
    margin: 0;
}

.row-2 {
    display: flex;
    flex-direction: row;
    align-content: center;
}

.checkbox-text-form {
    font-size: 0.9em;
    margin-top: -5px;
}

.checkbox-text-form h4 {
    color: #6f499b;
}

.checkbox-text-form input {
    height: 16px;
    width: 16px;
    margin-right: 10px;
}

.breadcrumb-container {
    display: flex;
    align-items: center;
    z-index: 1;
    width: 100%;
    height: 30px;
    padding: 0 30px;
}

.breadcrumb-container a {
    font-family: "Noto Sans", sans-serif;
    font-size: 0.9em;
    text-decoration: none;
    color: #6f499b;
    z-index: 1;
}

.breadcrumb-container a:hover {
    color: #24a7aa;
    border: none;
    margin: 0;
    padding: 0;
    font-size: 0.9em;
    font-weight: 500;
}

#breadcrumb-active {
    color: #24a7aa;
    font-weight: 500;
}

.breadcrumb-container h4 {
    color: #808080;
    font-weight: 500;
    font-size: 1.1em;
}
h4,
h5,
h6 {
    font-family: "Noto Sans", sans-serif;
    padding: 0;
    margin: 0;
}
button {
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
}

button:hover {
    opacity: 0.85;
}

.bottom-button-row {
    display: flex;
    flex-direction: row;
    justify-content: center;
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

.red-btn {
    background-color: #f24336;
}

.btn-mright {
    margin-right: 10px;
}
</style>
