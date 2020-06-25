<template>
    <span @click="follow">
        <i :class="icon"></i>
    </span>
</template>

<script>
export default {
    props: ['active'],

    data() {
        return {
            activeButton: this.active
        }
    },

    computed: {
        icon() {
            return this.activeButton ? 'fa fa-plus-square fa-fw' : 'far fa-plus-square fa-fw';
        },
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
