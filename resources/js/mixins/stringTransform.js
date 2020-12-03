export default {
    methods: {
        limitContent(content, noOfChar) {
            return content.substr(0, noOfChar) + '...';
        },
    }
}
