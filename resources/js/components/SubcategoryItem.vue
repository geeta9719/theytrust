<template>
    <div>
      <input type="checkbox" :id="subcategory.id" :name="subcategory.subcategory" :value="subcategory.id"
        class="subcategory" :data-category-id="subcategory.category_id"
        :data-category-name="subcategory.category_name" :checked="subcategory.checked"
        :data-category-slug="generateSlug(subcategory.category_name)"
        @change="toggleSubcategory">
      <label :for="subcategory.id">{{ subcategory.subcategory }}</label>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      subcategory: {
        type: Object,
        required: true
      }
    },
    methods: {
      toggleSubcategory(event) {
        this.$emit('toggle-subcategory', event.target.checked, event.target.value, event.target.dataset.categoryId);
      }
    }
  }
  </script>
  