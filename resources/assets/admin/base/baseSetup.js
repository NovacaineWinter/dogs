import Vue from 'vue';
import routes from '../setup/setupRoutes';
import navbarItems from '../setup/navbarItems';


Vue.component('navbar-component', require('./navbar.vue'));
Vue.component('footer-component', require('./footerLinks.vue'));

navbarItems.push(	
	{
		uri:'/',
		text:'Home',
		position:10,
		bold:false,
	},
);


routes.push(
	{
		path:'/',

		component: require('./home.vue')
	},		
);

