<template>
<div>
    <div class="container m-t-1 center" v-if="shouldLoadMore">
        <button class="btn btn__loadmore"
                @click.prevent="loadMore"
                :disabled="loading">
            Load More
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
