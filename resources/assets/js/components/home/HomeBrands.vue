<template>
    <div class="brand-grid" v-if="brands">
        <div class="brand" v-for="(brand, index) in brands">
            <a :href="brand.link" :title="brand.name">
                <img class="lazyload" :data-src="brand.logo|image('medium')" alt="brand">
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: [],
        data () {
            return {
                loading: false,
                brands: null,
                error: null
            }
        },
        created(){
            this.fetchData()
        },
        methods: {
            fetchData() {
                var vm = this;

                this.error = this.brands = null;
                this.loading = true;
                axios.get('/api/'+ LANG +'/brand/list?featured_only=true').then((response) => {
                    vm.brands = response.data.data;
                    this.loading = false
                });
            }
        },
    }
</script>
