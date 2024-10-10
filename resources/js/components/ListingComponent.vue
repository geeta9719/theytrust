<style>

.filter-section h2{
    background-color: #ece4fa;
    color: #000;
     font-size: 18px;
    font-weight: 700;
font-family: "Epilogue", sans-serif;
    padding: 7px 11px;
}
.filters select {
   font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
    colo:#23262a;
       
}
select {
    -webkit-appearance: auto!important;
    -moz-appearance: auto!important;
    text-indent: 1px;
 
}
 .company-description-box{
 border-right:1px solid #ccc;
 }
.btn-wrap{
  width:100%;
  text-align:right
}
.company-details h3{
    font-size: 24px !important;
    font-weight: 700;
    color: #171a1f !important;
    text-transform: capitalize;
    font-family: "Epilogue", sans-serif;
}
 .btn-wrap button:hover {
    background-color: #dee1e6;
    color:#000;
}
.rate {
    background: url(https://theytrust-us.developmentserver.info/img/star.png) no-repeat left center;
    
}
.dollar {
    background: url(https://theytrust-us.developmentserver.info/img/dollar.png) no-repeat left center;
    
}


.indust {
    background: url(https://theytrust-us.developmentserver.info/img/zig.png) no-repeat left center;
    
}




.btn-wrap button {
    background-color: #dee1e6;
    color: #000;
}

.smallselect {
height: 35px;
    width: 70px;
    background-size: 18px;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 0 0px 0 18px;
    background-position-x: 3px;
    background-color:#fff;}

.bigselect {
height: 35px;
    width: 188px;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 0 0px 0 18px;
    text-indent: 4px;
    font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
    color:#23262a;

}
.bigselect::placeholder{
color:#23262a;
}
.logobox{
display:block;}


.logobox .buttons {

    display: grid;
 
}
.write-box{
    text-align: right;
    padding-right: 41px;}
.service-box{
display:flex;}
.write-review-link{
        margin-top: 12px;
    font-size: 14px;
    font-weight: 600;
    margin-left: 12px;
    color: #379ae6 !important;
    text-decoration: underline;
    display: block;
}
.company-description{
margin-bottom:40px;
font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
}
.location-suggestions{
position:relative;}
.searchlocation{
position:relative;
}

.searchlocation ul {
margin:0;
padding:0;
}
.searchlocation ul li{
    padding: 10px;
    font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
    color: #23262a;

}



@media (max-width: 767px) {
.searchlocation {
    position: absolute;
    width: 65%;
    border: 0;
}
.company-header {
    display: flex;
    gap: 20px;
    flex-direction: column;
}
.company-description-box{
border:0;}
.company-details{
border:0!important;}
.company-description {
    margin-bottom: 0;
}

.smallselect {
padding: 0;
    width: 100%;
   
    margin-top: 17px;
}
.bigselect{
padding: 0;
    width: 100%;
   
    margin-top: 17px;
}



.logobox {
    display: block;
            text-align: center;
}
.service-box {
    display: flex;
    flex-direction: column;
}
}







</style>


<template>


  <div class="category-page ">
  
    <nav class="breadcrumb">
      <a href="#" @click.prevent="resetFilters">Home</a>
      <span v-if="selectedCategory"> / </span>
      <a href="#" v-if="selectedCategory" @click.prevent="selectCategory(selectedCategory.id)">{{ selectedCategory.category }}</a>
      <span v-if="selectedSubcategory"> / </span>
      <a href="#" v-if="selectedSubcategory" @click.prevent="selectSubcategory(selectedSubcategory.id)">{{ selectedSubcategory.subcategory }}</a>
    </nav>
    <div class="container">
    <h1>{{ pageTitle }}</h1>
    <p>
      <template v-for="category in categories" :key="category.id">
        <a href="#" @click.prevent="selectCategory(category.id)">{{ category.category }}</a><span v-if="categories.indexOf(category) < categories.length - 1"> | </span>
      </template>
    </p>




    <div class="filter-section">
      <h2>Discover the Globe's Best (Title of the page)</h2>
      <div class="filters">
        <div class="searchlocation">
          <input type="text"  class="bigselect"  placeholder="Search Location" v-model="searchLocation" @input="debouncedFetchLocations" />
          <ul v-if="locations.length" class="location-suggestions">
            <li v-for="location in locations" :key="location.id" @click="selectLocation(location)">
              {{ location.city }}
            </li>
          </ul>
      </div>
        <select class="bigselect" v-model="selectedSubcategoryId" @change="onSubcategoryChange">
          <option value="">Select Subcategory</option>
          <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">{{ subcategory.subcategory }}</option>
        </select>
        <select class="bigselect" v-model="selectedSkillId" @change="onSkillChange">
          <option value="">Select Skill</option>
          <option v-for="skill in skills" :key="skill.id" :value="skill.id">{{ skill.name }}</option>
        </select>
        <select class="bigselect" v-model="selectedDeepSkillId" @change="onDeepSkillChange">
          <option value="">Deep Skill</option>
          <option v-for="deepSkill in deepSkills" :key="deepSkill.id" :value="deepSkill.id">{{ deepSkill.name }}</option>
        </select>
        <select class="smallselect dollar" v-model="selectedBudgetId" @change="updateURL">
        
          <option v-for="budget in budgets" :key="budget.id" :value="budget.id">{{ budget.budget }}</option>
        </select>
        <select class="smallselect dollar " v-model="selectedRateId" @change="updateURL">
     
          <option v-for="rate in rates" :key="rate.id" :value="rate.id">{{ rate.rate }}</option>
        </select>
        <select class="smallselect indust" v-model="selectedIndustryId" @change="updateURL">
         
          <option v-for="industry in industries" :key="industry.id" :value="industry.id">{{ industry.name }}</option>
        </select>
        <select class="smallselect rate" v-model="selectedRating" @change="updateURL">
         
          <option v-for="n in 5" :key="n" :value="n">{{ n }} stars</option>
        </select>
        
      </div>
     <div class="btn-wrap"> <button @click="updateURL">Sort Results</button></div>
    </div>
    <div v-if="companies.length" class="result-card" v-for="company in companies" :key="company.id">
      <div class="company-header">
      <div class="logobox">
        <img :src="company.logo" alt="Logo" class="company-logo">
          <div class="buttons">
            <a :href="`/profile/${company.id}`" class="view-profile-btn">View Profile</a>
            <button class="request-quote-btn">Request Quote</button>
          </div>
            </div>
        <div class="company-details">

<div class="row">
<div class="col-md-8">
 <h3>{{ company.name }}</h3>
          <p>{{ company.tagline }}</p>
</div>
<div class="col-md-4 write-box">
 <p v-if="company.company_review">
       
         ★
        <span>{{ company.company_review.length }} Reviews</span>
        <a :href="`/company/${company.id}/getReview`" class="write-review-link">Write a Review</a>
      </p>
      <p v-else>
        No reviews yet
        <a :href="`/company/${company.id}/getReview`" class="write-review-link">Write a Review</a>
      </p>
       
</div>
</div>

         
       
         
         
           <h4>Target Service Areas</h4>
           <div class="service-box">
        <div class="service-line" v-for="serviceLine in company.service_lines" :key="serviceLine.id">
          <canvas :id="'canvas-' + serviceLine.id" width="50" height="50"></canvas>
          <div class="service-line-category">
            {{ serviceLine.category?.category || 'Category has been deleted' }}
          </div>
        </div>
        </div>

        </div>
      </div>
     <div class="company-service-lines">


     <div class="container">
      <div class="row">
     <div class="col-md-8 company-description-box">
       <p class="company-description">{{ company.short_description }}</p>
     </div>
     <div class="col-md-4">
       <div class="company-meta">
        <div class="meta-item">
          <span class="meta-title">Location</span>
          <span class="meta-value">{{ company.location }}</span>
        </div>
        <div class="meta-item">
          <span class="meta-title">Employees</span>
          <span class="meta-value">{{ company.size }}</span>
        </div>
        <div class="meta-item">
          <span class="meta-title">Hourly Rate</span>
          <span class="meta-value">{{ company.rate }}</span>
        </div>
        <div class="meta-item">
          <span class="meta-title">Minimum Project Size</span>
          <span class="meta-value">{{ company.budget }}</span>
        </div>
      </div>
     </div>
     </div>
     </div>
        
       











       
      </div>
   
      <p class="company-full-description" :class="{ expanded: expandedDescriptions[company.id] }">
        {{ company.description }}
      </p>
      <button v-if="company.description && company.description.length > 200" @click="toggleDescription(company.id)">
        {{ expandedDescriptions[company.id] ? 'Show Less' : 'Show More' }}
      </button>
    </div>
  </div>
  </div>
</template>

<script>
import axios from 'axios';
import debounce from 'lodash/debounce';

export default {
  props: {
    categories: Array,
    budgets: Array,
    rates: Array,
    industries: Array
  },
  data() {
    return {
      pageTitle: 'Top Category Names (Title of the page)', // Initialize page title
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
      locations: [], // Array to store fetched locations
      cache: {
        subcategories: {},
        skills: {},
        deepSkills: {}
      },
      companies: [], // To store fetched companies data
      expandedDescriptions: {}
    };
  },
  methods: {
    async selectCategory(categoryId) {
      this.clearSelection();
      this.selectedCategoryId = categoryId;
      this.selectedCategory = this.categories.find(category => category.id == categoryId);
      await this.fetchSubcategories(categoryId);
      this.updateURL();
      this.updatePageTitle();
    },
    async selectSubcategory(subcategoryId) {
      this.clearSkills();
      this.selectedSubcategoryId = subcategoryId;
      this.selectedSubcategory = this.subcategories.find(subcategory => subcategory.id == subcategoryId);
      await this.fetchSkills(subcategoryId);
      this.updateURL();
      this.updatePageTitle();
    },
    async selectSkill(skillId) {
      this.clearDeepSkills();
      this.selectedSkillId = skillId;
      this.selectedSkill = this.skills.find(skill => skill.id == skillId);
      await this.fetchDeepSkills(skillId);
      this.updateURL();
      this.updatePageTitle();
    },
    async selectDeepSkill(deepSkillId) {
      this.selectedDeepSkillId = deepSkillId;
      this.selectedDeepSkill = this.deepSkills.find(deepSkill => deepSkill.id == deepSkillId);
      this.updateURL();
      this.updatePageTitle();
    },
    onSubcategoryChange(event) {
      const subcategoryId = event.target.value;
      this.selectSubcategory(subcategoryId);
    },
    onSkillChange(event) {
      const skillId = event.target.value;
      this.selectSkill(skillId);
    },
    onDeepSkillChange(event) {
      const deepSkillId = event.target.value;
      this.selectDeepSkill(deepSkillId);
    },
    async fetchSubcategories(categoryId) {
      if (!categoryId) {
        this.clearSelection();
        return;
      }

      if (this.cache.subcategories[categoryId]) {
        this.subcategories = this.cache.subcategories[categoryId];
        return;
      }

      try {
        const response = await axios.get(`/api/categories/${categoryId}/subcategories`);
        this.subcategories = response.data.subcategories;
        this.cache.subcategories[categoryId] = this.subcategories;
        this.clearSkills();
      } catch (error) {
        console.error('Error fetching subcategories:', error);
      }
    },
    async fetchSkills(subcategoryId) {
      if (!subcategoryId) {
        this.clearSkills();
        return;
      }

      if (this.cache.skills[subcategoryId]) {
        this.skills = this.cache.skills[subcategoryId];
        return;
      }

      try {
        const response = await axios.get(`/api/subcategories/${subcategoryId}/skills`);
        this.skills = response.data.skills;
        this.cache.skills[subcategoryId] = this.skills;
        this.clearDeepSkills();
      } catch (error) {
        console.error('Error fetching skills:', error);
      }
    },
    async fetchDeepSkills(skillId) {
      if (!skillId) {
        this.clearDeepSkills();
        return;
      }

      if (this.cache.deepSkills[skillId]) {
        this.deepSkills = this.cache.deepSkills[skillId];
        return;
      }

      try {
        const response = await axios.get(`/api/skills/${skillId}/deepskills`);
        console.log(response);
        this.deepSkills = response.data.deepskills;
        this.cache.deepSkills[skillId] = this.deepSkills;
      } catch (error) {
        console.error('Error fetching deep skills:', error);
      }
    },
    async fetchCompanies() {
      try {
        const response = await axios.get('/api/companies', {
          params: {
            categoryId: this.selectedCategoryId,
            subcategoryId: this.selectedSubcategoryId,
            skillId: this.selectedSkillId,
            deepSkillId: this.selectedDeepSkillId,
            budget: this.selectedBudgetId,
            rate: this.selectedRateId,
            industry: this.selectedIndustryId,
            rating: this.selectedRating,
            location: this.searchLocation
          }
        });
        this.companies = response.data.companies;
        this.$nextTick(() => {
          this.drawProgressCircles();
        });
      } catch (error) {
        console.error('Error fetching companies:', error);
      }
    },
    async fetchLocations() {
      if (!this.searchLocation) {
        this.locations = [];
        return;
      }

      try {
        const response = await axios.get(`/api/location`, {
          params: {
            search: this.searchLocation,
          }
        });
        this.locations = response.data.locations;
      } catch (error) {
        console.error('Error fetching locations:', error);
      }
    },
    selectLocation(location) {
      this.searchLocation = location.city;
      this.locations = [];
      this.updateURL();
    },
    clearSelection() {
      this.subcategories = [];
      this.selectedSubcategoryId = '';
      this.selectedSubcategory = null;
      this.clearSkills();
    },
    clearSkills() {
      this.skills = [];
      this.selectedSkillId = '';
      this.selectedSkill = null;
      this.clearDeepSkills();
    },
    clearDeepSkills() {
      this.deepSkills = [];
      this.selectedDeepSkillId = '';
      this.selectedDeepSkill = null;
    },
    updateURL() {
      const pathSegments = [];

      if (this.selectedCategoryId) {
        const selectedCategory = this.categories.find(category => category.id == this.selectedCategoryId);
        if (selectedCategory) {
          pathSegments.push(selectedCategory.slug);
        }
      }

      if (this.selectedSubcategoryId) {
        const selectedSubcategory = this.subcategories.find(subcategory => subcategory.id == this.selectedSubcategoryId);
        if (selectedSubcategory) {
          pathSegments.push(selectedSubcategory.slug);
        }
      }

      if (this.selectedSkillId) {
        const selectedSkill = this.skills.find(skill => skill.id == this.selectedSkillId);
        if (selectedSkill) {
          pathSegments.push(selectedSkill.slug);
        }
      }

      if (this.selectedDeepSkillId) {
        const selectedDeepSkill = this.deepSkills.find(deepSkill => deepSkill.id == this.selectedDeepSkillId);
        if (selectedDeepSkill) {
          pathSegments.push(selectedDeepSkill.slug);
        }
      }

      const query = new URLSearchParams();

      if (this.selectedBudgetId) query.set('budget', this.selectedBudgetId);
      if (this.selectedRateId) query.set('rate', this.selectedRateId);
      if (this.selectedIndustryId) query.set('industry', this.selectedIndustryId);
      if (this.selectedRating) query.set('rating', this.selectedRating);
      if (this.searchLocation) query.set('location', this.searchLocation);

      const newPath = `/listing/${pathSegments.join('/')}`;
      const newURL = `${newPath}${query.toString() ? `?${query.toString()}` : ''}`;

      window.history.pushState(null, '', newURL);
      this.fetchCompanies(); // Fetch companies data when URL updates
    },
    resetFilters() {
      this.pageTitle = 'Top Category Name (Title of the page)';
      this.selectedCategory = null;
      this.selectedCategoryId = '';
      this.selectedSubcategory = null;
      this.selectedSubcategoryId = '';
      this.selectedSkill = null;
      this.selectedSkillId = '';
      this.selectedDeepSkill = null;
      this.selectedDeepSkillId = '';
      this.selectedBudgetId = '';
      this.selectedRateId = '';
      this.selectedIndustryId = '';
      this.selectedRating = '';
      this.searchLocation = '';
      this.clearSelection();
      this.updateURL();
    },
    updatePageTitle() {
      if (this.selectedDeepSkill) {
        this.pageTitle = this.selectedDeepSkill.name;
      } else if (this.selectedSkill) {
        this.pageTitle = this.selectedSkill.name;
      } else if (this.selectedSubcategory) {
        this.pageTitle = this.selectedSubcategory.subcategory;
      } else if (this.selectedCategory) {
        this.pageTitle = this.selectedCategory.category;
      } else {
        this.pageTitle = 'Top Category Name (Title of the page)';
      }
      console.log('Updated pageTitle:', this.pageTitle);
    },
    toggleDescription(companyId) {
      this.$set(this.expandedDescriptions, companyId, !this.expandedDescriptions[companyId]);
    },
    drawProgressCircles() {
      this.companies.forEach(company => {
        company.service_lines.forEach(serviceLine => {
          const canvas = document.getElementById(`canvas-${serviceLine.id}`);
          if (canvas) {
            const context = canvas.getContext('2d');
            const radius = canvas.width / 2;
            const lineWidth = 5;
            const startAngle = -0.5 * Math.PI;
            const endAngle = ((serviceLine.percent / 100) * 2 * Math.PI) - 0.5 * Math.PI;

            context.clearRect(0, 0, canvas.width, canvas.height);

            // Draw background circle
            context.beginPath();
            context.arc(radius, radius, radius - lineWidth, 0, 2 * Math.PI);
            context.lineWidth = lineWidth;
            context.strokeStyle = '#e6e6e6';
            context.stroke();

            // Draw foreground circle
            context.beginPath();
            context.arc(radius, radius, radius - lineWidth, startAngle, endAngle);
            context.lineWidth = lineWidth;
            context.strokeStyle = '#007bff';
            context.stroke();

            // Draw percentage text
            context.font = '12px Arial';
            context.fillStyle = '#000';
            context.textAlign = 'center';
            context.textBaseline = 'middle';
            context.fillText(`${serviceLine.percent}%`, radius, radius);
          }
        });
      });
    }
  },
  watch: {
    selectedCategoryId(newVal) {
      if (newVal) {
        this.fetchSubcategories(newVal);
      }
    },
    selectedSubcategoryId(newVal) {
      if (newVal) {
        this.fetchSkills(newVal);
      }
    },
    selectedSkillId(newVal) {
      if (newVal) {
        this.fetchDeepSkills(newVal);
      }
    }
  },
  created() {
    this.debouncedFetchLocations = debounce(this.fetchLocations, 300);

    const params = new URLSearchParams(window.location.search);
    this.selectedCategoryId = params.get('categoryId') || '';
    this.selectedSubcategoryId = params.get('subcategoryId') || '';
    this.selectedSkillId = params.get('skillId') || '';
    this.selectedDeepSkillId = params.get('deepSkillId') || '';
    this.selectedBudgetId = params.get('budgetId') || '';
    this.selectedRateId = params.get('rateId') || '';
    this.selectedIndustryId = params.get('industryId') || '';
    this.selectedRating = params.get('rating') || '';
    this.searchLocation = params.get('location') || '';

    const pathSegments = window.location.pathname.split('/').filter(segment => segment);

    if (pathSegments.length > 1) {
      const categorySlug = pathSegments[1];
      const subcategorySlug = pathSegments[2];

      const selectedCategory = this.categories.find(category => category.slug === categorySlug);
      if (selectedCategory) {
        this.selectedCategoryId = selectedCategory.id;
        this.selectedCategory = selectedCategory;
        this.fetchSubcategories(selectedCategory.id);

        const selectedSubcategory = this.subcategories.find(subcategory => subcategory.slug === subcategorySlug);
        if (selectedSubcategory) {
          this.selectedSubcategoryId = selectedSubcategory.id;
          this.selectedSubcategory = selectedSubcategory;
          this.fetchSkills(selectedSubcategory.id);
        }
      }
    }

    if (this.selectedCategoryId) {
      this.fetchSubcategories(this.selectedCategoryId);
    }
    if (this.selectedSubcategoryId) {
      this.fetchSkills(this.selectedSubcategoryId);
    }
    if (this.selectedSkillId) {
      this.fetchDeepSkills(this.selectedSkillId);
    }

    this.updateURL();
    this.updatePageTitle();
  }
};
</script>

<style>
.category-page {
  padding: 20px;
  font-family: Arial, sans-serif;
}

.breadcrumb {
  font-size: 14px;
  margin-bottom: 20px;
  color: #555;
}

.breadcrumb a {
  color: #007bff;
  text-decoration: none;
}

.breadcrumb a:hover {
  text-decoration: underline;
}

h1 {
  font-size: 24px;
  margin-bottom: 10px;
}

p {
  font-size: 16px;
  color: #333;
}

p a {
  color: #007bff;
  text-decoration: none;
}

p a:hover {
  text-decoration: underline;
}

.filter-section {
  margin-top: 20px;
  background-color: #f9f9f9;
  padding: 15px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.filters {
    display: flex;
    flex-wrap: wrap;
    /* gap: 10px; */
    justify-content: space-between;
    align-items: center;
}

 
.filters button {
  padding: 10px 15px;
  font-size: 14px;
  color: #fff;
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.filters button:hover {
  background-color: #0056b3;
}


.location-suggestions {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: white;
  border: 1px solid #ddd;
  border-radius: 5px;
  max-height: 200px;
  overflow-y: auto;
  z-index: 10;
}

.location-suggestions li {
  padding: 10px;
  cursor: pointer;
}

.location-suggestions li:hover {
  background-color: #f1f1f1;
}

.result-card {
  border: 1px solid #ddd;
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 5px;
}

.company-header {
  display: flex;
  gap: 20px;
}

.company-logo {
  width: 100px;
  height: 100px;
  object-fit: cover;
}
.company-details .company-description{
  border-top: 1px solid #ccc;
   padding-top: 18px;
     margin-top: 20px;
}
.company-details p{
font-size: 12px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
padding-left: 28px;}
.company-details h3{
padding-left: 28px;}
.company-details h4{
    padding-left: 28px;
    font-size: 16px;
    font-weight: 700;
    font-family: "Epilogue", sans-serif;
    border-top: 1px solid #ccc;
    padding-top: 34px;

}
.company-details .service-line{
padding-left: 28px;}
.company-details {
  flex: 1;
  border-left: 1px solid #ccc;
    
}

.company-description,
.company-full-description {

  text-overflow: ellipsis;
}

.company-full-description.expanded {
  max-height: none;
}

.company-service-lines {
  margin-top: 20px;
}

.service-line {
  display: flex;
  align-items: center;
  gap: 10px;
}

.service-line canvas {
  border-radius: 50%;
}

.service-line-category {
  font-size: 14px;
}

.company-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 20px;
}
.meta-item{
    display: flex;
    margin: auto;
    width: 100%;
}
.meta-title {
     color: #00bdd6;
    background-color: #ebfdff;
    border-color: #00bdd6 !important;
    border-radius: 5px;
    padding: 3px 21px 3px 14px;
    font-size: 14px;
    margin-right: 5px;
    font-weight: 400 !important;
    border: 0;
    border-radius: 18px;
     font-family: "Inter", sans-serif;
    vertical-align: middle;
    display: flex;
    align-items: center;

}

.meta-title {
  font-weight: bold;
}

.meta-value {
    color: #424448;
    font-weight: 400;
    font-size: 14px;
     font-family: "Inter", sans-serif;
}

.buttons {
  margin-top: 10px;
  display: flex;
  gap: 10px;
}
.company-details .buttons {
    padding-left: 28px;
}
.write-box p span{
 font-size: 14px;
    font-weight: 700;
font-family: "Epilogue", sans-serif;
}
.write-box p a{
font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
}
.view-profile-btn:hover,
.request-quote-btn:hover {
color:#000!important;
text-decoration:none!important;}
.view-profile-btn,
.request-quote-btn {
  padding: 6px 15px;
font-size: 14px;
    font-weight: 400;
    font-family: "Inter", sans-serif;
  color: #fff;
  background-color: #00bdd6;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
}

.view-profile-btn:hover,
.request-quote-btn:hover {
  background-color: #00bdd6;
}

button {
  margin-top: 10px;
  padding: 10px 15px;
  background-color: #00bdd6;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
.breadcrumb a{
color:#00bdd6!important;}


</style> 