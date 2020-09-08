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

export function setCookie(cname, cvalue, extime, path = '/') {
  let d = new Date();
  d.setTime(d.getTime() + extime);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=" + path;
}

export function getCookie(cname) {
  let name = cname + "=";

  // Decode the cookie string, to handle cookies with special characters, e.g. '$'
  var decodedCookie = decodeURIComponent(document.cookie);

  // Split document.cookie on semicolons into an array called ca
  let ca = decodedCookie.split(';');

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
  return "";
}

export function checkCookie(cname) {
  let cvalue = getCookie(cname);
  if (cvalue != "") {
    // Cookie exists
    console.log(cname + " = " + cvalue);
  } else {
    // Cookie doesn't exist
  }
}
