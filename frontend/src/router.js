import { createRouter, createWebHistory } from 'vue-router';
import Registration from './components/Registration.vue';
import Login from './components/Login.vue';
import RegistrationView from './components/RegistrationView.vue';

const routes = [
  { path: '/login', component: Login, meta: { requiresGuest: true } },
  { path: '/register', component: Registration, meta: { requiresAuth: true } },
  { path: '/registrations/:id', component: RegistrationView, meta: { requiresAuth: true } }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  
  if (to.matched.some(record => record.meta.requiresAuth) && !token) {
    next('/login');
  } else if (to.matched.some(record => record.meta.requiresGuest) && token) {
    next('/');
  } else {
    next();
  }
});

export default router;