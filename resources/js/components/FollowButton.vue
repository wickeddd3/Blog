<template>
    <button class="btn btn-primary btn-block"
            @click="follow">
            {{ activeButton ? 'Unfollow' : 'Follow' }}
    </button>
</template>

<script>
export default {
    props: ['active'],

    data() {
        return {
            activeButton: this.active
        }
    },

    methods: {
        follow() {
            axios[(this.activeButton ? 'delete' : 'post')](location.pathname + '/followers')
            .then((response) => {
                this.activeButton = ! this.activeButton;
            });
        }
    }
}
</script>
