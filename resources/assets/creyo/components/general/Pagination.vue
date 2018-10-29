<template>
    <b-pagination
            :total="total"
            :current.sync="currentPage"
            :per-page="perPage"
            @change="onChangePage">
    </b-pagination>
</template>
<script>
    export default {
        name: 'pagination',
        props: {
            maxVisibleButtons: {
                type: Number,
                required: false,
                default: 5
            },
            totalPages: {
                type: Number,
                required: true
            },
            total: {
                type: Number,
                required: true
            },
            perPage: {
                type: Number,
                required: true
            },
            currentPage: {
                type: Number,
                required: true
            },
        },
        methods: {
            onChangePage(currentPage) {
                this.$emit('pagechanged', currentPage);
            },
        }
    };
</script>