<template>
    <div class="image-chooser">
        <b-modal :active.sync="isActive" :width="640" scroll="keep">
            <div class="modal-card" style="width: auto">
                <header class="modal-card-head">
                    <p class="modal-card-title">Library</p>
                </header>
                <section class="modal-card-body no-padding">
                    <b-tabs v-model="activeTab">
                        <b-tab-item label="Gallery" icon="google-photos">
                            <div class="columns is-multiline is-mobile">
                                <div class="column" v-for="(image, index) in images">
                                    <div class="image is-128x128" :class="{ 'active': image.selected}"
                                         @click="selectImage(image, index)">
                                        <img :src="image.file_path"/>
                                        <b-checkbox v-model="image.selected"></b-checkbox>
                                    </div>
                                </div>
                            </div><!--Pagination-->
                            <pagination v-if="meta.last_page>1" :totalPages="meta.last_page" :total="meta.total"
                                        :perPage="meta.per_page" :currentPage="meta.current_page"
                                        @pagechanged="getData"></pagination>
                            <b-loading :active.sync="loading" :is-full-page="false" :can-cancel="false"></b-loading>
                        </b-tab-item>
                        <b-tab-item label="Upload" icon="cloud-upload">
                            <div class="image-upload">
                                <file-pond
                                        name="images"
                                        ref="pond"
                                        allow-multiple="true"
                                        allow-revert="false"
                                        accepted-file-types="image/jpeg, image/png, image/gif"
                                        :server="serverOptions"
                                        class="no-margin"
                                        v-bind:files="myFiles"/>
                            </div>
                        </b-tab-item>
                    </b-tabs>
                </section>
                <footer class="modal-card-foot">
                    <button class="button" type="button" @click="close">Close</button>
                    <button class="button is-primary" @click="ok">Ok</button>
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
                isActive: false,
                loading: false,
                meta: {},
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
                activeTab: 0
            }
        },
        methods: {
            selectImage: function (image) {
                Vue.set(image, 'selected', !image.selected);
            },
            getData(page = 1) {
                this.loading = true;
                this.meta.current_page = page;
                axios.get(this.$store.state.API_URL + 'images?page=' + page)
                    .then(response => {
                        this.images = response.data.data;
                        this.meta = response.data.meta;
                    }).catch(error => {
                    this.errored = true
                }).finally(() => this.loading = false);
            },
            open: function () {
                this.isActive = true;
                this.getData();
            },
            ok: function () {
                let selectedImages = [];
                this.images.forEach(function (image) {
                    if (image.selected) {
                        selectedImages.push(_.merge({}, image));
                    }
                });

                this.$emit('onDone', selectedImages);
                this.isActive = false;
            },
            close: function () {
                this.$emit('onDone', []);
                this.isActive = false;
            }
        },
        mounted: function () {
        }
    };
</script>