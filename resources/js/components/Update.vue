<template>
    <div class="modal" :class="modalClass">

        <div class="modal-background"></div>
        <div class="modal-card">

            <header class="modal-card-head">
                <p class="modal-card-title">
                    <span v-if="fetching">{{ fetchingText }}</span>
                    <span v-if="updating">{{ updatingText }}</span>
                    <span v-if="list.friend_name && !updating">Update {{ list.friend_name | uppercase }}'s Details</span>
                </p>
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
                <button class="button is-success" @click="update">Update</button>
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
            },
            phonebookDetails:{
                id:''
            },
            fetching: true,
            fetchingText: 'Trying to fetch data...',
            updating: false,
            updatingText: "Updating User"

        }
    },
    props:[
        "modalClass"
    ],
    methods:{
        close(){
            this.fetching=true;
            this.fetchingText= 'Trying to fetch data...';
            this.updating=false;
            this.updatingText= "Updating..."
            this.$emit("closeUpdate")
            this.list={} // Empty all the fields, work of v-model
            this.errors={}

        },
        update(){
            
            this.updating=true;
            this.$Progress.start()
            axios.patch(`/phonebook_save/${this.list.id}`,this.list).then((response)=>{

                this.updating=false;
                this.close();
                this.$Progress.finish();
                this.list={} // Empty all the fields, work of v-model

            }).catch((error)=>{

                this.updating=true;
                this.updatingText="Error updating"
                this.errors = error.response.data.errors;
                this.$Progress.finish();

            })
            

        },
        fetchPhonebookDetails(phonebookId){

            this.$Progress.start()

            this.phonebookDetails.id=phonebookId;

            axios.post("/fetchPhonebookDetails", this.phonebookDetails).then((response) => {

                this.fetching = false
                this.list = response.data[0];

                this.$Progress.finish()

            }).catch((error) => {
                this.$Progress.finish();
                this.fetchingText="Error trying to fetch data"
            });
            console.log(this.modalClass);
        }
    },
    filters:{
        uppercase(text){
            if (!text) return ''
            text = text.toString()
            return text.charAt(0).toUpperCase() + text.slice(1)
        }
    }
}
</script>