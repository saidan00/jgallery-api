import Vue from 'vue';
import VueRouter from 'vue-router';
import Gallery from '../views/Gallery';
// import NotFound from '../views/NotFound';

Vue.use(VueRouter);

const routes = [{
  path: '/',
  name: 'Gallery',
  component: Gallery
}, {
  path: '/albums/:id',
  name: 'Album',
  props: true,
  component: () =>
    import ('../views/Album.vue'),
}];

const router = new VueRouter({
  mode: 'history',
  base: '/',
  routes
});

export default router