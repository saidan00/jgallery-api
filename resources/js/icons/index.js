import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret, faEdit, faTrash, faPlusSquare, faBackward } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faUserSecret, faEdit, faTrash, faPlusSquare, faBackward)

Vue.component('font-awesome-icon', FontAwesomeIcon)