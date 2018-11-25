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
	{
		path:'/oh-ok',

		component: require('./views/ohOk.vue')
	},
	{
		path:'/privacy-policy',

		component: require('./views/privacyPolicy.vue')
	},
	{
		path:'/data-retention',

		component: require('./views/dataRetentionPolicy.vue')
	},	
	{
		path:'/terms-and-conditions',

		component: require('./views/termsAndConditions.vue')
	},
	{
		path:'/environment',

		component: require('./views/environmentalImpact.vue')
	},	
	{
		path:'/about-us',

		component: require('./views/aboutUs.vue')
	},		
);

