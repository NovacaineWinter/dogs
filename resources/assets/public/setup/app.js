import './bootstrap';

import router from './router';



/*
*	Init vue
*/ 
const app = new Vue({
    el: '#app',
    data: {   
    	csrf:document.head.querySelector('meta[name="csrf-token"]').content,
    },
    router: router,

});

