<template>
  <div>
    <div class="field-row">
      <div class="label">
        <h4>{{ label }}</h4>
        <h4><div class="required" v-show="isRequired">*</div></h4>
      </div>

      <select
        class="onboarding-form-select"
        v-model="inputValue"
        @change="updateValue"
      >
        <option value="" :disabled="isRequired">
          {{ placeHolder }}
        </option>

        <option v-for="item in options" :value="item.name" :key="item.code">
          {{ item.name }}
        </option>
      </select>
    </div>
    <div class="error-field">
      <div></div>
      <ErrorInputField
        v-if="errorMessage"
        :message="errorMessage"
        class="error-message"
      />
    </div>
  </div>
</template>

<script>
import { onBeforeMount, ref } from 'vue'
import ErrorInputField from '@/components/Notifs/ErrorInputField.vue'
export default {
  components: { ErrorInputField },
  props: {
    errorMessage: [Array, String],
    label: String,
    value: [Number, String],
    placeHolder: {
      default: '',
      type: String,
    },
    isRequired: {
      default: false,
      type: Boolean,
    },
    options: Object,
  },
  emits: ['update:value'],
  setup(props, { emit }) {
    const inputValue = ref('')
    const updateValue = () => {
      emit('update:value', inputValue.value)
    }
    onBeforeMount(() => {
      if (props.value && props.options) {
        inputValue.value = props.value
      }
    })

    return { inputValue, updateValue }
  },
}
</script>

<style lang="sass">
.error-field
  display: flex
  justify-content: space-between
  align-items: center
  .error-message
    width: 65%

.field-row
  display: flex
  flex-direction: row
  align-items: center
  justify-content: space-between
  width: 600px
  .onboarding-form-select
    height: 38px
    width: 65%
    border: solid 2px #a9a9a9
    border-radius: 5px
    outline: none
    padding-left: 10px
    font-family: "Noto Sans", sans-serif
    font-weight: 500
    font-size: 1em
    background: #fff
    select:required:invalid
      color: #a0a0a0
    option[value=""][disabled]
      display: none
    option
      font-family: "Noto Sans", sans-serif
      font-weight: 500
      font-size: 1em
      color: #606060
    &:focus
        border: solid 2px #6f499b
</style>
