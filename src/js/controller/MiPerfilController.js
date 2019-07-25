import '../app';
require('bootstrap');
import * as $ from 'jquery';
import Vue from 'vue';
import VeeValidate, { Validator } from 'vee-validate';
import * as es from 'vee-validate/dist/locale/es';
import MainHeader from '../../../component/main-header.vue';
import { Session } from "../model/Session";
import { User } from "../model/User";
Validator.localize('es', es);
Vue.use(VeeValidate, {
    locale: 'es'
});
var vue = Vue;
new vue({
    el: '#mainMiPerfil',
    components: {
        // @ts-ignore
        MainHeader: MainHeader
    },
    data: {
        alert_title: '',
        alert_message: '',
        username: Session.getSessionUsername(),
        full_name: '',
        password: '',
        email: '',
        phone: '',
        picture: '../../resource/image/default-profile-img.png'
    },
    mounted: function () {
        var _this = this;
        /*** Message modal ***/
        var message = $("#message");
        User.getProfile().then(function (response) {
            if (response.data.profile.status === "success") {
                /* Creo un objeto usuario y le asigno la respuesta del servicio */
                var user = new User(response.data.profile.data.full_name, response.data.profile.data.email, response.data.profile.data.phone, response.data.profile.data.picture);
                /* Hago uso del objeto en memoria y mediante getter o setter obtengo los datos para actualizar los campos Vue */
                _this.full_name = user.full_name;
                _this.email = user.email;
                _this.phone = user.phone;
                _this.picture = user.picture;
            }
            else {
                /*** Prepare and show message ***/
                _this.alert_title = "Error de datos";
                _this.alert_message = "No se pudieron obtener los datos de tu perfil.";
                message.find(".modal-content").removeClass("modal-danger");
                message.find(".modal-content").removeClass("modal-success");
                message.find(".modal-content").addClass("modal-warning");
                message.modal("show");
            }
        }).catch(function (error) {
            /*** Prepare and show message ***/
            _this.alert_title = "Error de comunicación";
            _this.alert_message = "En estos momento no es posible establecer conexión con el servidor.";
            message.find(".modal-content").removeClass("modal-warning");
            message.find(".modal-content").removeClass("modal-success");
            message.find(".modal-content").addClass("modal-danger");
            message.modal("show");
        });
    },
    methods: {
        validateForm: function () {
            var _this = this;
            this.$validator.validateAll().then(function (isValid) {
                /*** Message modal ***/
                var message = $("#message");
                if (isValid) {
                    /* Crear nuevo obj User */
                    var user = new User(_this.full_name, _this.email, _this.phone, _this.picture);
                    /* Set old and new password */
                    user.password = _this.password;
                    /* Enviar datos actualizados */
                    user.updateProfile().then(function (response) {
                        if (response.data.profile.status === "success") {
                            /*** Prepare and show message ***/
                            _this.alert_title = "¡Excelente!";
                            _this.alert_message = "Se pudo guardar los datos de tu perfil exitosamente.";
                            message.find(".modal-content").removeClass("modal-warning");
                            message.find(".modal-content").removeClass("modal-danger");
                            message.find(".modal-content").addClass("modal-success");
                            message.modal("show");
                            /*** Enable submit again ***/
                            var submit = $("button[type=submit]");
                            /* Disabled */
                            submit.removeAttr("disabled");
                            /* Loading */
                            submit.find("i").removeClass("fa-spinner fa-spin");
                            submit.find("i").addClass("fa-sign-out-alt");
                        }
                        else {
                            /*** Prepare and show message ***/
                            _this.alert_title = "Error de datos";
                            _this.alert_message = "No se pudieron guardar los datos de tu perfil.";
                            message.find(".modal-content").removeClass("modal-danger");
                            message.find(".modal-content").removeClass("modal-success");
                            message.find(".modal-content").addClass("modal-warning");
                            message.modal("show");
                            /*** Enable submit again ***/
                            var submit = $("button[type=submit]");
                            /* Disabled */
                            submit.removeAttr("disabled");
                            /* Loading */
                            submit.find("i").removeClass("fa-spinner fa-spin");
                            submit.find("i").addClass("fa-sign-out-alt");
                        }
                    }).catch(function (error) {
                        /*** Prepare and show message ***/
                        _this.alert_title = "Error de comunicación";
                        _this.alert_message = "En estos momento no es posible establecer conexión con el servidor.";
                        message.find(".modal-content").removeClass("modal-warning");
                        message.find(".modal-content").removeClass("modal-success");
                        message.find(".modal-content").addClass("modal-danger");
                        message.modal("show");
                        /*** Enable submit again ***/
                        var submit = $("button[type=submit]");
                        /* Disabled */
                        submit.removeAttr("disabled");
                        /* Loading */
                        submit.find("i").removeClass("fa-spinner fa-spin");
                        submit.find("i").addClass("fa-sign-out-alt");
                    });
                }
                else {
                    /*** Prepare and show message ***/
                    _this.alert_title = "Error de datos";
                    _this.alert_message = "Por favor revisa todos los campos con error.";
                    message.find(".modal-content").removeClass("modal-danger");
                    message.find(".modal-content").removeClass("modal-success");
                    message.find(".modal-content").addClass("modal-warning");
                    message.modal("show");
                    /*** Enable submit again ***/
                    var submit = $("button[type=submit]");
                    /* Disabled */
                    submit.removeAttr("disabled");
                    /* Loading */
                    submit.find("i").removeClass("fa-spinner fa-spin");
                    submit.find("i").addClass("fa-sign-out-alt");
                }
            }).catch(function () {
                _this.$validator.errors.clear();
            });
        },
        openFileBox: function () {
            /*** Open file dialog ***/
            $("#picture_input").trigger("click");
        },
        setImagePicture: function (event) {
            var _this = this;
            // event.target.files[0].size <= 2097152 bytes = 2 MB.
            if (event.target.files && event.target.files[0] && event.target.files[0].size <= 2097152) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    /*** Set base64 ***/
                    _this.picture = event.target.result;
                    /*** Validate is an image or not ***/
                    if (_this.picture.indexOf("data:image/png;base64") === -1 &&
                        _this.picture.indexOf("data:image/jpg;base64") === -1 &&
                        _this.picture.indexOf("data:image/jpeg;base64") === -1 &&
                        _this.picture.indexOf("data:image/bmp;base64") === -1 &&
                        _this.picture.indexOf("data:image/gif;base64") === -1 &&
                        _this.picture.indexOf("data:image/svg;base64") === -1 &&
                        _this.picture.indexOf("data:image/tiff;base64") === -1) {
                        /*** Not image, remove broken ***/
                        _this.removeImagePicture();
                    }
                    else {
                        $("#btn_remove_picture").removeAttr("hidden");
                    }
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        },
        removeImagePicture: function () {
            this.picture = '../../resource/image/default-profile-img.png';
            $("#picture_input").val("");
            $("#btn_remove_picture").attr("hidden", "hidden");
        },
        preventMultiSubmit: function () {
            var submit = $("button[type=submit]");
            /* Disabled */
            submit.attr("disabled", "disabled");
            /* Loading */
            submit.find("i").removeClass("fa-sign-out-alt");
            submit.find("i").addClass("fa-spinner fa-spin");
        },
        showHidePasswordField_1: function () {
            var password = $("#password");
            var password_show_hide = $("#password_show_hide_1");
            /* Check status type */
            if (password.attr("type") === "password") {
                /*Change type */
                password.attr("type", "text");
                /* Title */
                password_show_hide.attr("title", "Ocultar contraseña");
                /* Change icon */
                password_show_hide.find("i").removeClass("fa-eye-slash");
                password_show_hide.find("i").addClass("fa-eye");
            }
            else {
                /*Change type */
                password.attr("type", "password");
                /* Title */
                password_show_hide.attr("title", "Mostrar contraseña");
                /* Change icon */
                password_show_hide.find("i").removeClass("fa-eye");
                password_show_hide.find("i").addClass("fa-eye-slash");
            }
        },
        showHidePasswordField_2: function () {
            var password = $("#retry_password");
            var password_show_hide = $("#password_show_hide_2");
            /* Check status type */
            if (password.attr("type") === "password") {
                /*Change type */
                password.attr("type", "text");
                /* Title */
                password_show_hide.attr("title", "Ocultar contraseña");
                /* Change icon */
                password_show_hide.find("i").removeClass("fa-eye-slash");
                password_show_hide.find("i").addClass("fa-eye");
            }
            else {
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
//# sourceMappingURL=MiPerfilController.js.map