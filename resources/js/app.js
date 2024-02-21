import "./bootstrap";
import { createApp } from "vue";
import App from "./Pages/App.vue";
import "@vuepic/vue-datepicker/dist/main.css";
import "vue-multiselect/dist/vue-multiselect.css";
const app = createApp(App);
app.mount("#app");
