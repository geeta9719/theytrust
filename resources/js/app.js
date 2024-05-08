import { createApp } from 'vue';
import FocusComponent from './components/FocusComponent.vue';

const app = createApp({});
app.component('FocusComponent', FocusComponent);
app.component('FocusMainComponent', FocusComponent);
app.mount('#app');


