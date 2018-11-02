<template>
    <div class="section">
        <div class="container" v-if="!loading">
            <div class="columns account-header">
                <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                    <!-- Title -->
                   <page-title :title="title"></page-title>
                    <div class="listing-controls">
                        <div class="layout-controls">
                            <button class="button is-primary is-link">
                                <b-icon icon="check-all" type="is-light"></b-icon>
                                <span>Save changes</span>
                            </button>
                        </div>
                        <!-- Sort -->
                        <div class="language-box">
                            <b-field>
                                <b-radio-button v-model="language" :native-value="lang.code" v-for="(lang, index) in languages" v-bind:key="index">
                                    <span>{{lang.name}}</span>
                                </b-radio-button>
                            </b-field>
                        </div>
                    </div>

                    <!-- Account layout -->
                    <div class="columns is-account-grid is-multiline is-element-details">
                        <div class="column is-8">
                            <!-- User card -->
                            <div class="flat-card is-component profile-info-card is-auto">
                                <div class="card-body">
                                    <b-field label="Title" type="is-default">
                                        <multilanguage-input v-model="product" param="name" :language.sync="language"></multilanguage-input>
                                    </b-field>
                                    <b-field label="Description" type="is-default">
                                        <multilanguage-mce v-model="product" param="description" :language.sync="language"></multilanguage-mce>
                                    </b-field>
                                </div>
                            </div>
                            <!-- Gold Customer card -->
                            <div class="flat-card profile-info-card is-auto overflow-visible is-no-border"><!-- Title -->
                                <div class="card-title">
                                    <h3>Product images</h3>
                                    <div class="edit-account has-simple-popover popover-hidden-mobile" data-content="Edit Account" data-placement="top">
                                        <a  @click="openImageChooser"> <feather-upload-cloud></feather-upload-cloud></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="empty-cart-card" v-if="!product.images.length">
                                        <div class="empty-cart has-text-centered">
                                            <img src="/images/icons/new-cart.svg" alt="">
                                            <a @click="openImageChooser" class="button big-button rounded">Add product images</a>
                                            <small>Not added images to product yet!</small>
                                        </div>
                                    </div>

                                    <div class="product-images">
                                        <draggable v-model="product.images">
                                            <div class="product-image" :class="{'is-6':index==0, 'is-3':index != 0}" v-for="(image, index) in product.images">
                                                <div class="image" :class="{'is-256x256':index==0, 'is-128x128':index!=0}">
                                                    <img :src="image"/>

                                                    <div class="overlay">
                                                        <b-tooltip label="Remove">
                                                            <a @click="removeImage(index)">
                                                                <b-icon icon="delete" type="is-white"></b-icon>
                                                            </a>
                                                        </b-tooltip>
                                                    </div>
                                                </div>
                                            </div>
                                        </draggable>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Details -->
                        <div class="column is-4">
                            <div class="flat-card profile-info-card is-auto overflow-visible is-no-border">
                                <!-- Title -->
                                <div class="card-title">
                                    <h3>Product availability</h3>
                                </div>
                                <!-- Contact Info -->
                                <div class="card-body">
                                    <div class="control">
                                        <label>Status</label>
                                        <chosen-select v-model='product.status'>
                                            <option :value="st.code" v-for="st in status">{{st.name}}</option>
                                        </chosen-select>
                                    </div>
                                </div>
                                <!-- Background Nephos Icon -->
                                <img class="card-bg" src="assets/images/logo/nephos-greyscale.svg" alt="">
                            </div>

                            <!-- Price Info -->
                            <div class="flat-card profile-info-card is-auto is-no-border">
                                <!-- Title -->
                                <div class="card-title">
                                    <h3>Prices</h3>
                                </div>
                                <!-- Billing Address -->
                                <div class="card-body">
                                    <b-field label="Price" type="is-default">
                                        <money-input v-model="product.price"></money-input>
                                    </b-field>
                                    <b-field label="Compare Price" type="is-default">
                                        <money-input v-model="product.regular_price"></money-input>
                                    </b-field>
                                </div>
                                <!-- /Address Form -->
                            </div>

                            <!-- Organization -->
                            <div class="flat-card profile-info-card product-organization-card is-auto is-no-border overflow-visible">
                                <!-- Title -->
                                <div class="card-title">
                                    <h3>Organization</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Brand -->
                                    <b-field label="Brand" type="is-default">
                                       <brand-chooser v-model="product.brand_id"></brand-chooser>
                                    </b-field>
                                    <!-- /Brand -->
                                    <hr/>
                                    <!-- Category -->
                                    <b-field label="Category" type="is-default">
                                        <categories-chooser v-model="product.categories"></categories-chooser>
                                    </b-field>
                                    <!-- /Category -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <image-chooser @onDone="onSelectedImage" ref="imageChooser"></image-chooser>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    import ProductApi from '@/services/api/products';
    import BrandChooser from "../../components/general/ProductBrandChooser.vue";
    import MultilanguageMce from "../../components/general/MultilanguageMce.vue";

    export default {
        data: function() {
            return {
                languages: this.$store.state.languages,
                language: 'en',
                loading: true,
                product: {
                    images: [],
                    status: 'FEATURED',
                    price: 0,
                    regular_price: 0,
                    brand_id: 0,
                    categories: []
                },
                isImageChooserShow: true,
            };

        },
        computed: {
            title:function () {
                return this.product.id?'EDIT PRODUCT':'ADD PRODUCT';
            },
            status: function(){
                return ProductApi.status;
            }
        },
        methods: {
            getProductDetail: function(){
                let self = this;
                self.loading = true;
                ProductApi.show(this.$route.params.id).then(function(response){
                    self.loading = false;
                    self.product = response.data;
                });
            },
            openImageChooser : function(){
                this.$refs.imageChooser.open();
            },
            onSelectedImage: function(images){
                var _this = this;
                if(this.product.images){
                    images.forEach(function(image){
                        _this.product.images.push(image);
                    })
                }else{
                    _this.product.images = images;
                }
                localStorage.setItem('images', JSON.stringify(images));
            },
            removeImage: function(index){
                this.$dialog.confirm({
                    title: 'Deleting image',
                    message: 'Are you sure you want to <b>delete</b> this image?',
                    confirmText: 'Delete image',
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => {
                        this.product.images.splice(index,1);
                    }
                })
            }
        },
        mounted: function(){
            //Get product data
            if(this.$route.params.id != 'new' && this.$route.params.id > 0){
                this.getProductDetail();
                return;
            }
            this.loading = false;
        },
        components:{
            MultilanguageMce,
            BrandChooser,
            draggable
        }
    };
</script>

<style>
    .product-images{
        margin: -5px;
    }

    .product-images:before, .product-images:after{
        content: '';
        display: table;
        clear: both;
    }

    .product-images .product-image{
        width: 25%;
        float: left;
        padding: 5px;
    }

    .product-images .product-image:first-child{
        width: 50%;
    }

    .product-images .product-image:nth-child(6){
        clear: left;
    }

    .product-images .image{
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        position: relative; /* If you want text inside of it */
        margin: 0;
        border-radius: 4px;
        overflow: hidden;
        cursor: move;
    }

    .product-images .image:hover{
        opacity: 0.9;
    }

    .product-images .image img{
        margin: 0;
        max-width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        height: 100%;
    }

    .product-images .overlay{
        position: absolute;
        width: 100%;
        bottom: 0;
        background: linear-gradient(transparent, #000);
        padding: 10px 0 0px;
    }
</style>