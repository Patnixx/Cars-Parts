import { createRouter, createWebHistory } from 'vue-router';
import CarsPage from '../pages/CarsPage.vue';
import PartsPage from '../pages/PartsPage.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/cars', component: CarsPage },
    { path: '/parts', component: PartsPage },
    { path: '/', redirect: '/cars' }
  ]
});

export default router;