<template>
    <div class="categories-chooser">
        <v-jstree :data="categories" text-field-name="name" value-field-name="id" show-checkbox multiple whole-row @item-click="itemClick"></v-jstree>
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
            selectedCategories: function () {
                let result = [];
                this.categories.forEach(function (cat) {
                    if (cat.selected) {
                        result.push(cat.id);
                    }

                    //Get child selected
                    cat.children.forEach(function (child) {
                        if (child.selected) {
                            result.push(child.id);
                        }
                    })
                });
                return result;
            }
        },
        methods: {
            itemClick(event) {
                this.$emit('input', this.selectedCategories)
            }
        },
        mounted: function () {
            let self = this;
            CategoriesAPI.getCategories().then(response => {
                response.data.forEach(function (cat) {
                    cat.opened = false;

                    if(self.value.indexOf(cat.id)>=0){
                        cat.selected = true;
                    }else{
                        cat.selected = false;
                    }
                    //Get child selected
                    cat.children.forEach(function (child) {
                        child.opened = false;

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
        }
    };
</script>