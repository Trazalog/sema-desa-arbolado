import '../app';
require('bootstrap');
import Vue from 'vue';
import MainHeader from '../../../component/main-header.vue';
var vue = Vue;
new vue({
    el: '#mainHome',
    components: {
        // @ts-ignore
        MainHeader: MainHeader
    },
    data: {},
    methods: {}
});
//# sourceMappingURL=HomeController.js.map