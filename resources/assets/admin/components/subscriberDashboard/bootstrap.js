import Vue from 'vue';

require('./routes.js');
require('./navbarItems.js');


	/* Components */
	//Vue.component('subscription-overview', require('./components/subscriptionOverview.vue'));

	/* Subcomponents */
	Vue.component('dash-tabs', require('./subcomponents/dashTabs.vue'));
	Vue.component('subscription-info', require('./subcomponents/subscriptionBreakdown.vue'));
	Vue.component('dog-detail-modal', require('./subcomponents/dogDetailsModal.vue'));
	Vue.component('cancel-subscription-modal', require('./subcomponents/cancelSubscriptionModal.vue'));