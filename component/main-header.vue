<template>
    <div id="mainHeader">
        <div class="col-12 text-center">
            <div class="row main-menu-bar">
                <div class="col-6 text-left my-auto">
                    <a href="home.html">
                        <img class="text-center" src="../resource/image/main-icon-white.png" width="65" height="65" alt="Arbolado 2019">
                    </a>
                    <span style="color:#FEFEFE;">Arbolado</span>
                </div>
                <div class="col-6 text-right">
                    <p class="main-font text-white text-light mb-0 pb-0 text-mini">{{ username }}</p>
                    <p class="main-font text-white text-light mb-0 pb-1 text-mini">{{ current_date }}</p>
                    <a class=" main-font text-light" href="#" v-on:click="logout()"><i class="fas fa-sign-out-alt pr-1"></i>Salir</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {DateTime} from "../src/js/model/DateTime";
    import {Session} from "../src/js/model/Session";

    export default {
        name: "main-header",
        //props: ['username', 'current_date'],
        data(){
            return {
                username: '',
                current_date: ''
            }
        },
        methods: {
            setUsername() {

                this.username = Session.getSessionUsername();
            },
            getCurrentDate() {
                this.current_date = DateTime.getCurrentDate();
            },
            logout() {

                if(Session.exists()){

                    Session.invalidate();

                    window.location.replace("/");
                }
            }
        },
        mounted () {
            this.setUsername();
            this.getCurrentDate();
        }
    }
</script>

<style scoped>

</style>