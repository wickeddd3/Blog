<template>
    <span @click="like">
        <i :class="icon"></i>
    </span>
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
        icon() {
            return this.activeButton ? 'fa fa-thumbs-up fa-lg pr-1' : 'far fa-thumbs-up fa-lg pr-1';
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
