<template>
  <div id="app">
    <div id="mainDiv">
      <div class="category-card">
        <input type="hidden" id="companyIdInput" name="companyId" :value="companyId">

        <div v-if="Object.keys(selectedData).length > 0" class="category">
          <h3>Select Primary Services</h3>
          <div class="category-main">
            <div v-for="(selectedCategory, index) in selectedData" :key="selectedCategory.id" class="category-item">
              <label :for="'input_' + selectedCategory.id">{{ selectedCategory.category_name }}:</label>
              <input type="number" :id="'input_' + selectedCategory.id" :name="'input_' + selectedCategory.id"
                v-model.number="selectedCategory.inputValue" @input="validateCategorySum">
            </div>
          </div>
        </div>
        <span v-if="categorySumError" class="error" style="color: red;">{{ categorySumError }}</span>
      </div>
      <div v-for="(selectedCategory, index) in selectedData" :key="selectedCategory.id" class="category-item">
        <template v-if="selectedCategory.subcategories.length > 0">
          <div class="sub-category-card">
            <h3>{{ selectedCategory.category_name }}</h3>
            <div class="subcategory">
              <div v-for="(selectedSubCategory, index) in selectedCategory.subcategories" :key="selectedSubCategory.id"
                class="category-item">
                <label :for="'input_' + selectedSubCategory.id">{{ selectedSubCategory.subcategory_name }}:</label>
                <input type="text" :id="'input_' + selectedSubCategory.id" :name="'input_' + selectedSubCategory.id"
                  v-model="selectedSubCategory.value" @input="validateSubCategorySum(selectedCategory)">
              </div>
              <br>
              <span v-if="subCategorySumError[selectedCategory.category_id]" class="error" style="color: red;">{{
                subCategorySumError[selectedCategory.category_id]
                }}</span>
            </div>
            <div class="deepSkill">
              <template v-for="(selectedSubCategory, index) in selectedCategory.subcategories"
                :key="selectedCategory.subcategory_id">
                <li v-for="skill in selectedSubCategory.skills" :key="skill.id">{{ skill.skill_name }}</li>
              </template>
            </div>
            <div class="deepSkill">
              <template v-for="(selectedSubCategory, index) in selectedCategory.subcategories"
                :key="selectedCategory.subcategory_id">
                <li v-for="skill in selectedSubCategory.skills" :key="skill.id">
                  <div>
                    <template v-for="subskill in skill.subskills">
                      <p>{{ subskill.sub_skill_name }}</p>
                    </template>
                  </div>
                </li>
              </template>
            </div>
          </div>
        </template>
      </div>
      <div class="row catBox">
        <div class="col-lg-3 col-md-6 primarybox">
          <fieldset>
            <legend>Choose Primary Service</legend>
            <div v-for="category in categories" :key="category.id" class="category-item"
              :class="{ 'selected': selectedCategoryId === category.id }">
              <div class="checkbox-container">
                <input type="checkbox" :id="category.id" :name="category.name" :value="category.id"
                  class="primaryService" @change="toggleCategory($event, category.id)" v-model="category.checked">
                <label :for="category.id" class="checkbox-custom"></label>
              </div>
              <label :for="category.id">{{
                category.category }}</label>
              <button class="icon-button" @click="fetchSubcategoriesOn(category.id)">
                <img src="/arraw.png" alt="Right arrow">
              </button>
            </div>

          </fieldset>
        </div>
        <!-- Choose Sub Skill Fieldset -->
        <div class="col-lg-3 col-md-6">
          <fieldset>
            <legend>Choose Sub Category</legend>
            <div id="subCategoryFieldset" :class="{ 'open': subcategories.length }">
              <div v-for="subcategory in subcategories" :key="subcategory.id" class="category-item"
                :class="{ 'selected': selectedSubCategoryId == subcategory.id }">
                <div class="checkbox-container">
                  <input type="checkbox" :id="subcategory.id" :name="subcategory.subcategory" :value="subcategory.id"
                    class="subcategory" :data-category-id="subcategory.category_id"
                    :data-category-name="subcategory.category_name" :checked="subcategory.checked"
                    :data-category-slug="generateSlug(subcategory.category_name)"
                    @change="handleSubcategoryChange($event)">
                  <label :for="subcategory.id"
                    :style="{ color: selectedCategoryId === subcategory.id ? 'blue' : 'initial' }">{{
                      subcategory.subcategory
                    }}</label>
                  <button class="icon-button" @click="fetchSkillOn(subcategory.id, subcategory.category_id)">
                    <img src="/arraw.png" alt="Right arrow">
                  </button>
                </div>
              </div>
            </div>
          </fieldset>
        </div>

        <!-- Choose Sub Category Fieldset -->
        <div class="col-lg-3 col-md-6">
          <fieldset>
            <legend>Choose Skill </legend>
            <div id="SkillFieldset" :class="{ 'open': skills.length }">
              <div v-for="skill in skills" :key="skill.id" class="category-item"
                :class="{ 'selected': selectedSkillId == skill.id }">
                <div class="checkbox-container">
                  <input type="checkbox" :id="skill.id" :name="skill.name" :value="skill.id" class="subcategory"
                    :data-subcategory-id="skill.subcategory_id" :data-category-id="skill.subcategory.category_id"
                    :data-subcategory-name="skill.name" :checked="skill.checked"
                    :data-sub-category-slug="generateSlug(skill.subcategory.subcategory)"
                    @change="handleSkillChange($event)">
                  <label :for="skill.id" class="checkbox-custom"></label>
                </div>
                <label>{{ skill.name }}</label>
                <button class="icon-button"
                  @click="fetchSubSkillOn(skill.id, skill.subcategory.id, skill.subcategory.category_id)">
                  <img src="/arraw.png" alt="Right arrow">
                </button>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="col-lg-3 col-md-6">
          <fieldset>
            <legend>Choose Deep Skill </legend>
            <div id="SkillFieldset" :class="{ 'open': Subskills.length }">
              <div v-for="subskill in Subskills" :key="subskill.id" class="category-item"
                :class="{ 'selected': selectedSkillId == subskill.id }">
                <div class="checkbox-container">
                  <input type="checkbox" :id="subskill.id" :name="subskill.name" :value="subskill.id"
                    class="subcategory" :checked="subskill.checked" :data-skill-id="subskill.subcat_child_id"
                    @change="handleSubSkillChange($event)">
                  <label :for="subskill.id" class="checkbox-custom"></label>
                </div>
                <label>{{ subskill.name }}</label>
              </div>
            </div>
          </fieldset>
        </div>

        <!-- <button @click="submitForm">Submit</button>
         -->
        <button @click="submitForm" :disabled="submitButtonDisabled">Submit</button>



      </div>
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
    },
    companyId: {
      type: Number, // Adjust the type based on the type of your company ID
      required: true
    }
  },
  watch: {
    // Watch for changes in selectedData or its nested properties
    selectedData: {
      handler: 'fistTimevalidate', // Call validateCategorySum when selectedData changes
      deep: true // Deeply watch for changes in nested properties
    },
    // categorySumError() {
    //   // Call validateForm() whenever categorySumError changes
    //   this.validateForm();
    // }
  },
  data() {
    // debugger;
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
      Subskills: [],
      categorySumError: "",
      subCategorySumError: [],
      selectedCategoryId: null,
      selectedSubCategoryId: null,
      selectedSkillId: null,
      submitButtonDisabled: true

    };
  },
  mounted() {
    // Call validateForm() on mount or whenever necessary
    // this.validateForm();
    this.fistTimevalidate();

  },
  methods: {
    generateSlug(name) {
      return name.toLowerCase().replace(/\s+/g, '-');
    },
    toggleCategory(event, categoryId) {
      const isChecked = event.target.checked;
      this.selectedCategoryId = categoryId;
      this.selectedSubCategoryId = null;

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
      this.selectedCategoryId = categoryId;
      this.selectedSubCategoryId = null;
      axios.get('/api/subcategories', {
        params: {
          categories: categoryId
        }
      })
        .then(response => {
          // debugger
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
          this.skills = [];
          console.log(this.subcategories, "upate datatata")

          // this.handleSubcategoryFetchSuccess(response.data, categoryId);
        })
        .catch(error => {
          this.handleSubcategoryFetchError(error);
        });
    },

    fetchSkillOn(subcategoryId, categoryId) {
      this.selectedSubCategoryId = subcategoryId;
      this.getSkills(subcategoryId)
        .then(skills => {
          let responseData = skills;
          this.skills = skills;
          const categoryObj = this.selectedData.find(cat => cat.category_id == categoryId);
          const subcategory = this.subcategories.find(subcat => subcat.id == subcategoryId);
          const matchingCategory = this.selectedData.find(cat => cat.category_id == categoryId);

          // debugger;
          if (matchingCategory) {
            const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
            if (index !== -1) {
              matchingCategory?.subcategories[index].skills.forEach(skills => {
                console.log(skills, "sllll");
                const found = responseData.some(item => item.id == skills.skill_id);
                if (found) {
                  const matchingItem = responseData.find(item => item.id == skills.skill_id);
                  if (matchingItem) {
                    matchingItem.checked = true;
                  }
                }
              });

            }

          }
        })
    },

    fetchSubSkillOn(SkillId, subcategoryId, categoryId) {
      this.getDeepSkills(SkillId)
        .then(Subskills => {
          let responseData = Subskills;
          this.Subskills = Subskills;
          console.log(Subskills, "SubskillsSubskillsSubskillsSubskillsSubskills")
          console.log(Subskills, "asdfasdf")
          // this.subSkill
          const categoryObj = this.selectedData.find(cat => cat.category_id == categoryId);
          const subcategory = this.subcategories.find(subcat => subcat.id == subcategoryId);
          const matchingCategory = this.selectedData.find(cat => cat.category_id == categoryId);
          // debugger;
          if (matchingCategory) {
            const index = categoryObj.subcategories.findIndex(sub => sub.subcategory_id == subcategoryId);
            const Skillindex = categoryObj.subcategories[index].skills.findIndex(sub => sub.subcategory_id == subcategoryId);
            if (index !== -1) {
              matchingCategory?.subcategories[index].skills.forEach(skills => {
                console.log(skills, "sllll");
                const found = responseData.some(item => item.id == skills.skill_id);
                if (found) {
                  const matchingItem = responseData.find(item => item.id == skills.skill_id);
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
      // debugger;
      this.subcategories = subcategories;
      this.skills = [];
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
        value: "",
        subcategories: []
      });
    },
    handleSubcategoryChange(event) {
      const subcategoryId = event.target.value;
      const categoryId = event.target.dataset.categoryId;
      const isChecked = event.target.checked;
      this.selectedSubCategoryId = subcategoryId;
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
            value: "",
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
      this.selectedSkillId = skillId;

      this.getDeepSkills(skillId)
        .then(Subskills => {
          let responseData = Subskills;
          this.Subskills = Subskills;
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
            skill_name: skill.name,
            value: "",
            subskills: []
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
    handleSubSkillChange(event) {
      const subSkillId = event.target.value;
      const subSkillname = event.target.name;
      const skillId = event.target.dataset.skillId;
      const isChecked = event.target.checked;
      this.selectedSkillId = skillId;
      const object = this.findSkillIndex(this.selectedData, skillId)
      if (isChecked) {
        // Push new subskill to the selected data
        this.selectedData[object.categoryIndex].subcategories[object.subcategoryIndex].skills[object.skillIndex].subskills.push({
          sub_skill_id: subSkillId,
          sub_skill_name: subSkillname,
        });
      } else {
        // Remove subskill from the selected data
        const subskills = this.selectedData[object.categoryIndex].subcategories[object.subcategoryIndex].skills[object.skillIndex].subskills;
        const indexToRemove = subskills.findIndex(subskill => subskill.sub_skill_id === subSkillId);
        if (indexToRemove !== -1) {
          subskills.splice(indexToRemove, 1);
        }
      }
    },
    findSkillIndex(data, skillId) {
      for (let i = 0; i < data.length; i++) {
        const category = data[i];
        for (let j = 0; j < category.subcategories.length; j++) {
          const subcategory = category.subcategories[j];
          for (let k = 0; k < subcategory.skills.length; k++) {
            const skill = subcategory.skills[k];
            if (skill.skill_id == skillId) {
              return { categoryIndex: i, subcategoryIndex: j, skillIndex: k };
            }
          }
        }
      }
      return null; // Skill with given skillId not found
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
      console.log(skillId, "skillIdskillId")
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
    },
    validateCategorySum() {
      let sum = 0;

      // Calculate the sum of all selected category input values
      for (let category in this.selectedData) {
        sum += this.selectedData[category].inputValue;
      }

      // Check if the sum equals 100 for each input
      // for (let category in this.selectedData) {
      if (sum !== 100) {
        // If sum is not 100, set error message for each category
        this.categorySumError = "Sum of selected categories must equal 100!";
      } else {
        // If sum is 100, clear error message for each category
        this.categorySumError = "";
      }
      // }
    },
    validateSubCategorySum(category) {
      let sum = 0;
      let catHasError = false;
      let subhasError = false;
      // Calculate the sum of subcategory values for the specified category
      for (let subCategory of category?.subcategories) {
        console.log(subCategory, "asdfasdf");
        sum += parseInt(subCategory.value);
      }

      console.log(sum, "summmmmmmmmmm");
      if (sum !== 100) {
        // Set error message for the specified category
        this.subCategorySumError[category.category_id] = "Sum of subcategories must not exceed 100!";
        catHasError = true;
      } else {
        // Clear error message if sum is valid for the specified category
        this.subCategorySumError[category.category_id] = "";
        catHasError = false;

      }
    },
    fistTimevalidate() {
      let subhasError =false;
      let sum = 0;

      // Calculate the sum of all selected category input values
      for (let category in this.selectedData) {
        sum += this.selectedData[category].inputValue;
      }

      // Check if the sum equals 100 for each input
      // for (let category in this.selectedData) {
      if (sum !== 100) {
        // If sum is not 100, set error message for each category
        this.categorySumError = "Sum of selected categories must equal 100!";
        this.submitButtonDisabled = true;
      } else {
        // If sum is 100, clear error message for each category
        this.categorySumError = "";
        this.submitButtonDisabled = false;
      }
      let subsum = 0;
      // Calculate the sum of subcategory values for the specified category


      for (let category of this.selectedData) {
        for (let subCategory of category.subcategories) {
          subsum += parseInt(subCategory.value);
        }
        console.log(category,this.subCategorySumError, "categorycategorycategory")
        if (subsum !== 100) {
          // Set error message for the specified category
          this.subCategorySumError[category.category_id] = "Sum of subcategories must not exceed 100.!";
        } else {
          // Clear error message if sum is valid for the specified category
          this.subCategorySumError[category.category_id] = "";
        }
      }
      // subhasError = !!Object.values(this.subCategorySumError).find(message => message === "Sum of subcategories must not exceed 100.!");
      // console.log("subhasErrorsubhasError",subhasError)
      // subhasError = !!subhasError ? true : false;
      // console.log(subhasError,"hhhhhhhhhhhhhhhhhhhhhhh");
      // this.submitButtonDisabled = subhasError;
    },
    validateForm() {
      // Call your validation functions here
      this.validateCategorySum();
      this.validateSubCategorySum();

      // Update submitButtonDisabled based on categorySumError
      this.submitButtonDisabled = this.categorySumError !== "";
    },
    submitForm() {
      // Check if there are any errors after validation
      if (this.categorySumError !== "") {
        console.error('Validation failed. Please correct errors before submitting.');
        return;
      }
      // Make sure selectedData is not empty
      if (this.selectedData.length === 0) {
        console.error('No data to submit.');
        return;
      }
      const companyId = this.companyId;

      // Make sure companyId is defined
      if (!companyId) {
        console.error('Company ID is not defined.');
        return;
      }
      const requestData = {
        companyId: companyId, // Assuming companyId is defined in the component
        selectedData: this.selectedData
      };

      // Make the API call
      $.ajax({
        url: '/company/save-Service/' + companyId,
        method: 'POST',
        contentType: 'application/json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify(requestData),
        success: function (response) {
          console.log('Data saved successfully:', response);
          debugger;
          var redirectURL = '/company/' + companyId + '/industry';
          window.location.href = redirectURL;

        },
        error: function (xhr, status, error) {
          // Handle error response
          console.error('Error saving data:', error);
        }
      });
    }

  }
}
</script>
<style scoped>
/* sneha */
.deepSkill {
  display: flex;
}

.category-card {
  border: 1px solid #ccc;
  margin-bottom: 20px;
}

.category-card .category-main {
  padding-left: 20px;
}

.sub-category-card {
  border: 1px solid #ccc;
  margin-bottom: 20px;
}

.sucategory-card .category-main {
  padding-left: 20px;
}



.deepSkill li {
  background-color: #ccc;
  list-style: none;
  padding: 10px 16px 0px 16px;
  border-radius: 18px;
  vertical-align: middle;
  margin-right: 24px;
}


#categoryFieldset .category-item {
  margin-bottom: 27px !important;
}

#subCategoryFieldset .category-item {
  margin: 0;
  padding: 0;
}

#SkillFieldset .category-item {
  margin: 0;
  padding: 0;
}

.sub-category-card {
  width: 100%;
}

.sub-category-card h3 {
  /* font-size: 27px; */
  color: #fff;
  background-color: #388cff;
  padding: 6px 20px;
  font-size: 1.5rem;
  width: 100%;
}

.subcategory .category-item {
  margin-right: 35px;
  vertical-align: middle;
}

.subcategory {
  /* display: flex; */
  margin-top: 20px;
}

.subcategory label {
  margin-right: 10px;
}

.category {
  width: 100%;
  padding: 0;
}

.category-main {
  display: flex;
  margin-top: 20px;
}

.category h3 {

  color: #fff;
  background-color: #388cff;
  padding: 6px 20px;
  font-size: 1.5rem;
  width: 100%;
}

#app {
  margin-bottom: 50px;
}

.category-item {
  width: auto;
  padding: 0;
}

#categoryFieldset {
  padding: 20px;
}

.catBox .col-md-6 {
  border: 1px solid #ccc;

  padding: 0;
}

.catBox .primarybox {}

.category-item input {

  width: 71px;
}

.category-card {
  display: flex;
}

.category-card .category-item {
  margin-right: 35px;
  vertical-align: middle;
}

.category-card label {
  vertical-align: middle;

  margin-right: 14px;
  padding-top: 1px;

}

legend {

  background-color: #388cff;
  color: #fff;
  padding: 10px 20px;

}

/* sneha */

.category-item {
  display: flex;
  align-items: center;
}

.icon-button {
  cursor: pointer;
  padding: 0px 12px 8px 12px;
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

.selected {
  background-color: blue;
  /* Change background color to blue */
  color: white;
  /* Change text color to white */
}

/* Adjust width and margin to align cards in rows */
@media (max-width: 576px) {
  .category-card {
    width: 100%;
  }
}
</style>