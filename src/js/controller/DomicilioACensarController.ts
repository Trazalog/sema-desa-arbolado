import '../app';

require('bootstrap');

import * as $ from 'jquery';

import axios from 'axios';

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
        el: '#maindomicilioACensar',
        components: {
            // @ts-ignore
            MainHeader
        },
        data: {
            selectedStreet: '',
            calleOtra: '',
            numero: '',
            barrio: '',
            domicilioTaza: '',
            streetList: []
        },
        mounted(){

            (this as any).getStreets();

            console.log("Lista en mounted(): " + (this as any).streetList);
        },
        methods: {
            getStreets (){

                axios.get('https://api.myjson.com/bins/7ooif')
                    .then((response) => {

                        for (let i = 0; i < response.data.calles.length; i++)
                            (this as any).streetList.push(response.data.calles[i]);

                        console.log("Dentro del método:" + (this as any).streetList);
                    })
                    .catch((err)=>{

                        console.log("error: " + err);
                    });
            }
        }
    }
);