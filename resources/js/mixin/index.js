import Vue from 'vue'

export function toast(icon, message) {
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