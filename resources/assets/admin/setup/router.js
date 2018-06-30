import VueRouter from 'vue-router';

import routes from './setupRoutes';

export default new VueRouter({
	routes,
	linkActiveClass: 'is-active'
})