<template>
    <div class="wrapper">
        <div class="main-container" v-if="!isLoading">
            <img class="client-logo" src="assets/images/client-logo.svg" />
            <InputText
                label="First Name"
                placeHolder="Enter First Name"
                v-model:value="form.first_name"
                :key="form.first_name"
                :errorMessage="data_errors.first_name"
            />
            <InputText
                label="Last Name"
                placeHolder="Enter Last Name"
                v-model:value="form.last_name"
                :key="form.last_name"
                :errorMessage="data_errors.last_name"
            />
            <!-- <InputText
                label="Work Email"
                placeHolder="Enter Work Email"
                v-model:value="form.work_email_address"
                @change="setUserNameAsWorkEmail"
                :key="form.work_email_address"
                :errorMessage="data_errors.work_email_address"
            /> -->

            <LiveInputText
                label="Work Email"
                placeholder="Enter Work Email"
                v-model:value="work_email"
                :isStatus="work_email_status"
                :errorMessage="data_errors.work_email_address"
            />

            <InputText
                label="Mobile No."
                placeHolder="Enter Mobile No."
                v-model:value="form.mobile_no"
                :key="form.mobile_no"
                :errorMessage="data_errors.mobile_no"
            />
            <InputText
                label="Employee No."
                placeHolder="Enter Employee No."
                v-model:value="form.employee_no"
                :key="form.employee_no"
                :errorMessage="data_errors.employee_no"
            />

            <LiveInputText
                label="Username"
                placeholder="Enter Username"
                v-model:value="username"
                :isStatus="username_status"
                :key="update_username_from_email"
                :errorMessage="data_errors.username"
                :disable="isSetEmailAsUserName"
            />

            <div class="row-container">
                <div></div>
                <div
                    class="row-container-checkbox"
                    @click="checkSetWorkEmailAsUsername"
                >
                    <input
                        id="check-box"
                        type="checkbox"
                        v-model="isSetEmailAsUserName"
                    />
                    <p class="check-text">Set Work Email as Username</p>
                </div>
            </div>

            <LiveInputText
                label="Company Code"
                placeholder="Enter Company Code"
                v-model:value="company_code"
                :isStatus="company_code_status"
                :errorMessage="data_errors.company_id"
            />

            <button id="sign-up" @click="submit">Sign Up</button>
        </div>
        <div class="main-container" v-else>
            <Loading message="Processing" />
        </div>
        <div class="login-footer">
            <h3>HRIS Application is Powered by Array 2022</h3>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from "@vue/reactivity";
import LiveInputText from "../components/Forms/LiveInputText.vue";
import InputText from "../components/Forms/InputText.vue";
import InputPassword from "../components/Forms/InputPassword.vue";
import useEmployee from "../Api/employee";
import useCompanies from "../Api/companies";
import Loading from "../components/Loading.vue";
import useUsers from "../Api/users";
import axios from "axios";
import { watch } from "@vue/runtime-core";
import _ from "lodash";

