<script>
import Posts from '../components/Posts'

export default {
    components: {
        Posts
    },

    data() {
        return {
            active_tab: "popular"
        }
    },

    methods: {
        active(active_tab) {
            return (this.active_tab == active_tab) ? true : false;
        }
    }
}
</script>
