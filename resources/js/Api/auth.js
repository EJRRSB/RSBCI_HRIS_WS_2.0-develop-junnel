import { config, getTenantName } from "./config.js";
import { ref, reactive } from "vue";
import axios from 'axios'
import { VueCookieNext } from 'vue-cookie-next'
export default function useAuth() {
    const user = ref([]);
    const errors = ref('')

    const userLogin = async(data) => {
        errors.value = ''
        try {
            let response = await axios.post('/api/v1/login', data);
            user.value = response;
            VueCookieNext.setCookie("account_type", response.data.User.account_type);
            VueCookieNext.setCookie("token", user.value.data['Access-Token']);

        } catch (e) {
            //console.log(e.response)
            errors.value = e.response;
        }
    }

    const userChangePassword = async(data) => {
        errors.value = ''
        try {
            let response = await axios.post('/api/v1/change-password', data);
            user.value = response;


            VueCookieNext.setCookie("token", user.value.data['Access-Token'])
                // localStorage.setItem("token", user.value.data['Access-Token'])
                //console.log(user.value.data)

        } catch (e) {
            console.log(e)
            errors.value = e.response;
        }
    }

    const userCheckTenant = async() => {
        errors.value = ''
        try {
            let response = await axios.post('/api/v1/tenant/');
            user.value = response;
        } catch (e) {

            console.log(e.response)
            errors.value = e.response;
        }
    }




    return {
        user,
        userLogin,
        userChangePassword,
        errors,
        userCheckTenant
    }

}