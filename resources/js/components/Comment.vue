<template>
<div class="media p-2">
    <img :src="'/storage/'+data.owner.profile.avatar" class="mr-3 rounded-circle img-fluid" style="width:50px;height:50px;object-fit:cover;" alt="...">
    <div class="media-body pt-1">
        <h6 class="mt-0">
            <span class="font-weight-bold">
                {{ data.owner.full_name }}
            </span>
            {{ ago }}
            <p class="comment-owner-option pt-2 float-right">
                <span v-if="canUpdate">
                    <span @click="editing = true">
                        <i class="fa fa-edit fa-fw"></i>
                    </span>
                </span>
                <span v-if="canUpdate">
                    <span @click="destroy">
                        <i class="fa fa-trash fa-fw"></i>
                    </span>
                </span>
            </p>
        </h6>

        <span>
            <div class="text-muted" v-if="editing">
                <div class="form-group">
                    <textarea class="form-control form-control-sm" cols="5" rows="5" v-model="message"></textarea>
                </div>
                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>
            <div class="text-muted" v-text="message" v-else></div>
        </span>
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
