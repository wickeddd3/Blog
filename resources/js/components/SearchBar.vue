<template>
    <form @submit.prevent="filter()">
        <div class="searchbar">
            <button type="submit" class="searchbar__btn">
                <i class="fas fa-search"></i>
            </button>
            <input type="text"
                   v-model="search"
                   name="table_search"
                   class="searchbar__input">
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            search: '',
        }
    },

    methods: {
        filter() {
            this.$emit('filter', this.search);
        }
    }
}
</script>
