<template>
    <div>
        <div v-for="lang in languages">
            <vue-mce :config="config" v-model="value[param]" v-if="lang.code==defaultLanguage && language==defaultLanguage"/>
            <vue-mce :config="config" v-model="value[param+ '_' + lang.code]" v-if="lang.code!=defaultLanguage && lang.code==language"/>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'multilanguage-mce',
        props: ['value', 'param', 'language'],
        data: function(){
            return {
                defaultLanguage: this.$store.state.defaultLanguage,
                languages: this.$store.state.languages,
                config: {
                    themes: 'oxide',
                    branding: false,
                    menubar: false,
                    min_height: 200,
                    statusbar: false,
                    extended_valid_elements: 'img[class=myclass|!src|border:0|alt|title|width|height|style]',
                    plugins: 'print preview fullpage autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr lists textcolor imagetools colorpicker textpattern autoresize autolink code',
                    toolbar: 'bold italic strikethrough | forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist | image media | code',
                    image_advtab: true
                },
            }
        }
    };
</script>