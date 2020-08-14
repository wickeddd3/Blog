<template>
    <form @submit.prevent="filter()">
        <div class="input-group input-group-sm" style="width: 250px;">
            <input type="text" v-model="search" name="table_search" class="form-control float-right" placeholder="Search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
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
