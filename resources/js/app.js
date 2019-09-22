/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//imports////////////////////////////////////////////////////////////////////////////////
import Vue from 'vue';
import VueRouter from 'vue-router';
import { Form, HasError, AlertError } from 'vform';
import moment from 'moment';
import VueProgressBar from 'vue-progressbar';
import Swal from 'sweetalert2';
window.Swal = Swal;
// event ////////////////////////////////////////////////////////////////////////////////
//declare a variable called Eventers as the Event Listener

window.Eventers = new Vue();

//options////////////////////////////////////////////////////////////////////////////////
//1. progressbar
const ProgressBarOptions = {
	color: '#bffaf3',
	failedColor: '#874b4b',
	thickness: '10px',
	transition: {
		speed: '0.2s',
		opacity: '0.6s',
		termination: 300
	},
	autoRevert: true,
	location: 'top',
	inverse: false
};
const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000
});
window.Toast = Toast;

//usage ////////////////////////////////////////////////////////////////////////////////
Vue.use(VueRouter);
Vue.use(VueProgressBar, ProgressBarOptions);
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// constants ////////////////////////////////////////////////////////////////////////////
let routes = [
	{ path: '/dashboard', component: require('./components/Dashboard.vue').default },
	{ path: '/profiles', component: require('./components/Profiles.vue').default }
];

let axios = require('axios').default;
let router = new VueRouter({
	mode: 'history',
	routes // short for `routes: routes`
});

//filters
Vue.filter('properDateFilter', function(x) {
	return moment(x).format('MMM DD YYYY');
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// main ///////////////////////////////////////////////////////////////////////////////////
const app = new Vue({
	el: '#app',
	router
});
