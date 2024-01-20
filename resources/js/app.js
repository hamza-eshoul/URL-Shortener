import "./bootstrap";

import { createApp } from "vue";
import Projectheader from "./components/Projectheader.vue";
import Urlshortener from "./components/Urlshortener.vue";
import UrlsList from "./components/UrlsList.vue";
import UrlsStatistics from "./components/UrlsStatistics.vue";

const app = createApp();

app.component("projectheader", Projectheader);
app.component("urlshortener", Urlshortener);
app.component("urlslist", UrlsList);
app.component("urlstats", UrlsStatistics);

app.mount("#app");
