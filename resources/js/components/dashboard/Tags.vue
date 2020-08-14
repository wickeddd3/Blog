<template>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tags</h3>
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
                        <template v-if="all_tags.length > 0">
                            <template v-for="tag in all_tags">
                                <tr :key="tag.id">
                                    <td>
                                        <a :href="`/dashboard/tag/${tag.id}/edit`">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>
                                        {{ tag.name }}
                                    </td>
                                    <td> {{ tag.slug }} </td>
                                    <td> {{ tag.description }} </td>
                                    <td> {{ tag.posts_count }} </td>
                                    <td>
                                        <a :href="`/dashboard/tag/${tag.id}/delete`">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="5" class="text-center">No tags found.</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ tags_count }} Tags
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
            all_tags:[],
            dataSet:false,
            loading:false,
            tags_count:0,
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
            this.all_tags = [];
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
                    let items = data.tags.data;
                    this.dataSet = data.tags;
                    this.all_tags = [...this.all_tags, ...items];
                    this.tags_count = data.tags_count;
                    this.loading = false;
                })
                .catch((error) => {
                    this.loading = false;
                })
        },
    }
}
</script>
