import { createApp } from 'vue';
import FocusComponent from './components/FocusComponent.vue';
import IndustryClientForm from './components/Industry.vue';

const app = createApp({});
app.component('FocusComponent', FocusComponent);
app.component('industry-client-form', IndustryClientForm);
// app.component('FocusMainComponent', FocusComponent);
app.mount('#app');


