<template>
    <div>
        <div class="field-row">
            <h3>{{ label }}</h3>
            <div class="icon-indicator-row">
                <input
                    placeholder="Enter Password"
                    :type="isShow ? 'text' : 'password'"
                    v-model="inputValue"
                    @change="updateValue"
                    :v-bind:class="{ 'error-input': errorMessage }"
                />
                <div
                    :class="
                        isShow
                            ? 'icon-indicator-box bg-purple view-password'
                            : 'icon-indicator-box bg-blue view-password'
                    "
                    @click="isShow = !isShow"
                >
                    <img v-if="isShow" src="assets/images/ind-hide.svg" />
                    <img v-else src="assets/images/ind-view.svg" />
                </div>
            </div>
        </div>
        <div class="error-field" v-if="errorMessage">
            <div></div>
            <ErrorInputField :message="errorMessage" class="error-message" />
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import ErrorInputField from "../../components/Notifs/ErrorInputField.vue";
export default {
    components: { ErrorInputField },
    props: {
        value: {
            default: "",
            type: String,
        },
        label: {
            default: "Password",
            type: String,
        },
        placeHolder: {
            default: "Password",
            type: String,
        },
        errorMessage: [Array, String],
    },
    emits: ["update:value"],
    setup(props, { emit }) {
        const isShow = ref(false);
        const inputValue = ref();
        const updateValue = () => {
            emit("update:value", inputValue.value);
        };
        return { isShow, updateValue, inputValue };
    },
};
</script>

<style scoped>
.row-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}
.icon-indicator-row {
    display: flex;
    flex-direction: row;
    width: 100%;
    margin-bottom: 10px;
}
input {
    height: 38px;
    width: 100%;
    border: solid 2px #a9a9a9;
    border-right: none;
    border-radius: 5px 0 0 5px;
    outline: none;
    padding-left: 10px;
}
input:focus {
    border: solid 2px #6f499b;
}
.icon-indicator-box {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #a9a9a9;
    border-radius: 0 5px 5px 0;
    font-family: "Noto Sans", sans-serif;
    color: white;
    width: 36px;
    height: 38px;
}
.icon-indicator-box img {
    max-width: 25px;
    max-height: 18px;
}
.view-password:hover {
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
.bg-purple {
    background-color: #694b96;
}

.bg-blue {
    background-color: #008ebb;
}
.error-field {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
 
}
</style>
