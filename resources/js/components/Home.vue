<template>
    <div>
        <nav class="panel column is-offset-2 is-8">
            <p class="panel-heading">
                Phonebook
                <button class="button is-link is-outlined" id="addNew" @click="showModal">
                    Add
                </button>
            </p>
            <div class="panel-block">
                <p class="control has-icons-left">
                <input class="input" type="text" placeholder="Search">
                <span class="icon is-left">
                    <i class="fa fa-search"></i>
                </span>
                </p>
            </div>
            
            <a class="panel-block" v-for="(person,index) in list" :key="index">

                <span class="column is-9">{{ person.friend_name }}</span>

                <span class="column panel-icon is-1">
                    <i class="has-text-danger fa fa-trash" aria-hidden="true"></i>
                </span>
                <span class="column panel-icon is-1">
                    <i class="has-text-info fa fa-edit" aria-hidden="true" @click="displayFriendDetailsInUpdateModal(person.id)"></i>
                </span>
                <span class="column panel-icon is-1">
                    <i class="has-text-info fa fa-eye" aria-hidden="true" @click="displayFriendDetails(person.id)"></i>
                </span>

            </a>

        </nav>

        <Add :modalActiveClass="activeClass" @closeRequest="closeModal" />
        <FriendDetailsModal :modalClass="friendModalClass" @closeFriend="closeFriendModal"  ref="friendModal" />
        <UpdateFriendModal :modalClass="updateModalClass" @closeUpdate="closeUpdateModal" ref="updateModal" />
    
    </div>
</template>

<style scoped>
    #addNew:link{
        background-color:darkslateblue;
    }
</style>

<script>
    import Add from "./Add";
    import FriendDetailsModal from "./FriendDetailsModal";
    import UpdateFriendModal from "./Update"

    export default {

        data() {
            return{
                activeClass: '',
                friendModalClass:'',
                updateModalClass:'',
                error:{},
                list:{}
            }
        },

        components:{
            Add,
            FriendDetailsModal,
            UpdateFriendModal
        },

        mounted(){
            axios.post("/fetchUserPhonebook").then((response) => {
                this.list=response.data
                
            }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        },
        methods: {
            showModal(){
                this.activeClass='is-active'
            },
            closeModal(){
                this.activeClass=''
            },
            displayFriendDetails(id){

                this.$refs["friendModal"].fetchPhonebookDetails(id) // Call function fetchPhonebookDetail
                this.friendModalClass='is-active'

            },
            closeFriendModal(){
                this.friendModalClass=''
            },
            displayFriendDetailsInUpdateModal(id){

                this.$refs["updateModal"].fetchPhonebookDetails(id) // Call function fetchPhonebookDetail
                this.updateModalClass='is-active'

            },
            closeUpdateModal(){
                this.updateModalClass=''
            }
                
        }
    }
</script>