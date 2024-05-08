import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import FocusComponent from './components/FocusComponent.vue';

const app = createApp({});
app.component('FocusComponent', FocusComponent);
app.component('FocusMainComponent', FocusComponent);
// app.component('ExampleComponent', ExampleComponent);
app.mount('#app');


