require('./bootstrap');
window.Vue = require('vue');

import App from '../views/App.vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from '../js/routes';
import VueRouter from 'vue-router';
import Vueditor from 'vueditor';

let config = {
  toolbar: [
    'bold', 'italic', 'underline', 
    'divider', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', '|', 'indent', 'outdent',
    'insertOrderedList', 'insertUnorderedList', '|', 
    'removeFormat', 'undo', 'redo', '|'
  ]
};

Vue.use(Vueditor, config);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);   

const router = new VueRouter({
  mode:'history',
  routes:routes
});

const app = new Vue({
  router: router,
  
  el: '#app',
  render: a => a(App)
});
