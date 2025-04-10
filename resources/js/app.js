import { createApp } from 'vue';
import FocusComponent from './components/FocusComponent.vue';
import IndustryClientForm from './components/Industry.vue';
import router from './router'; // Import the router

import ListingComponent from './components/ListingComponent.vue';


const app = createApp({});
app.component('FocusComponent', FocusComponent);
app.component('industry-client-form', IndustryClientForm);
app.component('FocusMainComponent', FocusComponent);
app.component('listing-component', ListingComponent);
app.use(router); 

app.mount('#app');


