<template>
    <article class="border-b border-gray border-solid p-4">
        <div class="flex space-x-3 w-full">
            <div>
                <Link :href="route('user.profile', item.user.email)">
                    <Avatar
                        :user="item.user"
                        :color="
                            userStore.user.id == item.user.id
                                ? 'bg-teal-200 text-teal-700'
                                : 'bg-indigo-200 text-violet-600'
                        "
                    />
                </Link>
            </div>
            <div class="flex justify-between w-full">
                <div>
                    <div class="text-[15px] mb-4">
                        <div>
                            <Link
                                :href="route('user.profile', item.user.email)"
                            >
                                <b class="text-black">{{ item.user.name }}</b>
                            </Link>
                            <small class="text-[#999]">
                                - {{ item.created_at_for_humans }}</small
                            >
                        </div>
                        <p
                            class="text-[#0f1419] tweet-body"
                            v-html="item.tweet"
                        ></p>
                    </div>
                    <div class="flex space-x-4 items-center">
                        <div class="flex items-end space-x-2">
                            <CommentIcon class="w-4 cursor-pointer" />
                            <span
                                class="text-[#666666] text-sm"
                                v-if="item.replies_count"
                                >{{ item.replies_count }}</span
                            >
                        </div>
                        <div class="flex items-end space-x-2">
                            <HeartIcon
                                class="w-4 cursor-pointer"
                                @click="likeTweet(item)"
                                v-if="!item.your_like"
                            />
                            <HeartFullIcon
                                class="w-4 cursor-pointer"
                                @click="dislikeTweet(item)"
                                v-else
                            />
                            <span
                                class="text-[#666666] text-sm"
                                v-if="item.likes_count"
                                >{{ item.likes_count }}</span
                            >
                        </div>
                    </div>
                </div>
                <div
                    v-if="userStore.user.id == item.user.id"
                    class="relative group"
                    tabindex="-1"
                >
                    <MenuDotsIcon class="w-4 cursor-pointer" />
                    <div
                        class="border border-solid shadow-md absolute right-0 p-2 text-red-600 transition-all hidden group-focus:block"
                    >
                        <div
                            class="flex justify-center cursor-pointer space-x-2"
                            @click="deleteTweet(item)"
                        >
                            <TrashIcon class="w-4" /> <span>Delete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</template>
<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import Avatar from "@/Components/Avatar.vue";
import CommentIcon from "@/Assets/Icons/Comment.vue";
import HeartIcon from "@/Assets/Icons/Heart.vue";
import HeartFullIcon from "@/Assets/Icons/HeartFull.vue";
import MenuDotsIcon from "@/Assets/Icons/MenuDots.vue";
import TrashIcon from "@/Assets/Icons/Trash.vue";
import useTweetsStore from "@/Stores/tweets";
import useUserStore from "@/Stores/user";
const tweetsStore = useTweetsStore();
const userStore = useUserStore();
const loading = ref(false);

defineProps({
    item: {
        default: () => {},
        type: Object,
    },
});

const likeTweet = (item) => {
    if (!loading.value) {
        loading.value = true;
        tweetsStore.like({ id: item.id }).then(() => {
            item.likes_count++;
            item.your_like = 1;
            loading.value = false;
        });
    }
};

const dislikeTweet = (item) => {
    if (!loading.value) {
        loading.value = true;
        tweetsStore.dislike({ id: item.id }).then(() => {
            item.likes_count--;
            item.your_like = 0;
            loading.value = false;
        });
    }
};

const deleteTweet = (item) => {
    if (!loading.value) {
        loading.value = true;
        tweetsStore.delete({ id: item.id }).then(() => {
            tweetsStore.tweets.data = tweetsStore.tweets.data.filter(
                (tweet) => tweet.id != item.id
            );
        });
    }
};
</script>
<style>
.tweet-body > a {
    color: blue;
}
</style>
