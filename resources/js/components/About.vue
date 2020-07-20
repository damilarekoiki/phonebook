<template>
    <section class="section">
        <div class="container columns">
            <div class="card is-offset-3 is-4 column">
                <div class="card-image">
                    <figure class="image">
                    <img :src="'./assets/image/dammy.jpg'" alt="Placeholder image" style="width:100%;">
                    </figure>
                </div>
                <div class="card-content">

                    <div class="content" style="text-align: justify;">
                        Hi! My name is Damilare Koiki. I'm a full-stack developer. 
                        I built this site with Laravel and Vue.js
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    mounted() {
        this.$emit('dataStiilBeingFetched', false);
    }
}
</script>