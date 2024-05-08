<!-- Updated Template -->

<template>
  <div id="app">
    <div id="mainDiv">
      <div class="category-card">
        <div v-for="(selectedCategory, index) in selectedData" :key="selectedCategory.id" class="category-item">
          <label :for="'input_' + selectedCategory.id">{{ selectedCategory.category_name }}:</label>
          <input type="text" :id="'input_' + selectedCategory.id" :name="'input_' + selectedCategory.id">
        </div>
      </div>
      <div v-for="(selectedCategory, index) in selectedData" :key="selectedCategory.id" class="category-item">
        <template v-if="selectedCategory.subcategories.length > 0">
          <div class="sub-category-card">
            <h3>{{ selectedCategory.category_name }}</h3>
            <div v-for="(selectedSubCategory, index) in selectedCategory.subcategories"
              :key="selectedCategory.subcategory_id" class="category-item">
              <label :for="'input_' + selectedSubCategory.id">{{ selectedSubCategory.subcategory_name }}:</label>
              <input type="text" :id="'input_' + selectedSubCategory.subcategory_id"
                :name="'input_' + selectedSubCategory.subcategory_id">
            <ul>
              <li v-for="skill in selectedSubCategory.skills" :key="skill.id">{{ skill.skill_name }}</li>
            </ul>
            </div>
            
          </div>
        </template>
      </div>
      <div class="row catBox">
        <div class="col-lg-3 col-md-6">
          <fieldset>
            <legend>Choose Primary Service</legend>
            <div id="categoryFieldset" :class="{ 'active': isActive }">
              <div v-for="category in categories" :key="category.id" class="category-item">
                <div class="checkbox-container">
                  <input type="checkbox" :id="category.id" :name="category.name" :value="category.id"
                    class="primaryService" @change="toggleCategory($event, category.id)">
                  <label :for="category.id" class="checkbox-custom"></label>
                </div>
                <label>{{ category.category }}</label>
                <button class="icon-button" @click="fetchSubcategoriesOn(category.id)">
                  <img src="/arraw.png" alt="Right arrow">
                </button>
              </div>
            </div>
          </fieldset>
        </div>



        <!-- Choose Sub Skill Fieldset -->
        <div class="col-lg-3 col-md-6" v-if="subcategories.length">
          <fieldset>
            <legend>Choose Sub Category</legend>
            <div id="subCategoryFieldset" :class="{ 'open': subcategories.length }">
              <div v-for="subcategory in subcategories" :key="subcategory.id" class="category-item">
                <div class="checkbox-container">
                  <input type="checkbox" :id="subcategory.id" :name="subcategory.subcategory" :value="subcategory.id"
                    class="subcategory" :data-category-id="subcategory.category_id"
                    :data-category-name="subcategory.category_name" :checked="subcategory.checked"
                    :data-category-slug="generateSlug(subcategory.category_name)"
                    @change="handleSubcategoryChange($event)">
                  <label :for="subcategory.id" class="checkbox-custom"></label>
                </div>
                <label>{{ subcategory.subcategory }}</label>
                <button class="icon-button" @click="fetchSkillOn(subcategory.id,subcategory.category_id)">
                  <img src="/arraw.png" alt="Right arrow">
                </button>
                
              </div>
            </div>
          </fieldset>
        </div>
        <!-- Choose Sub Category Fieldset -->
        <div class="col-lg-3 col-md-6" v-if="skills.length">
          <fieldset>
            <legend>Choose Skill </legend>
            <div id="SkillFieldset" :class="{ 'open': skills.length }">
              <div v-for="skill in skills" :key="skill.id" class="category-item">
                <div class="checkbox-container">
                  <input type="checkbox" :id="skill.id" :name="skill.name" :value="skill.id" class="subcategory"
                    :data-subcategory-id="skill.subcategory_id" :data-category-id="skill.subcategory.category_id"
                    :data-subcategory-name="skill.name" :checked="skill.checked"
                    :data-sub-category-slug="generateSlug(skill.subcategory.subcategory)"
                    @change="handleSkillChange($event)">
                  <label :for="skill.id" class="checkbox-custom"></label>
                </div>
                <label>{{ skill.name }}</label>
                <button class="icon-button" @click="fetchSubSkillOn(skill.id,skill.subcategory.id,skill.subcategory.category_id)">
                  <img src="/arraw.png" alt="Right arrow">
                </button>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="col-lg-3 col-md-6" v-if="Subskills.length">
          <fieldset>
            <legend>Choose Deep Skill </legend>
            <div id="SkillFieldset" :class="{ 'open': Subskills.length }">
              <div v-for="subskill in Subskills" :key="subskill.id" class="category-item">
                <div class="checkbox-container">
                  <input type="checkbox" :id="subskill.id" :name="subskill.name" :value="subskill.id" class="subcategory"
                     :checked="subskill.checked"
                    @change="handleSubSkillChange($event)">
                  <label :for="subskill.id" class="checkbox-custom"></label>
                </div>
                <label>{{ subskill.name }}</label>
              </div>
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

