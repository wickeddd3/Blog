<template>
<div>
    <form @submit.prevent="fetch()">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search fa-fw"></i>
                </button>
            </div>
            <input type="text" name="search" v-model="search" class="form-control">
        </div>
    </form>

    <template v-if="all_posts.length > 0">
        <p> Total of {{ all_posts.length }} results for <b>{{ beforeSearch }}</b> </p>
        <div v-for="(post, index) in all_posts" :key="index">
            <div class="media pb-4">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">
                        <a class="text-dark" :href="post.path">
                            {{ post.title }}
                        </a>
                    </h5>
                    <p class="font-weight-light text-secondary">
                        <span v-html="limitContent(post.content)"></span>
                    </p>
                    <p style="margin:0;padding:0;">
                        <a class="text-dark" :href="'/profile/'+post.author.username">
                            {{ post.author.full_name }}
                        </a>
                        · {{ post.category.name }}
                    </p>
                    <span class="text-muted">
                        {{ published(post.published_at) }} ·
                        {{ post.comments_count }} <i class="far fa-comments fa-fw"></i> ·
                        {{ post.likesCount }} <i class="far fa-thumbs-up fa-fw"></i>
                    </span>
                    <span class="float-right" v-if="signedIn">
                        <bookmark-button :post="post"></bookmark-button>
                    </span>
                </div>
                <img :src="'/storage/'+post.featured" style="width:160px;height:150px;object-fit:cover;" class="ml-3" alt="...">
            </div>
        </div>
        <load-more :dataSet="dataSet" :loading="loading" @changed="fetch"></load-more>
    </template>
    <template v-else>
        <div class="text-center" v-if="result">
            No search results for <b>{{ beforeSearch }}</b>
        </div>
    </template>

</div>
</template>

<script>
import moment from 'moment'
import BookmarkButton from '../components/BookmarkButton'
import LoadMore from '../components/LoadMore'

export default {
    components: {
        BookmarkButton,
        LoadMore,
    },

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
        published(date) {
            return moment(date).format('MMM D');
        },
        limitContent(content) {
            return content.substr(0, 100) + '...';
        },
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
