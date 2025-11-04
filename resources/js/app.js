import { createApp } from 'vue';

import App from './App.vue';
import CarCard from './components/CarCard.vue';
import PartCard from './components/PartCard.vue';
import Navbar from './components/Navbar.vue';
import router from './router';

import 'bootstrap/dist/css/bootstrap.min.css';

createApp(App)
.use(router)
.component('CarCard', CarCard)
.component('PartCard', PartCard)
.component('Navbar', Navbar)
.mount('#app');