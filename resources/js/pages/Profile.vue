<script>
import FollowButton from '../components/FollowButton'
import Posts from '../components/Posts'
import MyPosts from '../components/MyPosts'

export default {
    components: {
        FollowButton,
        Posts,
        MyPosts
    },

    data() {
        return {
            active_page: "profilePosts",
            active_tab: "posts"
        }
    },

    watch: {
        active_page() {
            this.active_tab = (this.active_page == "profilePosts") ? 'posts' : 'drafted';
        }
    },

    methods: {
        active(active_tab) {
            return (this.active_tab == active_tab) ? true : false;
        }
    }
}
</script>
