<script setup>
import { ref } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import Avatar from 'primevue/avatar';
import Menu from 'primevue/menu';
import Button from 'primevue/button';

defineProps({
    title: {
        type: String,
        default: '',
    },
});

defineEmits(['toggle-sidebar']);

const page = usePage();
// For mock purposes since maybe teacher user doesn't have a specific auth setup yet
const user = page.props.auth?.user || { name: 'Teacher', profile_photo_url: '' };

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
    <header class="h-16 shrink-0 bg-[#F9FAFB] flex items-center justify-between px-4 sm:px-6">
        <div class="flex items-center gap-4">
            <button
                type="button"
                class="lg:hidden inline-flex items-center justify-center size-9 rounded-lg text-slate-500 hover:bg-slate-200"
                @click="$emit('toggle-sidebar')"
            >
                <i class="pi pi-bars text-lg" />
            </button>
        </div>

        <div class="flex items-center gap-4">
            <Button label="Cache Clear" severity="primary" rounded class="!px-4 !py-2 font-medium" />
            <Button icon="pi pi-external-link" severity="primary" rounded class="!w-10 !h-10 !p-0 flex items-center justify-center" />
            
            <button class="text-slate-400 hover:text-slate-600 transition-colors w-9 h-9 rounded-full flex items-center justify-center">
                <i class="pi pi-sun text-xl"></i>
            </button>

            <button type="button" class="flex items-center gap-2 outline-none" @click="toggleUserMenu">
                <Avatar :image="user.profile_photo_url" shape="circle" class="!bg-blue-400 text-white font-bold" />
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
        </div>
    </header>
</template>
