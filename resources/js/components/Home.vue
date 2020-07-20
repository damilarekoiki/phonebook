<template>
    <nav class="panel column is-offset-2 is-8">
        <p class="panel-heading">
            Phonebook
            <button class="button is-link is-outlined" id="addNew" @click="showModal">
                Add
            </button>
            <span class="is-pulled-right" v-if="loading">
                <i class="fa fa-refresh fa-spin fa-fw"></i>
                <span class="sr-only">Loading...</span>
            </span>
            
        </p>
        <div class="panel-block">
            <p class="control has-icons-left">
            <input class="input" type="text" placeholder="Search" v-model="search">
            <span class="icon is-left">
                <i class="fa fa-search"></i>
            </span>
            </p>
        </div>
        <!-- Facebook style preloader  -->
        <a class="animated-background panel-block" v-if="stillFetchingPhonebook"></a>
        <a class="animated-background panel-block" v-if="stillFetchingPhonebook"></a>
        <a class="animated-background panel-block" v-if="stillFetchingPhonebook"></a>
        <a class="animated-background panel-block" v-if="stillFetchingPhonebook"></a>
        <a class="animated-background panel-block" v-if="stillFetchingPhonebook"></a>
        <a class="animated-background panel-block" v-if="stillFetchingPhonebook"></a>

        <a class="panel-block" v-for="(person,index) in list" :key="index">

            <span class="column is-9">{{ person.friend_name | uppercase }}</span>

            <span class="column panel-icon is-1">
                <i class="has-text-danger fa fa-trash" aria-hidden="true" @click="handleDelete(index,person.id)"></i>
            </span>
            <span class="column panel-icon is-1">
                <i class="has-text-info fa fa-edit" aria-hidden="true" @click="displayFriendDetailsInUpdateModal(person.id)"></i>
            </span>
            <span class="column panel-icon is-1">
                <i class="has-text-info fa fa-eye" aria-hidden="true" @click="displayFriendDetails(person.id)"></i>
            </span>

        </a>

        <Add :modalActiveClass="activeClass" @closeRequest="closeModal" ref="addModal"/>
        <FriendDetailsModal :modalClass="friendModalClass" @closeFriend="closeFriendModal"  ref="friendModal" />
        <UpdateFriendModal :modalClass="updateModalClass" @closeUpdate="closeUpdateModal" ref="updateModal" />

    </nav>
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
    // import NProgress from 'nprogress';

    export default {

        data() {
            return{
                activeClass: '',
                friendModalClass:'',
                updateModalClass:'',
                error:{},
                list:{},
                tempList:{},
                loading:false,
                search:'',
                searchQuery:{
                    search:''
                },
                stillFetchingPhonebook:true
            }
        },

        components:{
            Add,
            FriendDetailsModal,
            UpdateFriendModal
        },

        watch:{
            search(){

                this.$Progress.start() //  Loader progress bar

                this.searchQuery.search=this.search;

                if(this.search==''){

                    this.list=this.tempList; // If search content is empty display the whole phonebook content
                    this.$Progress.finish() //  Loader progress bar

                }else{

                    axios.post("/search", this.searchQuery).then((response) => {

                        console.log(response);
                        this.list=response.data; // else display result of search query
                        this.$Progress.finish() //  Loader progress bar

                    }).catch((error) => {
                        this.$Progress.fail() //  Loader progress bar
                    })
                }
                

            }
        },

        mounted(){
            axios.post("/fetchUserPhonebook").then((response) => {
                this.list=response.data
                this.tempList=this.list; // save original list. Display it when nothng is in search box
                this.stillFetchingPhonebook=false
                this.$emit('dataStiilBeingFetched', false) // To control when footer will be displayed
                
            }).catch((error) => {
                console.log(error)
                this.errors = error.response.data.errors;
                this.stillFetchingPhonebook=false
                this.$emit('dataStiilBeingFetched', false) // To control when footer will be displayed
            })
        },
        methods: {
            showModal(){
                this.$refs["addModal"].list={}
                this.$refs["addModal"].errors={}
                this.activeClass='is-active'
            },
            closeModal(){
                this.activeClass=''
            },
            displayFriendDetails(id){

                this.$refs["friendModal"].list={}

                this.$refs["friendModal"].fetchPhonebookDetails(id) // Call function fetchPhonebookDetail
                this.friendModalClass='is-active'

            },
            closeFriendModal(){
                this.friendModalClass=''
            },
            displayFriendDetailsInUpdateModal(id){

                this.$refs["updateModal"].list={};
                this.$refs["updateModal"].errors={}
                this.$refs["updateModal"].fetchPhonebookDetails(id) // Call function fetchPhonebookDetail
                this.updateModalClass='is-active'

            },
            closeUpdateModal(){
                this.updateModalClass=''
            },
            handleDelete(index,id){

                if(confirm("Are you sure?")){

                    this.loading=!this.loading // Display loader

                    axios.delete(`/phonebook_save/${id}`).then((response) => {
                        
                        this.loading=!this.loading; // Remove loader
                        this.list.splice(index,1); // Remove from list
                        
                        alert('Deleted successfully');

                    }).catch((error) => {

                    })
                }
                
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


<style scoped>

    @keyframes placeHolderShimmer{
        0%{
            background-position: -468px 0
        }
        100%{
            background-position: 468px 0
        }
    }

    .animated-background {
        animation-duration: 1s;
        animation-fill-mode: forwards;
        animation-iteration-count: infinite;
        animation-name: placeHolderShimmer;
        animation-timing-function: linear;
        background: #f6f7f8;
        background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
        background-size: 800px 104px;
        height: 30px;
        position: relative;
        margin-top:10px;
    }

</style>