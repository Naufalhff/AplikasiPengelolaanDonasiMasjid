import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import 'summernote/dist/summernote-bs4.css';
import 'summernote/dist/summernote-bs4.min.js';


createApp(App).use(router).mount("#app");
