import "./bootstrap";

import { createApp } from "vue";

// components
import AppHeader from "./components/AppHeader.vue";
import AppBody from "./components/AppBody.vue";

const app = createApp();

app.component("appheader", AppHeader);
app.component("appbody", AppBody);

app.mount("#app");