export default {
    components: { InputText, InputPassword, LiveInputText, Loading },
    setup() {
        const isLoading = ref(false);
        const isSetEmailAsUserName = ref(false);
        const form = reactive({
            first_name: "",
            last_name: "",
            work_email_address: "",
            mobile_no: "",
            employee_no: "",
            username: "",
            company_id: "",
        });

        const data_errors = reactive({
            first_name: "",
            last_name: "",
            work_email_address: "",
            mobile_no: "",
            employee_no: "",
            username: "",
            company_id: "",
        });
        const { postEmployee, employees, errors } = useEmployee();
        const username = ref();
        const update_username_from_email = ref();
        //Catch Errors
        watch(errors, () => {
            for (let item in errors.value) {
                data_errors[item] = errors.value[item];
            }
        });

        const resetDataErrors = () => {
            data_errors.first_name = "";
            data_errors.last_name = "";
            data_errors.work_email_address = "";
            data_errors.mobile_no = "";
            data_errors.employee_no = "";
            data_errors.username = "";
            data_errors.company_id = "";
        };

        const checkSetWorkEmailAsUsername = () => {
            isSetEmailAsUserName.value = !isSetEmailAsUserName.value;
            if (!isSetEmailAsUserName.value) {
                username.value = "";
                form.username = "";
                update_username_from_email.value = Math.round(
                    +new Date() / 1000
                );
            }
            if (isSetEmailAsUserName.value) {
                setUserNameAsWorkEmail();
            }
        };
        const setUserNameAsWorkEmail = () => {
            if (isSetEmailAsUserName.value) {
                username.value = work_email.value;
                update_username_from_email.value = Math.round(
                    +new Date() / 1000
                );
            }
        };

        const hasError = ref(false);
        const company_code = ref();
        const company_code_status = ref(3);
        const { getCompanyCode, companies } = useCompanies();

        watch(
            company_code,
            _.debounce(() => {
                company_code_status.value = 0;
                data_errors["company_id"] = "";
                if (!company_code.value) {
                    company_code_status.value = 3;
                } else if (company_code.value) {
                    validateCompanyCode();
                } else {
                    company_code_status.value = 2;
                }
            }, 500)
        );

        const validateCompanyCode = async () => {
            company_code_status.value = 0;
            await getCompanyCode(company_code.value);
            if (companies.value.data.data) {
                data_errors["company_id"] = "";
                form.company_id = companies.value.data.data;
                company_code_status.value = 1;
            } else {
                data_errors["company_id"] = [
                    "The Company Code you entered does not exist.",
                ];
                hasError.value = true;
                company_code_status.value = 2;
            }
        };

        //Work Email Validation
        const work_email_status = ref(3);
        const work_email = ref();

        watch(
            work_email,
            _.debounce(() => {
                setUserNameAsWorkEmail();
                work_email_status.value = 0;
                data_errors["work_email_address"] = "";
                if (!work_email.value) {
                    work_email_status.value = 3;
                    return;
                }
                if (
                    !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
                        work_email.value
                    )
                ) {
                    data_errors["work_email_address"] = [
                        "The Work Email field must be a valid email address.",
                    ];
                    work_email_status.value = 2;
                    hasError.value = true;
                    return;
                }
                form.work_email_address = work_email.value;
                validateRegisterWorkEmail();
            }, 500)
        );

        const {
            validateWorkEmail,
            validateUsername,
            users,
            _email,
            _username,
        } = useUsers();

        const validateRegisterWorkEmail = async () => {
            work_email_status.value = 0;
            await validateWorkEmail(form.work_email_address);

            // if (_email.value.data.data.is_exist) { // before
            if (_email.value.data.is_exist) { // ELTOn
                data_errors["work_email_address"] = [
                    "The Work Email is already registered.",
                ];
                work_email_status.value = 2;
                hasError.value = true;
            } else {
                work_email_status.value = 1;
            }
        };

        //Username Validation
        const username_status = ref(3);
        watch(
            username,
            _.debounce(() => {
                data_errors["username"] = "";
                form.username = username.value;
                if (form.username) { 
                    validateRegisterUsername();
                    return;
                }
                username_status.value = 3;
            }, 500)
        );

        const validateRegisterUsername = async () => { 
            username_status.value = 0;
            await validateUsername(form.username);
            console.log("TEST UNAME");
            console.log(_username.value.data.is_exist); 
            if (_username.value.data.is_exist) { // before 
            // if (_username.value.data.is_exist) { // elton
                data_errors["username"] = [
                    "The Username is already registered.",
                ];
                username_status.value = 2;
                hasError.value = true;
            } else {
                username_status.value = 1;
            }
        };

        // validate;

        const validate = () => {
            hasError.value = false;
            if (!form.last_name) {
                data_errors["first_name"] = [
                    "The First Name field is required.",
                ];
                hasError.value = true;
            }
            if (!form.last_name) {
                data_errors["last_name"] = ["The Last Name field is required."];
                hasError.value = true;
            }
            if (!form.work_email_address) {
                data_errors["work_email_address"] = [
                    "The Work Email Address field is required.",
                ];
                hasError.value = true;
            }
            if (
                !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
                    form.work_email_address
                )
            ) {
                data_errors["work_email_address"] = [
                    "The Work Email field must be a valid email address.",
                ];
                hasError.value = true;
            }
            if (!form.employee_no) {
                data_errors["employee_no"] = [
                    "The Employee No. field is required.",
                ];
                hasError.value = true;
            }
            if (!form.username) {
                data_errors["username"] = ["The Username field is required."];
                hasError.value = true;
            }
            if (!form.company_id && !company_code.value) {
                data_errors["company_id"] = [
                    "The Company Code field is required.",
                ];
                hasError.value = true;
            }
            if (company_code.value && !form.company_id) {
                data_errors["company_id"] = [
                    "The Company Code you entered does not exist.",
                ];
                hasError.value = true;
            }
        };
        const submit = async () => {
            resetDataErrors();
            validate();
            if (hasError.value) {
                isLoading.value = false;
                return;
            }
            await postEmployee(form);
            isLoading.value = false;
            if (employees.value.status == 200) {
                console.log(employees.value);
            }
        };

        return {
            form,
            data_errors,
            company_code,
            submit,
            isLoading,
            company_code_status,
            isSetEmailAsUserName,
            setUserNameAsWorkEmail,
            checkSetWorkEmailAsUsername,
            work_email_status,
            work_email,
            username,
            username_status,
            update_username_from_email,
        };
    },
};
</script>

