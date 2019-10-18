import '../app';

require('bootstrap');

import Vue from 'vue';

import MainHeader from '../../../component/main-header.vue';
import * as $ from "jquery";

let vue: any = Vue;
new vue ({
    el: '#mainHome',
    components: {
        // @ts-ignore
        MainHeader
    },
    data: {
    },
    mounted(){

        // Remove loading
        $(".se-pre-con").fadeOut("slow");
    },
    methods: {
    }
});