<template>
  <div class="content">
    <img
      :id="[isLarge ? 'loader' : 'loader2']" 
      src="assets/images/loader.svg"
    />
    <div :class="[isLarge ? 'message' : 'message2']">{{ message }}</div>
  </div>
</template>

<script>
export default {
  props: {
    message: String,
    isLarge: {
      default: true,
      type: Boolean,
    },
  },
}
</script>

<style lang="sass" scoped>
.content
  display: flex
  flex-direction: column
  align-items: center
  justify-content: center
  #loader
    width: 50px
    padding-top: 80px
  #loader2
    width: 50px
  .message
    font-family: 'Source Sans Pro', sans-serif
    font-weight: 600
    font-size: 1.6em
    letter-spacing: 0.3px
    color: #6f499b
    padding-top: 20px
  .message2
    font-family: 'Source Sans Pro', sans-serif
    font-weight: 600
    font-size: 1.1em
    letter-spacing: 0.3px
    color: #6f499b
    padding-top: 20px
</style>
