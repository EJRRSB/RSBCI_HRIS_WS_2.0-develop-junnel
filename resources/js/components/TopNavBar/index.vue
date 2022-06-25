<template>
    <div class="main-header">
        <div class="header-left">
            <h2 id="header-title" class="header-title">
                Employee Registrants List
            </h2>
        </div>

        <div class="header-right">
            <div id="search-button">
                <img
                    class="header-search-icon"
                    src="/assets/images/search-white-icon.svg"
                />
            </div>
            <input type="text" placeholder="Search Here" id="search-bar" />
            <button class="admin-button">Admin Mode</button>
            <img
                id="profile-photo"
                src="/assets/images/default-pic-employee.svg"
            />
            <p id="profile-name">Matthew Gappi</p>
            <img
                @click="showDropDown = !showDropDown"
                id="header-dropdown"
                class="arrow-down-svg"
                src="/assets/images/arrow-down.svg"
            />
        </div>
    </div>

    <!-- Dropdown -->
    <div class="header-dropdown-container" v-show="showDropDown">
        <div class="header-dropdown-list">
            <div class="list-icon-container">
                <img
                    class="header-dropdown-icon"
                    src="/assets/images/header-list-profile.svg"
                />
            </div>
            <h4 class="header-dropdown-text">Account Settings</h4>
        </div>
        <div class="header-dropdown-list">
            <div class="list-icon-container">
                <img
                    class="header-dropdown-icon"
                    src="/assets/images/header-list-sample.svg"
                />
            </div>
            <h4 class="header-dropdown-text">Other Settings</h4>
        </div>
        <div class="header-dropdown-list">
            <div class="list-icon-container">
                <img
                    class="header-dropdown-icon"
                    src="/assets/images/header-list-password.svg"
                />
            </div>
            <h4 class="header-dropdown-text">Change Password</h4>
        </div>
        <div class="header-dropdown-list" @click="logout">
            <div class="list-icon-container">
                <img
                    class="header-dropdown-icon"
                    src="/assets/images/header-list-logout.svg"
                    style="padding-left: 2px"
                />
            </div>
            <h4 class="header-dropdown-text">Logout</h4>
        </div>
    </div>

    
</template>

<script>
import { ref } from "@vue/reactivity";
import { useRouter } from "vue-router";
import { VueCookieNext } from "vue-cookie-next";

export default {
    setup() {
        const showDropDown = ref(false);
        const router = useRouter();
        const logout = () => {
            VueCookieNext.setCookie("token", "");
            router.push("/");
        };
        const setTheme = () => {};
        return { showDropDown, logout };
    },
};
</script>

<style lang="scss" scoped>
.main-header {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 60px;
    background-color: #606060;
    padding: 0 280px 0 30px;
    padding: 0 90px 0 30px;
}

#header-title {
    font-family: "Source Sans Pro", sans-serif;
    font-size: 1.5em;
    font-weight: 600;
}

.header-left {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
}

.header-right {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-end;
}

.header-title {
    color: white;
    margin: 0 20px 0 0;
    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
}

#search-button {
    height: 30px;
    width: 30px;
    padding: 5px;
    background-color: #ffae39;
    border-radius: 2.5px 0 0 2.5px;
    cursor: pointer;
}

#search-bar {
    background-color: white;
    height: 30px;
    width: 250px;
    padding: 10px;
    border: none;
    outline: none;
    border-radius: 0px 2.5px 2.5px 0;
}

.admin-button {
    height: 30px;
    width: auto;
    padding: 0px 15px;
    margin: 0 20px;

    border: none;
    border-radius: 2.5px;

    background-color: #24a7aa;
    color: white;
    font-size: 0.8em;
}

#profile-photo {
    height: 35px;
    width: 35px;
    border-radius: 2.5px;
}

#profile-name {
    color: white;
    margin: 0 10px;
    font-weight: 500;
    font-family: "Source Sans Pro", sans-serif;
    font-size: 1.2em;
    line-height: auto;
}

#header-dropdown {
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1000%)
        contrast(100%);
    cursor: pointer;
    width: 14px;
}

.header-dropdown-container {
    position: fixed;
    display: flex;
    flex-direction: column;
    width: 195px;
    height: auto;
    top: 0;
    right: 50px;
    margin-right: 30px;
    margin-top: 60px;
}

.header-dropdown-list {
    display: flex;
    flex-direction: row;
    align-items: center;
    height: 38px;
    background-color: #ffffff;
    padding-left: 11px;
    border-bottom: 2px solid #dedede;
    cursor: pointer;
}

.list-icon-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 22px;
    width: 22px;
    margin-right: 12px;
}

.header-dropdown-icon {
    height: 22px;
    width: auto;
}

.header-dropdown-text {
    color: #51a4a8;
    font-size: 0.85em;
    margin: 0;
    padding-bottom: 2px;
}

.header-dropdown-list:hover {
    background-color: #51a4a8;
}

.header-dropdown-list:hover h4 {
    color: #ffffff;
}

.header-dropdown-list:hover img {
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1000%)
        contrast(100%);
}
</style>
