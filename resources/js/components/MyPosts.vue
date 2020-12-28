<template>
<div>
    <template v-if="all_posts.length > 0">
        <div class="panel" v-for="post in all_posts" :key="post.id">
            <div class="panel__item">
                <h5 class="panel__title">{{ post.title }}</h5>
                <div class="panel__option">
                    <button class="btn panel__btn m-r-1"
                            title="Publish"
                            @click="publishPost(post)"
                            v-if="active_tab == 'drafted'">
                        <i class="far fa-save panel__icon"></i>
                    </button>
                    <button class="btn panel__btn m-r-1"
                            title="Trash"
                            @click="trashPost(post)"
                            v-if="active_tab == 'published'">
                        <i class="far fa-trash-alt panel__icon"></i>
                    </button>
                    <button class="btn panel__btn m-r-1"
                            title="Restore"
                            @click="restorePost(post)"
                            v-if="active_tab == 'trashed'">
                        <i class="fa fa-trash-restore panel__icon"></i>
                    </button>
                    <button class="btn panel__btn"
                            title="Delete"
                            @click="deletePost(post)"
                            v-if="active_tab == 'trashed'">
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
        publishPost(post) {
            axios.post(`${location.pathname}/publish`,{ id: post.id})
                .then(response => {
                    this.all_posts.splice(this.all_posts.indexOf(post), 1);
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        trashPost(post) {
            axios.post(`${location.pathname}/trash`,{ id: post.id})
                .then(response => {
                    this.all_posts.splice(this.all_posts.indexOf(post), 1);
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        restorePost(post) {
            axios.post(`${location.pathname}/restore`,{ id: post.id})
                .then(response => {
                    this.all_posts.splice(this.all_posts.indexOf(post), 1);
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        deletePost(post) {
            axios.post(`${location.pathname}/delete`,{ id: post.id})
                .then(response => {
                    this.all_posts.splice(this.all_posts.indexOf(post), 1);
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>
