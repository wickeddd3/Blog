<template>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categories</h3>
                <div class="card-tools">
                    <search-bar @filter="filter"></search-bar>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 360px;">
                <table class="table table-sm table-head-fixed">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th><i class="fa fa-book fa-fw"></i></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="all_categories.length > 0">
                            <template v-for="category in all_categories">
                                <tr :key="category.id">
                                    <td>
                                        <a :href="`/dashboard/category/${category.id}/edit`">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>
                                        {{ category.name }}
                                    </td>
                                    <td> {{ category.slug }} </td>
                                    <td> {{ category.description }} </td>
                                    <td> {{ category.posts_count }} </td>
                                    <td>
                                        <template v-if="category.id != 1">
                                            <a :href="`/dashboard/category/${category.id}/delete`">
                                                <i class="fa fa-trash fa-fw"></i>
                                            </a>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="5" class="text-center">No categories found.</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ categories_count }} Categories
                <span class="float-right">
                    <load-more :dataSet="dataSet" :loading="loading" @changed="fetch"></load-more>
                </span>
            </div>
        </div>
        <!-- /.card -->

        <small id="list" class="form-text text-muted">
            Deleting a category does not delete the posts in that category.
            Instead, posts that were only assigned to the deleted category are set to the default category Uncategorized.
            The default category cannot be deleted.
            Categories can be selectively converted to tags using the category to tag converter.
        </small>
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
            all_categories:[],
            dataSet:false,
            loading:false,
            categories_count:0,
            search:''
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
            this.all_categories = [];
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
                    let items = data.categories.data;
                    this.dataSet = data.categories;
                    this.all_categories = [...this.all_categories, ...items];
                    this.categories_count = data.categories_count;
                    this.loading = false;
                })
                .catch((error) => {
                    this.loading = false;
                })
        },
    }
}
</script>
