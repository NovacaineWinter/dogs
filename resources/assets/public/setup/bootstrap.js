import Vue from 'vue';
import axios from 'axios';
import VueRouter from 'vue-router';
import vueSmoothScroll from 'vue-smooth-scroll';
//import VueCarousel from 'vue-carousel';


import { fas } from '@fortawesome/free-solid-svg-icons'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'



//add FA icons that we use
import { faPaw } from '@fortawesome/free-solid-svg-icons'
library.add(faPaw)




import './setupRoutes.js';
import './navbarItems.js';	

import '../base/baseSetup.js';

/*Load module components*/
import '../loadComponents';

/*load dynamic components*/


window.axios = axios;

window.Vue = Vue;
window._ = require('lodash');

/* Setup Axios */

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.defaults.baseUrl =  document.head.querySelector("[property=siteurl]").content;

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


/* setup vue */

Vue.use(VueRouter);

Vue.use(vueSmoothScroll);

//Vue.use(VueCarousel);

Vue.component('font-awesome-icon', FontAwesomeIcon)