<template>
    <div class="error-container">
        <div class="error-content">
            <div class="error-text" v-for="item in message" :key="item">
                {{ item }}
            </div>
        </div>
    </div>
</template>
<script>
import { toRef } from "vue";
export default {
    props: {
        message: Array,
    },
    setup(props) {
        const title = toRef(props, "title");
    },
};
</script>
<style lang="sass" scoped>
.error-container
  width: 100%

  .error-content
    display: flex
    align-items: center
    height: 30px
    width: 100%
    background-color: #ff908d
    padding-left: 15px
    border-radius: 5px
    .error-text
      font-family: 'Noto Sans', sans-serif
      font-size: .8em
      font-weight: 600
      color: #ffffff
</style>
