// require('./bootstrap');

// import Vue from "vue";
// import VueRouter from "vue-router";

// import App from "./components/App.vue";
// import Home from "./components/Home";
// import About from "./components/About";
// // import Register from './pages/Register'
// // import Login from './pages/Login'

// Vue.use(VueRouter);

// const routes=[
//     {path:"/", component:Home},
//     {path:"/about", component:About}
// ]
// const router =new VueRouter({
//     routes: routes,
//     mode: 'history'
// })

// const app = new Vue({
//     render: h => h(App),
//     router: router
// }).$mount("#app");



import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import App from './components/App'
import auth from './auth'
import router from './router'
// import NProgress from 'nprogress';
import VueProgressBar from 'vue-progressbar'

// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, auth)

const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
   
Vue.use(VueProgressBar, options)

// Load Index
// Vue.component('index', Index)

const app = new Vue({
    render: h => h(App),
    router: router
}).$mount("#app");