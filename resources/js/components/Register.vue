<template>

    <div class="container column">
        <div class="columns">
            <section class="section column is-7">
                <TopIllustration />
            </section>
            <section class="section column is-5">
                <div class="container">

                    <div class="notification is-danger" v-if="has_error && !success">
                        <p v-if="error == 'registration_validation_error'">
                            Validation error (s), please see the message (s) below
                        </p>
                        <p v-else>
                            Error, unable to register at this time. If the problem persists, please contact an administrator
                        </p>
                    </div>

                    <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

                        <div class="field">
                            <div class="columns">
                                <div class="column is-10">
                                    <p class="control has-icons-left">
                                        <input class="input" type="text" placeholder="First name" v-model="firstname" :class="{'is-danger':errors.firstname}">
                                    </p>
                                    <p class="help is-danger" v-if="has_error && errors.firstname">{{ errors.firstname }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="columns">
                                <div class="column is-10">
                                    <p class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Last name" v-model="lastname" :class="{'is-danger':errors.lastname}">
                                    </p>
                                    <p class="help is-danger" v-if="has_error && errors.lastname">{{ errors.lastname }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="columns">
                                <div class="column is-10">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input" type="email" placeholder="Email" v-model="email" :class="{'is-danger':errors.email}">
                                        <span class="icon is-small is-left">
                                        <i class="fa fa-envelope"></i>
                                        </span>
                                    </p>
                                    <p class="help is-danger" v-if="has_error && errors.email">{{ errors.email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="columns">
                                <div class="column is-10">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input" :type="passwordOrText" placeholder="Password" v-model="password" :class="{'is-danger':errors.password}">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                            <i class="fa show-pass" :class="passEye" @click="showHidePassword('password')"></i>
                                        </span>
                                    </p>
                                    <p class="help is-danger" v-if="has_error && errors.password">{{ errors.password }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <div class="columns">
                                <div class="column is-10">
                                    <p class="control has-icons-left has-icons-right">
                                        <input class="input" :type="confpasswordOrText" placeholder="Confirm password" v-model="password_confirmation" :class="{'is-danger':errors.password}">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                            <i class="fa show-pass" :class="confPassEye" @click="showHidePassword('confirmPassword')"></i>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <p class="control">
                                <button class="button is-link">Register</button>
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
                name: '',
                firstname: '',
                lastname: '',
                email: '',
                password: '',
                password_confirmation: '',
                has_error: false,
                error: '',
                errors: {},
                success: false,
                passwordOrText: 'password',
                confpasswordOrText: 'password',
                passEye: 'fa-eye',
                confPassEye: 'fa-eye'
            }
        },
        components: {
            TopIllustration,
            MiddleIllustration,
            BottomIllustration
        },
        methods: {
            register() {

                this.$Progress.start() //  Loader progress bar
                
                var app = this
                this.$auth.register({
                    data: {
                        firstname: app.firstname,
                        lastname: app.lastname,
                        email: app.email,
                        password: app.password,
                        password_confirmation: app.password_confirmation
                    },
                    success: function () {
                        app.$Progress.finish() //  Loader progress bar
                        app.success = true
                        this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
                    },
                    error: function (res) {
                        console.log(res.response.data.errors)
                        app.has_error = true
                        app.error = res.response.data.error
                        app.errors = res.response.data.errors || {};

                        app.$Progress.fail() //  Loader progress bar
                    }
                })
            },
            showHidePassword(el){
                if(el=='password'){
                    if(this.passwordOrText=='password') {this.passwordOrText='text'; this.passEye='fa-eye-slash'}
                    else if(this.passwordOrText=='text') {this.passwordOrText='password'; this.passEye='fa-eye'}
                }
                else if(el=='confirmPassword'){
                    if(this.confpasswordOrText=='password') {this.confpasswordOrText='text'; this.confPassEye='fa-eye-slash'}
                    else if(this.confpasswordOrText=='text') {this.confpasswordOrText='password'; this.confPassEye='fa-eye'}
                }
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