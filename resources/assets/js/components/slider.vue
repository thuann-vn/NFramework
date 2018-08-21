<template>
    <div class="slider fade" v-if="slider">
        <div v-for="(item, index) in slider.slides">
            <div class="image">
                <img :src="'/storage/' + item.image" alt="hero image">
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

                this.error = this.post = null;
                this.loading = true;
                // replace `getPost` with your data fetching util / API wrapper
                axios.get('/api/slider/get/home-slider')
                .then((response) => {
                    vm.slider = response.data;
                    console.log(vm.slider);
                    this.loading = false
                })
            }
        },
        updated() {
            if(this.slider){
                $('.slider.fade').slick({
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
