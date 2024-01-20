import "./bootstrap";

import { createApp } from "vue";
import Projectheader from "./components/Projectheader.vue";
import Urlshortener from "./components/Urlshortener.vue";
import UrlsList from "./components/UrlsList.vue";

const app = createApp();

app.component("projectheader", Projectheader);
app.component("urlshortener", Urlshortener);
app.component("urlslist", UrlsList);

app.mount("#app");
