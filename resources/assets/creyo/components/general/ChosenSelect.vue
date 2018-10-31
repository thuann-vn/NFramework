<template>
    <select :multiple="multiple"><slot></slot></select>
</template>
<script>
    export default {
        props:{
            value: [String, Array],
            multiple: Boolean
        },
        mounted(){
            $(this.$el)
                .val(this.value)
                .chosen({disable_search_threshold: 10})
                .on("change", e => this.$emit('input', $(this.$el).val()))
        },
        watch:{
            value(val){
                $(this.$el).val(val).trigger('chosen:updated');
            }
        },
        destroyed() {
            $(this.$el).Chosen('destroy');
        }
    };
</script>