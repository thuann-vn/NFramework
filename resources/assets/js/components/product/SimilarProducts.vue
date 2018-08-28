<template>
    <div class="products similar-products" v-if="products">
        <product v-for="(product, index) in products" v-bind:data="product" v-bind:key="product.id"></product>
    </div> <!-- end products -->
</template>

<script>
    export default {
        props: ['productId'],
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
                axios.get('/api/'+ LANG +'/product/similar/' + vm.productId).then((response) => {
                    vm.products = response.data.data;
                    this.loading = false
                });
            }
        },
        updated() {
            if (this.products) {
                $(this.$el).slick({
                    infinite: true,
                    slidesToShow: 8,
                    slidesToScroll: 8,
                    autoplay: true,
                    autoplaySpeed: 3000,
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
