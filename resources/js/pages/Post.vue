<script>
import moment from 'moment'
import Comments from '../components/Comments'
import LikeButton from '../components/LikeButton'
import BookmarkButton from '../components/BookmarkButton'

export default {
    props:[
        'initialCommentsCount',
        'initialLikesCount',
        'createdAt'
    ],

    components: {
        Comments,
        LikeButton,
        BookmarkButton,
    },

    data() {
        return {
            commentsCount: this.initialCommentsCount,
            likesCount: this.initialLikesCount,
            created_at: this.createdAt
        }
    },

    computed: {
        published() {
            return moment(this.created_at).fromNow();
        }
    }
}
</script>
