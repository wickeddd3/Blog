<template>
<div>
    <div v-if="items.length > 0">
        <div v-for="(comment, index) in items" :key="comment.id">
            <comment :data="comment" @deleted="remove(index)"></comment>
        </div>
        <!-- <load-more :dataSet="dataSet" @changed="fetch"></load-more> -->
    </div>
    <p class="heading-secondary center" v-else>No comments yet.</p>
    <new-comment @created="add"></new-comment>
</div>
</template>

<script>
import Comment from './Comment.vue'
import LoadMore from './LoadMore'
import NewComment from './NewComment'
import collection from '../mixins/collection'

export default {
    components: {
        Comment,
        LoadMore,
        NewComment
    },

    mixins:[collection],

    data() {
        return {
            dataSet: false
        }
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch(page) {
            if(! page) {
                let query = location.search.match(/page=(\d+)/);
                page = query ? query[1] : 1;
            }
            axios.get(`${location.pathname}/comments?page=${page}`)
                 .then(({data}) => {
                    let items = data.data;
                    this.dataSet = data;
                    this.items = [...this.items, ...items];
            });
        },
    }
}
</script>
