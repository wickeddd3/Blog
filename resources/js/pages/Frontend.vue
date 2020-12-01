<script>
import Posts from '../components/Posts'
import FollowButton from '../components/FollowButton'

export default {
    components: {
        Posts,
        FollowButton,
    },

    data() {
        return {
            active_tab: "popular",
            categories_collapse: false,
            tags_collapse: false
        }
    },

    methods: {
        active(active_tab) {
            return (this.active_tab == active_tab) ? true : false;
        }
    }
}
</script>
