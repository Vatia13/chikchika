import { defineStore } from "pinia";

export default defineStore("user", {
    state: () => ({
        user: {},
    }),

    actions: {
        /**
         * Fetch logged in user data from API request
         * @returns
         */
        me(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .get("me", { params: payload })
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Fetch visited user profile data
         * @returns
         */
        profile(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .get(`${payload.email}/profile`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Follow user
         * @returns
         */
        follow(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .post(`follow/${payload.id}`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Unfollow user
         * @returns
         */
        unfollow(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .delete(`unfollow/${payload.id}`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },
    },
});
