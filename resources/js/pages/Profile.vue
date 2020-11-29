<script>
import FollowButton from '../components/FollowButton'
import Posts from '../components/Posts'

export default {
    components: {
        FollowButton,
        Posts
    },

    data() {
        return {
            active_tab: "posts"
        }
    },

    methods: {
        active(active_tab) {
            return (this.active_tab == active_tab) ? true : false;
        }
    }
}
</script>
