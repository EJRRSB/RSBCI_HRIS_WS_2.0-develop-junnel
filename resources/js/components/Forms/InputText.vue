<template>
    <div>
        <div class="field-row">
            <div class="label">
                {{ label }}
                <span class="required" v-show="isRequired">*</span>
            </div>

            <div class="input-field">
                <input
                    autocomplete="off"
                    :type="type"
                    :placeholder="placeHolder"
                    v-model="inputValue"
                    @change="updateValue"
                    :class="{ textFieldDisabled: disable }"
                    :maxlength="maxlength"
                />
                <!-- :class="{ errorInput: errorMessage }" -->
            </div>
        </div>
        <div class="error-field" v-if="errorMessage">
            <div></div>
            <ErrorInputField :message="errorMessage" class="error-message" />
        </div>
    </div>
</template>

<script>
import ErrorInputField from "../../components/Notifs/ErrorInputField.vue";
import { onMounted, ref, watch } from "vue";

export default {
    components: { ErrorInputField },
    props: {
        errorMessage: [Array, String],
        label: {
            default: "Label Name",
            type: String,
        },
        placeHolder: {
            default: "",
            type: String,
        },
        maxlength: {
            default: '255',
            type: String,
        },
        type: {
            default: "text",
            type: String,
        },
        isRequired: {
            default: false,
            type: Boolean,
        },
        value: {
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
            emit("update:value", inputValue.value);
            console.log(props.value);
        };

        return { inputValue, updateValue };
    },
};
</script>

<style lang="sass" scoped>

.field-row
  display: flex
  flex-direction: row
  align-items: center
  justify-content: space-between
  margin-bottom: 10px
  .label
    font-family: 'Noto Sans', sans-serif
    font-weight: 600
    font-size: 1.1em
    color: #008dba

    .required
      color: #cc3333
      padding-left: 4px

  .input-field
    display: flex
    flex-direction: column
    width: 65%
    input
      height: 38px
      width: 100%
      border: solid 2px #a9a9a9
      border-radius: 5px
      outline: none
      padding-left: 10px
      &:focus
        border: solid 2px #6f499b
    .errorInput
      border: solid 2px #f34336
    .textFieldDisabled
      height: 38px
      width: 100%
      border: solid 2px #a9a9a9
      background-color: #efefef
      border-radius: 5px
      outline: none
      padding-left: 10px
      cursor: not-allowed
      pointer-events: none

.error-field
    display: flex
    justify-content: space-between
    margin-bottom: 10px
    .error-message
        width: 370px
</style>
