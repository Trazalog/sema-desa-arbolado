import '../app';

require('bootstrap');

import * as $ from 'jquery';

import Vue from 'vue';

import MainHeader from '../../../component/main-header.vue';

import VeeValidate, { Validator } from 'vee-validate';

import * as es from 'vee-validate/dist/locale/es';

Validator.localize('es', es);

Vue.use(VeeValidate, {
    locale: 'es'
});

let vue: any = Vue;
new vue ({
    el: '#mainAreasAsignadas',
    components: {
        // @ts-ignore
        MainHeader
    },
    data: {
    },
    methods: {
    }
});