import axios from "axios";

import {Session} from "./Session";

import {Endpoint} from "./Endpoint";
import {Tree} from "./Tree";
import * as store from "store2"
export class Form {


    /*** Instance form ***/
    public static async createInstance(){
        let url: string = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_INSTANCE_FORM;

        return await axios({
            method: "POST",
            url: url,
            timeout: Endpoint.TIMEOUT,
            withCredentials: false,
            data:{
                "request_box":{
                    "_post_instanciarform":{
                        "form_id":2
                    },
                    "_get_info_id":{
                        "a":"a"
                    }
                }
            },
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': store.get("token_type") + ' ' + store.get('access_token')
            }
        })
    }



    public static async sendDynamicFormData(data: any){
        let url: string = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_PUT_FORM;

        return await axios({
            method: "PUT",
            url: url,
            timeout: Endpoint.TIMEOUT,
            withCredentials: false,
            data: data,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': store.get("token_type") + ' ' + store.get('access_token')
            }
        })
    }


    public static async sendOnlyTreePicture(data: any){
        let url: string = Endpoint.PROTOCOL + "://" + Endpoint.HOSTNAME_BACKEND + ":" + Endpoint.PORT_BACKEND + Endpoint.URL_POST_NEW_TREE;

        return await axios({
            method: "POST",
            url: url,
            timeout: Endpoint.TIMEOUT,
            withCredentials: false,
            data: data,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': store.get("token_type") + ' ' + store.get('access_token')
            }
        })
    }
}