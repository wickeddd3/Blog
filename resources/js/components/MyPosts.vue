<template>
<div>
    <template v-if="all_posts.length > 0">
        <div class="panel" v-for="post in all_posts" :key="post.id">
            <div class="panel__item">
                <h5 class="panel__title">{{ post.title }}</h5>
                <div class="panel__option">
                    <button class="btn panel__btn m-r-1" title="Publish" v-if="active_tab == 'drafted'">
                        <i class="far fa-save panel__icon"></i>
                    </button>
                    <button class="btn panel__btn m-r-1" title="Trash" v-if="active_tab == 'published'">
                        <i class="far fa-trash-alt panel__icon"></i>
                    </button>
                    <button class="btn panel__btn m-r-1" title="Restore" v-if="active_tab == 'trashed'">
                        <i class="fa fa-trash-restore panel__icon"></i>
                    </button>
                    <button class="btn panel__btn" title="Delete" v-if="active_tab == 'trashed'">
                        <i class="fa fa-trash panel__icon"></i>
                    </button>
                </div>
            </div>
            <div class="panel__details">
                <span class="panel__date" v-if="active_tab == 'drafted'">
                    Created {{ publishedDate(post.created_at) }}
                </span>
                <span class="panel__date" v-if="active_tab == 'published'">
                    Published {{ publishedDate(post.published_at) }}
                </span>
                <span class="panel__date" v-if="active_tab == 'trashed'">
                    Trashed {{ publishedDate(post.deleted_at) }}
                </span>
            </div>
        </div>
        <load-more :dataSet="dataSet" :loading="loading" @changed="fetch"></load-more>
    </template>
    <template v-else>
        <p class="heading-secondary center">No posts found.</p>
    </template>
</div>
</template>

<script>
import LoadMore from '../components/LoadMore'
import dateFormat from '../mixins/dateFormat'

export default {
    props:['active_tab'],

    components: {
        LoadMore
    },

    mixins:[dateFormat],

    data() {
        return {
            all_posts: [],
            dataSet: false,
            loading: false,
        }
    },

    created() {
        this.fetch();
    },

    watch: {
        active_tab() {
            this.all_posts = [];
            this.dataSet = [];
            this.fetch(1);
        }
    },

    methods: {
        fetch(page) {
            this.loading = true;
            if(! page) {
                let query = location.search.match(/page=(\d+)/);
                page = query ? query[1] : 1;
            }
            let url;
            let filter = `?filter=${this.active_tab}`;
            url = `${location.pathname}/posts${filter}&page=${page}`
            axios.get(url)
                 .then(({data}) => {
                    let items = data.posts.data;
                    this.dataSet = data.posts;
                    this.all_posts = [...this.all_posts, ...items];
                    this.loading = false;
                })
                .catch((error) => {
                    this.loading = false;
                })
        },
    }
}
</script>
