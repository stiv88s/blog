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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('post-comment-component', require('./components/PostCommentComponent.vue').default);
Vue.component('comments-component', require('./components/CommentsComponent.vue').default);
// Vue.component('comment-component', require('./components/CommentComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('reset-password-component', require('./components/ResetPasswordComponent.vue').default);
Vue.component('block-user-component', require('./components/BlockUserComponent.vue').default);
Vue.component('users-component', require('./components/UsersComponent.vue').default);
// Vue.component('user-component', require('./components/UserComponent.vue').default);


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

            }
        })
    ;
}

