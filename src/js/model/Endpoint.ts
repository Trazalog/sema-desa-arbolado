export class Endpoint {

    private static _PROTOCOL: string = "https";

    private static _HOSTNAME_BACKEND: string = "demo3989873.mockable.io";

    private static _PORT_BACKEND: string = "443";


    /* ENDPOINTS
    * ==========
    */

    /* User login */
    private static _URL_LOGIN: string = "/user/login";

    /* Ger user profile */
    private static _URL_GET_USER_PROFILE: string = "/user/profile/get";

    /* Save user profile */
    private static _URL_UPDATE_USER_PROFILE: string = "/user/profile/update";




    static get PROTOCOL(): string {
        return this._PROTOCOL;
    }

    static set PROTOCOL(value: string) {
        this._PROTOCOL = value;
    }


    static get HOSTNAME_BACKEND(): string {
        return this._HOSTNAME_BACKEND;
    }

    static set HOSTNAME_BACKEND(value: string) {
        this._HOSTNAME_BACKEND = value;
    }

    static get PORT_BACKEND(): string {
        return this._PORT_BACKEND;
    }

    static set PORT_BACKEND(value: string) {
        this._PORT_BACKEND = value;
    }

    static get URL_LOGIN(): string {
        return this._URL_LOGIN;
    }

    static set URL_LOGIN(value: string) {
        this._URL_LOGIN = value;
    }

    static get URL_GET_USER_PROFILE(): string {
        return this._URL_GET_USER_PROFILE;
    }

    static set URL_GET_USER_PROFILE(value: string) {
        this._URL_GET_USER_PROFILE = value;
    }

    static get URL_UPDATE_USER_PROFILE(): string {
        return this._URL_UPDATE_USER_PROFILE;
    }

    static set URL_UPDATE_USER_PROFILE(value: string) {
        this._URL_UPDATE_USER_PROFILE = value;
    }
}