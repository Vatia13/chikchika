<template>
    <div v-if="user">
        <Head title="User feed" />
        <Component :is="userStore.user?.id ? AuthenticatedLayout : GuestLayout">
            <template #header>
                <div class="flex justify-between">
                    <div>
                        <h2
                            class="font-semibold text-xl text-gray-800 leading-tight"
                        >
                            {{ user.name }}
                        </h2>
                        <div>
                            <div class="flex space-x-2">
                                <b>{{ user.following_count }}</b
                                ><span>Following</span>
                            </div>
                            <div class="flex space-x-2">
                                <b>{{ user.followers_count }}</b
                                ><span>{{
                                    user.followers_count > 1
                                        ? "Followers"
                                        : "Follower"
                                }}</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="text-center"
                        v-if="user.id != userStore.user.id"
                    >
                        <button
                            class="bg-[#414141] rounded-2xl px-8 py-2 text-white disabled:opacity-50"
                            @click="toggleUserFollow"
                        >
                            {{ user.is_followed_by_me ? "Unfollow" : "Follow" }}
                        </button>
                        <br />
                        <small v-if="user.is_followed_by_me"
                            ><i>You are following</i></small
                        >
                    </div>
                </div>
            </template>
            <div class="py-12">
                <Feed>
                    <div
                        class="text-center p-8"
                        v-if="!user.is_followed_by_me && !user.is_public"
                    >
                        This user profile is private, follow to see user feed
                    </div>
                    <Tweet v-if="userStore.user?.id == user.id" />
                    <FeedItem
                        v-for="item in tweetsStore.tweets?.data"
                        :item="item"
                        :key="item.id"
                    />
                </Feed>
            </div>
        </Component>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";

import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Tweet from "@/Components/Tweet.vue";
import Feed from "@/Components/Feed.vue";
import FeedItem from "@/Components/FeedItem.vue";
import useTweetsStore from "@/Stores/tweets";
import useUserStore from "@/Stores/user";
const tweetsStore = useTweetsStore();
const userStore = useUserStore();
const user = ref(null);

onMounted(() => {
    fetchTweets();
    fetchUserProfile();
    fetchLoggedInUser();
});

const fetchTweets = () => {
    tweetsStore.fetchUserFeed(route().params).then((response) => {
        tweetsStore.tweets = response?.data;
    });
};

const fetchUserProfile = () => {
    userStore.profile(route().params).then((response) => {
        user.value = response?.data;
    });
};

const toggleUserFollow = (e) => {
    if (!userStore.user?.id) {
        Inertia.visit("login");
        return;
    }
    if (user.value.is_followed_by_me) {
        user.value.is_followed_by_me = 0;
        tweetsStore.tweets = {};
        userStore
            .unfollow({ id: user.value.id })
            .then(() => user.value.followers_count--)
            .catch((error) => {
                user.value.is_followed_by_me = 1;
                fetchTweets();
            });
        return;
    }
    user.value.is_followed_by_me = 1;
    userStore
        .follow({ id: user.value.id })
        .then(() => {
            user.value.followers_count++;
            fetchTweets();
        })
        .catch((error) => (user.value.is_followed_by_me = 0));
};

const fetchLoggedInUser = () => {
    userStore
        .me()
        .then((response) => {
            userStore.user = response?.data;
            window.localStorage.setItem("user", userStore.user);
        })
        .catch((error) => {
            userStore.user = {};
            window.localStorage.removeItem("user");
        });
};
</script>
