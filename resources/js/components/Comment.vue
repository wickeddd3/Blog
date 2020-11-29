<template>
<div class="comment">
    <div class="comment__left">
        <img :src="'/storage/'+data.owner.profile.avatar"
                :alt="'/storage/'+data.owner.profile.avatar"
                class="comment__author-img">
    </div>
    <div class="comment__right">
        <div class="comment__header">
            <div class="comment__author">
                <div class="comment__author-details">
                    <span class="comment__author-name">{{ data.owner.full_name }}</span>
                    <span class="comment__author-published">{{ ago }}</span>
                </div>
            </div>
            <div class="comment__option">
                <template v-if="canUpdate">
                    <button class="comment__option-btn" @click="editing = true">
                        <i class="fa fa-edit comment__option-icon"></i>
                    </button>
                </template>
                <template v-if="canUpdate">
                    <button class="comment__option-btn" @click="destroy">
                        <i class="fa fa-trash comment__option-icon"></i>
                    </button>
                </template>
            </div>
        </div>
        <div class="comment__body">
            <div class="comment__edit" v-if="editing">
                <textarea class="comment__edit-input" cols="30" rows="5" v-model="message"></textarea>
                <div class="comment__edit-option">
                    <button type="submit" class="comment__edit-btn" @click="update">Update</button>
                    <button type="submit" class="comment__edit-btn" @click="editing = false">Cancel</button>
                </div>
            </div>
            <div class="comment__message" v-text="message" v-else></div>
        </div>
    </div>
</div>
</template>

<script>
import moment from 'moment'

export default {
    props:['data'],

    data() {
        return {
            editing: false,
            id: this.data.id,
            message: this.data.message,
        }
    },

    computed: {
        ago() {
            return moment(this.data.created_at).fromNow() + '...';
        },
        signedIn() {
            return window.App.signedIn;
        },
        canUpdate() {
            return this.data.user_id == window.App.user;
        }
    },

    methods: {
        update() {
            axios.patch('/comments/' + this.data.id, {
                message: this.message
            });

            this.editing = false;
        },
        destroy() {
            axios.delete('/comments/' + this.data.id);

            this.$emit('deleted', this.data.id);
        }
    }
}
</script>

<style scoped>
.comment-owner-option {
    display: none;
}

.media:hover .comment-owner-option {
    display: block;
}
</style>
