import VueRouter from 'vue-router'
// Components
import Home from './components/Home'
import About from './components/About'

import Register from './components/Register'
import Login from './components/Login'

let progr=[
      {call: 'color', modifier: 'temp', argument: '#ffb000'},
      {call: 'fail', modifier: 'temp', argument: '#6e0000'},
      {call: 'location', modifier: 'temp', argument: 'top'},
      {call: 'transition', modifier: 'temp', argument: {speed: '1.5s', opacity: '0.6s', termination: 400}}
    ];
// Routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: true,
            progress: {
                func:progr
            }
        }
    },
    {
        path: '/about',
        name: 'about',
        component: About,
        meta: {
            auth: true,
            progress: {
                func:progr
            }
        }
    },
    {
        path: '/home',
        name: 'homePage',
        component: Home,
        meta: {
            auth: true,
            progress: {
                func:progr
            }
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: undefined,
            progress: {
                func:progr
            }
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: undefined,
            progress: {
                func:progr
            }
        }
    }

]
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})
export default router