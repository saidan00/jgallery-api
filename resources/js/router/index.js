import Vue from 'vue';
import VueRouter from 'vue-router';
import Gallery from '../views/Gallery';
import Login from '../views/Login';
// import NotFound from '../views/NotFound';

Vue.use(VueRouter);

const routes = [{
  path: '/',
  name: 'Login',
  component: Login
}, {
  path: '/albums/:id',
  name: 'Album',
  props: true,
  component: () =>
    import ('../views/Album.vue'),
}, {
  path: '/albums',
  name: 'Gallery',
  component: Gallery,
  meta: {
    requiresAuth: true
  }
}];

const router = new VueRouter({
  mode: 'history',
  base: '/',
  routes
});

export default router
