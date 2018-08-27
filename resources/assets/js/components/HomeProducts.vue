<template>
    <div class="products text-center" v-if="products">
        <div v-for="(product, index) in products">
            <product v-bind:data="product"></product>
        </div>
    </div>
</template>

<script>
    export default {
        props: [],
        data () {
            return {
                loading: false,
                products: null,
                error: null
            }
        },
        created(){
            this.fetchData()
        },
        methods: {
            fetchData() {
                var vm = this;

                this.error = this.products = null;
                this.loading = true;
                axios.get('/api/'+ LANG +'/product/list?featured_only=true&page_size=16').then((response) => {
                    vm.products = response.data.data;
                    this.loading = false
                });
            }
        },
        updated() {
            console.log(this.type);
            if(this.products){
                $(this.$el).slick({
                    autoplay: true,
                    autoplaySpeed: 3000,
                    infinite: false,
                    slidesToShow: 8,
                    slidesToScroll: 8,
                    dots: true,
                    mobileFirst: true,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 8,
                                slidesToScroll: 8
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 200,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        }
                    ]
                });
            }
        }
    }
</script>
