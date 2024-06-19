<template>
  <section class="container mt-5 mb-5 list-box">
    <form @submit.prevent="handleSubmit">
      <div class="category-card">
        <input type="hidden" id="companyIdInput" name="companyId" :value="companyId">

        <div v-if="selectedIndustries.length > 0" class="category mb-4">
          <h3>Select Industry Percentages: {{ categorySum }}%</h3>
          <div class="category-main row">
            <div v-for="industry in selectedIndustriesData" :key="industry.id" class="category-item col-md-3 col-12 mb-2">
              <label :for="'input_' + industry.id">{{ industry.name }}:</label>
              <div class="input-group">
                <input
                  type="number"
                  :id="'input_' + industry.id"
                  :name="'input_' + industry.id"
                  v-model.number="industryPercentages[industry.id]"
                  @input="validateCategorySum"
                  min="0"
                  max="100"
                  placeholder="Percentage"
                  class="form-control"
                >
              </div>
            </div>
          </div>
        </div>
        <span v-if="categorySumError && selectedIndustries.length > 0" class="error text-danger">
          {{ categorySumError }}
        </span>
      </div>

      <div class="category-card">
        <div v-if="selectedClientSizes.length > 0" class="category mb-4">
          <h3>Select Client Size Percentages: {{ clientSizeSum }}%</h3>
          <div class="category-main row">
            <div v-for="size in selectedClientSizesData" :key="size.id" class="category-item col-md-3 col-12 mb-2">
              <label :for="'client_input_' + size.id">{{ getClientSizeName(size.id) }}:</label>
              <div class="input-group">
                <input
                  type="number"
                  :id="'client_input_' + size.id"
                  :name="'client_input_' + size.id"
                  v-model.number="clientSizePercentages[size.id]"
                  @input="validateClientSizeSum"
                  min="0"
                  max="100"
                  placeholder="Percentage"
                  class="form-control"
                >
              </div>
            </div>
          </div>
        </div>
        <span v-if="clientSizeSumError && selectedClientSizes.length > 0" class="error text-danger">
          {{ clientSizeSumError }}
        </span>
      </div>

      <div class="row justify-content-center mb-4">
        <div class="col-md-6 text-center">
          <h4 class="font-weight-bold">Choose Size and Industries</h4>
        </div>
      </div>

      <div class="container catBox">
        <div class="row">
          <div class="col-md-6">
            <fieldset>
              <legend>Choose Industry</legend>
              <div v-for="industry in industries" :key="industry.id" class="form-check">
                <input
                  type="checkbox"
                  :id="industry.id"
                  :value="industry.id"
                  v-model="selectedIndustries"
                  class="form-check-input"
                >
                <label :for="industry.id" class="form-check-label">{{ industry.name }}</label>
              </div>
            </fieldset>
          </div>
          <div class="col-md-6">
            <fieldset>
              <legend>Choose Client Size</legend>
              <div v-for="size in clientSizes" :key="size.id" class="form-check">
                <input
                  type="checkbox"
                  :id="size.id"
                  :value="size.id"
                  v-model="selectedClientSizes"
                  class="form-check-input"
                >
                <label :for="size.id" class="form-check-label">{{ size.name }}</label>
              </div>
            </fieldset>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    industries: Array,
    clientSizes: Array
  },
  data() {
    return {
      selectedIndustries: [],
      selectedClientSizes: [],
      industryPercentages: {},
      clientSizePercentages: {},
      categorySumError: '',
      clientSizeSumError: '',
      companyId: "1"
    };
  },
  computed: {
  categorySum() {
    return Object.values(this.industryPercentages).reduce((sum, val) => sum + (parseInt(val, 10) || 0), 0);
  },
  clientSizeSum() {
    return Object.values(this.clientSizePercentages).reduce((sum, val) => sum + (parseInt(val, 10) || 0), 0);
  },
  selectedIndustriesData() {
    return this.industries.filter(industry => this.selectedIndustries.includes(industry.id));
  },
  selectedClientSizesData() {
    return this.clientSizes.filter(size => this.selectedClientSizes.includes(size.id));
  }
},
  methods: {
    fetchDataAndGenerateTextboxes() {
    axios.get(`/industry/${this.companyId}`)
      .then(response => {
        response.data.industry.forEach(industry => {
          this.selectedIndustries.push(industry.industry.id);
          this.industryPercentages[industry.industry.id] = industry.percent;
        });
        response.data.client_size.forEach(clientSize => {
          this.selectedClientSizes.push(clientSize.client_size.id);
          this.clientSizePercentages[clientSize.client_size.id] = clientSize.percent;
        });
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  },
    validateCategorySum() {
      this.categorySumError = this.categorySum > 100 ? 'Total percentage cannot exceed 100%' : '';
    },
    validateClientSizeSum() {
      this.clientSizeSumError = this.clientSizeSum > 100 ? 'Total percentage cannot exceed 100%' : '';
    },
    handleSubmit() {
      console.log()
      if (this.categorySum > 100) {
        this.categorySumError = 'Total percentage cannot exceed 100%';
        return;
      }

      if (this.clientSizeSum > 100) {
        this.clientSizeSumError = 'Total percentage cannot exceed 100%';
        return;
      }

      const data = {
        industries: this.selectedIndustries.map(id => ({
          id,
          percentage: this.industryPercentages[id] || 0
        })),
        clientSizes: this.selectedClientSizes.map(id => ({
          id,
          percentage: this.clientSizePercentages[id] || 0
        })),
        companyId: this.companyId
      };

      axios.post(`/company/save-industry/${this.companyId}`, data)
        .then(response => {
          window.location.href = `/company/${this.companyId}/marketing`;
        })
        .catch(error => {
          console.error('Error saving data:', error);
        });
    },
    getClientSizeName(id) {
      const size = this.clientSizes.find(size => size.id === id);
      return size ? size.name : '';
    }
  },
  created() {
    this.fetchDataAndGenerateTextboxes();
  }
};
</script>

<style scoped>
/* Add your styles here */
.container {
  width: 1280px;
  max-width: 1280px;
}
.selected {
  background-color: #eaf2f8;
  border: 1px solid blue;
  border-radius: 5px;
  padding: 5px 10px;
}
.container {
  padding: 20px;
}
.category-card {
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border: 1px solid #ccc;
  margin-bottom: 20px;
}
.category-card h3 {
  color: #fff;
  background-color: #388cff!important;
  padding: 6px 20px;
  font-size: 1.5rem;
  width: 100%;
  margin-bottom: 20px;
}
.category-main {
  padding: 0 20px;
  display: flex;
}
.category-item input {
  width: auto;
  padding: 5px 0px 0 9px;
  margin: 0;
  text-align: center;
}
.category-card label {
  vertical-align: middle;
  margin-right: 8px;
  padding-top: 1px;
  width: auto;
}
.category-item {
  display: flex;
}
.input-group-text {
  height: 37px;
  padding-top: 13px;
}
.selected label {
  background-color: #0087f2;
  color: #fff;
  font-weight: 600;
}
.catBox .col-md-6 {
  border: 1px solid #ccc;
  padding: 0;
}
.catBox .form-check {
  padding: 0 37px;
}
legend {
  background-color: #388cff;
  color: #fff;
  padding: 10px 20px;
}
.category-item {
  margin-bottom: 10px;
}
.input-group-text {
  background-color: #e9ecef;
}
.fieldset {
  margin-bottom: 20px;
}
.form-check {
  margin-bottom: 10px;
}
.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}
</style>
