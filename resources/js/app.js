require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueResource from 'vue-resource';
import router from './js/Router'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
   

window.Vue = require('vue');


Vue.component('tela-inicial', require('./components/TelaInicial.vue').default);
Vue.component('atendimentos', require('./components/Atendimentos.vue').default);
Vue.component('marcar-atendimento', require('./components/MarcarAtendimento.vue').default);
Vue.component('responder-atendimento', require('./components/ResponderAtendimento.vue').default);

Vue.use(BootstrapVue);
Vue.use(VueResource);


 /* Audio Record Plugin */
 import AudioRecorder from 'vue-audio-recorder';
 import Toasted from 'vue-toasted';
 /* Audio Record Plugin */
 Vue.use(AudioRecorder);
 Vue.use(Toasted);




const app = new Vue({
    toasted : Toasted,
    router,
    el: '#app',
});
