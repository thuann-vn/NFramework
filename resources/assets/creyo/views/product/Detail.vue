<template>
    <div class="section">
        <div class="container">
            <div class="columns is-account-grid is-multiline">
                <div class="column is-8">
                    <div class="flat-card upload-card is-auto">
                        <div class="card-body">
                            <vue-mce :config="config" />
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="flat-card upload-card is-auto">
                        <div class="card-body">
                            <file-pond
                                    name="images"
                                    ref="pond"
                                    label-idle="Drop files here..."
                                    allow-multiple="true"
                                    accepted-file-types="[image/*]"
                                    server="/api"
                                    v-bind:files="myFiles"
                                    v-on:init="handleFilePondInit"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // Import Vue FilePond
    import vueFilePond from 'vue-filepond';

    // Import FilePond styles
    import 'filepond/dist/filepond.min.css';

    // Import FilePond plugins
    // Please note that you need to install these plugins separately

    // Import image preview plugin styles
    import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

    // Import image preview and file type validation plugins
    import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
    import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

    // Create component
    const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

    export default {
        data: function() {
            return {
                myFiles: ['cat.jpeg'],
                config: {
                    themes: 'oxide',
                    branding: false,
                    menubar: false,
                    min_height: 200,
                    statusbar: false,
                    extended_valid_elements: 'img[class=myclass|!src|border:0|alt|title|width|height|style]',
                    plugins: 'print preview fullpage autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr lists textcolor imagetools colorpicker textpattern autoresize autolink code',
                    toolbar: 'formatselect bold italic strikethrough | forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | image media | code',
                    image_advtab: true,
                    content_css: [
                        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                        '//www.tinymce.com/css/codepen.min.css'
                    ]
                },
            };

        },
        methods: {
            handleFilePondInit: function() {
                console.log('FilePond has initialized');

                // FilePond instance methods are available on `this.$refs.pond`
            }
        },
        components: {
            FilePond
        }
    };
</script>