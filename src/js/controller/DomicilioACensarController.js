import '../app';
require('bootstrap');
import axios from 'axios';
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
    el: '#maindomicilioACensar',
    components: {
        // @ts-ignore
        MainHeader: MainHeader
    },
    data: {
        selectedStreet: '',
        calleOtra: '',
        numero: '',
        barrio: '',
        domicilioTaza: '',
        streetList: []
    },
    mounted: function () {
        this.getStreets();
        console.log("Lista en mounted(): " + this.streetList);
    },
    methods: {
        getStreets: function () {
            var _this = this;
            axios.get('https://api.myjson.com/bins/7ooif')
                .then(function (response) {
                for (var i = 0; i < response.data.calles.length; i++)
                    _this.streetList.push(response.data.calles[i]);
                console.log("Dentro del método:" + _this.streetList);
            })
                .catch(function (err) {
                console.log("error: " + err);
            });
        }
    }
});
//# sourceMappingURL=DomicilioACensarController.js.map