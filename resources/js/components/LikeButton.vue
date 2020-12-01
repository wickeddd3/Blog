<template>
    <button class="btn btn__like"
            @click.prevent="like">
            {{ text }}
    </button>
</template>

<script>
export default {
    props:['active'],

    data() {
        return {
            activeButton: this.active
        }
    },

    computed: {
        text() {
            return this.activeButton ? 'Liked' : 'Like';
        },
    },

    methods: {
        like() {
            axios[(this.activeButton ? 'delete' : 'post')](location.pathname + '/likes')
            .then((response) => {
                (this.activeButton) ? this.$emit('unliked') : this.$emit('liked');
                this.activeButton = !this.activeButton;
            });
        }
    }
}
</script>
