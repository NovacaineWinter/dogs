import './bootstrap';

import router from './router';



/*var handler = StripeCheckout.configure({
    key: 'pk_test_7rBfXVfqrPbJLePrSN2jJLwo',
    image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
    locale: 'auto',
    token: function(token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log(token);
    }
});

*/
/*
*	Init vue
*/ 
const app = new Vue({
    el: '#app',
    data: {   
    },
    router: router,

});