<style scoped>
.wrapper {
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.main-container {
    display: flex;
    flex-direction: column;
    padding: 80px 70px;
    background-color: #efefef;
    box-shadow: 2px 2px 5px 2px #cccccc;
    border-radius: 5px;
    margin-top: 50px;
    width: 650px;
}

.client-logo {
    height: auto;
    width: 300px;
    margin-top: -30px;
    margin-bottom: 40px;
    align-self: center;
}

#sign-up {
    height: 40px;
    color: white;
    background-color: #6f499b;
    border: none;
    border-radius: 5px;

    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    letter-spacing: 0.3px;
    margin-top: 40px;
}

#sign-up:hover {
    opacity: 0.85;
    cursor: pointer;
}

#change-password {
    height: 140px;
    color: white;
    background-color: #92c156;
    border: none;
    border-radius: 5px;

    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    letter-spacing: 0.3px;

    margin-top: 50px;
    margin-bottom: 10px;
}

#change-password:hover {
    opacity: 0.85;
    cursor: pointer;
}

h3 {
    padding: 10px 0;
    margin: 0;
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    color: #008dba;
}

#forgot-pass:hover {
    text-decoration: none;
    color: #92c156;
}

#loader {
    width: 150px;
    padding-top: 80px;
}

.login-footer {
    height: 40px;
    width: 660px;
    margin-top: 25px;
    background-color: #52a2a6;
    border-radius: 5px;
    box-shadow: 2px 2px 5px 2px #cccccc;
    cursor: pointer;
}

.login-footer h3 {
    font-weight: 500;
    font-size: 1em;
    text-align: center;
    color: white;
}
.row-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 5px;
    width: 100%;
}

.row-container-checkbox {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 5px;
    width: 370px;
    height: 20px;
}

#check-box {
    height: 16px;
    width: 16px;
    margin: 0px 10px 0px 0px;
    padding: 0;
    filter: invert(0%) hue-rotate(52deg) brightness(1);
}

.check-text {
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 0.9em;
    color: #6f499b;
    margin: 0;
}

.check-text:hover {
    color: #92c156;
    cursor: pointer;
}
</style>
