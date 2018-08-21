<template>
    <ul class="main-menu-wrap">
        <li v-for="(item, index) in items">
            <a :href="item.link">
                {{ item.title }}
                <span></span>
            </a>

            <div class="mega-menu" v-if="item.is_mega">
                <div class="mega-menu-title">{{item.title}}</div>
                <div class="mega-menu-wrap">
                    <div class="mega-menu-col" v-for="(column, columnIndex) in item.children">
                        <div v-for="(columSection) in column.children">
                            <p class="mega-menu-section-title">{{columSection.title}}</p>
                            <ul>
                                <li v-for="(megaItem, columnIndex) in columSection.children">
                                    <a :href="megaItem.link" :title="megaItem.title">{{megaItem.title}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mega-menu-col mega-menu-image" v-if="item.mega_option">
                        <img :src="item.mega_option.img"/>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        data () {
            return {
                loading: false,
                items: null,
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

                axios.get('/api/menu/get/main').then((response) => {
                    vm.items = response.data;
                    this.loading = false
                })
            }
        },
        updated() {
            if(this.items){
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
