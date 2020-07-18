<template>
    <div class="modal" :class="modalClass">

        <div class="modal-background"></div>
        <div class="modal-card">

            <header class="modal-card-head">
                <p class="modal-card-title">{{ list.friend_name | uppercase }}<span v-if="list.friend_name">'s Details</span></p>
                <button class="delete" aria-label="close" @click="closeModal"></button>
            </header>

            <section class="modal-card-body">
            <!-- Content ... -->

                <li class="panel-block">
                    <label class="column is-2"><b>Name</b></label> {{ list.friend_name }}
                </li>

                <li class="panel-block">
                    <label class="column is-2"><b>Phone</b></label> {{ list.friend_phone_number }}
                </li>

                <li class="panel-block">
                    <label class="column is-2"><b>Email</b></label> {{ list.friend_email }}
                </li>

            </section>

            <footer class="modal-card-foot">
                <button class="button is-success">Save changes</button>
                <button class="button" @click="closeModal">Cancel</button>
            </footer>

        </div>

    </div>
</template>

<script>
export default {
    data(){
        return {
            list:{

            },
            phonebookDetails:{
                id:''
            }
        }
    },
    props: ["modalClass"],
    methods:{

        closeModal(){
            this.$emit("closeFriend")
        },
        fetchPhonebookDetails(phonebookId){

            this.$Progress.start()

            this.phonebookDetails.id=phonebookId;

            axios.post("/fetchPhonebookDetails", this.phonebookDetails).then((response) => {

                this.list = response.data[0];
                this.$Progress.finish()

            }).catch((error) => {
                this.$Progress.finish()
            })
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