import './bootstrap';

import router from './router';



/*
*	Init vue
*/ 
const app = new Vue({
    el: '#app',
    data: {  
    	user:{
            active_subscriptions:{},
            active_notifications:{},
            pending_subscriptions:{}
        }  	
    },
    router: router,
    mounted: function()
    {
		this.reloadUserData();
    },
    methods:{
        reloadUserData(){
            axios.get('/api/get-logged-in-user')      
                .then(response => {this.user = response.data;})

                .catch(error => {});
        }
    }

});

