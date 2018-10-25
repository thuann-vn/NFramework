<template>
    <!-- Main section -->
    <div class="section">
        <!-- Container -->
        <div class="container">
            <!-- Cart page -->
            <div class="columns account-header">
                <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                    <div class="account-title">
                        <h2>PRODUCTS</h2>
                        <img class="brand-filigrane" src="assets/images/logo/nephos-greyscale.svg" alt="">
                    </div>

                    <!-- Account tabs -->
                    <div class="tabs account-tabs">
                        <ul>
                            <li class="is-active"><a href="account.html">All</a></li>
                        </ul>
                    </div>

                    <!-- Total and checkout -->
                    <div class="cart-summary" v-if="!loading">
                        <span class="cart-total">
                            {{meta.total}} <small><span>products in database</span></small>
                        </span>
                        <a href="checkout-step1.html" class="button feather-button is-bold primary-button raised">
                            ADD PRODUCT
                        </a>
                    </div>

                    <!-- Cart Layout -->
                    <div class="columns is-account-grid is-multiline">
                        <!-- Product list -->
                        <div class="column is-12">
                            <!-- Product -->
                            <div class="flat-card is-auto cart-card" v-for="product in products">
                                <ul class="cart-content">
                                    <li>
                                        <img :src="product.image|image('small')" alt="">
                                        <span class="product-info">
                                            <span>{{product.name}}</span>
                                            <span>{{product.brand.name}}</span>
                                        </span>
                                        <span class="product-price">
                                            <span>Price</span>
                                            <span>{{product.price|price}}</span>
                                        </span>

                                        <span class="product-price">
                                            <span>Regular Price</span>
                                            <span style="text-decoration: line-through">
                                                {{product.regular_price|price}}
                                            </span>
                                        </span>

                                        <span class="action">
                                            <span class="action-link is-like has-simple-popover" data-content="Add to Wishlist" data-placement="top" v-simple-popover>
                                                <a href="#"><i class="feather-icons" data-feather="heart" v-feather></i></a>
                                            </span>
                                            <span class="action-link is-remove has-simple-popover" data-content="Remove from Cart" data-placement="top" v-simple-popover>
                                                <a href="#"><i class="feather-icons" data-feather="x" v-feather></i></a>
                                            </span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="spacer"></div>
                            <!--Pagination-->
                            <pagination v-if="!loading" :totalPages="meta.last_page" :total="meta.total" :perPage="meta.per_page" :currentPage="meta.current_page" @pagechanged="getData"></pagination>
                        </div>
                    </div>
                    <!-- /Cart Layout -->
                </div>
            </div>
            <!-- /Cart page -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Main section -->
</template>
<script>
    export default {
        data (){
            return {
                products: [],
                meta: {},
                error: false,
                loading: true
            }
        },
        methods:{
            getData(page=1){
                this.meta.current_page = page;
                axios.get(this.$store.state.API_URL + 'products?page='+page)
                    .then(response => {
                        this.products = response.data.data;
                        this.meta = response.data.meta;
                        console.log(this.products);
                    }).catch(error => {
                    this.errored = true
                }).finally(() => this.loading = false);
            }
        },
        mounted:function () {
            this.getData();
        }
    }
</script>