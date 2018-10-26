<template>
    <div class="section">
        <div class="container">
            <div class="columns account-header">
                <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                    <!-- Title -->
                   <page-title title="PRODUCT DETAIL"></page-title>

                    <!-- Account layout -->
                    <div class="columns is-account-grid is-multiline is-element-details">
                        <div class="column is-8">
                            <!-- User card -->
                            <div class="flat-card is-component profile-info-card is-auto">
                                <!-- Title -->
                                <div class="card-title">
                                    <h3>Product details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="control">
                                        <label>Title</label>
                                        <input class="input is-default" type="text" placeholder="">
                                    </div>
                                    <div class="control">
                                        <label>Description</label>
                                        <vue-mce :config="config" />
                                    </div>
                                </div>
                            </div>
                            <!-- Gold Customer card -->
                            <div class="flat-card profile-info-card is-auto">
                                <div class="card-body">
                                    <div class="columns">
                                        <div class="column">
                                            <div class="image-upload">
                                                <file-pond
                                                        name="images"
                                                        ref="pond"
                                                        allow-multiple="true"
                                                        accepted-file-types="image/jpeg, image/png, image/gif"
                                                        :server="serverOptions"
                                                        class="no-margin"
                                                        v-bind:files="myFiles"
                                                        v-on:init="handleFilePondInit"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Referal card -->
                            <div class="flat-card profile-info-card is-auto is-dark is-achievement">
                                <div class="card-body">
                                    <img src="assets/images/logo/nephos-referral.svg" alt="">
                                    <div class="achievement-name">
                                        <span class="is-green">Nephos Referer</span>
                                        <span>You have referred <b>30+</b> customers. You get a 2.5% discount on all your purchases.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="column is-4">
                            <div class="flat-card profile-info-card is-auto">
                                <!-- Title -->
                                <div class="card-title">
                                    <h3>Account details</h3>

                                    <div class="edit-account has-simple-popover popover-hidden-mobile" data-content="Edit Account" data-placement="top">
                                        <a href="account-edit.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings feather-icons"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                                    </div>
                                </div>
                                <!-- Contact Info -->
                                <div class="card-body">
                                    <div class="columns">
                                        <div class="column is-6">
                                            <div class="info-block">
                                                <span class="label-text">First Name</span>
                                                <span class="label-value">Elie</span>
                                            </div>

                                            <div class="info-block">
                                                <span class="label-text">Email</span>
                                                <span class="label-value">eliedaniels@gmail.com</span>
                                            </div>
                                        </div>

                                        <div class="column is-6">
                                            <div class="info-block">
                                                <span class="label-text">Last Name</span>
                                                <span class="label-value">Daniels</span>
                                            </div>

                                            <div class="info-block">
                                                <span class="label-text">Phone</span>
                                                <span class="label-value">+1 555 623 568</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Background Nephos Icon -->
                                <img class="card-bg" src="assets/images/logo/nephos-greyscale.svg" alt="">
                            </div>

                            <!-- Address Info -->
                            <div class="flat-card profile-info-card is-auto">
                                <!-- Title -->
                                <div class="card-title">
                                    <h3>Billing address</h3>
                                    <!-- Cog Button -->
                                    <div class="edit-account is-vhidden">
                                        <a href="account-edit.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings feather-icons"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                                    </div>

                                </div>
                                <!-- Billing Address -->
                                <div class="card-body">
                                    <div class="columns">
                                        <div class="column is-6">
                                            <div class="info-block">
                                                <span class="label-text">Number</span>
                                                <span class="label-value">23, Block C2</span>
                                            </div>

                                            <div class="info-block">
                                                <span class="label-text">City</span>
                                                <span class="label-value">Los Angeles</span>
                                            </div>

                                            <div class="info-block">
                                                <span class="label-text">State</span>
                                                <span class="label-value">CA</span>
                                            </div>
                                        </div>

                                        <div class="column is-6">
                                            <div class="info-block">
                                                <span class="label-text">Street</span>
                                                <span class="label-value">Church Street</span>
                                            </div>

                                            <div class="info-block">
                                                <span class="label-text">Postal Code</span>
                                                <span class="label-value">100065</span>
                                            </div>

                                            <div class="info-block">
                                                <span class="label-text">Country</span>
                                                <span class="label-value">United States</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Address Form -->
                            </div>
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
    import PageTitle from "../../components/general/PageTitle.vue";

    // Create component
    const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

    export default {
        data: function() {
            return {
                myFiles: [],
                serverOptions: {
                    url: '/upload',
                    method: 'POST',
                    process: {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                },
                config: {
                    themes: 'oxide',
                    branding: false,
                    menubar: false,
                    min_height: 200,
                    statusbar: false,
                    extended_valid_elements: 'img[class=myclass|!src|border:0|alt|title|width|height|style]',
                    plugins: 'print preview fullpage autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr lists textcolor imagetools colorpicker textpattern autoresize autolink code',
                    toolbar: 'bold italic strikethrough | forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist | image media | code',
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
            PageTitle,
            FilePond
        }
    };
</script>