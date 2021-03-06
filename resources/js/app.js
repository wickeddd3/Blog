/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('navbar-view', require('./layouts/Navbar.vue').default);

Vue.component('create-post', require('./components/CreatePost.vue').default);
Vue.component('edit-post', require('./components/EditPost.vue').default);

Vue.component('post-view', require('./pages/Post.vue').default);
Vue.component('frontend-view', require('./pages/Frontend.vue').default);
Vue.component('posts-view', require('./pages/Posts.vue').default);
Vue.component('user-posts-view', require('./pages/UserPosts.vue').default);
Vue.component('profile-view', require('./pages/Profile.vue').default);
Vue.component('search-post-view', require('./pages/SearchPost.vue').default);

Vue.component('dashboard-posts-view', require('./pages/dashboard/Posts.vue').default);
Vue.component('dashboard-categories-view', require('./pages/dashboard/Categories.vue').default);
Vue.component('dashboard-tags-view', require('./pages/dashboard/Tags.vue').default);
Vue.component('dashboard-users-view', require('./pages/dashboard/Users.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
