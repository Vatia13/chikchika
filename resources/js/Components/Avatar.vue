<template>
    <div v-if="user?.name">
        <div
            class="rounded-full w-12 h-12 flex justify-center items-center font-bold"
            :class="color"
        >
            <span>{{ user.name.charAt(0) }}</span>
        </div>
    </div>
</template>
<script setup>
defineProps({
    user: {
        default: () => {},
        type: Object,
    },
    color: {
        default: "bg-indigo-200 text-violet-600",
        type: String,
    },
});
</script>
