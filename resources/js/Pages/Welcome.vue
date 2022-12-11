<template>
    <div>
        <Head title="Welcome" />

        <GuestLayout>
            <Feed>
                <Tweet />
                <FeedItem
                    v-for="item in tweetsStore.tweets?.data"
                    :item="item"
                    :key="item.id"
                />
            </Feed>
        </GuestLayout>
    </div>
</template>
<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Feed from "@/Components/Feed.vue";
import FeedItem from "@/Components/FeedItem.vue";
import Tweet from "@/Components/Tweet.vue";
import useTweetsStore from "@/Stores/tweets";
import useUserStore from "@/Stores/user";
const tweetsStore = useTweetsStore();
const userStore = useUserStore();

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

onMounted(() => {
    fetchTweets();
});

const fetchTweets = () => {
    tweetsStore.fetch().then((response) => {
        tweetsStore.tweets = response?.data;
    });
};
</script>
