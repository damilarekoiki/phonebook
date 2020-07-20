<template>
    <nav class="navbar is-fixed-top site-header" role="navigation" aria-label="main navigation">

        <div class="navbar-brand">

            <router-link :to="{name: 'home'}" class="navbar-item">
                <img :src="'./assets/image/phonebook.png'" alt="PhoneBook">
            </router-link>
            
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>

        <!-- LOGGED IN USER -->
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start" v-if="$auth.watch.loaded && $auth.check()">
                <!-- Home About Route Links -->
                <router-link v-for="(route, key) in routes.user"  :to="{name: route.path}" :key="key" class="navbar-item pages-links" exact> {{route.name}} </router-link>
            
                <!-- Logout Link -->
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </a>

                    <div class="navbar-dropdown">
                        <a href="javascript:;" @click="$auth.logout()" class="navbar-item">Logout</a>
                    </div>
                </div>
                
            </div>

            <!-- NOT LOGGED IN -->
            <div class="navbar-end" v-if="$auth.watch.loaded && !$auth.check()">
                <div class="navbar-item">
                    <div class="buttons">
                        <router-link v-for="(route, key) in routes.unlogged"  :to="{name: route.path}" :key="key" class="button" :class="{'is-light': key==1}" exact> {{route.name}} </router-link>
                    </div>
                </div>
            </div>

        </div>

        


    </nav>
</template>

<script>
    export default {
        data(){
            return{
                routes:{
                    unlogged:[
                        {
                            name: "Register",
                            path: "register"
                        },
                        {
                            name: "Login",
                            path: "login"
                        }
                    ],
                    user:[
                        {
                            name: "Home",
                            path: "homePage"
                        },
                        {
                            name: "About",
                            path: "about"
                        }
                    ]
                },
            }
        }
    }
</script>


<style scoped>
    .router-link-active{
        color: #3273dc
    }

    .pages-links{
        color:white
    }

    .navbar-link:hover{
        color: #3273dc
    }

    .site-header{
        background: #3273dc;
    }
    
</style>