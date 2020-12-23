<template>
<div class="categories">
    <div class="categories__header">
        <search-bar @filter="filter"></search-bar>
    </div>
    <div class="categories__body">
        <template v-if="all_categories.length > 0">
            <template v-for="category in all_categories">
                <div class="categories__item" :key="category.id">
                    <div class="categories__content">
                        <div class="categories__content-item categories__name">{{ category.name }}</div>
                        <div class="categories__content-item categories__slug">{{ category.slug }}</div>
                        <div class="categories__content-item categories__description">{{ category.description }}</div>
                        <div class="categories__content-item categories__posts">
                            <i class="fa fa-book fa-fw"></i>
                            {{ category.posts_count }}
                        </div>
                        <div class="categories__content-item categories__edit">
                            <a :href="`/admin/panel/categories/${category.id}/edit`">
                                <i class="fa fa-edit fa-fw"></i>
                            </a>
                        </div>
                        <div class="categories__content-item categories__trash">
                            <a @click="deleteItem(category.id)">
                                <i class="fa fa-trash fa-fw"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="center">
                <span class="heading-secondary">No category results</span>
            </div>
        </template>
    </div>
    <div class="categories__footer">
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
        deleteItem(id) {
            axios.delete(`${location.pathname}/${id}`)
                .then((res) => {
                    console.log(res)
                })
                .catch((error) => {
                    console.log(error)
                });
            location.reload();
        }
    }
}
</script>
