<template>
    <b-input v-cleave="masks.numeral" v-model="formatedValue" @input.native="getRawValue" type="is-default"></b-input>
</template>
<script>
    export default {
        name: 'money-input',
        props: ['value'],
        data: function(){
            return {
                formatedValue: this.value,
                masks: {
                    numeral: {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand',
                        suffix: 'vnd'
                    }
                }
            }
        },
        methods: {
            getRawValue(event) {
                this.$emit('input', event.target._vCleave.getRawValue())
            }
        }
    };
</script>