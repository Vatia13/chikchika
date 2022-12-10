<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12">
            <Feed>
                <Tweet />
                <FeedItem
                    v-for="item in tweetsStore.tweets?.data"
                    :item="item"
                    :key="item.id"
                />
            </Feed>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Feed from "@/Components/Feed.vue";
import FeedItem from "@/Components/FeedItem.vue";
import Tweet from "@/Components/Tweet.vue";
import { Head } from "@inertiajs/inertia-vue3";
import useTweetsStore from "@/Stores/tweets";
import useUserStore from "@/Stores/user";
const tweetsStore = useTweetsStore();
const userStore = useUserStore();

onMounted(() => {
    fetchTweets();
    fetchLoggedInUser();
});

const fetchTweets = () => {
    tweetsStore.fetch().then((response) => {
        tweetsStore.tweets = response?.data;
    });
};

const fetchLoggedInUser = () => {
    userStore.me().then((response) => {
        userStore.user = response?.data;
        window.localStorage.setItem("user", userStore.user);
    });
};
</script>
