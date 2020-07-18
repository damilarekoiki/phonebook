<template>
    <div class="container column">
        <div class="columns">
            <section class="section column is-7">
                <TopIllustration />
            </section>

            <section class="section column is-5">

                <div class="container">
                    <div class="notification is-danger" v-if="has_error">
                        <p>
                            Error, unable to connect with these credentials
                        </p>
                    </div>

                    <form autocomplete="off" @submit.prevent="login" method="post">

                        <div class="field">
                            <div class="columns">
                                <div class="column is-10">
                                    <div class="control has-icons-left">
                                        <input class="input" type="email" placeholder="Email" v-model="email" :class="{'is-danger':errors.email}">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <p class="help is-danger" v-if="has_error && errors.email">{{ errors.email }}</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="field">
                            <div class="columns">
                                <div class="column is-10">
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" :type="passwordOrText" placeholder="Password" v-model="password" :class="{'is-danger':errors.password}" />
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                            <i class="fa show-pass" :class="eye" @click="showHidePassword"></i>
                                        </span>
                                    </div>
                                    <p class="help is-danger" v-if="has_error && errors.password">{{ errors.password }}</p>
                                </div>
                            </div>
                            
                        </div>

                        

                        <div class="field">
                            <p class="control">
                                <button class="button is-link">Login</button>
                            </p>
                        </div>

                    </form>
                </div>

            </section>
        </div>
        <MiddleIllustration />
        <BottomIllustration />
    </div>
    
</template>

<script>

    import TopIllustration from './TopIllustration';
    import MiddleIllustration from './MiddleIllustration';
    import BottomIllustration from './BottomIllustration';

    export default {
        data() {
            return {
                email: null,
                password: null,
                has_error: false,
                passwordOrText: 'password',
                errors: {
                    
                },
                eye:'fa-eye'
            }
        },
        components: {
            TopIllustration,
            MiddleIllustration,
            BottomIllustration
        },
        mounted() {
        //
            this.$emit('dataStiilBeingFetched', false);
        },
        methods: {
            login() {

                this.$Progress.start() //  Loader progress bar

                // get the redirect object
                var redirect = this.$auth.redirect()
                var app = this
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function(response) {
                        app.$Progress.finish() //  Loader progress bar
                        const redirectTo = 'home'
                        this.$router.push({name: redirectTo})
                        console.log(response.headers.authorization);
                    },
                    error: function() {
                        app.has_error = true
                        app.$Progress.fail() //  Loader progress bar
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            },
            showHidePassword(){
                if(this.passwordOrText=='password') { this.passwordOrText='text'; this.eye="fa-eye-slash"}
                else if(this.passwordOrText=='text') { this.passwordOrText='password'; this.eye="fa-eye"}

            }
        }
    }
</script>

<style scoped>
    .show-pass{
        cursor:pointer;
        color:grey;
        pointer-events: all;
    }
</style>