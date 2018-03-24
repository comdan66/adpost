
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


/*
require('./bootstrap');


Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

*/

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


import Vue from 'vue';
import VueResource from 'vue-resource';
import BootstrapVue from 'bootstrap-vue';
import _ from 'lodash';

import App from './components/App.vue';
import GifBg from './components/GifBg.vue';
import Sidebar from './components/Sidebar.vue';
import SidebarGroup from './components/SidebarGroup.vue';
import SidebarItem from './components/SidebarItem.vue';
import SidebarCollapse from './components/SidebarCollapse.vue';
import SidebarCollapseItem from './components/SidebarCollapseItem.vue';
import SidebarCollapseToggle from './components/SidebarCollapseToggle.vue';
import DashboardCard from './components/DashboardCard.vue';
import Dashboard from './components/Dashboard.vue';
import ClipLoader from 'vue-spinner/src/ClipLoader.vue';
import ProjectTitle from './components/ProjectTitle.vue';
import ProjectPhaseTemplate from './components/ProjectPhaseTemplate.vue';
import ProjectPhase from './components/ProjectPhase.vue';
import ProjectPhaseThread from './components/ProjectPhaseThread.vue';
import ProjectPhaseReply from './components/ProjectPhaseReply.vue';
import ProjectThumbUploader from './components/ProjectThumbUploader.vue';
import ProjectOperation from './components/ProjectOperation.vue';
import ProjectSchedule from './components/ProjectSchedule.vue';

Vue.use(VueResource);
Vue.use(BootstrapVue);

Vue.component('gif-bg', GifBg);
Vue.component('sidebar', Sidebar);
Vue.component('sidebar-group', SidebarGroup);
Vue.component('sidebar-item', SidebarItem);
Vue.component('sidebar-collapse', SidebarCollapse);
Vue.component('sidebar-collapse-item', SidebarCollapseItem);
Vue.component('sidebar-collapse-toggle', SidebarCollapseToggle);
Vue.component('dashboard-card', DashboardCard);
Vue.component('dashboard', Dashboard);
Vue.component('clip-loader', ClipLoader);
Vue.component('project-title', ProjectTitle);
Vue.component('project-phase-template', ProjectPhaseTemplate);
Vue.component('project-phase', ProjectPhase);
Vue.component('project-phase-thread', ProjectPhaseThread);
Vue.component('project-phase-reply', ProjectPhaseReply);
Vue.component('project-thumb-uploader', ProjectThumbUploader);
Vue.component('project-operation', ProjectOperation);
Vue.component('project-schedule', ProjectSchedule);

const app = new Vue(App);

Vue.http.interceptors.push(function (request, next) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    request.headers.set('X-CSRF-TOKEN', csrfToken);
    next();
});
