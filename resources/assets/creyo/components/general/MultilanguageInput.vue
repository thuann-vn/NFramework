<template>
    <div>
        <div v-for="lang in languages">
            <b-input v-model="value[param]" v-if="lang.code==defaultLanguage && language==defaultLanguage"></b-input>
            <b-input v-model="value[param+ '_' + lang.code]" v-if="lang.code!=defaultLanguage && lang.code==language"></b-input>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'multilanguage-input',
        props: ['value', 'param', 'language'],
        data: function(){
            return {
                defaultLanguage: this.$store.state.defaultLanguage,
                languages: this.$store.state.languages,
            }
        }
    };
</script>