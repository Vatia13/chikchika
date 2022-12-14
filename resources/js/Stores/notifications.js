import { defineStore } from "pinia";

export default defineStore("notifications", {
    state: () => ({
        notifications: {},
        countUnread: 0,
    }),

    actions: {
        /**
         * Fetch all notifications
         * @returns
         */
        fetch() {
            return new Promise((resolve, reject) => {
                window.axios
                    .get("notifications")
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Fetch unread notifications
         * @returns
         */
        fetchUnread() {
            return new Promise((resolve, reject) => {
                window.axios
                    .get("notifications/unread")
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Mark all notifications as read
         * @returns
         */
        read() {
            return new Promise((resolve, reject) => {
                window.axios
                    .post(`notifications/read`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },
    },
});
