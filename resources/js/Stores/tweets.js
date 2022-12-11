import { defineStore } from "pinia";

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export default defineStore("tweets", {
    state: () => ({
        tweets: {},
        tweet: {},
        replies: {},
    }),

    actions: {
        /**
         * Fetch tweets feed from API request
         * @returns
         */
        fetch(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .get("tweets", { params: payload })
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Fetch replies from API request
         * @returns
         */
        fetchReplies(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .get(`tweets/${payload.tweet_id}/replies`, {
                        params: payload,
                    })
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Fetch single user tweets feed from API request
         * @returns
         */
        fetchUserFeed(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .get(`tweets/${payload.email}/feed`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Fetch single tweet
         * @returns
         */
        fetchOne(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .get(`tweets/${payload.tweet_id}`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Create a tweet
         * @returns
         */
        makeTweet(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .post("tweets", payload)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * Reply to a tweet
         * @returns
         */
        reply(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .post(`tweets/${payload.id}/reply`, payload)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * like tweet
         * @returns
         */
        like(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .post(`tweets/${payload.id}/like`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * dislike tweet
         * @returns
         */
        dislike(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .delete(`tweets/${payload.id}/unlike`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },

        /**
         * delete tweet
         * @returns
         */
        delete(payload) {
            return new Promise((resolve, reject) => {
                window.axios
                    .delete(`tweets/${payload.id}/delete`)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => reject(error));
            });
        },
    },
});
