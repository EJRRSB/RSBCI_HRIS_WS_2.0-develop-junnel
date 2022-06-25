<template>
  <div>
    <div class="field-row" style="height: auto max-height: 170px">
      <div class="col-2" style="width: 35% height: 170px">
        <h4>Company Logo</h4>
        <br />
        <p>Max File Size:<br />25MB</p>
      </div>
      <div class="col-2" style="width: 65%">
        <!-- <span class="remove_image" @click="removeImage">Remove Image</span> -->
        <div class="logo-upload-container">
          <span v-if="img" class="remove_image" @click="removeImage">&times;</span>
          <img v-if="!img" src="assets/images/company-logo-placeholder.svg" />
          <img v-else :src="img" />
        </div>
        <input
          type="file"
          ref="file"
          style="display: none"
          accept="image/*"
          max="2"
          @change="previewImage"
        />
        <button
          id="logo-upload-btn"
          class="green-btn"
          @click="this.$refs.file.value=null, $refs.file.click()"
        >
          Upload Logo
        </button>
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
import { ref } from 'vue'
import ErrorInputField from '../../components/Notifs/ErrorInputField.vue'
export default {
  components: { ErrorInputField },
  props: {
    errorMessage: [Array, String],
    label: {
      default: 'Label Name',
      type: String,
    },
  },
  emits: ['update:value', 'update:errorMessage'],
  setup(props, { emit }) {
    const img = ref(null)
    const previewImage = function (event) {
      var input = event.target
      emit('update:errorMessage', '')
      if (input.files[0].size > 25000000) {
        console.log(input.files[0].size)
        emit('update:errorMessage', ['File max size is 25 mb'])
        input.files = null
        return
      }

      if (input.files) {
        var reader = new FileReader()
        reader.onload = (e) => {
          img.value = e.target.result
          emit('update:value', input.files[0])
        }

        reader.readAsDataURL(input.files[0])
      }
    }


    // ELTON
    const removeImage = function (event) {    
      img.value = null
      emit('update:value', null)
    }


    return { previewImage, removeImage, img }
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
  .logo-upload-container
    display: flex
    align-items: center
    justify-content: center
    max-height: 240px
    padding: 20px 30px
    background-color: #efefef
    width: 100%
    border-radius: 5px
    margin-bottom: 10px
    img
      max-height: 80px

      
.logo-upload-container
  position: relative
 
.remove_image 
  color: #aaa
  float: right
  right: 0
  top: 0
  padding-right: 10px
  font-size: 28px
  font-weight: bold  
  position: absolute
  

.remove_image:hover,
.remove_image:focus 
  color: black
  text-decoration: none
  cursor: pointer 
 
</style>
