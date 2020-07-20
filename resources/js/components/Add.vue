<template>
    <div class="modal" :class="modalActiveClass">

        <div class="modal-background"></div>
        <div class="modal-card">

            <header class="modal-card-head">
                <p class="modal-card-title">Add New</p>
                <button class="delete" aria-label="close" @click="close"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.friend_name}" type="text" placeholder="Name" v-model="list.friend_name">
                    </div>
                    <small v-if="errors.friend_name" class="has-text-danger">{{errors.friend_name[0]}}</small>
                </div>

                <div class="field">
                    <label class="label">Phone number</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.friend_phone_number}" type="number" placeholder="Phone number" v-model="list.friend_phone_number">
                    </div>
                    <small v-if="errors.friend_phone_number" class="has-text-danger">{{errors.friend_phone_number[0]}}</small>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.friend_email}" type="email" placeholder="Email" v-model="list.friend_email">
                    </div>
                    <small v-if="errors.friend_email" class="has-text-danger">{{errors.friend_email[0]}}</small>
                </div>
                
            </section>

            <footer class="modal-card-foot">
                <button class="button is-success" @click="save">Save</button>
                <button class="button" @click="close">Cancel</button>
            </footer>

        </div>

    </div>
</template>

<script>

    export default {
        data(){
            return {
                list:{
                    friend_name: '',
                    friend_phone_number: '',
                    friend_email: ''
                },
                errors:{
                    friend_name: '',
                    friend_phone_number: '',
                    friend_email: '',
                }

            }
        },
        props:[
            "modalActiveClass"
        ],
        methods:{
            close(){
                this.$emit("closeRequest");
                this.list={} // Empty all the fields, work of v-model
                this.errors={}
            },
            save(){

                this.$Progress.start() //  Loader progress bar
                axios.post("/phonebook_save", this.list).then((response)=>{
                    this.$parent.list = response.data; // Push new list to Home list
                    this.$parent.tempList=response.data; // save original list. Display it when nothng is in search box
                    this.$Progress.finish() //  Loader progress bar
                    this.close();
                    this.list={} // Empty all the fields, work of v-model

                }).catch((error)=>{
                    this.$Progress.fail() //  Loader progress bar
                    this.errors = error.response.data.errors;
                });


            }
        }
    }
</script>