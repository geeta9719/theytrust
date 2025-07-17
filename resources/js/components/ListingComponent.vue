<style>
.loader-overlay {
  position: fixed;
  top: 0;
  left: 0;
  background-color: rgba(255, 255, 255, 0.9);
  width: 100%;
  height: 100%;
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
}

.rocket-loader {
  text-align: center;
  font-family: "Inter", sans-serif;
  color: #333;
  animation: float 2s ease-in-out infinite;
}

.rocket-loader i {
  font-size: 48px;
  color: #6c5ce7;
  animation: flyUp 1s ease-in-out infinite alternate;
}

.rocket-loader span {
  display: block;
  margin-top: 10px;
  font-size: 16px;
  color: #444;
}

@keyframes flyUp {
  0% {
    transform: translateY(0);
  }
  100% {
    transform: translateY(-12px);
  }
}

@keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
  }
}
</style>
<template>


  <div class="category-page ">

    <nav class="breadcrumb">
      <a href="#" @click.prevent="resetFilters">Home</a>
      <span v-if="selectedCategory"> / </span>
      <a href="#" v-if="selectedCategory" @click.prevent="selectCategory(selectedCategory.id)">{{
        selectedCategory.category }}</a>
      <span v-if="selectedSubcategory"> / </span>
      <a href="#" v-if="selectedSubcategory" @click.prevent="selectSubcategory(selectedSubcategory.id)">{{
        selectedSubcategory.subcategory }}</a>
    </nav>
    <div v-if="loading" class="loader-overlay">
      <div class="loader-overlay">
  <div class="rocket-loader">
    <i class="fas fa-rocket fa-bounce"></i>
    <span>Launching your results...</span>
  </div>
