<template>
  <div class="intro-box">
    <div id="company-onboarding-post-completion">
      <h1>Congratulations!</h1>
      <h4>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
        nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
      </h4>
      <img
        id="post-completion-image"
        src="assets/images/post-completion-image.svg"
      />
      <div
        class="bottom-button-row"
        style="display: flex; justify-content: center"
      >
        <button
          id="add-another-company-btn"
          class="purple-btn btn-mright"
          @click="$emit('addAnother')"
        >
          Add Another Company
        </button>
        <button id="proceed-to-tutorial-btn" class="green-btn">
          Proceed to Tutorial
        </button>
      </div>

      <ConfirmationModal
        v-if="showConfirmationModal"
        :id="teamDeleteID"
        @confirm="confirmDeleteTeam"
        @closeModal="showConfirmationModal = !showConfirmationModal"
      />
    </div>
  </div>
</template>

<script>
export default {
  emits: ['nextPage', 'prevPage', 'addAnother'],
}
</script>

<style lang="sass" scoped></style>
