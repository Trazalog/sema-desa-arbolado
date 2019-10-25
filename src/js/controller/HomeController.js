import '../app';
require('bootstrap');
import Vue from 'vue';
import MainHeader from '../../../component/main-header.vue';
import * as $ from "jquery";
import { User } from "../model/User";
import store from "store2";
var vue = Vue;
new vue({
    el: '#mainHome',
    components: {
        // @ts-ignore
        MainHeader: MainHeader
    },
    data: {},
    mounted: function () {
        /* Get tree list and store response for offline consultation */
        User.getArea().then(function (response) {
            store.add("get_tree_response", response.data);
        }).catch(function (error) {
            console.log(error);
        });
        // Remove loading
        $(".se-pre-con").fadeOut("slow");
    },
    methods: {}
});
//# sourceMappingURL=HomeController.js.map