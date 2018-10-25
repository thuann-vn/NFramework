<template>
    <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
        <a class="pagination-previous" @click="onClickPreviousPage" :disabled="isInFirstPage">Previous</a>
        <a class="pagination-next" @click="onClickNextPage" :disabled="isInLastPage">Next page</a>

        <ul class="pagination-list">
            <li v-for="page in pages">
                <a class="pagination-link" aria-label="Goto page 1"
                    @click="onClickPage(page.name)"
                     :disabled="page.isDisabled"
                     :class="{ 'is-current': isPageActive(page.name) }"
                     :aria-label="`Go to page number ${page.name}`">
                    {{ page.name }}
                </a>
            </li>
        </ul>
    </nav>
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
        computed: {
            startPage() {
                if (this.currentPage === 1) {
                    return 1;
                }

                if (this.currentPage === this.totalPages) {
                    return this.totalPages - this.maxVisibleButtons + 1;
                }

                return this.currentPage - 1;

            },
            endPage() {

                return Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);

            },
            pages() {
                const range = [];

                for (let i = this.startPage; i <= this.endPage; i+= 1 ) {
                    range.push({
                        name: i,
                        isDisabled: i === this.currentPage
                    });
                }

                return range;
            },
            isInFirstPage() {
                return this.currentPage === 1;
            },
            isInLastPage() {
                return this.currentPage === this.totalPages;
            },
        },
        methods: {
            onClickFirstPage() {
                this.$emit('pagechanged', 1);
            },
            onClickPreviousPage() {
                this.$emit('pagechanged', this.currentPage - 1);
            },
            onClickPage(page) {
                this.$emit('pagechanged', page);
            },
            onClickNextPage() {
                this.$emit('pagechanged', this.currentPage + 1);
            },
            onClickLastPage() {
                this.$emit('pagechanged', this.totalPages);
            },
            isPageActive(page) {
                return this.currentPage === page;
            },
        }
    };
</script>