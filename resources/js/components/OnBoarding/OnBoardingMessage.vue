<template>
  <div class="intro-box">
    <div id="company-onboarding-intro">
      <h1>Company Onboarding</h1>
      <h4>
        To get you started with ease, fill out the lorem ipsum dolor sit amet,
        consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
        laoreet dolore magna aliquam erat
      </h4>
      <img
        id="onboarding-intro-image"
        src="assets/images/onboarding-intro-image.svg"
      />
      <button id="intro-button" class="button" @click="$emit('nextPage')">
        Get Started
      </button>
    </div>
  </div>
</template>

<script setup>
import { defineEmits } from "vue";
const emit = defineEmits(["nextPage", "prevPage"]);
</script>

<style lang="scss" scoped>
</style>