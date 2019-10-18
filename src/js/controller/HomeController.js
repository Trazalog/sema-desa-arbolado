import '../app';
require('bootstrap');
import Vue from 'vue';
import MainHeader from '../../../component/main-header.vue';
import * as $ from "jquery";
var vue = Vue;
new vue({
    el: '#mainHome',
    components: {
        // @ts-ignore
        MainHeader: MainHeader
    },
    data: {},
    mounted: function () {
        // Remove loading
        $(".se-pre-con").fadeOut("slow");
    },
    methods: {}
});
//# sourceMappingURL=HomeController.js.map