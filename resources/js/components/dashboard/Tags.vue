<template>
<div class="tags">
    <div class="tags__header">
        <search-bar @filter="filter"></search-bar>
    </div>
    <div class="tags__body">
        <template v-if="all_tags.length > 0">
            <template v-for="tag in all_tags">
                <div class="tags__item" :key="tag.id">
                    <div class="tags__content">
                        <div class="tags__content-item tags__name">{{ tag.name }}</div>
                        <div class="tags__content-item tags__slug">{{ tag.slug }}</div>
                        <div class="tags__content-item tags__description">{{ tag.description }}</div>
                        <div class="tags__content-item tags__posts">
                            <i class="fa fa-book fa-fw"></i>
                            {{ tag.posts_count }}
                        </div>
                        <div class="tags__content-item tags__edit">
                            <a :href="`/dashboard/tags/${tag.id}/edit`">
                                <i class="fa fa-edit fa-fw"></i>
                            </a>
                        </div>
                        <div class="tags__content-item tags__trash">
                             <a @click="deleteItem(tag.id)">
                                <i class="fa fa-trash fa-fw"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="center">
                <span class="heading-secondary">No tag results</span>
            </div>
        </template>
    </div>
    <div class="tags__footer">
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
