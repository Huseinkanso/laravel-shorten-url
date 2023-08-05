

import './bootstrap';
import { createApp, VueElement } from 'vue';
import Notifications from '@kyvg/vue3-notification'
import Main from "./Main.vue"
import { router } from "./router"

const app = createApp({});
// used for doing a global event listener ,send event from pagination to index his grand father


import eventBus from './event-bus';
app.use(eventBus);


app.component('main-component', Main);
app.use(Notifications).use(router).mount('#app');
