<template>
<div class="users">
    <div class="users__header">
        <search-bar @filter="filter"></search-bar>
    </div>
    <div class="users__body">
        <template v-if="all_users.length > 0">
            <template v-for="user in all_users">
                <div class="users__item" :key="user.id">
                    <div class="users__content">
                        <div class="users__content-item users__name">{{ user.full_name }}</div>
                        <div class="users__content-item users__username">{{ user.username }}</div>
                        <div class="users__content-item users__email">{{ user.email }}</div>
                        <div class="users__content-item users__role">{{ user.role }}</div>
                        <div class="users__content-item users__date">{{ published(user.verified_at) }}</div>
                        <div class="users__content-item users__edit">
                            <a :href="`/dashboard/user/${user.id}/edit`" v-if="user.role != 'administrator'">
                                <i class="fa fa-edit fa-fw"></i>
                            </a>
                        </div>
                    </div>
                    <div>

                    </div>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="center">
                <span class="heading-secondary">No user results</span>
            </div>
        </template>
    </div>
    <div class="users__footer">
        <div class="center">
            <load-more :dataSet="dataSet" :loading="loading" @changed="fetch"></load-more>
        </div>
    </div>
</div>
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
