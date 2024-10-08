// Vuetify
import "vuetify/styles";
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const customTheme = {
    dark: false
};

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi', 
      },
    theme: {
        defaultTheme: "customTheme",
        themes: {
            customTheme,
        },
    },
});

export default vuetify;