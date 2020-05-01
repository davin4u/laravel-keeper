require('./bootstrap');

import Vue from 'vue';
import LoginForm from "./components/Auth/LoginForm";
import RegisterForm from "./components/Auth/RegisterForm";

import { routex } from './mixins/routex';
import { http } from "./mixins/http";

Vue.mixin(routex);
Vue.mixin(http);

window.Events = new Vue();

Vue.component('loginform', LoginForm);
Vue.component('registerform', RegisterForm);

window.$vueApp = new Vue({
    el: '#app',

    data: {},

    components: {
        LoginForm,
        RegisterForm
    }
});