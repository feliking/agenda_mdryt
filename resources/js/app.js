import 'babel-polyfill'
import Vue from 'vue'

import router from '~/router/index'
import store from '~/store/index'
import App from '$comp/App'
import '~/plugins/index'
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import vuetify from '~/plugins/vuetify'
//import acl from '~/router/acl';

const moment = require('moment')
require('moment/locale/es') 
Vue.use(require('vue-moment'), {
    moment
})

export const app = new Vue({
  router,
  //acl,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
