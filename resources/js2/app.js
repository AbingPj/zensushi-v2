
require("./bootstrap");
window.Vue = require("vue");

import VueEvents from "vue-events";
Vue.use(VueEvents);

import Vuetable from "vuetable-2";
Vue.component("vuetable", Vuetable);

import VueTableCssForBootstrap4 from "./vt2/VuetableCssBootstrap4.js";
Vue.prototype.$VueTableCssForBootstrap4 = VueTableCssForBootstrap4;

import VuetablePagination from "./vt2/VuetablePaginationBootstrap4.vue";
Vue.component("vuetable-pagination", VuetablePagination);

Vue.component("filter-bar", require("./vt2/FilterBar.vue").default);
Vue.component("per-page-option", require("./vt2/PerPageOption.vue").default);

import VuetablePaginationInfo from "vuetable-2/src/components/VuetablePaginationInfo";
Vue.component("vuetable-pagination-info", VuetablePaginationInfo);

import VueTour from 'vue-tour'
require('vue-tour/dist/vue-tour.css')
Vue.use(VueTour)


Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component(
    "tour-sample",
    require("./components/vtour.vue").default
);
Vue.component(
    "vc-items",
    require("./components/pages/items/Items.vue").default
);
Vue.component(
    "vc-items-table",
    require("./components/pages/items/items-vuetable/ItemsTables.vue").default
);
Vue.component(
    "vc-items-choose-itemtype-modal",
    require("./components/pages/items/ItemsChooseTypeModal.vue").default
);
Vue.component(
    "vc-items-create",
    require("./components/pages/items/ItemsCreate.vue").default
);

Vue.component(
    "vc-items-delete-modal",
    require("./components/pages/items/ItemsDelete.vue").default
);

Vue.component(
    "vc-items-update-modal",
    require("./components/pages/items/ItemsUpdate.vue").default
);

Vue.component(
    "vc-items-in-modal",
    require("./components/pages/items/ItemsIn.vue").default
);

Vue.component(
    "vc-items-out-modal",
    require("./components/pages/items/ItemsOut.vue").default
);

Vue.component(
    "vc-items-additional-modal",
    require("./components/pages/items/ItemsAdditional.vue").default
);

Vue.component(
    "vc-records",
    require("./components/pages/records/Records.vue").default
);

Vue.component(
    "vc-records-table",
    require("./components/pages/records/RecordsTable.vue").default
);

Vue.component(
    "vc-items-raw-product-in",
    require("./components/pages/items/items-raw-product-in/ItemsRawProductIn.vue").default
);


Vue.component(
    "items-raw-out",
    require("./components/pages/items/ItemsRawOut.vue").default
);
Vue.component(
    "items-raw-out-2",
    require("./components/pages/items/items-raw-product-in/ItemsRawOut2.vue").default
);

Vue.component(
    "modal-delete-record",
    require("./components/pages/records/ModalDeleteRecord.vue").default
);

Vue.component(
    "modal-update-record",
    require("./components/pages/records/ModalUpdateRecord.vue").default
);

Vue.component(
    "notifications-page",
    require("./components/pages/notifications/Notifications.vue").default
);

Vue.component(
    "delivery-page",
    require("./components/pages/delivery/DeliveryPage.vue").default
);

Vue.component(
    "delivery-request-page",
    require("./components/pages/delivery-request/DeliveryRequestPage.vue").default
);

Vue.component(
    "notification-button",
    require("./components/NotificationButton.vue").default
);

Vue.component(
    "notification-page",
    require("./components/NotificationsPage.vue").default
);

const app = new Vue({
    el: "#app2"
});
