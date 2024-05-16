<template>
  <div class="error-modal" v-if="isOpen">
    <div class="modal-content">
      <span class="close" @click="closeModal">&times;</span>
   <p>Please Select the Primary  Value</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    isOpen: Boolean,
    modalErrorMessage: String
  },
  methods: {
    closeModal() {
      this.$emit('close');
    }
  }
}
</script>

<style scoped>
.error-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 0, 0, 0.5); /* Red color with 50% opacity */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999; /* Ensure modal is on top of other content */
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  max-width: 400px; /* Limit the width of the modal content */
  text-align: center; /* Center-align the content */
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  color: red; /* Change close button color to red */
  font-size: 24px; /* Increase close button size */
}
</style>
