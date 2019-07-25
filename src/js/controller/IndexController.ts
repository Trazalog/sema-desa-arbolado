import '../app';
import * as $ from 'jquery';

import Vue from 'vue';

import VeeValidate, {Validator} from 'vee-validate';

import * as es from 'vee-validate/dist/locale/es';

import {Session} from "../model/Session";

import {User} from "../model/User";

import {Configuration} from "../model/Configuration";

import {Connectivity} from "../model/Connectivity";

require('bootstrap');

Validator.localize('es', es);

Vue.use(VeeValidate, {
    locale: 'es'
});

let vue: any = Vue;
new vue ({
    el: '#mainLogin',
    data: {
        username: '',
        password: '',
        alert_title: '',
        alert_message: '',
        interval: null,
        connection_quality: ''
    },
    mounted() {

        if (!Configuration.checkCompatibility()){

            let message = $("#message");

            /*** Prepare and show message ***/
            this.alert_title = "¡Advertencia!";
            this.alert_message = "Tu navegador web " + Configuration.getBrowserName() + " necesita ser actualizado para que puedas usar todas las funciones de la aplicación.";


            message.find(".modal-content").removeClass("modal-warning");
            message.find(".modal-content").addClass("modal-danger");
            (<any>message).modal("show");
        }


        /* Check connectivity */
        this.checkNetworkConnection();

        this.interval = setInterval(() => {
            this.checkNetworkConnection();
        }, 10000)
    },
    beforeDestroy() {

        clearInterval(this.interval);
    },
    methods: {
        validateForm: function () {
            this.$validator.validateAll().then(isValid => {

                /*** Message modal ***/
                let message = $("#message");


                if (isValid) {

                    this.$validator.errors.clear();


                    User.login(this.username, this.password)
                        .then( response => {

                            if (response.data.login.status === "success") {


                                /*** JS create session ***/
                                Session.create(
                                    response.data.login.data.session_id,
                                    response.data.login.data.username,
                                );


                                /*** Redirection ***/
                                let url = "home.html";
                                window.location.replace(url);


                            } else if (response.data.login.status === "error") {

                                /*** Prepare and show message ***/
                                this.alert_title = "Error al iniciar sesión";
                                this.alert_message = "El usuario o la contraseña no son válidos.";


                                message.find(".modal-content").removeClass("modal-danger");
                                message.find(".modal-content").addClass("modal-warning");
                                (<any>message).modal("show");


                                /*** Clean data entry ***/
                                this.username = "";
                                this.password = "";


                                /*** Enable submit again ***/
                                let submit = $("button[type=submit]");

                                /* Disabled */
                                submit.removeAttr("disabled");

                                /* Loading */
                                submit.find("i").removeClass("fa-spinner fa-spin");
                                submit.find("i").addClass("fa-sign-out-alt");


                            } else {

                                /*** Prepare and show message ***/
                                this.alert_title = "Error en el servidor";
                                this.alert_message = "Se produjo un problema en el servidor y la respuesta no se pudo obtener.";


                                message.find(".modal-content").removeClass("modal-warning");
                                message.find(".modal-content").addClass("modal-danger");
                                (<any>message).modal("show");


                                /*** Clean data entry ***/
                                this.username = "";
                                this.password = "";


                                /*** Enable submit again ***/
                                let submit = $("button[type=submit]");

                                /* Disabled */
                                submit.removeAttr("disabled");

                                /* Loading */
                                submit.find("i").removeClass("fa-spinner fa-spin");
                                submit.find("i").addClass("fa-sign-out-alt");

                            }
                        })
                        .catch(error => {

                            /*** Prepare and show message ***/
                            this.alert_title = "Error de comunicación";
                            this.alert_message = "En estos momento no es posible establecer conexión con el servidor.";


                            message.find(".modal-content").removeClass("modal-warning");
                            message.find(".modal-content").addClass("modal-danger");
                            (<any>message).modal("show");


                            /*** Clean data entry ***/
                            this.username = "";
                            this.password = "";


                            /*** Enable submit again ***/
                            let submit = $("button[type=submit]");

                            /* Disabled */
                            submit.removeAttr("disabled");

                            /* Loading */
                            submit.find("i").removeClass("fa-spinner fa-spin");
                            submit.find("i").addClass("fa-sign-out-alt");

                        });

                } else {

                    /*** Prepare and show message ***/
                    this.alert_title = "Error de datos";
                    this.alert_message = "Debes ingresar un usuario y contraseña válidos.";


                    message.find(".modal-content").removeClass("modal-danger");
                    message.find(".modal-content").addClass("modal-warning");
                    (<any>message).modal("show");


                    /*** Enable submit again ***/
                    let submit = $("button[type=submit]");

                    /* Disabled */
                    submit.removeAttr("disabled");

                    /* Loading */
                    submit.find("i").removeClass("fa-spinner fa-spin");
                    submit.find("i").addClass("fa-sign-out-alt");


                    this.username = "";
                    this.password = "";
                }

            }).catch(() => {

                this.$validator.errors.clear();
            });
        },
        checkNetworkConnection() {

            this.connection_quality = Connectivity.checkInternetSpeed();

            let message_icon = $("#signal");

            switch (this.connection_quality) {

                case "Buena": {

                    message_icon.removeClass("qmedium-icon");
                    message_icon.removeClass("qbad-icon");
                    message_icon.addClass("qgood-icon");

                } break;

                case "Regular":{

                    message_icon.removeClass("qgood-icon");
                    message_icon.removeClass("qbad-icon");
                    message_icon.addClass("qmedium-icon");

                } break;

                case "Mala":{

                    message_icon.removeClass("qgood-icon");
                    message_icon.removeClass("qmedium-icon");
                    message_icon.addClass("qbad-icon");

                } break;
            }

        },
        preventMultiSubmit() {

            let submit = $("button[type=submit]");

            /* Disabled */
            submit.attr("disabled", "disabled");

            /* Loading */
            submit.find("i").removeClass("fa-sign-out-alt");
            submit.find("i").addClass("fa-spinner fa-spin");

        },
        showHidePasswordField() {

            let password = $("#password");
            let password_show_hide = $("#password_show_hide");

            /* Check status type */
            if (password.attr("type") === "password") {

                /*Change type */
                password.attr("type", "text");

                /* Title */
                password_show_hide.attr("title", "Ocultar contraseña");

                /* Change icon */
                password_show_hide.find("i").removeClass("fa-eye-slash");
                password_show_hide.find("i").addClass("fa-eye");


            } else {

                /*Change type */
                password.attr("type", "password");

                /* Title */
                password_show_hide.attr("title", "Mostrar contraseña");

                /* Change icon */
                password_show_hide.find("i").removeClass("fa-eye");
                password_show_hide.find("i").addClass("fa-eye-slash");

            }
        }
    }
});