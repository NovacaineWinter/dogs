import routes from '../../setup/setupRoutes';




routes.push(
	{
		path:'/how-it-works',

		component: require('./views/howItWorks.vue')
	},
	{
		path:'/contact-us',

		component: require('./views/hiThere.vue')
	},
	{
		path:'/sign-up',

		component: require('./views/subscribe.vue')
	},		
);

