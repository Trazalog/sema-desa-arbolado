var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : new P(function (resolve) { resolve(result.value); }).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
import axios from "axios";
import { Session } from "./Session";
import { Endpoint } from "./Endpoint";
var User = /** @class */ (function () {
    function User(full_name, email, phone, picture) {
        this._full_name = full_name;
        this._email = email;
        this._phone = phone;
        this._picture = picture;
    }
    /*** Sign in ***/
    User.login = function (username, password) {
        return __awaiter(this, void 0, void 0, function () {
            var url;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        url = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_LOGIN;
                        return [4 /*yield*/, axios({
                                method: "POST",
                                url: url,
                                timeout: 5000,
                                withCredentials: false,
                                params: {
                                    username: username,
                                    password: password
                                },
                                headers: {
                                    'Cache-Control': 'no-cache',
                                    'Content-Type': 'application/json'
                                }
                            })];
                    case 1: return [2 /*return*/, _a.sent()];
                }
            });
        });
    };
    /*** get profile ***/
    User.getProfile = function () {
        return __awaiter(this, void 0, void 0, function () {
            var url, session_id, username;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        url = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_GET_USER_PROFILE;
                        session_id = Session.getSessionID();
                        username = Session.getSessionUsername();
                        return [4 /*yield*/, axios({
                                method: "GET",
                                url: url,
                                timeout: 5000,
                                withCredentials: false,
                                params: {
                                    session_id: session_id,
                                    username: username
                                },
                                headers: {
                                    'Cache-Control': 'no-cache',
                                    'Content-Type': 'application/json'
                                }
                            })];
                    case 1: return [2 /*return*/, _a.sent()];
                }
            });
        });
    };
    /*** update profile ***/
    User.prototype.updateProfile = function () {
        return __awaiter(this, void 0, void 0, function () {
            var url, session_id, username;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        url = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_UPDATE_USER_PROFILE;
                        session_id = Session.getSessionID();
                        username = Session.getSessionUsername();
                        return [4 /*yield*/, axios({
                                method: "PUT",
                                url: url,
                                timeout: 5000,
                                withCredentials: false,
                                params: {
                                    session_id: session_id,
                                    username: username,
                                    full_name: this._full_name,
                                    password: this._password,
                                    email: this._email,
                                    phone: this._phone,
                                    picture: this._picture
                                },
                                headers: {
                                    'Cache-Control': 'no-cache',
                                    'Content-Type': 'application/json'
                                }
                            })];
                    case 1: return [2 /*return*/, _a.sent()];
                }
            });
        });
    };
    Object.defineProperty(User.prototype, "username", {
        get: function () {
            return this._username;
        },
        set: function (value) {
            this._username = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(User.prototype, "full_name", {
        get: function () {
            return this._full_name;
        },
        set: function (value) {
            this._full_name = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(User.prototype, "password", {
        get: function () {
            return this._password;
        },
        set: function (value) {
            this._password = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(User.prototype, "email", {
        get: function () {
            return this._email;
        },
        set: function (value) {
            this._email = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(User.prototype, "phone", {
        get: function () {
            return this._phone;
        },
        set: function (value) {
            this._phone = value;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(User.prototype, "picture", {
        get: function () {
            return this._picture;
        },
        set: function (value) {
            this._picture = value;
        },
        enumerable: true,
        configurable: true
    });
    return User;
}());
export { User };
//# sourceMappingURL=User.js.map