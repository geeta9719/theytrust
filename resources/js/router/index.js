// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import ListingComponent from '../components/ListingComponent.vue'; // Adjust the path as needed

const routes = [
  {
    path: '/listing/:category?/:subcategory?/:skill?/:subskill?',
    name: 'ListingComponent',
    component: ListingComponent,
  },
  // Other routes can be added here
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
