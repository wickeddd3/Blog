<template>
    <span @click="bookmark">
        <i :class="icon"></i>
    </span>
</template>

<script>
export default {
    props:['post'],
    data() {
        return {
            activeButton: this.post.isBookmarked,
        }
    },
    computed: {
        icon() {
            return this.activeButton ? 'fas fa-bookmark media__icon--active' : 'far fa-bookmark media__icon';
        },
    },
    methods: {
        bookmark() {
            axios[(this.activeButton ? 'delete' : 'post')](`/posts/${this.post.category.slug}/${this.post.slug}/bookmarks`)
            .then((response) => {
                this.activeButton = !this.activeButton;
            });
        }
    }
}
</script>
