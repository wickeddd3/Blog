<template>
<div class="nav__dropdown">
    <div class="nav__dropdown-list">
        <div class="nav__dropdown-header">
            <div class="nav__dropdown-header--left">
                <i class="fas fa-bell nav__dropdown-title--icon m-r-1"></i>
                <span class="nav__dropdown-title">Notifications</span>
            </div>
            <div class="nav__dropdown-header--right">
                <i class="fas fa-ellipsis-v nav__dropdown-title--icon"></i>
            </div>
        </div>
        <template v-if="notifications.length > 0">
            <template v-for="notification in notifications">
                <a :href="notification.data.link" target="__blank" :key="notification.id" @click="markAsRead(notification)">
                    <div class="nav__dropdown-item">
                        <div class="nav__dropdown-featured">
                            <img :src="`/storage/${notification.data.featured}`" alt="" class="nav__dropdown-img">
                        </div>
                        <div class="nav__dropdown-content">
                            <p class="nav__dropdown-author">{{ notification.data.author }} posted:</p>
                            <p :class="{'nav__dropdown-notification': true, 'nav__dropdown-notification--unread': read(notification.read_at)}">
                                {{ notification.data.title }}
                            </p>
                            <span :class="{'nav__dropdown-date': true, 'nav__dropdown-date--unread': read(notification.read_at)}">
                                {{ ago(notification.created_at) }}
                            </span>
                        </div>
                    </div>
                </a>
            </template>
        </template>
        <template v-else>
            <div class="center">
                <h1 class="heading-secondary m-3">
                    No notifications
                </h1>
            </div>
        </template>
    </div>
</div>
</template>

<script>
import dateFormat from '../mixins/dateFormat'

export default {
    props:['auth_user'],

    mixins:[dateFormat],

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
            axios.get(`/@/${this.auth_user}/profile/notifications`)
                 .then((response) => {
                    this.notifications = response.data.notifications
                 });
        },
        markAsRead(notification) {
            axios.post(`/@/${this.auth_user}/profile/notifications`, { notificationId: notification.id })
                 .then((response) => {

                 })
        },
        read(read_at) {
            return (read_at) ? false : true;
        }
    }
}
</script>
