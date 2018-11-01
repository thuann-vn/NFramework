<template>
    <div class="categories-chooser">
        <treeselect v-if="!isLoading" v-model="value" placeholder="Choose categories..." search-nested :multiple="true" :flat="true" :options="categories" :default-expand-level="1" @input="inputChanged" sortValueBy="INDEX"></treeselect>
        <b-loading :is-full-page="false" :active.sync="isLoading" :can-cancel="false"></b-loading>
    </div>
</template>
<script>
    import CategoriesAPI from '@/services/api/categories';

    export default {
        name: 'category-chooser',
        props: ['value'],
        data: function () {
            return {
                categories: [],
                isLoading: true,
            }
        },
        computed: {
        },
        methods: {
            inputChanged(event) {
                this.$emit('input', this.value)
            }
        },
        mounted: function () {
            let self = this;
            CategoriesAPI.getCategories().then(response => {
                response.data.forEach(function (cat) {
                    cat.opened = false;
                    cat.label = cat.name;

                    if(self.value.indexOf(cat.id)>=0){
                        cat.selected = true;
                    }else{
                        cat.selected = false;
                    }
                    //Get child selected
                    cat.children.forEach(function (child) {
                        child.opened = false;
                        child.label = child.name;
                        delete child.children;

                        if(self.value.indexOf(child.id)>=0){
                            child.selected = true;
                            cat.opened = true;
                        }else{
                            child.selected = false;
                        }
                    })
                });
                this.categories = response.data;
            }).finally(()=>{
                this.isLoading = false;
            });
        },
    };
</script>