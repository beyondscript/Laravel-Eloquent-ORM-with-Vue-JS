import {createWebHistory, createRouter} from 'vue-router';
import store from './store.js';
import home from './components/pages/home.vue';
import show_first_table_data from './components/pages/show_first_table_data.vue';
import store_data_in_second_table from './components/pages/store_data_in_second_table.vue';
import show_second_table_data from './components/pages/show_second_table_data.vue';
import pageNotFound from './components/pages/errors/404.vue';
import serverError from './components/pages/errors/500.vue';
import appDebug from './components/pages/errors/app_debug.vue';

const routes = [
	{
		path: '/',
		name: 'Home',
		component: home,
		meta: {
			isServerError: false
		}
	},
	{
		path: '/show-first-table-data',
		name: 'Show-First-Table-Data',
		component: show_first_table_data,
		meta: {
			isServerError: false
		}
	},
    {
		path: '/store-data-in-second-table',
		name: 'Store-Data-In-Second-Table',
		component: store_data_in_second_table,
		meta: {
			isServerError: false
		}
	},
	{
		path: '/show-second-table-data',
		name: 'Show-Second-Table-Data',
		component: show_second_table_data,
		meta: {
			isServerError: false
		}
	},
	{
		path: '/:pathMatch(.*)*',
		name: '404',
		component: pageNotFound,
		meta: {
			isServerError: false
		}
	},
	{
		path: '/server-error',
		name: '500',
		component: serverError,
		meta: {
			isServerError: true
		}
	},
	{
		path: '/app-debug',
		name: 'appDebug',
		component: appDebug,
		meta: {
			isServerError: true
		}
	}
]

const router = createRouter({
	history: createWebHistory(),
	routes
})

router.beforeEach((to, from, next) => {
	if(to.meta.isServerError === true && store.getters.getServerError === false){
		next({name: '404'})
	}
	else{
		next()
	}
})

export default router