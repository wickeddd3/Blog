<template>
<div>
    <template v-if="signedIn">
        <div class="pt-3" v-if="verified">
            <textarea name="message" id="message" v-model="message" cols="5" rows="5" placeholder="Write your comment..." class="form-control form-control-sm"></textarea>
            <button type="submit" @click="addComment" class="btn btn-sm btn-primary float-right mt-2">
                Comment
            </button>
        </div>
        <p v-else class="text-center" >You must <a href="/email/verify">verify</a> your email to share your comments.</p>
    </template>
    <div class="text-center pt-3" v-else>
        <p>Please <a href="/login">sign in</a> or <a href="/register">create an account</a> to share your comments.</p>
    </div>
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
