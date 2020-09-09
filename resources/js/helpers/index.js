import Vue from 'vue';
import axios from 'axios';
import store from '../store';

const toast = (icon, message) => {
  Vue.swal({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1250,
    timerProgressBar: true,
    icon: icon,
    title: message,
  });
}

const setCookie = (cname, cvalue, extime, path = '/') => {
  let d = new Date();
  d.setTime(d.getTime() + extime);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=" + path;
}

const getCookie = (cname) => {
  let name = cname + "=";

  // Decode the cookie string, to handle cookies with special characters, e.g. '$'
  var decodedCookie = decodeURIComponent(document.cookie);

  // Split document.cookie on semicolons into an array called ca
  let ca = decodedCookie.split(';');
  console.log(document.cookie)

  // Loop through the ca array
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];

    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }

    // If the cookie is found
    if (c.indexOf(name) == 0) {
      // return the value of the cookie
      return JSON.parse(c.substring(name.length, c.length));
    }
  }

  // If the cookie is not found
  return null;
}

const checkCookie = (cname) => {
  let cvalue = getCookie(cname);
  if (cvalue != "") {
    // Cookie exists
    console.log(cname + " = " + cvalue);
  } else {
    // Cookie doesn't exist
  }
}

// check if logged in
const initialize = (router) => {
  router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const currentUser = getCookie('user');

    console.log(currentUser);

    // if route require login and user not logged in yet
    if (requiresAuth && !currentUser) {
      next('/');
    } else if (to.path == '/' && currentUser) {
      next('/albums');
    } else {
      next();
    }
  });

  axios.interceptors.response.use(null, (error) => {
    if (error.resposne.status == 401) {
      store.commit('logout');
      router.push('/login');
    }

    return Promise.reject(error);
  });

  if (store.getCurrentUser) {
    setAuthorization(store.getCurrentUser.access_token);
  }
}

export { toast, setCookie, getCookie, checkCookie, initialize };
