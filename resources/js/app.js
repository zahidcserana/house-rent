require("./bootstrap");

require("moment");
import "vue-select/dist/vue-select.css";

import Vue from "vue";

import { InertiaApp } from "@inertiajs/inertia-vue";
import { InertiaForm } from "laravel-jetstream";
import PortalVue from "portal-vue";
import vSelect from "vue-select";

Vue.component("v-select", vSelect);
Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

Vue.filter("formatDate", function(value) {
    if (value) {
        return moment(String(value)).format("MMMM YYYY");
    }
});

Vue.filter("number2Decimal", function(value) {
    return parseFloat(value).toFixed(2)
});

Vue.filter("statusMap", function(value) {
    if (value) {
        const status = {
            unpaid: "m-badge--primary",
            paid: "m-badge--success",
            cancel: "m-badge--warning",
            INITIATED: "m-badge--brand",
            INITIATING: "m-badge--metal",
            APPROVED_BY_GM: "m-badge--info",
            APPROVED_BY_DF: "m-badge--danger",
            available: "m-badge--primary",
            rented: "m-badge--success",
            unavailable: "m-badge--warning",
            active: "m-badge--success",
            inactive: "m-badge--warning",
        };

        return status[value];
    }
});

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(app);
