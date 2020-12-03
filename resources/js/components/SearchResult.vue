<template>
<div>
    <form @submit.prevent="fetch()">
        <div class="search__bar">
            <button class="search__bar-btn" type="submit">
                <i class="fa fa-search search__bar-icon"></i>
            </button>
            <input type="text"
                    name="search"
                    v-model="search"
                    class="search__bar-input">
        </div>
    </form>
    <template v-if="all_posts.length > 0">
        <div class="heading-secondary m-t-1 m-b-1">
            Total of {{ all_posts.length }} results for <b>{{ beforeSearch }}</b>
        </div>
        <div v-for="(post, index) in all_posts" :key="index">
            <div class="media">
                <div class="media__header">
                    <div class="media__author">
                        <img class="media__author--avatar"
                            :src="`/storage/${post.author.profile.avatar}`"
                            :alt="`/storage/${post.author.profile.avatar}`">
                        <div class="media__author--details">
                            <a class="media__author--name" :href="'/profile/'+post.author.username">
                                {{ post.author.full_name }}
                            </a>
                            <p class="media__author--date">
                                {{ publishedDate(post.published_at) }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <span class="media__category">
                            {{ post.category.name }}
                        </span>
                    </div>
                </div>
                <div class="media__body">
                    <div class="media__content">
                        <a class="heading-title" :href="post.path">{{ post.title }}</a>
                        <p class="paragraph" v-html="limitContent(post.content, 300)"></p>
                    </div>
                    <img class="media__img" :src="'/storage/'+post.featured" :alt="'/storage/'+post.featured">
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
                    <div>
                        <span v-if="signedIn">
                            <bookmark-button :post="post"></bookmark-button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <load-more :dataSet="dataSet" :loading="loading" @changed="fetch"></load-more>
    </template>
    <template v-else>
        <div class="heading-secondary m-t-1 m-b-1" v-if="result">
            No search results for <b>{{ beforeSearch }}</b>
        </div>
        <div class="search__noresult">
            <i class="fas fa-exclamation-circle search__noresult-icon"></i>
            <span class="heading-secondary m-t-1">No results</span>
        </div>
    </template>
</div>
</template>

<script>
import BookmarkButton from '../components/BookmarkButton'
import LoadMore from '../components/LoadMore'
import dateFormat from '../mixins/dateFormat'
import stringTransform from '../mixins/stringTransform'

export default {
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
            search: '',
            beforeSearch: '',
            result: false,
        }
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        },
    },

    methods: {
        fetch(page) {
            history.pushState(null, null, '?search='+this.search);
            this.loading = true;
            if(! page) {
                let query = location.search.match(/page=(\d+)/);
                page = query ? query[1] : 1;
                this.dataSet = [];
                this.all_posts = [];
            }
            let url = `${location.pathname}?search=${this.search}&page=${page}`;

            this.beforeSearch = this.search;

            axios.get(url)
                .then(({data}) => {
                    let items = data.posts.data;
                    this.dataSet = data.posts;
                    this.all_posts = [...this.all_posts, ...items];
                    this.loading = false;
                    this.result = false;
                    (data.posts.data.length == 0) ? this.result = true : '';
                })
                .catch((error) => {
                    this.loading = false;
                    this.result = true;
                });

        },
    }
}
</script>
