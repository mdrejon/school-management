<script setup>
import { ref } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import Avatar from 'primevue/avatar';
import OverlayBadge from 'primevue/overlaybadge';
import Menu from 'primevue/menu';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';

defineProps({
    title: {
        type: String,
        default: '',
    },
});

defineEmits(['toggle-sidebar']);

const page = usePage();
const user = page.props.auth.user;

const userMenu = ref();
const userMenuItems = ref([
    { label: 'Profile', icon: 'pi pi-user', route: 'profile.show' },
    {
        label: 'Log Out',
        icon: 'pi pi-sign-out',
        command: () => router.post(route('logout')),
    },
]);

const toggleUserMenu = (event) => userMenu.value.toggle(event);
</script>

<template>
    <header class="h-16 shrink-0 bg-white border-b border-slate-200 flex items-center gap-4 px-4 sm:px-6">
        <button
            type="button"
            class="lg:hidden inline-flex items-center justify-center size-9 rounded-lg text-slate-500 hover:bg-slate-100"
            @click="$emit('toggle-sidebar')"
        >
            <i class="pi pi-bars text-lg" />
        </button>

        <h1 class="text-lg font-semibold text-slate-800 truncate">
            {{ title }}
        </h1>

        <div class="flex-1" />

        <IconField class="hidden md:block w-64">
            <InputIcon class="pi pi-search" />
            <InputText placeholder="Search..." class="w-full" size="small" />
        </IconField>

        <OverlayBadge value="3" severity="danger" class="cursor-pointer">
            <i class="pi pi-bell text-xl text-slate-500" />
        </OverlayBadge>

        <button type="button" class="flex items-center gap-2" @click="toggleUserMenu">
            <Avatar :image="user.profile_photo_url" shape="circle" />
            <span class="hidden sm:block text-sm font-medium text-slate-700">{{ user.name }}</span>
            <i class="pi pi-angle-down text-xs text-slate-400 hidden sm:block" />
        </button>

        <Menu ref="userMenu" :model="userMenuItems" :popup="true">
            <template #item="{ item, props }">
                <Link v-if="item.route" :href="route(item.route)" v-bind="props.action">
                    <span :class="item.icon" />
                    <span class="ml-2">{{ item.label }}</span>
                </Link>
                <a v-else v-bind="props.action" @click="item.command">
                    <span :class="item.icon" />
                    <span class="ml-2">{{ item.label }}</span>
                </a>
            </template>
        </Menu>
    </header>
</template>
