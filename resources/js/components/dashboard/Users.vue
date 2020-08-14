<template>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
                <div class="card-tools">
                    <search-bar @filter="filter"></search-bar>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 410px;">
                <table class="table table-sm table-head-fixed">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th><i class="fa fa-book fa-fw"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="all_users.length > 0">
                            <template v-for="user in all_users">
                                <tr :key="user.id">
                                    <td>
                                        <a :href="`/dashboard/user/${user.id}/edit`" v-if="user.role != 'administrator'">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>
                                        {{ user.full_name }}
                                    </td>
                                    <td> {{ user.username }} </td>
                                    <td> {{ user.email }} </td>
                                    <td> {{ user.role }} </td>
                                    <td> {{ user.posts_count }} </td>
                                </tr>
                            </template>
                        </template>
                        <template v-else>
                            <tr>
                                <td colspan="5" class="text-center">No users found.</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ users_count }} Users
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
            all_users:[],
            dataSet:false,
            loading:false,
            users_count:0,
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
            return moment(date).format('MMM D');
        },
        filter(search) {
            history.pushState(null, null, '?search='+search);
            this.search = search;
            this.dataSet = [];
            this.all_users = [];
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
                    let items = data.users.data;
                    this.dataSet = data.users;
                    this.all_users = [...this.all_users, ...items];
                    this.users_count = data.users_count;
                    this.loading = false;
                })
                .catch((error) => {
                    this.loading = false;
                })
        },
    }
}
</script>
