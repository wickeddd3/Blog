<template>
    <button class="btn btn__follow" @click="follow">
        <template v-if="activeButton">
            <i class="fas fa-minus-circle"></i> &nbsp; Unfollow
        </template>
        <template v-else>
            <i class="fas fa-plus-circle"></i> &nbsp; Follow
        </template>
    </button>
</template>

<script>
export default {
    props: ['blogger'],

    data() {
        return {
            activeButton: this.blogger.isFollowedTo
        }
    },

    methods: {
        follow() {
            let url;
            (location.pathname == '/')
                ? url = `/profile/${this.blogger.username}/followers`
                : url = `${location.pathname}/followers`;
            axios[(this.activeButton ? 'delete' : 'post')](url)
            .then((response) => {
                this.activeButton = ! this.activeButton;
            });
        }
    }
}
</script>
