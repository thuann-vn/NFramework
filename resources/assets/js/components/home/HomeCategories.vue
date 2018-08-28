<template>
    <div class="categories text-center" v-if="categories">
        <div class="category" v-for="(category, index) in categories">
            <a :href="category.link"><img :src="category.image|image('medium')" alt="category"></a>
            <a class="category-name" :href="category.link">
                {{category.name}}
            </a>
        </div>
    </div> <!-- end categories -->
</template>

<script>
    export default {
        props: [],
        data () {
            return {
                loading: false,
                categories: null,
                error: null
            }
        },
        created(){
            this.fetchData()
        },
        methods: {
            fetchData() {
                var vm = this;

                this.error = this.categories = null;
                this.loading = true;
                axios.get('/api/'+ LANG +'/category/list?home_featured=true&page_size=16').then((response) => {
                    vm.categories = response.data.data;
                    this.loading = false
                });
            }
        },
    }
</script>
