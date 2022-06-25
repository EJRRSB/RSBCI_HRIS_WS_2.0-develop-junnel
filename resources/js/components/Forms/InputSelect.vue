<template>
  <div>
    <div class="field-row">
      <div class="label">
        <h4>{{ label }}</h4>
        <h4><div class="required" v-show="isRequired">*</div></h4>
      </div>

      <div class="select-field">
        <select v-model="inputValue" @change="updateValue">
          <option value="" :disabled="isRequired">
            {{ placeHolder }}
          </option>

          <option v-for="(value, key) in options" :value="key" :key="key">
            {{ value.substring(0, 100) }}
          </option>
        </select>
      </div>
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
import ErrorInputField from '../../components/Notifs/ErrorInputField.vue'
export default {
  components: { ErrorInputField },
  props: {
    errorMessage: [Array, String],
    label: String,
    value: {
      type: [Number, String],
      default: null,
    },
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
        console.log('HERERE: ' + props.value)
        inputValue.value = props.value
      }
    })

    return { inputValue, updateValue }
  },
}
</script>

<style lang="sass">

.field-row
  display: flex
  flex-direction: row
  align-items: center
  justify-content: space-between
  width: 600px
  margin: 10px 0 10px
  .select-field
    display: flex
    flex-direction: column
    width: 65%
    select
      height: 38px
      background: red
      border: solid 2px #a9a9a9
      border-radius: 5px
      width: 100%
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
