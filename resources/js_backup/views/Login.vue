<template>
    <div class="container-body">
        <div class="main-container">
            <img class="array-logo" src="assets/images/array-logo.svg" />

            <!-- Login Form -->
            <div id="content-1" class="content" v-if="page == 1">
                <div class="field-col">
                    <h3>Username</h3>
                    <input
                        class="text-field"
                        type="text"
                        v-model="form_login.email"
                        placeholder="Enter Username/Work Email"
                    />
                </div>
                <ErrorInputField
                    v-if="data_errors.email"
                    :message="data_errors.email"
                />
                <div class="field-row">
                    <InputPassword v-model:value="form_login.password" />
                </div>
                <ErrorInputField
                    v-if="data_errors.password"
                    :message="data_errors.password"
                />
                <ErrorInputField
                    v-if="data_errors.unauth"
                    :message="data_errors.unauth"
                />
                <div id="rm-row" class="row-container">
                    <div
                        class="row-container"
                        style="justify-content: flex-start width: 50%"
                    >
                        <input
                            id="rm-box"
                            type="checkbox"
                            v-on:click="rememberMe"
                            :checked="isRemember"
                        />
                        <p class="rm-text" v-on:click="rememberMe">
                            Remember Me
                        </p>
                    </div>

                    <div
                        class="row-container"
                        style="justify-content: flex-end width: 50%"
                    >
                        <!-- <a id="forgot-pass" href="x">Forgot Password?</a> -->
                    </div>
                </div>

                <button id="login" @click="login">Login</button>
                <button id="sign-up" @click="signUp">Sign Up</button>
            </div>
            <!-- Change Password Form (FIRST TIME LOGIN) -->
            <div id="content-2" class="content" v-if="page == 2">
                <div class="field-col">
                    <InputPassword
                        label="Current Password"
                        v-model:value="form_change_pass.password"
                    />
                </div>
                <ErrorInputField
                    v-if="data_error_pass.password"
                    :message="data_error_pass.password"
                />

                <div class="field-col">
                    <InputPassword
                        label="New Password"
                        v-model:value="form_change_pass.new_password"
                        placeHolder="Enter New Password"
                    />
                </div>
                <ErrorInputField
                    v-if="data_error_pass.new_password"
                    :message="data_error_pass.new_password"
                />

                <div class="field-col">
                    <InputPassword
                        label="Confirm Password"
                        v-model:value="form_change_pass.confirm_password"
                        placeHolder="Re-enter New Password"
                    />
                </div>
                <ErrorInputField
                    v-if="data_error_pass.confirm_password"
                    :message="data_error_pass.confirm_password"
                />

                <button id="change-password" @click="changePassword">
                    Change Password
                </button>
            </div>
            <Loading message="Logging you in..." v-if="page == 3" />
        </div>
    </div>
</template>

