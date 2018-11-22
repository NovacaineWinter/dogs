import routes from '../../setup/setupRoutes';



routes.push(
	{
		path:'/payment-methods',

		component: require('./views/paymentMethods.vue')
	},
	{
		path:'/history',

		component: require('./views/accountHistory.vue')
	},	
	{
		path:'/invoices',

		component: require('./views/viewInvoices.vue')
	},	
	{
		path:'/details',

		component: require('./views/accountDetails.vue')
	},		
	{
		path:'/add-subscription',

		component: require('./views/addNewSubscription.vue')
	},		
);
