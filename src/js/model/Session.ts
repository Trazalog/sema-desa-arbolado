import * as store from "store2";


export class Session {


    public static create(session_id: string,  username: string) {

        store.set("session_id", session_id);
        store.set("username", username);
    }

    public static invalidate() {

        store.remove("session_id");
        store.remove("username");

        store.clearAll();
    }


    public static exists() {

        return store.size() === 2 &&
            store.has("session_id") &&
            store.has("username");
    }

    public static getSessionID(){

        return store.get("session_id");
    }


    public static getSessionUsername(){

        return store.get("username");
    }
}