import axios from "axios";

import {Session} from "./Session";

import {Endpoint} from "./Endpoint";

export class User {

    private _username: string;
    private _full_name: string;
    private _password: string;
    private _email: string;
    private _phone: string;
    private _picture: string;


    /*** Sign in ***/
    public static async login(username: string, password: string){

        let url: string = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_LOGIN;

        return await axios({
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
        });
    }

    /*** get profile ***/
    public static async getProfile(){

        let url: string = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_GET_USER_PROFILE;

        let session_id = Session.getSessionID();
        let username = Session.getSessionUsername();

        return await axios({
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
        });
    }

    /*** update profile ***/
    public async updateProfile(){

        let url: string = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_UPDATE_USER_PROFILE;

        let session_id = Session.getSessionID();
        let username = Session.getSessionUsername();

        return await axios({
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
        });
    }


    constructor(full_name: string, email: string, phone: string, picture: string) {
        this._full_name = full_name;
        this._email = email;
        this._phone = phone;
        this._picture = picture;
    }

    get username(): string {
        return this._username;
    }

    set username(value: string) {
        this._username = value;
    }

    get full_name(): string {
        return this._full_name;
    }

    set full_name(value: string) {
        this._full_name = value;
    }

    get password(): string {
        return this._password;
    }

    set password(value: string) {
        this._password = value;
    }

    get email(): string {
        return this._email;
    }

    set email(value: string) {
        this._email = value;
    }

    get phone(): string {
        return this._phone;
    }

    set phone(value: string) {
        this._phone = value;
    }

    get picture(): string {
        return this._picture;
    }

    set picture(value: string) {
        this._picture = value;
    }
}