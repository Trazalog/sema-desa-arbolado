import * as store from "store2";
var Session = /** @class */ (function () {
    function Session() {
    }
    Session.create = function (session_id, username) {
        store.set("session_id", session_id);
        store.set("username", username);
    };
    Session.invalidate = function () {
        store.remove("session_id");
        store.remove("username");
        store.clearAll();
    };
    Session.exists = function () {
        return store.size() === 2 &&
            store.has("session_id") &&
            store.has("username");
    };
    Session.getSessionID = function () {
        return store.get("session_id");
    };
    Session.getSessionUsername = function () {
        return store.get("username");
    };
    return Session;
}());
export { Session };
//# sourceMappingURL=Session.js.map