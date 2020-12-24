<template>
<div class="posts">
    <success-message :message="success" v-show="success"></success-message>
    <div class="posts__header">
        <search-bar @filter="filter"></search-bar>
    </div>
    <div class="posts__body">
        <template v-if="all_posts.length > 0">
            <template v-for="post in all_posts">
                <div class="posts__item" :key="post.id">
                    <div class="posts__content">
                        <div class="posts__content-item posts__title">{{ limitContent(post.title, 50) }}</div>
                        <div class="posts__content-item posts__category">{{ post.category.name }}</div>
                        <div class="posts__content-item posts__details">
                            <span> <i class="far fa-comments fa-fw"></i> {{ post.comments_count }} </span>
                            <span> <i class="far fa-thumbs-up fa-fw"></i> {{ post.likesCount }} </span>
                            <span> <i class="far fa-eye fa-fw"></i> {{ post.views_count }} </span>
                        </div>
                        <div class="posts__content-item posts__date">{{ publishedDate(post.published_at) }}</div>
                        <div class="posts__content-item posts__featured">
                            <button class="btn btn--primary" @click="unfeature(post)" v-show="post.featured_at">
                                <i class="fas fa-star fa-fw"></i>
                            </button>
                            <button class="btn btn--primary" @click="feature(post)" v-show="!post.featured_at">
                                <i class="far fa-star fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="center">
                <span class="heading-secondary">No post results</span>
            </div>
        </template>
    </div>
    <div class="posts__footer">
        <div class="center">
            <load-more :dataSet="dataSet" :loading="loading" @changed="fetch"></load-more>
        </div>
    </div>
</div>
</template>

<script>
import SearchBar from '../../components/SearchBar'
import LoadMore from '../../components/dashboard/LoadMore'
import stringTransform from '../../mixins/stringTransform'
import dateFormat from '../../mixins/dateFormat'
import SuccessMessage from '../../components/SuccessMessage'

export default {
    components: {
        SearchBar,
        LoadMore,
        SuccessMessage
    },

    mixins:[
        stringTransform,
        dateFormat
    ],

    data() {
        return {
            all_posts:[],
            dataSet:false,
            loading:false,
            posts_count:0,
            search:'',
            success:false
        }
    },

    created() {
        this.fetch();
    },

    methods: {
        filter(search) {
            history.pushState(null, null, '?search='+search);
            this.search = search;
            this.dataSet = [];
            this.all_posts = [];
            this.fetch(1, search);
        },
        fetch(page) {
            this.loading = true;
            if(! page) {
                let query = location.search.match(/page=(\d+)/);
                page = query ? query[1] : 1;
            }
            let url;
            if(this.search) {
                url = `${location.pathname}?search=${this.search}&page=${page}`;
            } else {
                url = `${location.pathname}?page=${page}`;
            }
            axios.get(url)
                .then(({data}) => {
                    let items = data.posts.data;
                    this.dataSet = data.posts;
                    this.all_posts = [...this.all_posts, ...items];
                    this.posts_count = data.posts_count;
                    this.loading = false;
                })
                .catch((error) => {
                    this.loading = false;
                })
        },
        feature(post) {
            axios.post('/admin/panel/posts/feature',{ id: post.id})
                .then(response => {
                    Vue.set(post, 'featured_at', true)
                    this.success = `${post.title} is successfully featured !`;
                })
        },
        unfeature(post) {
            axios.post('/admin/panel/posts/unfeature',{ id: post.id})
                .then(response => {
                    Vue.set(post, 'featured_at', false)
                    this.success = `${post.title} is successfully unfeatured !`;
                })
        }
    }
}
</script>
