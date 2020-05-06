require("./bootstrap");

window.Vue = require("vue");

import VueEvents from "vue-events";
Vue.use(VueEvents);

// import VueTour from 'vue-tour'
// require('vue-tour/dist/vue-tour.css')
// Vue.use(VueTour)

// Vue.component(
//     "tour-sample",
//     require("./components/vtour.vue").default
// );

/////  Inventory  /////
Vue.component("inventory-page", require("./pages/Inventory/index.vue").default);
Vue.component("action-button", require("./pages/Inventory/actionbutton.vue").default);
Vue.component("items-update-modal", require("./pages/Inventory/ItemsUpdate.vue").default);
Vue.component("items-delete-modal", require("./pages/Inventory/ItemsDelete.vue").default);
Vue.component("items-addtional-modal", require("./pages/Inventory/ItemsAdditional.vue").default);
Vue.component("items-in-modal", require("./pages/Inventory/ItemsIn.vue").default);
Vue.component("items-out-modal", require("./pages/Inventory/ItemsOut.vue").default);
Vue.component("items-choose-itemtype-modal", require("./pages/Inventory/ItemsChooseTypeModal.vue").default);
Vue.component("items-create", require("./pages/Inventory/ItemsCreate.vue").default);

////  Production /////
Vue.component("production-page", require("./pages/Production/index.vue").default);
Vue.component("production-raw-out", require("./pages/Production/ItemsRawOut2.vue").default);

/// Records ///
Vue.component("records-page", require("./pages/Records/index.vue").default);
Vue.component("modal-delete-record", require("./pages/Records/ModalDeleteRecord.vue").default);
Vue.component("modal-update-record", require("./pages/Records/ModalUpdateRecord.vue").default);

/// Delivery Request
Vue.component("delivery-request-page", require("./pages/DeliveryRequest/index.vue").default);

/// Deliveries
Vue.component("deliveries-page", require("./pages/Deliveries/index.vue").default);

////  Users
Vue.component("users-page", require("./pages/Users/index.vue").default);
Vue.component("create-user-page", require("./pages/Users/CreateUser.vue").default);





const app = new Vue({
    el: "#app2"
});
