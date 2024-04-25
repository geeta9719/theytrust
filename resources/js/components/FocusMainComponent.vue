<template>
  <div id="app">
    <div id="mainDiv">
      <!-- Choose Primary Service Fieldset -->
      <div class="row catBox">
        <div class="col-lg-3 col-md-6">
          <fieldset>
            <legend>Choose Primary Service</legend>
            <div id="categoryFieldset" :class="{ 'active': isActive }">
              <CategoryItem v-for="category in categories" :key="category.id"
                :category="category" :selectedCategory="selectedCategory"
                @toggle-category="toggleCategory" @fetch-subcategories="fetchSubcategories">
              </CategoryItem>
            </div>
          </fieldset>
        </div>

        <!-- Choose Sub Category Fieldset -->
        <div class="col-lg-3 col-md-6" v-if="hasSubCategory && subcategories.length">
          <fieldset>
            <legend>Choose Sub Category</legend>
            <div id="subCategoryFieldset" :class="{ 'open': subcategories.length }">
              <SubcategoryItem v-for="subcategory in subcategories" :key="subcategory.id"
                :subcategory="subcategory" @toggle-subcategory="toggleSubcategory">
              </SubcategoryItem>
            </div>
          </fieldset>
        </div>
      </div>

      <!-- Modal for Error Message -->
      <Modal :isOpen="showModal" @close="showModal = false" />

    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Modal from './Modal.vue'; // Import your modal component
import CategoryItem from './CategoryItem.vue';
import SubcategoryItem from './SubcategoryItem.vue';

export default {
  components: {
    Modal,
    CategoryItem,
    SubcategoryItem
  },
  props: {
    categories: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      isActive: true,
      hasSubCategory: true,
      subcategories: [],
      selectedCategory: null,
      selectedSubcategories: {}, // Object to store selected subcategories for each category
      showModal: false,// Flag to control modal visibility
      selectedData: [],
    };
  },
  methods: {
    generateSlug(name) {
      return name.toLowerCase().replace(/\s+/g, '-');
    },
    toggleCategory(isChecked, categoryId) {
      if (!isChecked) {
        this.removeCategoryFromSelectedData(categoryId);
      } else {
        this.addCategoryToSelectedData(categoryId);
      }
      console.log(this.selectedData, "selectedData111");
    },
    removeCategoryFromSelectedData(categoryId) {
      const categoryIndex = this.selectedData.findIndex(cat => cat.category_id == categoryId);
      if (categoryIndex !== -1) {
        this.selectedData.splice(categoryIndex, 1);
      }
    },
    addCategoryToSelectedData(categoryId) {
      if (!categoryId) {
        this.showModal = true; // Show modal if no category is selected
        return;
      }
      this.fetchSubcategoriesOnCategorySelect(categoryId);
    },
    fetchSubcategoriesOnCategorySelect(categoryId) {
      axios.get('/api/subcategories', {
        params: {
          categories: categoryId
        }
      })
        .then(response => {
          this.handleSubcategoryFetchSuccess(response.data, categoryId);
        })
        .catch(error => {
          this.handleSubcategoryFetchError(error);
        });
    },
    handleSubcategoryFetchSuccess(subcategories, categoryId) {
      this.subcategories = subcategories;
      this.selectedCategory = categoryId;
      const selectedCategory = this.findSelectedCategory(categoryId);
      if (!selectedCategory) {
        console.error('Selected category not found');
        return;
      }
      const existingCategoryIndex = this.findExistingCategoryIndex(categoryId);
      if (existingCategoryIndex !== -1) {
        this.updateCategorySubcategories(existingCategoryIndex);
      } else {
        this.addNewCategoryToSelectedData(selectedCategory);
      }
    },
    handleSubcategoryFetchError(error) {
      console.error('Error fetching subcategories:', error);
    },
    findSelectedCategory(categoryId) {
      return this.categories.find(cat => cat.id == categoryId);
    },
    findExistingCategoryIndex(categoryId) {
      return this.selectedData.findIndex(cat => cat.category_id == categoryId);
    },
    addNewCategoryToSelectedData(selectedCategory) {
      this.selectedData.push({
        category_id: selectedCategory.id,
        category_name: selectedCategory.category,
        subcategories: []
      });
    },
    toggleSubcategory(isChecked, subcategoryId, categoryId) {
      debugger;
      const categoryObj = this.selectedData.find(cat => cat.category_id == categoryId);
      if (!categoryObj) {
        console.error('Selected category not found in selectedData');
        return;
      }
      const subcategory = this.subcategories.find(subcat => subcat.id == subcategoryId);
      if (!subcategory) {
        console.error('Selected subcategory not found');
        return;
      }
      if (isChecked) {
        const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
        if (index === -1) {
          categoryObj.subcategories.push({
            subcategory_id: subcategory.id,
            subcategory_name: subcategory.subcategory
          });
        }
      } else {
        const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
        if (index !== -1) {
          categoryObj.subcategories.splice(index, 1);
        }
      }
      console.log(this.selectedData,"selectedData")
    }
  }
}
</script>

<style scoped>
.category-item {
  display: flex;
  align-items: center;
}

.icon-button {
  cursor: pointer;
  padding: 8px 12px;
  border: none;
  background-color: transparent;
}

.icon-button img {
  width: 20px;
  height: 20px;
  margin-right: 5px;
}

#mainDiv {
  width: 80%;
  margin: 50px auto auto auto;
}

.selected {
  background-color: #eaf2f8;
  border: 1px solid blue;
  border-radius: 5px;
  padding: 5px 10px;
}

.visually-hidden {
  position: absolute;
  overflow: hidden;
  clip: rect(0 0 0 0);
  height: 1px;
  width: 1px;
  margin: -1px;
  padding: 0;
  border: 0;
}

#subCategoryFieldset {
  transition: max-height 0.3s ease-out;
  max-height: 0;
  overflow: hidden;
}

#subCategoryFieldset.open {
  max-height: 500px;
}
</style>
