/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// window.Ziggy = Ziggy

// import route from '../../vendor/tightenco/ziggy/src/js/route';
import {Ziggy} from '../assets/js/ziggy.js';
import route from 'ziggy';

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'

Vue.use(Toaster, {timeout: 10000})


Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    }
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('graphic-component', require('./components/GraphicComponent.vue').default);
Vue.component('analytics-component', require('./components/AnalyticsComponent.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('post-comment-component', require('./components/PostCommentComponent.vue').default);
Vue.component('comments-component', require('./components/CommentsComponent.vue').default);
// Vue.component('comment-component', require('./components/CommentComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('reset-password-component', require('./components/ResetPasswordComponent.vue').default);
Vue.component('users-component', require('./components/UsersComponent.vue').default);
// Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('permissions-component', require('./components/PermissionsComponent.vue').default);
Vue.component('permission-component', require('./components/PermissionComponent.vue').default);
Vue.component('admin-notifications-component', require('./components/AdminNotificationsComponent.vue').default);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if (document.getElementById("app")) {
    const app = new Vue({
            el: '#app',
            data: {

            },
            methods: {

            },
            computed: {

            },
            mounted() {
            }
        })
    ;
}

