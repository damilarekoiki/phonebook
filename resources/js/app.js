require('./bootstrap');

import Vue from "vue";
import VueRouter from "vue-router";

import App from "./components/App.vue";
import Home from "./components/Home";
import About from "./components/About";

Vue.use(VueRouter);

const routes=[
    {path:"/", component:Home},
    {path:"/about", component:About}
]
const router =new VueRouter({
    routes: routes,
    mode: 'history'
})

const app = new Vue({
    render: h => h(App),
    router: router
}).$mount("#app");