<template>
    <div>

        <MyHeader />

        <div class="container">
            <router-view />
        </div>
        
        <MyFooter />
        
    </div>

</template>

<script>
    import MyHeader from "./MyHeader";
    import MyFooter from "./MyFooter";

    export default {
        components:{
            MyHeader,
            MyFooter,
        }
    }
</script>