require('./bootstrap');

import Vue from 'vue';
import LoginForm from "./components/Auth/LoginForm";

import { routex } from './mixins/routex';

Vue.mixin(routex);

window.Events = new Vue();

Vue.component('loginform', LoginForm);

window.$vueApp = new Vue({
    el: '#app',

    data: {},

    components: {
        LoginForm
    }
});