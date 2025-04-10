<template>
  <div>
    <input type="checkbox" :id="category.id" :name="category.name" :value="category.id"
      class="primaryService" @change="toggleCategory">
    <label :for="category.id" :class="{ 'selected': selectedCategory === category.id }">{{ category.category }}</label>
    <button class="icon-button" @click="fetchSubcategories">
      <img src="/arraw.png" alt="Right arrow">
    </button>
  </div>
</template>

<script>
export default {
  props: {
    category: {
      type: Object,
      required: true
    },
    selectedCategory: {
      type: Number,
      required: true
    }
  },
  methods: {
    toggleCategory(event) {
      this.$emit('toggle-category', event.target.checked, this.category.id);
    },
    fetchSubcategories() {
      this.$emit('fetch-subcategories', this.category.id);
    }
  }
}
</script>