export default {
  components: {
    Modal
  },
  props: {
    categories: {
      type: Array,
      required: true
    }
  },
  data() {
    debugger;
    return {
      modalErrorMessage: "",
      isActive: true,
      hasSubCategory: true,
      subcategories: [],
      selectedCategory: null,
      selectedSubcategories: {}, // Object to store selected subcategories for each category
      showModal: false,// Flag to control modal visibility
      selectedData: [],
      hasSkill: true,
      skills: [],
      Subskills:[]
    };
  },
  methods: {
    generateSlug(name) {
      return name.toLowerCase().replace(/\s+/g, '-');
    },
    toggleCategory(event, categoryId) {
      const isChecked = event.target.checked;

      if (!isChecked) {
        this.removeCategoryFromSelectedData(categoryId);
      } else {
        this.addCategoryToSelectedData(categoryId);
      }
      console.log(this.selectedData, "selectedData22222")
    },

    // Remove category from selectedData
    removeCategoryFromSelectedData(categoryId) {
      const categoryIndex = this.selectedData.findIndex(cat => cat.category_id == categoryId);
      if (categoryIndex !== -1) {
        this.selectedData.splice(categoryIndex, 1);
      }
    },

    // Add category to selectedData and fetch subcategories
    addCategoryToSelectedData(categoryId) {
      if (!categoryId) {
        // this.showModal = true;
        // Show modal if no category is selected
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
          let responseData = response.data;
          const firstItemId = responseData[0]?.id;
          const matchingCategory = this.selectedData.find(cat => cat.category_id === firstItemId);
          if (matchingCategory) {
            // Iterate through subcategories in selectedData's matching category
            matchingCategory?.subcategories.forEach(subcategory => {
              const found = responseData.some(item => item.id === subcategory.subcategory_id);
              if (found) {
                const matchingItem = responseData.find(item => item.id === subcategory.subcategory_id);
                if (matchingItem) {
                  matchingItem.checked = true;
                }
              }
            });
          }
          this.handleSubcategoryFetchSuccess(responseData, categoryId);
        })
        .catch(error => {
          this.handleSubcategoryFetchError(error);
        });
    },
    fetchSubcategoriesOn(categoryId) {
      axios.get('/api/subcategories', {
        params: {
          categories: categoryId
        }
      })
        .then(response => {
          debugger
          let responseData = response.data;
          const firstItemId = responseData[0]?.category_id;
          const matchingCategory = this.selectedData.find(cat => cat.category_id == firstItemId);
          if (matchingCategory) {
            matchingCategory?.subcategories.forEach(subcategory => {
              const found = responseData.some(item => item.id == subcategory.subcategory_id);
              if (found) {
                // Set isChecked to true for the corresponding item in response data
                const matchingItem = responseData.find(item => item.id == subcategory.subcategory_id);
                if (matchingItem) {
                  matchingItem.checked = true;
                }
              }
            });
          }
          console.log(responseData, "responseData")
          this.subcategories = responseData;
          this.skills =[];
          console.log(this.subcategories, "upate datatata")

          // this.handleSubcategoryFetchSuccess(response.data, categoryId);
        })
        .catch(error => {
          this.handleSubcategoryFetchError(error);
        });
    },

    fetchSkillOn(subcategoryId,categoryId) {
      this.getSkills(subcategoryId)
        .then(skills => {
          let responseData = skills;
          this.skills = skills;
          const categoryObj = this.selectedData.find(cat => cat.category_id == categoryId);
          const subcategory = this.subcategories.find(subcat => subcat.id == subcategoryId);
          const matchingCategory = this.selectedData.find(cat => cat.category_id == categoryId);
          debugger;
          if (matchingCategory) {
            const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
            if (index !== -1) {
              matchingCategory?.subcategories[index].skills.forEach(skills => {
                console.log(skills,"sllll");
              const found = responseData.some(item => item.id == skills.skill_id);
                if (found) {
                  const matchingItem = responseData.find(item => item.id ==skills.skill_id );
                  if (matchingItem) {
                    matchingItem.checked = true;
                  }
                }
              });

            }

          }
        })
    },

    fetchSubSkillOn(SkillId,subcategoryId,categoryId) {
      this.getDeepSkills(SkillId)
        .then(Subskills => {
          let responseData = Subskills;
          this.Subskills = Subskills;
          // this.subSkill
          const categoryObj = this.selectedData.find(cat => cat.category_id == categoryId);
          const subcategory = this.subcategories.find(subcat => subcat.id == subcategoryId);
          const matchingCategory = this.selectedData.find(cat => cat.category_id == categoryId);
          debugger;
          if (matchingCategory) {
            const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
            const Skillindex = categoryObj.subcategories[index].skills.findIndex(sub => sub.subcategory_id == subcategoryId);
            if (index !== -1) {
              matchingCategory?.subcategories[index].skills.forEach(skills => {
                console.log(skills,"sllll");
              const found = responseData.some(item => item.id == skills.skill_id);
                if (found) {
                  const matchingItem = responseData.find(item => item.id ==skills.skill_id );
                  if (matchingItem) {
                    matchingItem.checked = true;
                  }
                }
              });

            }

          }
        })
    },

    // Handle successful subcategory fetch
    handleSubcategoryFetchSuccess(subcategories, categoryId) {
      debugger;
      this.subcategories = subcategories;
      this.skills =[];
      this.selectedCategory = categoryId;

      const selectedCategory = this.findSelectedCategory(categoryId);
      if (!selectedCategory) {
        console.error('Selected category not found');
        return;
      }

      const existingCategoryIndex = this.findExistingCategoryIndex(categoryId);
      if (existingCategoryIndex !== -1) {
        // this.updateCategorySubcategories(existingCategoryIndex);
      } else {
        this.addNewCategoryToSelectedData(selectedCategory);
      }
    },

    // Handle subcategory fetch error
    handleSubcategoryFetchError(error) {
      console.error('Error fetching subcategories:', error);
    },

    // Find selected category from categories array
    findSelectedCategory(categoryId) {
      return this.categories.find(cat => cat.id == categoryId);
    },

    // Find existing category index in selectedData array
    findExistingCategoryIndex(categoryId) {
      return this.selectedData.findIndex(cat => cat.category_id == categoryId);
    },

    // Add new category to selectedData array
    addNewCategoryToSelectedData(selectedCategory) {
      this.selectedData.push({
        category_id: selectedCategory.id,
        category_name: selectedCategory.category,
        subcategories: []
      });
    },

    // Function to toggle subcategories when their checkboxes are checked or unchecked
    handleSubcategoryChange(event) {
      const subcategoryId = event.target.value;
      const categoryId = event.target.dataset.categoryId;
      const isChecked = event.target.checked;

      // Find the category object in selectedData
      const categoryObj = this.selectedData.find(cat => cat.category_id == categoryId);
      if (!categoryObj) {
        event.target.checked = false;
        this.showModal = true;
        this.modalErrorMessage = "Please select the Category"; // Assign to data property modalErrorMessage
        console.error('Selected category not found in selectedData');
        console.error('Selected category not found in selectedData');
        return;
      }
      const subcategory = this.subcategories.find(subcat => subcat.id == subcategoryId);
      if (!subcategory) {
        console.error('Selected subcategory not found');
        return;
      }

      // If checkbox is checked, add the subcategory to selectedData, else remove it
      if (isChecked) {
        // Check if the subcategory is already selected
        const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
        if (index === -1) {
          // If not selected, push it to the subcategories array of the category object
          categoryObj.subcategories.push({
            subcategory_id: subcategory.id,
            subcategory_name: subcategory.subcategory,
            skills: []
          });
        }
      } else {
        // If unchecked, remove the subcategory from selectedData if it exists
        const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
        if (index !== -1) {
          categoryObj.subcategories.splice(index, 1);
        }
      }
      this.getSkills(subcategoryId)
        .then(skills => {
          let responseData = skills;
          this.skills = skills;
          const matchingCategory = this.selectedData.find(cat => cat.category_id == categoryId);
          if (matchingCategory) {
            const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
            if (index !== -1) {
              matchingCategory?.subcategories[index].skills.forEach(skills => {
                const found = responseData.some(item => item.id == subcategory.subcategory_id);
                if (found) {
                  // Set isChecked to true for the corresponding item in response data
                  const matchingItem = responseData.find(item => item.id == subcategory.subcategory_id);
                  if (matchingItem) {
                    matchingItem.checked = true;
                  }
                }
              });

            }

          }
        })
        .catch(error => {
          console.error(error); // Handle any errors
        });
    },
    handleSkillChange(event) {


      const skillId = event.target.value;
      const categoryId = event.target.dataset.categoryId;
      const subcategoryId = event.target.dataset.subcategoryId;
      const isChecked = event.target.checked;

      this.getDeepSkills(skillId)
        .then(Subskills => {
          let responseData = Subskills;
          this.Subskills = Subskills;
          
          // const matchingCategory = this.selectedData.find(cat => cat.category_id == categoryId);
          // if (matchingCategory) {
          //   const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
          //   if (index !== -1) {
          //     matchingCategory?.subcategories[index].skills.forEach(skills => {
          //       const found = responseData.some(item => item.id == subcategory.subcategory_id);
          //       if (found) {
          //         // Set isChecked to true for the corresponding item in response data
          //         const matchingItem = responseData.find(item => item.id == subcategory.subcategory_id);
          //         if (matchingItem) {
          //           matchingItem.checked = true;
          //         }
          //       }
          //     });

          //   }

          // }
        })
        .catch(error => {
          console.error(error); // Handle any errors
        });

      // Find the category object in selectedData
      const categoryObj = this.selectedData.find(cat => cat.category_id == categoryId);
      if (!categoryObj) {
        event.target.checked = false;
        this.showModal = true;
        this.modalErrorMessage = "Please select the Category";
        return;
      }
      const subCategoryObj = categoryObj?.subcategories.find(sub => sub.subcategory_id == subcategoryId);
      if (!subCategoryObj) {
        event.target.checked = false;
        this.showModal = true;
        this.modalErrorMessage = "Please select the SubCatgroy"; // Assign to data property modalErrorMessage
        return;
      }
      const skill = this.skills.find(skill => skill.id == skillId);
      if (isChecked) {
        const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
        if (index !== -1) {
          categoryObj.subcategories[index].skills.push({
            skill_id: skill.id,
            skill_name: skill.name
          });
        }
      } else {
        const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
        if (index !== -1) {
          const skillIndex = categoryObj.subcategories[index].skills.findIndex(s => s.skill_id == skillId);
          if (skillIndex !== -1) {
            categoryObj.subcategories[index].skills.splice(skillIndex, 1);
          }
        }
      }
    },
    closeModal() {
      this.showModal = false;
    },
    getSkills(subcategoryId) {
      return axios.get('/api/skill', {
        params: {
          id: subcategoryId
        }
      })
        .then(response => {
          return response.data;
        })
        .catch(error => {
          throw new Error('Error fetching skills: ' + error.message);
        });
    },
    getDeepSkills(skillId) {
      console.log(skillId,"skillIdskillId")
      return axios.get('/api/subskill', {
        params: {
          id: skillId
        }
      })
        .then(response => {
          return response.data;
        })
        .catch(error => {
          throw new Error('Error fetching skills: ' + error.message);
        });
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
  /* Change background color as needed */
  border: 1px solid blue;
  border-radius: 5px;
  /* Add border radius as needed */
  padding: 5px 10px;
  /* Add padding as needed */
}

/* Hide default checkbox */
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

/* Transition effect for subcategory fieldset */
#subCategoryFieldset {
  transition: max-height 0.3s ease-out;
  /* Adjust transition duration and easing as needed */
  max-height: 0;
  overflow: hidden;
}

#subCategoryFieldset.open {
  max-height: 500px;
  /* Adjust max-height to fit your content */
}

/* Updated CSS */
category-card {
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 10px;
  margin-bottom: 20px;
}

.category-card h2 {
  margin-top: 0;
}

.category-item {
  margin-bottom: 10px;
}

/* Adjust width and margin to align cards in rows */
@media (max-width: 576px) {
  .category-card {
    width: 100%;
  }
}
</style>