<template>
    <div class="slider fade" v-if="slider">
        <div v-for="(item, index) in slider.slides">
            <div class="image">
                <img :src="item.image | image" alt="hero image">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                loading: false,
                slider: null,
                error: null
            }
        },
        created(){
            this.fetchData()
        },
        methods: {
            fetchData() {
                var vm = this;

                this.error = this.slider = null;
                this.loading = true;
                axios.get('/api/slider/get/home-slider')
                .then((response) => {
                    vm.slider = response.data;
                    this.loading = false
                })
            }
        },
        updated() {
            if(this.slider){
                $(this.$el).slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear'
                });
            }
        }
    }
</script>
