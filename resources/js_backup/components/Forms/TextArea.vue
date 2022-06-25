<template>
  <div>
    <div class="field-row">
      <div class="label">
        <h4>{{ label }}</h4>
        <h4><div class="required" v-show="isRequired">*</div></h4>
      </div>

      <textarea
        :type="type"
        class="description"
        :placeholder="placeHolder"
        v-model="inputValue"
        @change="updateValue"
        :v-bind:class="{ 'error-input': errorMessage }"
      >
      </textarea>
    </div>
    <div class="field-row">
      <div></div>
      <ErrorInputField
        v-if="errorMessage"
        :message="errorMessage"
        style="width: 65%"
      />
    </div>
  </div>
</template>

<script>
import ErrorInputField from '@/components/Notifs/ErrorInputField.vue'
import { onMounted, ref, watch } from 'vue'

export default {
  components: { ErrorInputField },
  props: {
    errorMessage: [Array, String],
    label: {
      default: 'Label Name',
      type: String,
    },
    placeHolder: {
      default: '',
      type: String,
    },
    type: {
      default: 'text',
      type: String,
    },
    isRequired: {
      default: false,
      type: Boolean,
    },
    value: {
      default: '',
      type: String,
    },
    defaultValue: String,
  },
  emits: ['update:value'],
  setup(props, { emit }) {
    const inputValue = ref(props.value)
    onMounted(() => {
      console.log('TESTER' + props.defaultValue)
      if (!props.value) {
        inputValue.value = props.defaultValue
        emit('update:value', inputValue.value)
      }
    })
    emit('update:value', inputValue.value)
    const updateValue = () => {
      emit('update:value', inputValue.value)
    }

    return { inputValue, updateValue }
  },
}
</script>

<style lang="sass" scoped>
.field-row
  display: flex
  flex-direction: row
  align-items: center
  justify-content: space-between
  width: 600px
  margin: 10px 0px
  #description
    height: 10em
    width: 100%
    margin-bottom: 40px
    padding-left: 10px
    padding-top: 10px
    border: solid 2px #dedede
    border-radius: 5px
    outline: none
    font-family: 'Noto Sans', 'sans-serif'

    &:focus
      border: solid 2px #6f499b
  .text-field-disabled
    height: 38px
    width: 65%
    border: solid 2px #a9a9a9
    background-color: #efefef
    border-radius: 5px
    outline: none
    padding-left: 10px
    cursor: not-allowed
.error-input
  border: solid 2px #f34336
</style>