<script>
import { onBeforeMount, reactive, ref, watch } from "vue";
import Loading from "../components/Loading.vue";
import useAuth from "../Api/auth";
import ErrorInputField from "../components/Notifs/ErrorInputField.vue";
import { useRouter, useRoute } from "vue-router";
import { VueCookieNext } from "vue-cookie-next";
import useValidators from "../validators";
import InputPassword from "../components/Forms/InputPassword.vue";
export default {
    components: { ErrorInputField, Loading, InputPassword },
    setup() {
        const router = useRouter();

        const form_login = reactive({
            email: "",
            password: "",
        });
        const data_errors = reactive({
            email: "",
            password: "",
            unauth: "",
        });
        const page = ref(1);
        const token = ref("");

        //Remember Me
        const isRemember = ref(false);
        const rememberMe = () => {
            if (isRemember.value) {
                isRemember.value = false;
            } else {
                isRemember.value = true;
            }
        };

        const rememberEmail = () => {
            if (isRemember.value) {
                VueCookieNext.setCookie("email", form_login.email);
            }
        };

        onBeforeMount(() => {
            if (VueCookieNext.getCookie("email")) {
                form_login.email = VueCookieNext.getCookie("email");
            }
        });

        //Login Page
        const { userLogin, userChangePassword, user, errors } = useAuth();
        const { v_required, v_email, v_username } = useValidators();
        const login = async () => {
            //Validate First
            resetFormLogin();
            const hasError = ref(false);
            if (!form_login.email) {
                data_errors["email"] = ["The Email field is required."];
                hasError.value = true;
            } else if (
                !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
                    form_login.email
                )
            ) {
                data_errors["email"] = ["The Email format is invalid."];
                hasError.value = true;
            }
            if (!form_login.password) {
                data_errors["password"] = ["The Password field is required."];
                hasError.value = true;
            }
            if (hasError.value) {
                return;
            }

            page.value = 3;
            resetFormLogin();
            await userLogin(form_login);
        };

        watch(user, () => {
            console.log("LOGIN");
            console.log(user.value);
            if (user.value.data.message == "errors") {
                for (let item in user.value.data.errors) {
                    data_errors[item] = user.value.data.errors[item];
                }
            } else if (user.value.data.message == "unauthorized") {
                console.log(user.value.data);
                data_errors["unauth"] = [user.value.data.errors];
                page.value = 1;
            } else if (user.value.data.User.first_login) {
                //If first time login
                resetFormChangePass();
                VueCookieNext.setCookie("token", "");
                rememberEmail();
                page.value = 2;
            } else {
                rememberEmail();
                router.push("/employee-landing");
            }
        });

        const resetFormLogin = () => {
            data_errors.email = "";
            data_errors.password = "";
            data_errors.unauth = "";
        };

        //Change Password
        const form_change_pass = reactive({
            password: "",
            confirm_password: "",
            new_password: "",
        });
        const data_error_pass = reactive({
            password: "",
            confirm_password: "",
            new_password: "",
        });
        const resetFormChangePass = () => {
            data_error_pass.password = "";
            data_error_pass.confirm_password = "";
            data_error_pass.new_password = "";
        };

        const changePassword = async () => {
            resetFormChangePass();
            hasError.value = false;
            if (form_change_pass.new_password.length < 8) {
                data_error_pass["new_password"] = [
                    "Password must be at least 8 characters.",
                ];
                hasError.value = true;
            }
            if (
                form_change_pass.new_password !=
                form_change_pass.confirm_password
            ) {
                data_error_pass["confirm_password"] = [
                    "Those passwords didn't match. Try again",
                ];
                hasError.value = true;
            }
            page.value = 3;
            const data = reactive({
                email: form_login.email,
                password: form_change_pass.password,
                new_password: form_change_pass.new_password,
            });
            console.log(data);
            await userChangePassword(data);
            page.value = 2;
        };

        watch(user, () => {s
            if (user.value.data.message == "unauthorized") {
                data_error_pass["password"] = ["The password is incorrect."];
            }
            if (user.value.data.message == "errors") {
                for (let item in user.value.data.errors) {
                    data_error_pass[item] = user.value.data.errors[item];
                }
            }
        });

        const signUp = () =>{
            router.push("/sign-up");
        }

        return {
            data_error_pass,
            form_change_pass,
            changePassword,
            data_errors,
            form_login,
            login,
            page,
            isRemember,
            rememberMe,
            signUp
        };
    },
};
</script>

<style scoped>
.container-body {
    width: 100%;
    /* background: url("assets/images/login_bg.png"); */
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: top center;
    background-size: cover;
    min-height: 100vh;
    height: auto;
}

.main-container {
    width: 540px;
    height: 700px;
    display: flex;
    flex-direction: column;

    position: absolute;
    padding: 80px 70px;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;

    margin: auto;

    background-color: #efefef;
    box-shadow: 2px 2px 5px 2px #cccccc;
    border-radius: 5px;
}

.content {
    display: flex;
    flex-direction: column;
}

.array-logo {
    height: 74px;
    width: auto;
    margin-bottom: 50px;
}

.row-container {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.field-col {
    width: 100%;
    display: flex;
    flex-direction: column;
}

.text-field {
    height: 38px;
    width: 100%;
    border: solid 2px #a9a9a9;
    border-radius: 5px;
    outline: none;
    padding-left: 10px;
}

.text-field:focus {
    border: solid 2px #6f499b;
}

#rm-box {
    height: 40px;
    margin: 0px 10px 0px 0px;
    padding: 0;
    filter: invert(0%) hue-rotate(52deg) brightness(1);
}

.rm-text {
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 1em;
    color: #6f499b;
    margin: 0;
}

.rm-text:hover {
    color: #92c156;
    cursor: pointer;
}

#forgot-pass {
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 1em;
    color: #ff9d3b;
    margin: 0;
    text-decoration: none;
    align-self: flex-end;
}

#login {
    height: 40px;
    color: white;
    background-color: #92c156;
    border: none;
    border-radius: 5px;

    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    letter-spacing: 0.3px;

    margin-top: 60px;
    margin-bottom: 10px;
}

#login:hover {
    opacity: 0.85;
    cursor: pointer;
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
}

#sign-up:hover {
    opacity: 0.85;
    cursor: pointer;
}

#change-password {
    height: 40px;
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
</style>
