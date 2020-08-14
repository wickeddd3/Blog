<template>
    <a href="" class="text-dark ml-1" @click.prevent="like">{{ text }}</a>
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
            return this.activeButton ? 'Unlike' : 'Like';
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
