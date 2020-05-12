require('./bootstrap');

import User from './User';
import Vue from 'vue';
import Vuex from 'vuex';

import App from "./components/App";
import LoginForm from "./components/Auth/LoginForm";
import RegisterForm from "./components/Auth/RegisterForm";

import { routex } from './mixins/routex';
import { http } from "./mixins/http";

import VueTippy from "vue-tippy";

Vue.use(Vuex);
Vue.use(VueTippy);

Vue.mixin(routex);
Vue.mixin(http);

window.Events = new Vue();

Vue.component('loginform', LoginForm);
Vue.component('registerform', RegisterForm);
Vue.component('app', App);

const store = new Vuex.Store({
    state: {
        user: new User(window.Laravel.user || {}),

        screen: null,

        pageData: {
            sideMenuItems: []
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = new User(user);
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