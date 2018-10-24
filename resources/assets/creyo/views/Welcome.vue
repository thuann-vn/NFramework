<template>
    <div>
        <!-- Search overlay -->
        <div class="search-overlay"></div>

        <!-- Search input -->
        <div class="search-input-wrapper is-desktop is-hidden">
            <div class="field">
                <div class="control">
                    <input type="text" name="search" autofocus required>
                    <span id="clear-search" role="button"><i data-feather="x"></i></span>
                    <span class="search-help">Type the name of the product you are looking for</span>
                </div>
            </div>
        </div>
        <!-- Main section -->
        <div class="section">
            <!-- Container -->
            <div class="container">

                <!-- Product Categories Grid -->
                <div class="columns category-header">
                    <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                        <!-- Title -->
                        <div class="category-title no-border is-padded">
                            <h2>SHOP</h2>
                            <img class="brand-filigrane" src="/images/logo/nephos-greyscale.svg" alt="">
                        </div>

                        <div class="is-categories-grid">
                            <!-- Tile Grid -->
                            <div class="tile is-ancestor">
                                <div class="tile is-vertical is-8">
                                    <div class="tile">
                                        <div class="tile is-parent is-vertical">
                                            <!-- Accessories Tile -->
                                            <article class="tile is-child has-background-image" data-background="/images/bg/accessories.jpeg" onClick="return true">
                                                <div class="tile-content is-small">
                                                    <!-- Category name -->
                                                    <h2 class="shop-category is-small">Accessories</h2>
                                                    <!-- Animated divider -->
                                                    <div class="divider"></div>
                                                    <!-- Category subtitle -->
                                                    <p>Inner Comfort</p>
                                                    <!-- Category description -->
                                                    <p class="is-italic">Finest products collected amongst the countrie's best artisans.</p>
                                                    <!-- Products number -->
                                                    <div class="products is-absolute">
                                                        119 <span>Products</span>
                                                    </div>
                                                    <!-- View category link -->
                                                    <a href="products.html" class="action">
                                                        <span>Discover</span>
                                                        <i data-feather="chevron-right"></i>
                                                    </a>
                                                </div>
                                                <!-- Overlay -->
                                                <div class="tile-overlay"></div>
                                            </article>
                                            <!-- Kitchen Tile -->
                                            <article class="tile is-child has-background-image" data-background="/images/bg/kitchen.jpeg" onClick="return true">
                                                <div class="tile-content is-small">
                                                    <h2 class="shop-category is-small">Kitchen</h2>
                                                    <div class="divider"></div>
                                                    <p>Inner Comfort</p>
                                                    <p class="is-italic">Finest products collected amongst the countrie's best artisans.</p>
                                                    <div class="products is-absolute">
                                                        187 <span>Products</span>
                                                    </div>
                                                    <a href="products.html" class="action">
                                                        <span>Discover</span>
                                                        <i data-feather="chevron-right"></i>
                                                    </a>
                                                </div>
                                                <!-- Overlay -->
                                                <div class="tile-overlay"></div>
                                            </article>
                                        </div>
                                        <!-- House Tile -->
                                        <div class="tile is-parent">
                                            <article class="tile is-child has-min-height has-background-image" data-background="/images/bg/house.jpeg" onClick="return true">
                                                <div class="tile-content">
                                                    <h2 class="shop-category">House</h2>
                                                    <div class="divider"></div>
                                                    <p>Inner Comfort</p>
                                                    <p class="is-italic">Finest products collected amongst the countrie's best artisans.</p>
                                                    <div class="products">
                                                        268 <span>Products</span>
                                                    </div>
                                                    <a href="products.html" class="action">
                                                        <span>Discover</span>
                                                        <i data-feather="chevron-right"></i>
                                                    </a>
                                                </div>
                                                <!-- Overlay -->
                                                <div class="tile-overlay"></div>
                                            </article>
                                        </div>
                                    </div>
                                    <!-- Kids Tile -->
                                    <div class="tile is-parent">
                                        <article class="tile is-child is-danger has-min-height has-background-image" data-background="/images/bg/kids.jpg" onClick="return true">
                                            <div class="tile-content">
                                                <h2 class="shop-category">For kids</h2>
                                                <div class="divider"></div>
                                                <p>Their Playground</p>
                                                <p class="is-italic">Finest products collected amongst the countrie's best artisans.</p>
                                                <div class="products">
                                                    376 <span>Products</span>
                                                </div>
                                                <a href="products.html" class="action">
                                                    <span>Discover</span>
                                                    <i data-feather="chevron-right"></i>
                                                </a>
                                            </div>
                                            <!-- Overlay -->
                                            <div class="tile-overlay"></div>
                                        </article>
                                    </div>
                                </div>
                                <!-- Office Tile -->
                                <div class="tile is-parent">
                                    <article class="tile is-child has-background-image" data-background="/images/bg/office.jpeg" onClick="return true">
                                        <div class="tile-content">
                                            <h2 class="shop-category">Office</h2>
                                            <div class="divider"></div>
                                            <p>Premium Office furniture</p>
                                            <p class="is-italic">Finest products collected amongst the countrie's best artisans.</p>
                                            <div class="products">
                                                391 <span>Products</span>
                                            </div>
                                            <a href="products.html" class="action">
                                                <span>Discover</span>
                                                <i data-feather="chevron-right"></i>
                                            </a>
                                        </div>
                                        <div class="tile-overlay"></div>
                                    </article>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- /House products -->

            </div>
            <!-- /Container -->
        </div>
        <!-- /Main section -->
    </div>
</template>
<script>
    export default {}
</script>