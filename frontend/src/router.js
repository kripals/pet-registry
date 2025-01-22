import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/Home.vue';
import DocumentScreen from './components/DocumentScreen.vue';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/document/:id',
      name: 'DocumentScreen',
      component: DocumentScreen
    }
  ]
});