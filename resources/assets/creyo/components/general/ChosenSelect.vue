<template>
    <select :multiple="multiple"><slot></slot></select>
</template>
<script>
    export default {
        props:{
            value: [String, Array, Number],
            placeholder: [String],
            multiple: Boolean
        },
        mounted(){
            $(this.$el)
                .val(this.value)
                .chosen({
                    disable_search_threshold: 10,
                    placeholder: this.placeholder ? this.placeholder : ''
                })
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