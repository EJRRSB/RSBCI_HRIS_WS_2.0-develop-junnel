<template>
    <div>
        <router-view v-if="isAuth"></router-view>
    </div>
</template>

<script>
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import { onBeforeMount, ref, watch } from "vue";
import useAuth from "../Api/auth";
import { getTenantName } from "../Api/config";
import { useRouter } from "vue-router";

export default {
    components: {
        Home,
        Login,
    },
    setup() {
        const { user, userCheckTenant } = useAuth();
        const isAuth = ref(false);
        const router = useRouter();
        const CheckTenantName = async () => {
            await userCheckTenant();
        };
        watch(user, () => {
            console.log(user.value.data);
            if (user.value.data.is_exist) {
                isAuth.value = true;
            } else {
                window.location.href = "https://chronos.rsbcidevteam.tech/";
            }
        });
        onBeforeMount(CheckTenantName);

        return { isAuth };
    },
};
</script>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    background-image: url("/assets/images/bg.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    width: 100%;
    height: 100vh;
}
</style>
