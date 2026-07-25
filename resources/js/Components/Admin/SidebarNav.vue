<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import menu from '@/admin-menu';

defineProps({
    onNavigate: {
        type: Function,
        default: () => {},
    },
});

const page = usePage();

// A menu item with no `module` key is always shown (e.g. Pages, Menus) —
// only items tied to a module a developer disabled in Site Configuration
// get filtered out, hiding the feature from the admin entirely rather than
// just leaving a broken/pointless link in place.
const visibleMenu = computed(() => {
    const enabledModules = page.props.enabledModules ?? [];

    return menu
        .map((group) => ({
            ...group,
            items: group.items.filter((item) => !item.module || enabledModules.includes(item.module)),
        }))
        .filter((group) => group.items.length > 0);
});

const isActive = (routeName) => route().current(routeName) || route().current(`${routeName}.*`);
</script>

<template>
    <div class="flex flex-col h-full">
        <div class="h-16 flex items-center gap-2 px-5 shrink-0 border-b border-slate-800">
            <div class="flex items-center justify-center size-9 rounded-lg bg-indigo-500 text-white font-bold">
                S
            </div>
            <div class="leading-tight">
                <div class="text-white font-semibold text-sm">School CMS</div>
                <div class="text-slate-400 text-xs">Admin Panel</div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-6">
            <div v-for="(group, index) in visibleMenu" :key="index">
                <div
                    v-if="group.label"
                    class="px-3 mb-2 text-[11px] font-semibold tracking-wider text-slate-500 uppercase"
                >
                    {{ group.label }}
                </div>

                <div class="space-y-1">
                    <Link
                        v-for="item in group.items"
                        :key="item.route"
                        :href="route(item.route)"
                        @click="onNavigate"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors"
                        :class="isActive(item.route)
                            ? 'bg-indigo-500/15 text-indigo-300'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white'"
                    >
                        <i :class="item.icon" class="text-base" />
                        <span>{{ item.label }}</span>
                    </Link>
                </div>
            </div>
        </nav>
    </div>
</template>
