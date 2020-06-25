<template>
<div>
    <div v-if="notifications.length > 0">
        <template v-for="notification in notifications">
            <p :key="notification.id">
                <a :href="notification.data.link"
                    :class="{ 'font-weight-bold': read(notification.read_at) }"
                    v-text="notification.data.message"
                    @click="markAsRead(notification)">
                </a>
            </p>
        </template>
    </div>
    <div v-else>
        No notifications found.
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            notifications:[]
        }
    },

    created() {
        this.fetchNotifications();
    },

    methods: {
        fetchNotifications() {
            axios.get(location.pathname)
                 .then((response) => {
                    this.notifications = response.data.notifications
                 });
        },
        markAsRead(notification) {
            axios.post(location.pathname + '/read', { notificationId: notification.id })
                 .then((response) => {

                 })
        },
        read(read_at) {
            return (read_at) ? false : true;
        }
    }
}
</script>
