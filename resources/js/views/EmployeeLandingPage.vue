<template>
    <MainTemplate>
        <!-- Main Header -->

        <!-- Board Area -->
        <div class="board">
            <!-- Breadcrumb -->
            <div class="breadcrumb-container">
                <a href="index.html">Array Company</a>
                <h4>&nbsp; &#92; &nbsp;</h4>
                <a href="index.html" id="breadcrumb-active">Welcome Page</a>
            </div>

            <!-- Board Content -->
            <div class="board-content">
                <div class="welcome-employee-container">
                    <h1>Welcome to the Company Site!</h1>
                    <h3>
                        To get you started , fill out the lorem ipsum dolor sit
                        amet, consectetuer adipiscing elit, sed diam nonummy
                        nibh euismod tincidunt ut laoreet dolore magna aliquam
                        erat.
                    </h3>
                    <img src="assets/images/employee-welcome.svg" />
                    <button class="green-btn">
                        Proceed to Employee Onboarding
                    </button>
                </div>
            </div>
        </div>
    </MainTemplate>
</template>

<script>
import MainTemplate from "../components/MainTemplate.vue";
export default {
    components: { MainTemplate },
};
</script>

<style scoped>
@charset "utf-8";

* {
    box-sizing: border-box;
}

html,
body {
    height: 100%;
    width: 100%;
    padding: 0;
    margin: 0;
    background-color: #efefef;
    overflow-x: hidden;
}

.left-container {
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100vh;
    width: auto;

    z-index: 5; /* Stay on top */
    top: 0; /* Stay at the top */
    left: 0;

    overflow-x: hidden;
    overflow-y: hidden;
    background-color: #efefef;
    box-shadow: 1px 0px 5px 0px #888888;
}

.right-container {
    padding-left: 60px;
    width: 100%;
    min-height: 100vh;
    height: auto;
}

.main-header {
    position: fixed;
    display: flex;
    flex-direction: row;
    align-items: center;
    z-index: 4;
    width: 100%;
    height: 60px;
    background-color: #6f499b;
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
    width: 20%;
    min-width: 300px;
}

.header-right {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-end;
    width: 80%;
    min-width: 700px;
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
    border-radius: 5px;
    margin: 0;
    padding: 0;
    background-color: #606060;
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

.board {
    width: 100%;
    /* background: url("assets/images/bg-light.png"); */
    background: #ffffffd2;
    height: 100%;
    widows: 100%;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: top center;
    background-size: cover;
    height: 100%;
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

.board-content {
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

.welcome-employee-container {
    background-color: #ffffff;
    width: 680px;
    height: 680px;
    border-radius: 5px;

    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px 80px 20px 80px;
}

.welcome-employee-container h1 {
    font-family: "Source Sans Pro", sans-serif;
    font-weight: 700;
    font-size: 2em;
    color: #6f499b;
    margin-bottom: 20px;
}

.welcome-employee-container h3 {
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    text-align: center;
    color: #606060;
    margin-bottom: 40px;
}

.welcome-employee-container img {
    height: 340px;
    width: auto;
    margin-bottom: 50px;
}

/* Global CSS*/

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

.row {
    display: flex;
    direction: row;
}

.col {
    display: flex;
    direction: column;
}

input {
    font-family: "Noto Sans", sans-serif;
    font-weight: 500;
    font-size: 1em;
    color: #606060;
}

select {
    font-family: "Noto Sans", sans-serif;
    font-weight: 500;
    font-size: 1em;
    color: #606060;
    background-color: white;
}

.col-2 {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    height: inherit;
}

.error-message {
    display: flex;
    align-items: center;
    height: 30px;
    width: 65%;

    background-color: #ff908d;

    padding-left: 15px;
    border-radius: 5px;
}

.error-message p {
    font-size: 0.8em;
    font-weight: 600;
    color: #ffffff;
}

form .text-field:invalid {
    border: solid 2px #f34336;
}

h1,
h2,
h3 {
    font-family: "Source Sans Pro", sans-serif;
    padding: 0;
    margin: 0;
}

h4,
h5,
h6 {
    font-family: "Noto Sans", sans-serif;
    padding: 0;
    margin: 0;
}

p {
    font-family: "Noto Sans", sans-serif;
    font-weight: 500;
    font-size: 1em;
    padding: 0;
    margin: 0;
}

h4[required]:after {
    content: "*";
    color: #cc3333;
    padding-left: 4px;
}

.modal {
    visibility: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    height: 400px;
    width: 400px;
    padding: 30px 20px;

    position: absolute;
    z-index: 7;
    left: calc(50% - 200px);
    top: calc(50% - 200px);
    background-color: white;

    border-radius: 5px;
}

.modal h4 {
    font-size: 1.1em;
    color: #606060;
}

.question-mark {
    min-width: 100px;
}

.modal-background {
    visibility: hidden;
    position: absolute;
    width: 100vw;
    height: 100vh;
    background-color: #606060;
    opacity: 0.8;
    z-index: 6;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
}

.notification-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    height: 120px;
    width: 400px;

    position: fixed;
    z-index: 6;
    right: 20px;
    bottom: 20px;
    border: solid 2px #efefef;
    box-shadow: 1px 0px 5px 0px #888888;
    border-radius: 10px;
    padding: 20px 30px;
}

.notification-container img {
    margin-right: 20px;
}

.notification-textbox {
    color: white;
}

.notification-textbox h3 {
    font-weight: 600;
    font-size: 1.3em;
}

.notification-textbox p {
    font-weight: 500;
    font-size: 0.9em;
}

#notif-success {
    visibility: hidden;
    background-color: #92c156;
}

#notif-error {
    visibility: hidden;
    background-color: #f34336;
}

#notif-warning {
    visibility: hidden;
    background-color: #ff9d3b;
}

@media screen and (max-width: 865px) {
    .board-content {
        transform: scale(0.9);
        transform-origin: center 0;
        height: inherit;
    }
}

.navlinks-container {
    transition: 0.3s;
    transition-timing-function: ease-in-out;
}
.navlinks-container .menu-icon-svg {
    transition: 0.3s;
    transition-timing-function: ease-in-out;
}
.navlinks-container p {
    transition: 0.3s;
    transition-timing-function: ease-in-out;
}
.navlinks-container .arrow-down-svg {
    transition: 0.3s;
    transition-timing-function: ease-in-out;
}

.navlinks-container:hover {
    cursor: pointer;
    background-color: #92c156;
}
.navlinks-container:hover p {
    color: white;
}
.navlinks-container:hover .menu-icon-svg {
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1000%)
        contrast(100%);
}
.navlinks-container:hover .arrow-down-svg {
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1000%)
        contrast(100%);
}

.admin-button:hover {
    opacity: 0.85;
}

#header-dropdown:hover {
    width: 14px;
}

.collapse-button:hover {
    background-color: #92c156;
}

#search-button:hover {
    background-color: #92c156;
}

.button:hover {
    opacity: 0.85;
}

.navlinks-collapsed-container:hover {
    background-color: #92c156;
}

.navlinks-collapsed-container:hover img {
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1000%)
        contrast(100%);
}
</style>
