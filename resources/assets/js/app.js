import App from "./components/App";

require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';

import LoginForm from "./components/Auth/LoginForm";
import RegisterForm from "./components/Auth/RegisterForm";

import { routex } from './mixins/routex';
import { http } from "./mixins/http";

Vue.use(Vuex);

Vue.mixin(routex);
Vue.mixin(http);

window.Events = new Vue();

Vue.component('loginform', LoginForm);
Vue.component('registerform', RegisterForm);
Vue.component('app', App);

const store = new Vuex.Store({
    state: {
        user: window.Laravel.user || {},

        screen: null,

        pageData: {
            sideMenuItems: []
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },

        changeScreen(state, screen) {
            state.screen = screen;
        },

        updatePageData(state, data) {
            for (let key in data) {
                state.pageData[key] = data[key];
            }
        }
    }
});

window.$vueApp = new Vue({
    store,

    el: '#app',

    data: {},

    components: {
        LoginForm,
        RegisterForm
    }
});