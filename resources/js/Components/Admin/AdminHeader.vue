<script setup>
import { ref, computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import Avatar from 'primevue/avatar';
import OverlayBadge from 'primevue/overlaybadge';
import Menu from 'primevue/menu';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import axios from 'axios';

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
const toggleUserMenu = (event) => userMenu.value.toggle(event);

const changeLanguage = () => {
    // Implement language change functionality
    console.log('Change language');
};

const logout = () => {
    axios.post(route('logout')).then(() => {
        window.location.href = '/';
    });
};

const profileRoute = computed(() => {
    if (page.url.startsWith('/student') && route().has('student.profile')) {
        return route('student.profile');
    }
    if (page.url.startsWith('/teacher') && route().has('teacher.profile')) {
        return route('teacher.profile');
    }
    return route('profile.show');
});
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

        <Menu ref="userMenu" :model="[]" :popup="true" class="w-72 mt-2 p-0">
            <template #start>
                <div class="p-4 border-b border-slate-100 flex items-center gap-3">
                    <Avatar :image="user.profile_photo_url" shape="circle" class="w-12 h-12" />
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-800 text-sm">Hi, {{ user.name }}</span>
                            <span class="bg-green-100 text-green-600 text-[10px] font-bold px-1.5 py-0.5 rounded">Pro</span>
                        </div>
                        <div class="text-xs text-slate-500">{{ user.email }}</div>
                    </div>
                </div>
                <div class="p-2 space-y-1 border-b border-slate-100">
                    <Link :href="profileRoute" class="flex items-center gap-3 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-lg">
                        <span class="font-medium">My Profile</span>
                    </Link>
                </div>
                <div class="p-2 space-y-1 border-b border-slate-100 flex justify-between items-center px-5">
                    <span class="text-sm font-medium text-slate-700">Language</span>
                    <button @click="changeLanguage" class="flex items-center gap-1 text-sm bg-gray-100 px-2 py-1 rounded">
                        English <img src="https://flagcdn.com/w20/us.png" alt="English" class="w-4 h-3 rounded-sm" />
                    </button>
                </div>
            </template>
            <template #end>
                <div class="p-2">
                    <button @click="logout" class="w-full text-left flex items-center gap-3 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-lg">
                        <span class="font-medium">Sign Out</span>
                    </button>
                </div>
            </template>
        </Menu>
    </header>
</template>
