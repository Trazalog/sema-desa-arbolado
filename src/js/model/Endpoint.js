var Endpoint = /** @class */ (function () {
    function Endpoint() {
    }
    Object.defineProperty(Endpoint, "PROTOCOL", {
        get: function () {
            return this._PROTOCOL;
        },
        set: function (value) {
            this._PROTOCOL = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Endpoint, "HOSTNAME_BACKEND", {
        get: function () {
            return this._HOSTNAME_BACKEND;
        },
        set: function (value) {
            this._HOSTNAME_BACKEND = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Endpoint, "PORT_BACKEND", {
        get: function () {
            return this._PORT_BACKEND;
        },
        set: function (value) {
            this._PORT_BACKEND = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Endpoint, "URL_LOGIN", {
        get: function () {
            return this._URL_LOGIN;
        },
        set: function (value) {
            this._URL_LOGIN = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Endpoint, "URL_GET_USER_PROFILE", {
        get: function () {
            return this._URL_GET_USER_PROFILE;
        },
        set: function (value) {
            this._URL_GET_USER_PROFILE = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Endpoint, "URL_UPDATE_USER_PROFILE", {
        get: function () {
            return this._URL_UPDATE_USER_PROFILE;
        },
        set: function (value) {
            this._URL_UPDATE_USER_PROFILE = value;
        },
        enumerable: true,
        configurable: true
    });
    Endpoint._PROTOCOL = "https";
    Endpoint._HOSTNAME_BACKEND = "demo3989873.mockable.io";
    Endpoint._PORT_BACKEND = "443";
    /* ENDPOINTS
    * ==========
    */
    /* User login */
    Endpoint._URL_LOGIN = "/user/login";
    /* Ger user profile */
    Endpoint._URL_GET_USER_PROFILE = "/user/profile/get";
    /* Save user profile */
    Endpoint._URL_UPDATE_USER_PROFILE = "/user/profile/update";
    return Endpoint;
}());
export { Endpoint };
//# sourceMappingURL=Endpoint.js.map