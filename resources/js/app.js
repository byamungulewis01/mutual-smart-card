import "./bootstrap";
import "../css/app.css";
import "../css/style.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
// import Echo from "laravel-echo";
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-buttons-dt';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';

import jsZip from 'jszip';
import pdfMake from 'pdfmake';

DataTable.use(DataTablesCore);

// Attach jsZip and pdfMake to window object (necessary for some export functions)
window.JSZip = jsZip;
window.pdfMake = pdfMake;

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("VueDatePicker", VueDatePicker)
            .component('DataTable', DataTable)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

// console.log(Echo);
// console.log(Echo);
