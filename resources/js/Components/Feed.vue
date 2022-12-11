<template>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8">
            <div class="border-l border-r border-gray border-solid">
                <slot></slot>
            </div>
            <div
                class="flex justify-center py-8 text-blue-600"
                v-if="showLoadMore"
            >
                <button @click="fetchTweets">Load More</button>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";
import useTweetsStore from "@/Stores/tweets";
const tweetsStore = useTweetsStore();

const showLoadMore = computed(() => {
    return tweetsStore.tweets?.last_page > tweetsStore.tweets?.current_page;
});

const fetchTweets = () => {
    if (tweetsStore.tweets?.current_page < tweetsStore.tweets?.last_page) {
        const nextPage = tweetsStore.tweets.current_page + 1;
        tweetsStore.fetch({ page: nextPage }).then((response) => {
            if (tweetsStore.tweets?.data?.length) {
                tweetsStore.tweets.current_page = response?.data.current_page;
                tweetsStore.tweets.data = [
                    ...tweetsStore.tweets.data,
                    ...response?.data?.data,
                ];
            }
        });
    }
};
</script>
