import '../app';

require('bootstrap');

import Vue from 'vue';

import MainHeader from '../../../component/main-header.vue';

let vue: any = Vue;
new vue ({
    el: '#mainHome',
    components: {
        // @ts-ignore
        MainHeader
    },
    data: {
    },
    methods: {
    }
});