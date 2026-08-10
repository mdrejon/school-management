<script setup>
import { computed, ref, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import menu from '@/admin-menu';

defineProps({
    onNavigate: {
        type: Function,
        default: () => {},
    },
});

const page = usePage();

const visibleMenu = computed(() => {
    const enabledModules = page.props.enabledModules ?? [];

    return menu
        .map((group) => {
            if (group.items) {
                return {
                    ...group,
                    items: group.items.filter((item) => !item.module || enabledModules.includes(item.module)),
                };
            }
            return group;
        })
        .filter((group) => !group.items || group.items.length > 0);
});

const isActive = (routeName) => {
    if (!routeName) return false;
    return route().current(routeName) || route().current(`${routeName}.*`);
};

const isGroupActive = (group) => {
    if (group.route && isActive(group.route)) return true;
    if (group.items && group.items.some((item) => isActive(item.route))) return true;
    return false;
};

const openGroups = ref({});

onMounted(() => {
    visibleMenu.value.forEach((group, index) => {
        if (group.items && isGroupActive(group)) {
            openGroups.value[index] = true;
        }
    });
});

const toggleGroup = (index) => {
    openGroups.value[index] = !openGroups.value[index];
};
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

        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <div v-for="(group, index) in visibleMenu" :key="index">
                <template v-if="!group.items">
                    <Link
                        :href="route(group.route)"
                        @click="onNavigate"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors mb-1"
                        :class="isActive(group.route)
                            ? 'bg-indigo-500/15 text-indigo-300'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white'"
                    >
                        <i v-if="group.icon" :class="group.icon" class="text-base" />
                        <span>{{ group.label }}</span>
                    </Link>
                </template>
                <template v-else>
                    <button
                        @click="toggleGroup(index)"
                        class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-sm transition-colors mb-1"
                        :class="isGroupActive(group) || openGroups[index]
                            ? 'text-white'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white'"
                    >
                        <div class="flex items-center gap-3">
                            <i v-if="group.icon" :class="group.icon" class="text-base" />
                            <span class="font-medium">{{ group.label }}</span>
                        </div>
                        <i :class="openGroups[index] ? 'pi pi-chevron-down' : 'pi pi-chevron-right'" class="text-[10px]" />
                    </button>

                    <div v-show="openGroups[index]" class="pl-7 space-y-1 mb-2">
                        <Link
                            v-for="item in group.items"
                            :key="item.route"
                            :href="route(item.route)"
                            @click="onNavigate"
                            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors"
                            :class="isActive(item.route)
                                ? 'bg-indigo-500/15 text-indigo-300'
                                : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                        >
                            <i :class="item.icon" class="text-[13px]" />
                            <span>{{ item.label }}</span>
                        </Link>
                    </div>
                </template>
            </div>
        </nav>
    </div>
</template>
