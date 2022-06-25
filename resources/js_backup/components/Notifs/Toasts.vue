<template>
  <Transition name="fade">
    <div :id="type" class="notification-container" v-if="showToast">
      <img src="@/assets/images/checkmark.svg" style="width: 50px" />
      <div class="notification-textbox">
        <div class="title">Success!</div>
        <div class="desc">
          <!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit sedo. -->
        </div>
      </div>
    </div>
  </Transition>
</template>

<script>
export default {
  props: {
    type: String,
    title: {
      type: String,
      default: "Added",
    },
    showToast: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style scoped>
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
.fade-enter-active,
.fade-leave-active {
  transition: opacity 2.5s ease-out;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
.notification-container img {
  margin-right: 20px;
}

.notification-textbox {
  color: white;
}

.notification-textbox .title {
  font-weight: 600;
  font-size: 1.3em;
}

.notification-textbox .desc {
  font-weight: 500;
  font-size: 0.9em;
}

#notif-success {
  background-color: #92c156;
}

#notif-error {
  background-color: #f34336;
}

#notif-warning {
  background-color: #ff9d3b;
}
</style>