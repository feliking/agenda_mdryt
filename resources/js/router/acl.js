import Vue from 'vue'
import { AclInstaller, AclCreate, AclRule } from 'vue-acl'
import router from './index'
import store from '~/store/index'
 
Vue.use(AclInstaller)
 
export default new AclCreate({
  initial: 'public',
  notfound: '/profile',
  router,
  acceptLocalRules: true,
  globalRules: {
    admin: new AclRule('admin').generate(),
    usuario: new AclRule('usuario').generate(),
    public: new AclRule('public').or('admin').or('usuario').generate(),
  },
  middleware: async acl => {
    if (store.getters['auth/user'] != null) {
      acl.change(store.getters['auth/user'].roles[0].name)
    } else {
      acl.change('public')
    }
  }
})