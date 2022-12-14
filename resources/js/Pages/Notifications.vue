<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Notifications
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8"
                >
                    <div class="border-l border-r border-gray border-solid">
                        <button
                            @click="readNotifications"
                            class="p-4 bg-green-300"
                        >
                            Mark all as read
                        </button>
                        <div
                            class="p-4 border-b border-solid border-gray-400 hover:bg-gray-200"
                            v-for="notification in notificationsStore.notifications"
                            :key="notification.id"
                        >
                            <span
                                :class="
                                    notification.read_at
                                        ? 'text-gray-400'
                                        : 'font-bold'
                                "
                                >{{ notification.data.message }}</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import useNotificationsStore from "@/Stores/notifications";
const notificationsStore = useNotificationsStore();

onMounted(() => {
    fetchNotifications();
});

const fetchNotifications = () => {
    notificationsStore.fetch().then((response) => {
        notificationsStore.notifications = response.data;
    });
};

const readNotifications = () => {
    notificationsStore.read().then(() => fetchNotifications());
};
</script>
