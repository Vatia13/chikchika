<template>
    <Head title="Home" />

    <Component :is="userStore.user?.id ? AuthenticatedLayout : GuestLayout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tweet
            </h2>
        </template>
        <div class="py-12">
            <Feed>
                <div v-if="tweetsStore.tweet?.id">
                    <FeedItem
                        :item="tweetsStore.tweet"
                        @delete="onDeleteTweet"
                    />
                    <Reply :id="tweetsStore.tweet?.id" />
                    <div
                        class="text-center border-y-2 border-solid border-y-gray uppercase font-bold"
                    >
                        Replies
                    </div>
                    <div v-if="tweetsStore.tweets?.data">
                        <FeedItem
                            v-for="item in tweetsStore.tweets.data"
                            :key="item.id"
                            :item="item"
                        />
                    </div>
                </div>
                <div class="text-center p-8" v-else>
                    There is no tweet or its a private
                </div>
            </Feed>
        </div>
    </Component>
</template>
<script setup>
import { onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Feed from "@/Components/Feed.vue";
import FeedItem from "@/Components/FeedItem.vue";
import Reply from "@/Components/Reply.vue";
import { Head } from "@inertiajs/inertia-vue3";
import useTweetsStore from "@/Stores/tweets";
import useUserStore from "@/Stores/user";
const tweetsStore = useTweetsStore();
const userStore = useUserStore();

onMounted(() => {
    fetchTweet();
    loadReplies();
    fetchLoggedInUser();
});

const fetchTweet = () => {
    tweetsStore.fetchOne(route().params).then((response) => {
        tweetsStore.tweet = response?.data;
    });
};

const loadReplies = () => {
    tweetsStore.fetchReplies(route().params).then((response) => {
        tweetsStore.tweets = response?.data;
    });
};

const fetchLoggedInUser = () => {
    userStore.me().then((response) => {
        userStore.user = response?.data;
        window.localStorage.setItem("user", userStore.user);
    });
};

const onDeleteTweet = () => {
    Inertia.visit("/");
};
</script>
