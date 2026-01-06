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
  0%   { transform: translateY(0); }
  100% { transform: translateY(-12px); }
}
@keyframes float {
  0%, 100% { transform: translateY(0); }
  50%      { transform: translateY(-5px); }
}
</style>

<template>
  <div class="category-page">
    <nav class="breadcrumb">
      <a href="#" @click.prevent="resetFilters">Home</a>
      <span v-if="selectedCategory"> / </span>
      <a href="#" v-if="selectedCategory" @click.prevent="selectCategory(selectedCategory.id)">
        {{ selectedCategory.category }}
      </a>
      <span v-if="selectedSubcategory"> / </span>
      <a href="#" v-if="selectedSubcategory" @click.prevent="selectSubcategory(selectedSubcategory.id)">
        {{ selectedSubcategory.subcategory }}
      </a>
    </nav>

    <div v-if="loading" class="loader-overlay">
      <div class="rocket-loader">
        <i class="fas fa-rocket fa-bounce"></i>
        <span>Launching your results..............</span>
      </div>
    </div>

    <div class="container">
      <h1>{{ pageTitle }}</h1>

      <p>
        <template v-for="(category, idx) in categories" :key="category.id">
          <a href="#" @click.prevent="selectCategory(category.id)">{{ category.category }}</a>
          <span v-if="idx < categories.length - 1"> | </span>
        </template>
      </p>

      <div class="filter-section">
        <div class="filters">
          <div class="searchlocation" style="position:relative">
            <input
              type="text"
              class="bigselect"
              placeholder="Search Location"
              v-model="searchLocation"
              @input="debouncedFetchLocations"
            />
            <span
              v-if="searchLocation"
              @click="clearLocation"
              style="position: absolute; right: 10px; top: 9px; cursor: pointer; color: red;"
            >×</span>
            <ul v-if="locations.length" class="location-suggestions">
              <li v-for="location in locations" :key="location.id" @click="selectLocation(location)">
                {{ location.city }}
              </li>
            </ul>
          </div>

          <select class="bigselect" v-model="selectedSubcategoryId" @change="onSubcategoryChange">
            <option value="">Select Subcategory</option>
            <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">
              {{ subcategory.subcategory }}
            </option>
          </select>

          <select class="bigselect" v-model="selectedSkillId" @change="onSkillChange">
            <option value="">Select Skill</option>
            <option v-for="skill in skills" :key="skill.id" :value="skill.id">
              {{ skill.name }}
            </option>
          </select>

          <select class="bigselect" v-model="selectedDeepSkillId" @change="onDeepSkillChange">
            <option value="">Deep Skill</option>
            <option v-for="deepSkill in deepSkills" :key="deepSkill.id" :value="deepSkill.id">
              {{ deepSkill.name }}
            </option>
          </select>

          <select class="smallselect dollar" v-model="selectedBudgetId" @change="updateURL">
            <option value="">Budget</option>
            <option v-for="budget in budgets" :key="budget.id" :value="budget.id">{{ budget.budget }}</option>
          </select>

          <select class="smallselect dollar" v-model="selectedRateId" @change="updateURL">
            <option value="">Hourly Rate</option>
            <option v-for="rate in rates" :key="rate.id" :value="rate.id">{{ rate.rate }}</option>
          </select>

          <select class="smallselect indust" v-model="selectedIndustryId" @change="updateURL">
            <option value="">Industry</option>
            <option v-for="industry in industries" :key="industry.id" :value="industry.id">{{ industry.name }}</option>
          </select>

          <select class="smallselect rate" v-model="selectedRating" @change="updateURL">
            <option value="">Rating</option>
            <option v-for="n in 5" :key="n" :value="n">{{ n }} stars</option>
          </select>
        </div>

        <div class="btn-wrap">
          <label for="sortOrder">Sort by:</label>
          <select id="sortOrder" @change="setSortOrder($event.target.value)">
            <option value="asc"  :selected="sortOrder==='asc'">Ascending</option>
            <option value="desc" :selected="sortOrder==='desc'">Descending</option>
          </select>
        </div>
      </div>

      <div v-for="company in companies" :key="company.id" class="result-card">
        <div class="company-header">
          <div class="logobox">
            <img :src="getLogo(company)" alt="Logo" class="company-logo" />
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
                <p>{{ getPlanName(company) }}</p>
                <p>ttu_score {{ company.ttu_score }}</p>
                <p>ttu_rank {{ company.ttu_rank }}</p>
              </div>

              <div class="col-md-4 write-box">
                <p v-if="company.company_review_count && Number(company.company_review_count) > 0">
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
                  {{ (serviceLine.category && serviceLine.category.category) ? serviceLine.category.category : 'Category has been deleted' }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="company-service-lines">
          <div class="container">
            <div class="row">
              <div class="col-md-8 company-description-box">
                <p class="company-description">{{  }}</p>
              </div>
              <div class="col-md-4">
                <div class="company-meta">
                  <div class="meta-item">
                    <span class="meta-title">Location</span>
                    <span class="meta-value">{{ getCompanyAddress(company) }}</span>
                  </div>
                  <div class="meta-item">
                    <span class="meta-title">Employees</span>
                    <span class="meta-value">{{ company.size || '-' }}</span>
                  </div>
                  <div class="meta-item">
                    <span class="meta-title">Hourly Rate</span>
                    <span class="meta-value">{{ company.rate || '-' }}</span>
                  </div>
                  <div class="meta-item">
                    <span class="meta-title">Minimum Project Size</span>
                    <span class="meta-value">{{ company.budget || '-' }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <p class="company-full-description" :class="{ expanded: expandedDescriptions[company.id] }">
          {{ company.short_description }}
        </p>
        <button
          v-if="company.short_description && company.short_description.length > 200"
          @click="toggleDescription(company.id)"
        >
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
      pageTitle: 'Top Category Names (Title of the page)',
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
      countryname: '',

      subcategories: [],
      skills: [],
      deepSkills: [],
      locations: [],

      cache: { subcategories: {}, skills: {}, deepSkills: {} },
      companies: [],
      expandedDescriptions: {},
      sortOrder: 'asc',
      loading: false,
      updateUrl: ''
    };
  },
  methods: {
    // Compute a usable logo URL for a company record returned by the API.
    // - If `company.logo` is already an absolute URL (http/https) return it.
    // - If it looks like an Azure/storage path, build an Azure URL.
    // - Otherwise fall back to `/storage/...` so local storage symlink works.
    getLogo(company) {
      if (!company || !company.logo) {
        return '/front_components/images/logo.png';
      }

      const logo = String(company.logo || '');

      // Absolute URL already
      if (/^https?:\/\//i.test(logo)) return logo;

      // If the path already contains 'company-logos' or 'images/logo' assume Azure blob path
      if (logo.indexOf('company-logos') !== -1 || logo.indexOf('images/logo') !== -1) {
        // Replace with your Azure account/container base if needed.
        // Prefer using a global config var if set on window.APP.azureUrl
        const azureBase = (window.APP && window.APP.azureUrl) || 'https://cheenti.blob.core.windows.net';
        // If the saved logo path already includes the container, avoid double container
        return `${azureBase}/${logo.replace(/^\/+/, '')}`;
      }

      // Default to local storage URL (works when using `php artisan storage:link`)
      return `/storage/${logo.replace(/^\/+/, '')}`;
    },
    // ---------- Helpers used by template ----------
    getPlanName(company) {
      const u = company && company.user;
      const cs = u && u.current_subscription && u.current_subscription[0];
      const plan = cs && cs.plan && cs.plan.name;
      return plan || 'Free';
    },
    getCompanyAddress(company) {
      const a = company && company.address && company.address[0];
      return (a && a.address) || '-';
    },

    // ---------- UI actions ----------
    setSortOrder(order) {
      this.sortOrder = order;
      this.updateURL();
    },

    async selectCategory(categoryId) {
      this.clearSelection();
      this.selectedCategoryId = categoryId;
      this.selectedCategory = this.categories.find(c => String(c.id) === String(categoryId)) || null;
      await this.fetchSubcategories(categoryId);
      this.updateURL();
      this.updatePageTitle();
    },

    async selectSubcategory(subcategoryId) {
      this.clearSkills();
      this.selectedSubcategoryId = subcategoryId;
      this.selectedSubcategory = this.subcategories.find(s => String(s.id) === String(subcategoryId)) || null;
      await this.fetchSkills(subcategoryId);
      this.updateURL();
      this.updatePageTitle();
    },

    async selectSkill(skillId) {
      this.clearDeepSkills();
      this.selectedSkillId = skillId;
      this.selectedSkill = this.skills.find(s => String(s.id) === String(skillId)) || null;
      await this.fetchDeepSkills(skillId);
      this.updateURL();
      this.updatePageTitle();
    },

    async selectDeepSkill(deepSkillId) {
      this.selectedDeepSkillId = deepSkillId;
      this.selectedDeepSkill = this.deepSkills.find(d => String(d.id) === String(deepSkillId)) || null;
      this.updateURL();
      this.updatePageTitle();
    },

    onSubcategoryChange(e) { this.selectSubcategory(e.target.value); },
    onSkillChange(e)       { this.selectSkill(e.target.value); },
    onDeepSkillChange(e)   { this.selectDeepSkill(e.target.value); },

    // ---------- Data fetchers ----------
    async fetchSubcategories(categoryId) {
      if (!categoryId) { this.clearSelection(); return; }
      if (this.cache.subcategories[categoryId]) {
        this.subcategories = this.cache.subcategories[categoryId];
        return;
      }
      try {
        const { data } = await axios.get(`/api/categories/${categoryId}/subcategories`);
        this.subcategories = data.subcategories || [];
        this.cache.subcategories[categoryId] = this.subcategories;
        this.clearSkills();
      } catch (err) {
        console.error('Error fetching subcategories:', err);
      }
    },

    async fetchSkills(subcategoryId) {
      if (!subcategoryId) { this.clearSkills(); return; }
      if (this.cache.skills[subcategoryId]) {
        this.skills = this.cache.skills[subcategoryId];
        return;
      }
      try {
        const { data } = await axios.get(`/api/subcategories/${subcategoryId}/skills`);
        this.skills = data.skills || [];
        this.cache.skills[subcategoryId] = this.skills;
        this.clearDeepSkills();
      } catch (err) {
        console.error('Error fetching skills:', err);
      }
    },

    async fetchDeepSkills(skillId) {
      if (!skillId) { this.clearDeepSkills(); return; }
      if (this.cache.deepSkills[skillId]) {
        this.deepSkills = this.cache.deepSkills[skillId];
        return;
      }
      try {
        const { data } = await axios.get(`/api/skills/${skillId}/deepskills`);
        this.deepSkills = data.deepSkills || [];
        this.cache.deepSkills[skillId] = this.deepSkills;
      } catch (err) {
        console.error('Error fetching deep skills:', err);
      }
    },

    async fetchCompanies() {
      try {
        const { data } = await axios.get('/api/data', {
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
        this.companies = data.companies || [];
        this.$nextTick(this.drawProgressCircles);
      } catch (err) {
        console.error('Error fetching companies:', err);
      }
    },

    async fetchLocations() {
      if (!this.searchLocation) { this.locations = []; return; }
      try {
        const { data } = await axios.get(`/api/location`, { params: { search: this.searchLocation } });
        this.locations = data.locations || [];
      } catch (err) {
        console.error('Error fetching locations:', err);
      }
    },

    // ---------- Location ----------
    selectLocation(location) {
      this.searchLocation = location.city || '';
      this.countryname = location.country_iso2 || '';
      this.locations = [];
      this.updateURL();
      this.updatePageTitle();
    },

    clearLocation() {
      this.searchLocation = '';
      this.countryname = '';
      this.locations = [];
      this.$nextTick(() => {
        const input = document.querySelector('.searchlocation input');
        if (input) input.blur();
      });
      this.updateURL();
      this.updatePageTitle();
    },

    // ---------- Clear helpers ----------
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

    // ---------- URL / Meta ----------
    updateURL() {
      // Build path from selected items
      const pathSegments = [];

      if (this.selectedCategoryId) {
        const cat = this.categories.find(c => String(c.id) === String(this.selectedCategoryId));
        if (cat) pathSegments.push(cat.slug);
      }
      if (this.selectedSubcategoryId) {
        const sub = this.subcategories.find(s => String(s.id) === String(this.selectedSubcategoryId));
        if (sub) pathSegments.push(sub.slug);
      }
      if (this.selectedSkillId) {
        const skl = this.skills.find(s => String(s.id) === String(this.selectedSkillId));
        if (skl) pathSegments.push(skl.slug);
      }
      if (this.selectedDeepSkillId) {
        const dsk = this.deepSkills.find(d => String(d.id) === String(this.selectedDeepSkillId));
        if (dsk) pathSegments.push(dsk.slug);
      }

      // Optional location prefix: /country/city
      let locationPrefix = '';
      if (this.searchLocation && this.countryname) {
        const city = String(this.searchLocation).trim().toLowerCase().split(/\s+/)[0];
        const country = String(this.countryname).trim().toLowerCase();
        locationPrefix = `/${country}/${city}`;
      }

      const query = new URLSearchParams();
      if (this.sortOrder)        query.set('order', this.sortOrder);
      if (this.selectedBudgetId) query.set('budget', this.selectedBudgetId);
      if (this.selectedRateId)   query.set('rate', this.selectedRateId);
      if (this.selectedIndustryId) query.set('industry', this.selectedIndustryId);
      if (this.selectedRating)   query.set('rating', this.selectedRating);
      // (location now encoded in path, not query)

      const newPath = `${locationPrefix}/companies/${pathSegments.join('/')}`.replace(/\/+$/,'');
      const newURL = `${newPath}${query.toString() ? `?${query.toString()}` : ''}`;
      this.updateUrl = newURL;

      this.loading = true;
      window.history.pushState(null, '', newURL || '/companies');

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
      this.countryname = '';
      this.clearSelection();
      this.updateURL();
    },

    updatePageTitle() {
      const hasLocation = !!(this.searchLocation && this.searchLocation.trim());
      const location = hasLocation ? this.searchLocation.trim() : '';

      if (this.selectedDeepSkill) {
        this.pageTitle = hasLocation
          ? `${this.selectedDeepSkill.page_heading} in ${location}`
          : `${this.selectedDeepSkill.page_heading}`;
      } else if (this.selectedSkill) {
        this.pageTitle = hasLocation
          ? `${this.selectedSkill.page_heading} in ${location}`
          : `${this.selectedSkill.page_heading}`;
      } else if (this.selectedSubcategory) {
        const h = this.selectedSubcategory.page_heading || this.selectedSubcategory.subcategory;
        this.pageTitle = hasLocation ? `${h} in ${location}` : `${h}`;
      } else if (this.selectedCategory) {
        const h = this.selectedCategory.page_heading || this.selectedCategory.category;
        this.pageTitle = hasLocation ? `${h} in ${location}` : `${h}`;
      } else {
        this.pageTitle = '';
      }

      this.$nextTick(this.updateMetaTags);
    },

    toggleDescription(companyId) {
      this.$set(this.expandedDescriptions, companyId, !this.expandedDescriptions[companyId]);
    },

    drawProgressCircles() {
      this.companies.forEach(company => {
        (company.service_lines || []).forEach(serviceLine => {
          const canvas = document.getElementById(`canvas-${serviceLine.id}`);
          if (!canvas) return;

          const ctx = canvas.getContext('2d');
          const radius = canvas.width / 2;
          const lineWidth = 5;
          const startAngle = -0.5 * Math.PI;
          const percent = Number(serviceLine.percent) || 0;
          const endAngle = ((percent / 100) * 2 * Math.PI) - 0.5 * Math.PI;

          ctx.clearRect(0, 0, canvas.width, canvas.height);

          // background circle
          ctx.beginPath();
          ctx.arc(radius, radius, radius - lineWidth, 0, 2 * Math.PI);
          ctx.lineWidth = lineWidth;
          ctx.strokeStyle = '#e6e6e6';
          ctx.stroke();

          // progress circle
          ctx.beginPath();
          ctx.arc(radius, radius, radius - lineWidth, startAngle, endAngle);
          ctx.lineWidth = lineWidth;
          ctx.strokeStyle = '#007bff';
          ctx.stroke();

          // percentage text
          ctx.font = '12px Arial';
          ctx.fillStyle = '#000';
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          ctx.fillText(`${percent}%`, radius, radius);
        });
      });
    },

    updateMetaTags() {
      const now = new Date();
      const month = now.toLocaleString('default', { month: 'long' });
      const year = now.getFullYear();
      const monthYear = `- ${month} ${year}`;

      const source =
        this.selectedDeepSkill ||
        this.selectedSkill ||
        this.selectedSubcategory ||
        this.selectedCategory;

      let dynamicMetaTitle = (source && source.meta_title) ? source.meta_title : (this.pageTitle || 'Find Top Service Providers');
     

      const location = (this.searchLocation && this.searchLocation.trim()) || '';
      const suffix = ' | They Trust Us';
      if (location) {
  dynamicMetaTitle = dynamicMetaTitle.replace(
    "'{month-year}'",
    `in ${location}  ${monthYear}`
  );
} else {
  dynamicMetaTitle = dynamicMetaTitle.replace(
    "'{month-year}'",
    monthYear
  );
}

    dynamicMetaTitle = dynamicMetaTitle.replace("'{month-year}'", monthYear);
      const dynamicMetaDescription =
        `Explore the ${this.pageTitle} ranked by client reviews, team size, hourly rate, expertise and location. Find your partner today.`;

      document.title = dynamicMetaTitle;

      const setMetaTag = (name, content, property = false) => {
        const selector = property ? `meta[property='${name}']` : `meta[name='${name}']`;
        let tag = document.head.querySelector(selector);
        if (!tag) {
          tag = document.createElement('meta');
          if (property) tag.setAttribute('property', name);
          else tag.setAttribute('name', name);
          document.head.appendChild(tag);
        }
        tag.setAttribute('content', content);
      };

      setMetaTag('description', dynamicMetaDescription);
      setMetaTag('og:title', dynamicMetaTitle, true);
      setMetaTag('og:description', dynamicMetaDescription, true);
      setMetaTag('og:type', 'website', true);
      setMetaTag('og:url', window.location.href, true);
    },

    // ---------- Init from route ----------
    async initFromRoute() {
      // Query params
      const params = new URLSearchParams(window.location.search);
      this.selectedCategoryId    = params.get('categoryId')    || '';
      this.selectedSubcategoryId = params.get('subcategoryId') || '';
      this.selectedSkillId       = params.get('skillId')       || '';
      this.selectedDeepSkillId   = params.get('deepSkillId')   || '';
      this.selectedBudgetId      = params.get('budget')        || '';
      this.selectedRateId        = params.get('rate')          || '';
      this.selectedIndustryId    = params.get('industry')      || '';
      this.selectedRating        = params.get('rating')        || '';
      this.searchLocation        = params.get('location')      || this.searchLocation;

      // Path segments
      const segments = (window.location.pathname || '/').split('/').filter(Boolean);
      // Expected forms:
      // /companies/<category>/<subcategory>/<skill>/<deepskill>
      // /{country}/{city}/companies/<...>
      let idx = 0;
      let countrySlug = '';
      let citySlug = '';

      if (segments[0] && segments[1] && segments[0] !== 'companies') {
        countrySlug = segments[0];
        citySlug = segments[1];
        idx = 2;
      }
      if (countrySlug && citySlug) {
        this.countryname = countrySlug.toUpperCase(); // store ISO2 if your API returns in uppercase
        this.searchLocation = citySlug;               // you can map back to proper case if needed
      }

      const isCompaniesRoot = segments[idx] === 'companies';
      if (isCompaniesRoot) {
        const categorySlug = segments[idx + 1];
        const subcategorySlug = segments[idx + 2];
        const skillSlug = segments[idx + 3];
        const deepSkillSlug = segments[idx + 4];

        // Resolve Category
        if ((!this.selectedCategoryId) && categorySlug) {
          const cat = (this.categories || []).find(c => c.slug === categorySlug);
          if (cat) {
            this.selectedCategory = cat;
            this.selectedCategoryId = cat.id;
          }
        } else if (this.selectedCategoryId) {
          this.selectedCategory = (this.categories || []).find(
            c => String(c.id) === String(this.selectedCategoryId)
          ) || null;
        }

        // Subcategories after category
        if (this.selectedCategoryId) {
          await this.fetchSubcategories(this.selectedCategoryId);
        }

        // Resolve Subcategory
        if ((!this.selectedSubcategoryId) && subcategorySlug) {
          const sub = (this.subcategories || []).find(s => s.slug === subcategorySlug);
          if (sub) {
            this.selectedSubcategory = sub;
            this.selectedSubcategoryId = sub.id;
          }
        } else if (this.selectedSubcategoryId) {
          this.selectedSubcategory = (this.subcategories || []).find(
            s => String(s.id) === String(this.selectedSubcategoryId)
          ) || null;
        }

        // Skills after subcategory
        if (this.selectedSubcategoryId) {
          await this.fetchSkills(this.selectedSubcategoryId);
        }

        // Resolve Skill
        if ((!this.selectedSkillId) && skillSlug) {
          const skl = (this.skills || []).find(s => s.slug === skillSlug);
          if (skl) {
            this.selectedSkill = skl;
            this.selectedSkillId = skl.id;
          }
        } else if (this.selectedSkillId) {
          this.selectedSkill = (this.skills || []).find(
            s => String(s.id) === String(this.selectedSkillId)
          ) || null;
        }

        // Deep skills after skill
        if (this.selectedSkillId) {
          await this.fetchDeepSkills(this.selectedSkillId);
        }

        // Resolve Deep Skill
        if ((!this.selectedDeepSkillId) && deepSkillSlug) {
          const dsk = (this.deepSkills || []).find(d => d.slug === deepSkillSlug);
          if (dsk) {
            this.selectedDeepSkill = dsk;
            this.selectedDeepSkillId = dsk.id;
          }
        } else if (this.selectedDeepSkillId) {
          this.selectedDeepSkill = (this.deepSkills || []).find(
            d => String(d.id) === String(this.selectedDeepSkillId)
          ) || null;
        }
      }

      // Finalize: URL (normalized) + title + data
      this.updateURL();
      this.updatePageTitle();
    }
  },

  // Avoid duplicate background fetches from watchers during init.
  watch: {
    selectedCategoryId(newVal, oldVal) {
      if (newVal && newVal !== oldVal) this.fetchSubcategories(newVal);
    },
    selectedSubcategoryId(newVal, oldVal) {
      if (newVal && newVal !== oldVal) this.fetchSkills(newVal);
    }
  },

  async mounted() {
    // bind debounce with correct "this"
    this.debouncedFetchLocations = debounce(this.fetchLocations.bind(this), 300);

    // ensure categories exist if they’re normally fetched
    if (!this.categories || !this.categories.length) {
      if (typeof this.fetchCategories === 'function') {
        await this.fetchCategories();
      }
    }

    await this.initFromRoute();
  }
};
</script>
