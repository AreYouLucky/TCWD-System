import "./bootstrap";
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import vuetify from "./vuetify";
import VueSweetalert2 from 'vue-sweetalert2';
import 'animate.css';
import Vue3Lottie from 'vue3-lottie'


const componentContext = import.meta.glob('./components/**/*.vue',{ eager: true });

const app = createApp({});

for (const path in componentContext) {
    const componentModule = componentContext[path];
    const fileName = path.split('/').pop().replace(/\.\w+$/, '');
  
    const component = componentModule.default;
    app.component(fileName, component);
  };
  
app.use(vuetify,VueSweetalert2,Vue3Lottie).mount("#app");
