import '../app';
require('bootstrap');
import Vue from 'vue';
import MainHeader from '../../../component/main-header.vue';
import VeeValidate, { Validator } from 'vee-validate';
import * as es from 'vee-validate/dist/locale/es';
Validator.localize('es', es);
Vue.use(VeeValidate, {
    locale: 'es'
});
var vue = Vue;
new vue({
    el: '#mainManzanasAsignadas',
    components: {
        // @ts-ignore
        MainHeader: MainHeader
    },
    data: {},
    methods: {}
});
//# sourceMappingURL=ManzanasAsignadasController.js.map