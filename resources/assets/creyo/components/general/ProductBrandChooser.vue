<template>
    <chosen-select v-model='selectedBrand' placeholder="Please select a brand" v-if="!isLoading">
        <option :value="br.id" v-for="br in brands">{{br.name}}</option>
    </chosen-select>
</template>
<script>
    import BrandsApi from '@/services/api/brands';

    export default {
        name: 'brand-chooser',
        props: ['value'],
        data: function () {
            return {
                selectedBrand: null,
                brands: [],
                isLoading: true,
            }
        },
        computed: {
        },
        methods: {
            inputChanged(event) {
                this.$emit('input', this.selectedBrand)
            }
        },
        watch: {
            value: function (val) {
                this.selectedBrand = val;
            },
        },
        mounted: function () {
            let self = this;
            self.selectedBrand = self.value;
            BrandsApi.list().then(response => {
                self.brands = response.data;
            }).finally(()=>{
                self.isLoading = false;
            });
        },
    };
</script>