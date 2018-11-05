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
                                            <span class="action-link is-like has-simple-popover" data-content="Edit product" data-placement="top" v-simple-popover>
                                                <router-link :to="{ name: 'productDetail', params: { id: product.id }}">
                                                    <feather-heart></feather-heart>
                                                </router-link>
                                            </span>
                                            <span class="action-link is-remove has-simple-popover" data-content="Delete" data-placement="top" v-simple-popover>
                                                <a href="#"><feather-x></feather-x></a>
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
        <div class="filters-quickview is-active">
            <div class="inner">
                <!-- Header -->
                <div class="quickview-header">
                    <h2>Filters</h2>
                </div>

                <!-- Filters body -->
                <div class="filters-body">


                    <!-- Categories checkboxes -->
                    <div class="filter-block">
                        <h3 class="filter-title has-padding">Categories</h3>
                        <div class="columns is-checkboxes is-gapless is-multiline">
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="house" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            House
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="office" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Office
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="kids" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Kids
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="kitchen" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Kitchen
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="accessories" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Misc
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Categories -->

                    <!-- Types -->
                    <div class="filter-block">
                        <h3 class="filter-title has-padding">Types</h3>
                        <div class="columns is-checkboxes is-gapless is-multiline">
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="chairs" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Chairs
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="couches" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Couches
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="tables" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Tables
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="beds" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Beds
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="lights" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Lights
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="devices" type="checkbox" class="d-checkbox" checked="">
                                            <span></span>
                                            Devices
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Types -->

                    <!-- Price range filter -->
                    <div class="filter-block">
                        <h3 class="filter-title">Price</h3>
                        <div class="price-range-wrapper">
                            <div class="price-limit">0</div>
                            <div class="range-slider">
                                <input class="input-range" type="range" value="1500" min="1" max="1500">
                                <div class="slider-output">
                                    <small>Show between</small><span class="range-value">$0 - $1500</span>
                                </div>
                            </div>
                            <div class="price-limit">1500</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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