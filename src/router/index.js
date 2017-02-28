import Vue from 'vue'
import Router from 'vue-router'
import Hello from 'components/Hello'
import Mv from 'components/Mv'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    {
      path: '/mv/mvid=:id',
      name: 'Mv',
      component: Mv
    }
  ]
})
