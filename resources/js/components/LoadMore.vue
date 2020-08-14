<template>
<div>
    <div class="text-center" v-if="shouldLoadMore">
        <button class="btn btn-sm btn-primary" @click.prevent="loadMore" :disabled="loading">
            <b-spinner small v-if="loading"></b-spinner> Load More
        </button>
    </div>
</div>
</template>

<script>
export default {
    props:['dataSet', 'loading'],

    data() {
        return {
            page: 1,
            prevUrl: false,
            nextUrl: false,
            last_page: false,
            total: false,
        }
    },

    created() {
        this.updateDataSet();
    },

    watch: {
        dataSet() {
            this.updateDataSet();
        },
        page() {
            this.fetch();
        }
    },

    computed: {
        shouldLoadMore() {
            return this.page != this.last_page && this.total > 10;
        }
    },

    methods: {
        updateDataSet() {
            this.page = this.dataSet.current_page;
            this.prevUrl = this.dataSet.prev_page_url;
            this.nextUrl = this.dataSet.next_page_url;
            this.last_page = this.dataSet.last_page;
            this.total = this.dataSet.total;
        },
        loadMore() {
            if(this.page != this.last_page) { this.page++; }
        },
        fetch() {
            return this.$emit('changed', this.page);
        }
    }

}
</script>
