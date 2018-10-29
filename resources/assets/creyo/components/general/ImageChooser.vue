<template>
    <div>
        <button class="button is-primary is-medium"
                @click="isCardModalActive = true">
            Launch image modal
        </button>
        <b-modal :active.sync="isCardModalActive" :width="640" scroll="keep">
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">Library</p>
                </header>
                <section class="modal-card-body no-padding">
                    <b-tabs v-model="activeTab">
                        <b-tab-item>
                            <template slot="header">
                                <span v-feather data-feather="image"></span>
                                <span> Gallery</span>
                            </template>
                            <vue-select-image :dataImages="dataImages"
                                              :is-multiple="true"
                                              :selectedImages="initialSelected"
                                              @onselectmultipleimage="onSelectMultipleImage">
                            </vue-select-image>
                        </b-tab-item>
                        <b-tab-item>
                            <template slot="header">
                                <span v-feather data-feather="upload-cloud"></span>
                                <span> Upload</span>
                            </template>

                            <div class="image-upload">
                                <file-pond
                                        name="images"
                                        ref="pond"
                                        allow-multiple="true"
                                        allow-revert="false"
                                        accepted-file-types="image/jpeg, image/png, image/gif"
                                        :server="serverOptions"
                                        class="no-margin"
                                        v-bind:files="myFiles"
                                        v-on:init="handleFilePondInit"/>
                            </div>
                        </b-tab-item>
                    </b-tabs>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="$parent.close()">Close</button>
                    <button class="button is-primary">Ok</button>
                </footer>
            </div>
        </b-modal>
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
    const FilePond = vueFilePond(FilePondPluginFileValidateType);

    export default {
        name: 'image-chooser',
        data() {
            return {
                images: [],
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
                isImageModalActive: false,
                isCardModalActive: false,
                activeTab: 0,
                showBooks: false
            }
        },
        methods: {
            getData(page=1){
                this.meta.current_page = page;
                axios.get(this.$store.state.API_URL + 'images?page='+page)
                    .then(response => {
                        this.images = response.data.data;
                        this.meta = response.data.meta;
                    }).catch(error => {
                    this.errored = true
                }).finally(() => this.loading = false);
            }
        }
    };
</script>