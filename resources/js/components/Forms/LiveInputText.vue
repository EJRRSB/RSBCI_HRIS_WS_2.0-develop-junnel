<template>
    <div>
        <div class="row-container">
            <h3>{{ label }}</h3>
            <div class="icon-indicator-row">
                <input
                    v-model="inputValue"
                    @keyup="updateValue"
                    :placeholder="placeholder"
                    :class="{ textFieldDisabled: disable }"
                />
                <!-- Status Code
                        0 = Loading
                        1 = Valid
                        2 = Invalid
                        3 = Default
                -->
                <div v-if="isStatus == 0" class="icon-indicator-box bg-default">
                    <div>
                        <img src="assets/images/loader.svg" />
                    </div>
                </div>
                <div
                    v-else-if="isStatus == 1"
                    class="icon-indicator-box bg-green"
                >
                    <div>
                        <img src="assets/images/ind-valid.svg" />
                    </div>
                </div>
                <div
                    v-else-if="isStatus == 2"
                    class="icon-indicator-box bg-red"
                >
                    <div>
                        <img src="assets/images/ind-error.svg" />
                    </div>
                </div>
                <div
                    v-else-if="isStatus == 3"
                    class="icon-indicator-box bg-default"
                    :class="{ bgDisable: disable }"
                ></div>
            </div>
        </div>
        <div class="input-row" v-if="errorMessage">
            <div></div>
            <ErrorInputField :message="errorMessage" class="error-message" />
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import ErrorInputField from "../../components/Notifs/ErrorInputField.vue";
import { onMounted } from "@vue/runtime-core";

export default {
    components: { ErrorInputField },
    props: {
        value: {
            default: "",
            type: String,
        },
        isStatus: {
            default: 0,
            type: Number,
        },
        errorMessage: {
            default: "",
            type: [String, Array],
        },
        label: {
            default: "",
            type: String,
        },
        placeholder: {
            default: "",
            type: String,
        },
        defaultValue: {
            default: "",
            type: String,
        },
        disable: {
            default: false,
            type: Boolean,
        },
    },
    emits: ["update:value"],
    setup(props, { emit }) {
        const inputValue = ref(props.value);
        onMounted(() => {
            if (!props.value) {
                inputValue.value = props.defaultValue;
                emit("update:value", inputValue.value);
            }
        });
        emit("update:value", inputValue.value);
        const updateValue = () => {
            //console.log(inputValue.value);
            emit("update:value", inputValue.value);
        };
        return { updateValue, inputValue };
    },
};
</script>

<style scoped>
.input-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}
.row-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
    width: 100%;
}
.icon-indicator-row {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    width: 370px;
}
input {
    height: 36px;
    border-right: 0;
    border-radius: 5px 0 0 5px;
    padding-left: 10px;
    outline: none;
    width: 100%;
    border-top: solid 2px #a9a9a9;
    border-left: solid 2px #a9a9a9;
    border-bottom: solid 2px #a9a9a9;
}
.icon-indicator-box {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    border-radius: 0 5px 5px 0;
    font-family: "Noto Sans", sans-serif;
    color: white;
    width: 36px;
    height: 36px;
}
.icon-indicator-box img {
    width: 22px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}
input:focus {
    border: solid 2px #6f499b;
}
h3 {
    padding: 10px 0;
    margin: 0;
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    color: #008dba;
}
.bg-default {
    border-top: solid 2px #a9a9a9;
    border-right: solid 2px #a9a9a9;
    border-bottom: solid 2px #a9a9a9;
}
.bg-red {
    background-color: #f34336;
    border-top: solid 2px #f34336;
    border-left: solid 2px #f34336;
    border-bottom: solid 2px #f34336;
}
.bg-green {
    background-color: #92c156;
    border-top: solid 2px #92c156;
    border-left: solid 2px #92c156;
    border-bottom: solid 2px #92c156;
}
.bgDisable {
    background-color: #efefef;
}
.textFieldDisabled {
    border-bottom: solid 2px #a9a9a9;
    border-left: solid 2px #a9a9a9;
    border-top: solid 2px #a9a9a9;
    background-color: #efefef;
    outline: none;
    padding-left: 10px;
    cursor: not-allowed;
    pointer-events: none;
}
.error-message {
    width: 370px;
}
</style>
