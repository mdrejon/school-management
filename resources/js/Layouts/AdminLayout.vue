<script setup>
import { ref, watch } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import Drawer from 'primevue/drawer';
import Toast from 'primevue/toast';
import ConfirmDialog from 'primevue/confirmdialog';
import SidebarNav from '@/Components/Admin/SidebarNav.vue';
import AdminHeader from '@/Components/Admin/AdminHeader.vue';

defineProps({
    title: {
        type: String,
        default: 'Dashboard',
    },
});

const mobileSidebarOpen = ref(false);

const page = usePage();
const toast = useToast();

watch(
    () => page.props.flash,
    (flash) => {
        if (flash?.success) {
            toast.add({ severity: 'success', summary: 'Success', detail: flash.success, life: 3500 });
        }
        if (flash?.error) {
            toast.add({ severity: 'error', summary: 'Error', detail: flash.error, life: 4500 });
        }
    },
    { immediate: true, deep: true },
);
</script>

<template>
    <Head :title="title" />
    <Toast />
    <ConfirmDialog />

    <div class="h-screen flex bg-slate-100 overflow-hidden">
        <aside class="hidden lg:flex lg:flex-col w-64 shrink-0 bg-slate-900">
            <SidebarNav />
        </aside>

        <Drawer
            v-model:visible="mobileSidebarOpen"
            class="!w-64 !bg-slate-900"
            :show-close-icon="false"
            :pt="{ header: { class: '!hidden' }, content: { class: '!p-0 !h-full' } }"
        >
            <SidebarNav :on-navigate="() => (mobileSidebarOpen = false)" />
        </Drawer>

        <div class="flex-1 flex flex-col min-w-0">
            <AdminHeader :title="title" @toggle-sidebar="mobileSidebarOpen = true" />

            <main class="flex-1 overflow-y-auto overflow-x-hidden p-4 sm:p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
