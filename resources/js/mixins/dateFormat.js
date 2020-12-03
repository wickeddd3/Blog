import moment from 'moment'

export default {
    methods: {
        publishedDate(date) {
            return moment(date).format('MMM D, YYYY');
        },
        ago(date) {
            return moment(date).fromNow() + '...';
        },
    }
}
