<template>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Posts</h3>
                <div class="card-tools">
                    <search-bar @filter="filter"></search-bar>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 410px;">
                <table class="table table-sm table-head-fixed">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Published</th>
                            <th><i class="far fa-star fa-fw"></i></th>
                            <th><i class="far fa-comments fa-fw"></i></th>
                            <th><i class="far fa-thumbs-up fa-fw"></i></th>
                            <th><i class="far fa-eye fa-fw"></i></th>
                            <th><i class="far fa-star fa-fw"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="all_posts.length > 0">
                            <template v-for="post in all_posts">
                                <tr :key="post.id">
                                    <td>
                                        <a :href="`/dashboard/post/${post.id}/edit`">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>
                                        {{ limitContent(post.title) }}
                                    </td>
                                    <td> {{ post.category.name }} </td>
                                    <td> {{ published(post.published_at) }} </td>
                                    <td>
                                        <i class="fas fa-star fa-fw" v-if="post.featured_at"></i>
                                        <i class="far fa-star fa-fw" v-else></i>
                                    </td>
                                    <td> {{ post.comments_count }} </td>
                                    <td> {{ post.likesCount }} </td>
                                    <td> {{ post.views_count }} </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" :href="`/dashboard/post/${post.id}/unfeature`" v-if="post.featured_at">
                                            <i class="fas fa-star fa-fw"></i>
                                        </a>
                                        <a class="btn btn-sm btn-outline-primary" :href="`/dashboard/post/${post.id}/feature`" v-else>
                                            <i class="far fa-star fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="8" class="text-center">No posts found.</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ posts_count }} Posts
                <span class="float-right">
                    <load-more :dataSet="dataSet" :loading="loading" @changed="fetch"></load-more>
                </span>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->
</template>

<script>
import moment from 'moment'
import SearchBar from '../../components/SearchBar'
import LoadMore from '../../components/dashboard/LoadMore'

export default {
    components: {
        SearchBar,
        LoadMore,
    },

    data() {
        return {
            all_posts:[],
            dataSet:false,
            loading:false,
            posts_count:0,
            search:''
        }
    },

    created() {
        this.fetch();
    },

    methods: {
        limitContent(content) {
            return content.substr(0, 30) + '...';
        },
        published(date) {
            return moment(date).format('MMM D Y');
        },
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
    }
}
</script>
