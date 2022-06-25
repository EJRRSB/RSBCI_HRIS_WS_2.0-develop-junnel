<template>
    <div class="modal-background">
        <div class="modal">
            <div></div>
            <img
                class="question-mark"
                src="assets/images/question-mark.svg"
                style="width: 50px"
            />
            <h4>{{ message }}</h4>
            <h3>{{ id }}</h3>
            <div class="bottom-button-row">
                <button class="red-btn btn-mright" @click="$emit('closeModal')">
                    No
                </button>
                <button class="green-btn" @click="$emit('confirm')">
                    {{ yesButtonLabel }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: String,
            default: "",
        },
        message: {
            type: String,
            default: "Are you sure you want to delete?",
        },
        yesButtonLabel: {
            type: String,
            default: "Yes",
        },
    },
};
</script>

<style lang="sass" scoped>
.modal
  display: flex
  flex-direction: column
  align-items: center
  justify-content: space-between
  height: 400px
  width: 400px
  padding: 30px 20px
  position: absolute
  left: calc(50% - 200px)
  top: calc(50% - 200px)
  background-color: white
  border-radius: 5px
  & h4
    font-size: 1.1em
    color: #606060
    text-align: center
  & h3
    color: #606060

.question-mark
  min-width: 100px

.modal-background
  position: fixed
  width: 100%
  height: 100%
  background-color: #6060605e
  z-index: 6
  left: 0
  top: 0
  right: 0
  bottom: 0
.red-btn
    background-color: #F24336
.green-btn
  background-color: #92c156
  margin-left: 10px

button
  font-family: Noto Sans,sans-serif
  font-weight: 600
  font-size: 1em
  height: 40px
  min-width: 100px
  border: none
  outline: none
  padding: 0 25px
  color: #fff
  border-radius: 5px
  cursor: pointer
</style>
