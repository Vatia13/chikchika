<template>
    <div class="w-full p-4">
        <div class="flex space-x-4" v-if="userStore?.user?.id && id">
            <Link :href="route('profile.view', userStore.user.username)">
                <Avatar
                    :user="userStore.user"
                    color="bg-teal-200 text-teal-700"
                />
            </Link>
            <div class="w-full">
                <div class="items-center flex w-full">
                    <div
                        class="absolute text-[#536471] text-lg"
                        v-if="showPlaceholder"
                    >
                        Tweet your reply
                    </div>
                    <div
                        class="tweet-container"
                        @input="onChange"
                        ref="tweetContainerRef"
                        contenteditable
                    ></div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <div
                                v-if="errorMessage"
                                class="text-red-600 text-sm"
                            >
                                {{ errorMessage }}
                            </div>
                        </div>

                        <button
                            class="bg-[#1d9bf0] rounded-2xl px-8 py-2 text-white disabled:opacity-50"
                            :disabled="showPlaceholder"
                            @click="createTweet"
                        >
                            Reply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import Avatar from "@/Components/Avatar.vue";
import useUserStore from "@/Stores/user";
import useTweetsStore from "@/Stores/tweets";
const userStore = useUserStore();
const tweetsStore = useTweetsStore();
const showPlaceholder = ref(true);
const tweetContainerRef = ref(null);
const errorMessage = ref(null);

const props = defineProps({
    id: {
        default: null,
        type: Number,
    },
});

const onChange = (e) => {
    showPlaceholder.value = e.target.innerText.length > 0 ? false : true;
    tweetsStore.tweet.text = e.target.innerText;
    if (e.target.innerText.length <= 140) {
        errorMessage.value = null;
    }
};

const createTweet = (e) => {
    if (tweetsStore.tweet?.text) {
        tweetsStore
            .reply({ id: props.id, tweet: tweetsStore.tweet.text })
            .then((response) => {
                response.data.user = userStore.user;
                tweetsStore.tweets.data.unshift(response.data);
                tweetContainerRef.value.innerText = "";
                showPlaceholder.value = true;
            })
            .catch((error) => {
                errorMessage.value =
                    error.response?.data?.message ?? error.response.statusText;
            });
    }
};
</script>
<style scoped>
.tweet-container {
    z-index: 1;
    width: 100%;
    outline: none;
    user-select: text;
    white-space: pre-wrap;
    overflow-wrap: break-word;
}
</style>