</div>

    </div>
    <div class="container">
      <h1>{{ pageTitle }}</h1>
      <p>
        <template v-for="category in categories" :key="category.id">
          <a href="#" @click.prevent="selectCategory(category.id)">{{ category.category }}</a><span
            v-if="categories.indexOf(category) < categories.length - 1"> | </span>
        </template>
      </p>
      <div class="filter-section">
        <div class="filters">
          <div class="searchlocation">
            <input type="text" class="bigselect" placeholder="Search Location" v-model="searchLocation"
              @input="debouncedFetchLocations" />
            <span v-if="searchLocation" @click="clearLocation"
              style="position: absolute; right: 10px; top: 9px; cursor: pointer; color: red;">×</span>
            <ul v-if="locations.length" class="location-suggestions">
              <li v-for="location in locations" :key="location.id" @click="selectLocation(location)">
                {{ location.city }}
              </li>
            </ul>
          </div>
          <select class="bigselect" v-model="selectedSubcategoryId" @change="onSubcategoryChange">
            <option value="">Select Subcategory</option>
            <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">{{
              subcategory.subcategory }}</option>
          </select>
          <select class="bigselect" v-model="selectedSkillId" @change="onSkillChange">
            <option value="">Select Skill</option>
            <option v-for="skill in skills" :key="skill.id" :value="skill.id">{{ skill.name }}</option>
          </select>
          <select class="bigselect" v-model="selectedDeepSkillId" @change="onDeepSkillChange">
            <option value="">Deep Skill</option>
            <option v-for="deepSkill in deepSkills" :key="deepSkill.id" :value="deepSkill.id">{{ deepSkill.name }}
            </option>
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
        <div class="btn-wrap">
          <label for="sortOrder">Sort by:</label>
          <select id="sortOrder" @change="setSortOrder($event.target.value)">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
          </select>
        </div>
      </div>
      <div v-if="companies.length" class="result-card" v-for="company in companies" :key="company.id">
        <div class="company-header">
          <div class="logobox">
            <img :src="company.logo" alt="Logo" class="company-logo">
            <div class="buttons">
              <a :href="`/profile/${company.slug}`" class="view-profile-btn">View Profile</a>
              <button class="request-quote-btn">Request Quote</button>
            </div>
          </div>
          <div class="company-details">
            <div class="row">
              <div class="col-md-8">
                <h3>{{ company.name }}</h3>
                <p>{{ company.tagline }}</p>
                <p>{{ company?.user?.current_subscription[0]?.plan?.name ?? 'Free' }}</p>

                <p> ttu_score {{ company?.ttu_score }}</p>
                <p> ttu_rank {{ company?.ttu_rank }}</p>
              </div>
              <div class="col-md-4 write-box">
                <p v-if="company.company_review_count">
                  ★
                  <span>{{ company.company_review_count }} Reviews</span>
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
                    <span class="meta-value">{{ company.address[0].address }}</span>
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
      countryname: '', // To store selected country name
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
      expandedDescriptions: {},
      sortOrder: 'asc',
      loading: false,
      updateUrl: ''
    };
  },
  methods: {
    setSortOrder(order) {
      this.sortOrder = order; // Update sort order
      this.updateURL(); // Call updateURL to refresh the URL and fetch data
    },
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
        console.log(response.data.deepSkills, "teteteteet");
        debugger
        this.deepSkills = response.data.deepSkills;
        debugger
        console.log('Fetched deep skills:', this.deepSkills);
        debugger
        // this.cache.deepSkills[skillId] = this.deepSkills;
      } catch (error) {
        console.error('Error fetching deep skills:', error);
      }
    },
    async fetchCompanies() {
      try {
        console.log(encodeURIComponent(this.selectedBudgetId));
        const response = await axios.get('/api/data', {
          params: {
            categoryId: this.selectedCategoryId,
            subcategoryId: this.selectedSubcategoryId,
            skillId: this.selectedSkillId,
            deepSkillId: this.selectedDeepSkillId,
            budget: this.selectedBudgetId,
            rate: this.selectedRateId,
            industry: this.selectedIndustryId,
            rating: this.selectedRating,
            location: this.searchLocation,
            order: this.sortOrder
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
      this.countryname = location.country_iso2;
      this.locations = [];

      // 🔁 Trigger page update actions
      this.updateURL();          // ✅ update URL with location
      this.updatePageTitle();    // ✅ update meta title & description
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
        if (selectedCategory) pathSegments.push(selectedCategory.slug);
      }

      if (this.selectedSubcategoryId) {
        const selectedSubcategory = this.subcategories.find(subcategory => subcategory.id == this.selectedSubcategoryId);
        if (selectedSubcategory) {
          pathSegments.push(selectedSubcategory.slug);
        }
      }

      if (this.selectedSkillId) {
        const selectedSkill = this.skills.find(skill => skill.id == this.selectedSkillId);
        if (selectedSkill) pathSegments.push(selectedSkill.slug);
      }

      if (this.selectedDeepSkillId) {
        const selectedDeepSkill = this.deepSkills.find(deepSkill => deepSkill.id == this.selectedDeepSkillId);
        if (deepSkill) pathSegments.push(deepSkill.slug);
      }

      // ✅ Smart location prefix (only if searchLocation given)
      let locationPrefix = '';
      if (this.searchLocation?.trim()) {
        const parts = this.searchLocation.trim().toLowerCase().split(/\s+/);
        const city = parts[0];
        const part2 = this.countryname.trim().toLowerCase().split(/\s+/);;
        const counteryname = part2[0];
        locationPrefix = `/${counteryname}/${city}`;
        // locationPrefix = `/${loc1}/`;
      }

      const query = new URLSearchParams();
      if (this.sortOrder) query.set('order', this.sortOrder);
      if (this.selectedBudgetId) query.set('budget', this.selectedBudgetId);
      if (this.selectedRateId) query.set('rate', this.selectedRateId);
      if (this.selectedIndustryId) query.set('industry', this.selectedIndustryId);
      if (this.selectedRating) query.set('rating', this.selectedRating);
      // if (this.searchLocation) query.set('location', this.searchLocation);

      const newPath = `${locationPrefix}/companies/${pathSegments.join('/')}`;
      const newURL = `${newPath}${query.toString() ? `?${query.toString()}` : ''}`;
      this.updateUrl = newURL;

      window.history.pushState(null, '', newURL);
      this.loading = true;

      this.fetchCompanies().finally(() => {
        this.loading = false;
      });
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
      const hasLocation = this.searchLocation?.trim() !== '';
      const location = this.searchLocation?.trim();

      if (this.selectedDeepSkill) {
        this.pageTitle = hasLocation
          ? `${this.selectedDeepSkill.name} in ${location}`
          : `${this.selectedDeepSkill.name}`;
      } else if (this.selectedSkill) {
        this.pageTitle = hasLocation
          ? `${this.selectedSkill.name} ${location}`
          : `${this.selectedSkill.name} `;
      } else if (this.selectedSubcategory) {
        this.pageTitle = hasLocation
          ? `${this.selectedSubcategory.page_heading}  in ${location}`
          : `${this.selectedSubcategory.page_heading} `;
      } else if (this.selectedCategory) {
        this.pageTitle = hasLocation
          ? ` ${this.selectedCategory.page_heading}  in ${location}`
          : ` ${this.selectedCategory.page_heading} `;
      } else {
        this.pageTitle = 'Top Category Name ';
      }

      console.log('Page Title:', this.pageTitle);

      this.$nextTick(() => {
        this.updateMetaTags();
      });
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
    },
    updateMetaTags() {
      console.log("Updating meta tags...");

      const now = new Date();
      const month = now.toLocaleString('default', { month: 'long' });
      const year = now.getFullYear();
      const monthYear = `${month}-${year}`;

      let title = this?.pageTitle || "Find Top Service Providers";

      const source =
        this.selectedDeepSkill ??
        this.selectedSkill ??
        this.selectedSubcategory ??
        this.selectedCategory;

      let dynamicMetaTitle = source?.meta_title || title;
      dynamicMetaTitle = dynamicMetaTitle.replace("'{month-year}'", monthYear);
  
      const location = this.searchLocation?.trim();
const suffix = ' | They Trust Us';

// Add "in Location" before the suffix if location is present
if (location) {
  dynamicMetaTitle = dynamicMetaTitle.replace(suffix, ` in ${location}${suffix}`);
}


      const dynamicMetaDescription =  `Explore the ${this.pageTitle} ranked by client reviews, team size, hourly rate, expertise and location. Find your partner today.`;

      // ✅ Set document title
      document.title = `${dynamicMetaTitle}`;

      // ✅ Utility function to set or create meta tag
      const setMetaTag = (name, content, property = false) => {
        const selector = property ? `meta[property='${name}']` : `meta[name='${name}']`;
        let tag = document.head.querySelector(selector);

        if (!tag) {
          tag = document.createElement('meta');
          if (property) {
            tag.setAttribute('property', name);
          } else {
            tag.setAttribute('name', name);
          }
          document.head.appendChild(tag);
        }

        tag.setAttribute('content', content);
      };

      // ✅ Set standard + OG tags
      setMetaTag('description', dynamicMetaDescription);
      setMetaTag('og:title', dynamicMetaTitle, true);
      setMetaTag('og:description', dynamicMetaDescription, true);
      setMetaTag('og:type', 'website', true);
      setMetaTag('og:url', window.location.href, true);

      // ✅ Debug logs
      console.log("✅ Updated title: ", document.title);
      console.log("✅ Updated description: ", document.querySelector("meta[name='description']")?.getAttribute('content'));
      console.log("✅ Updated OG Title: ", document.querySelector("meta[property='og:title']")?.getAttribute('content'));
    },
    clearLocation() {
      this.searchLocation = '';
      this.countryname = '';
      this.locations = [];

      // blur the input (optional)
      this.$nextTick(() => {
        const input = document.querySelector('.searchlocation input');
        if (input) input.blur();
      });

      this.updateURL();
      this.updatePageTitle();
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
    // selectedSkillId(newVal) {
    //   if (newVal) {
    //     this.fetchDeepSkills(newVal);
    //   }
    // }
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

    // this.updateURL();
    // this.updatePageTitle();
  }
};
</script>
