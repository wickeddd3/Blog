<template>
<div>
    <template v-if="all_posts.length > 0">
        <div class="media" v-for="(post, index) in all_posts" :key="index">
            <div class="media__header">
                <div class="media__author">
                    <img class="media__author--avatar"
                        :src="`/storage/${post.author.avatar}`"
                        :alt="`/storage/${post.author.avatar}`">
                    <div class="media__author--details">
                        <a class="media__author--name" :href="`/@/${post.author.username}/profile`">
                            {{ post.author.full_name }}
                        </a>
                        <p class="media__author--date">{{ publishedDate(post.published_at) }}</p>
                    </div>
                </div>
                <div> <span class="media__category">{{ post.category.name }}</span> </div>
            </div>
            <div class="media__body">
                <div class="media__content">
                    <a class="heading-title" :href="post.path">{{ post.title }}</a>
                    <p class="paragraph" v-html="limitContent(post.content, 300)"></p>
                </div>
                <img class="media__img" :src="'/storage/'+post.featured" :alt="'/storage/'+post.featured" v-if="post.featured">
            </div>
            <div class="media__footer">
                <div class="m-r-1">
                    <i class="far fa-thumbs-up media__icon"></i>
                    <span class="heading-secondary">{{ post.likesCount }}</span>
                </div>
                <div class="m-r-3">
                    <i class="far fa-comments media__icon"></i>
                    <span class="heading-secondary">{{ post.comments_count }}</span>
                </div>
                <div v-if="signedIn && verified">
                    <bookmark-button :post="post"></bookmark-button>
                </div>
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
import BookmarkButton from '../components/BookmarkButton'
import LoadMore from '../components/LoadMore'
import dateFormat from '../mixins/dateFormat'
import stringTransform from '../mixins/stringTransform'

export default {
    props: ['active_tab'],

    components: {
        BookmarkButton,
        LoadMore,
    },

    mixins:[
        dateFormat,
        stringTransform
    ],

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

    computed: {
        signedIn() {
            return window.App.signedIn;
        },
        verified() {
            return window.App.verified;
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
            (location.pathname == "/")
            ? url = `${location.pathname}posts${filter}&page=${page}`
            : url = `${location.pathname}/posts${filter}&page=${page}`
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
