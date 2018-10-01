<template>
    <div class="product">
        <a :href="data.link">
            <img class="lazyload" :data-src="data.image|image('small')" alt="product">
        </a>
        <div class="product-info">
            <a class="product-brand" :href="data.link" v-if="data.brand">{{data.brand.name}}</a>
            <a :href="data.link">
                <div class="product-name">{{ data.name }}</div>
            </a>
            <div class="product-regular-price" v-if="data.regular_price">{{data.regular_price|price}}</div>
            <div class="product-price">{{data.price|price}}</div>
        </div>

        <span class="cart-button" v-if="data.in_cart">
            <span class="cart-icon"></span>
        </span>

        <!-- Cart button -->
        <span v-if="data.in_cart" class="cart-button">
            <span class="cart-icon"></span>
        </span>
        <a v-else-if="data.variant_count>0" :href="data.link" class="cart-button add-to-cart" :data-id="data.id">
            <span class="cart-icon empty"></span>
        </a>
        <a v-else href="javascript:;" class="cart-button add-to-cart not-added" :data-id="data.id">
            <span class="cart-icon empty"></span>
        </a>

        <!-- Wish button -->
        <span v-if="data.in_wishlist" class="wishlist-button" :data-id="data.id">
            <span class="cart-icon heart"></span>
        </span>
        <a :href="'/wish-list/add/' + data.id" v-else class="wishlist-button add-to-wishlist">
            <span class="cart-icon heart empty"></span>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['data'],
    }
</script>
