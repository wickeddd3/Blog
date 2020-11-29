<template>
<div>
    <template v-if="signedIn">
        <div class="comment__box" v-if="verified">
            <textarea name="message"
                    id="message"
                    v-model="message"
                    cols="2"
                    rows="10"
                    placeholder="Write your comment..."
                    class="comment__box-input"
                    ></textarea>
            <button type="submit"
                    @click="addComment"
                    class="comment__box-btn">
                <i class="fa fa-paper-plane comment__box-icon"></i>
            </button>
        </div>
        <p class="center" v-else>You must <a href="/email/verify">verify</a> your email to share your comments.</p>
    </template>
    <template v-else>
        <p class="heading-secondary center m-t-3">Please &nbsp;<a href="/login" class="text-primary"> sign in &nbsp;</a> or &nbsp;<a href="/register" class="text-primary">create an account &nbsp;</a> to share your comments.</p>
    </template>
</div>
</template>

<script>
export default {
    data() {
        return {
            message:''
        }
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        },
        verified() {
            return window.App.verified;
        }
    },

    methods: {
        addComment() {
            axios.post(location.pathname + '/comments', { message: this.message })
                 .then(({data}) => {
                    this.message = ''
                    this.$emit('created', data);
                 });
        }
    }
}
</script>
