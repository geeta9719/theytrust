<template>
    <div class="category-page">
      <Breadcrumb :selectedCategory="selectedCategory" :selectedSubcategory="selectedSubcategory" />
      <h1>Top Category Name (Title of the page)</h1>
      <p>
        <template v-for="category in categories" :key="category.id">
          <a href="#" @click.prevent="fetchSubcategories(category.id)">{{ category.category }}</a><span v-if="categories.indexOf(category) < categories.length - 1"> | </span>
        </template>
      </p>
      <FilterSection
        :subcategories="subcategories"
        :skills="skills"
        :deepSkills="deepSkills"
        :budgets="budgets"
        :rates="rates"
        :industries="industries"
        :selectedCategoryId="selectedCategoryId"
        :selectedSubcategoryId="selectedSubcategoryId"
        :selectedSkillId="selectedSkillId"
        :selectedDeepSkillId="selectedDeepSkillId"
        :selectedBudgetId="selectedBudgetId"
        :selectedRateId="selectedRateId"
        :selectedIndustryId="selectedIndustryId"
        :selectedRating="selectedRating"
        :searchLocation="searchLocation"
        @update-selection="updateSelection"
        @sort-results="sortResults"
      />
      <ResultsSection :results="sortedResults" />
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import debounce from 'lodash/debounce';
  import Breadcrumb from './components/Breadcrumb.vue';
  import FilterSection from './components/FilterSection.vue';
  import ResultsSection from './components/ResultsSection.vue';
  
  export default {
    components: {
      Breadcrumb,
      FilterSection,
      ResultsSection,
    },
    props: {
      categories: Array,
      budgets: Array,
      rates: Array,
      industries: Object,
    },
    data() {
      return {
        selectedCategory: null,
        selectedSubcategory: null,
        selectedSkill: null,
        selectedDeepSkill: null,
        selectedCategoryId: '',
        selectedSubcategoryId: '',
        selectedSkillId: '',
        selectedDeepSkillId: '',
        selectedBudgetId: '',
        selectedRateId: '',
        selectedIndustryId: '',
        selectedRating: '',
        searchLocation: '',
        subcategories: [],
        skills: [],
        deepSkills: [],
        sortedResults: [],
        cache: {
          subcategories: {},
          skills: {},
          deepSkills: {},
        },
      };
    },
    methods: {
      async fetchSubcategories(categoryId) {
        if (!categoryId) {
          this.clearSelection();
          return;
        }
  
        if (this.cache.subcategories[categoryId]) {
          this.subcategories = this.cache.subcategories[categoryId];
          this.selectedCategory = this.categories.find(category => category.id === categoryId);
          return;
        }
  
        try {
          const response = await axios.get(`/api/categories/${categoryId}/subcategories`);
          this.subcategories = response.data.subcategories;
          this.cache.subcategories[categoryId] = this.subcategories;
          this.selectedCategory = this.categories.find(category => category.id === categoryId);
          this.clearSkills();
        } catch (error) {
          console.error('Error fetching subcategories:', error);
        }
      },
      async fetchSkills() {
        if (!this.selectedSubcategoryId) {
          this.clearSkills();
          return;
        }
  
        if (this.cache.skills[this.selectedSubcategoryId]) {
          this.skills = this.cache.skills[this.selectedSubcategoryId];
          this.selectedSubcategory = this.subcategories.find(subcategory => subcategory.id === this.selectedSubcategoryId);
          return;
        }
  
        try {
          const response = await axios.get(`/api/subcategories/${this.selectedSubcategoryId}/skills`);
          this.skills = response.data.skills;
          this.cache.skills[this.selectedSubcategoryId] = this.skills;
          this.selectedSubcategory = this.subcategories.find(subcategory => subcategory.id === this.selectedSubcategoryId);
          this.clearDeepSkills();
        } catch (error) {
          console.error('Error fetching skills:', error);
        }
      },
      async fetchDeepSkills() {
        if (!this.selectedSkillId) {
          this.clearDeepSkills();
          return;
        }
  
        if (this.cache.deepSkills[this.selectedSkillId]) {
          this.deepSkills = this.cache.deepSkills[this.selectedSkillId];
          this.selectedSkill = this.skills.find(skill => skill.id === this.selectedSkillId);
          return;
        }
  
        try {
          const response = await axios.get(`/api/skills/${this.selectedSkillId}/deepskills`);
          this.deepSkills = response.data.deepSkills;
          this.cache.deepSkills[this.selectedSkillId] = this.deepSkills;
          this.selectedSkill = this.skills.find(skill => skill.id === this.selectedSkillId);
        } catch (error) {
          console.error('Error fetching deep skills:', error);
        }
      },
      clearSelection() {
        this.subcategories = [];
        this.selectedCategory = null;
        this.clearSkills();
      },
      clearSkills() {
        this.skills = [];
        this.selectedSubcategory = null;
        this.clearDeepSkills();
      },
      clearDeepSkills() {
        this.deepSkills = [];
        this.selectedSkill = null;
        this.selectedDeepSkill = null;
      },
      async sortResults() {
        try {
          const response = await axios.get('/api/sorted-results', {
            params: {
              categoryId: this.selectedCategoryId,
              subcategoryId: this.selectedSubcategoryId,
              skillId: this.selectedSkillId,
              deepSkillId: this.selectedDeepSkillId,
              budgetId: this.selectedBudgetId,
              rateId: this.selectedRateId,
              industryId: this.selectedIndustryId,
              rating: this.selectedRating,
              location: this.searchLocation,
            },
          });
          this.sortedResults = response.data.results;
        } catch (error) {
          console.error('Error fetching sorted results:', error);
        }
      },
      updateSelection(selection) {
        Object.assign(this, selection);
      },
    },
    watch: {
      selectedSkillId(newVal) {
        if (newVal) {
          this.selectedSkill = this.skills.find(skill => skill.id === newVal);
          this.fetchDeepSkills();
        } else {
          this.clearDeepSkills();
        }
      },
      selectedDeepSkillId(newVal) {
        if (newVal) {
          this.selectedDeepSkill = this.deepSkills.find(deepSkill => deepSkill.id === newVal);
        } else {
          this.selectedDeepSkill = null;
        }
      },
    },
    created() {
      this.fetchSubcategories = debounce(this.fetchSubcategories, 300);
      this.fetchSkills = debounce(this.fetchSkills, 300);
      this.fetchDeepSkills = debounce(this.fetchDeepSkills, 300);
    },
  };
  </script>
  