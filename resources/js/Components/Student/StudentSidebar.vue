<script setup>
import { computed, ref, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
    onNavigate: {
        type: Function,
        default: () => {},
    },
});

const page = usePage();

const menu = [
    { 
        label: 'Dashboard', 
        icon: 'pi pi-th-large', 
        route: 'student.dashboard' 
    },
    { 
        label: 'Assignment', 
        icon: 'pi pi-file',
        items: [
            { label: 'My Assignment', icon: 'pi pi-circle-fill', route: 'student.assignments.index' },
            { label: 'Assignment Submit', icon: 'pi pi-circle-fill', route: 'student.assignments.submissions' },
        ]
    },
    { 
        label: 'Syllabus', 
        icon: 'pi pi-book',
        route: 'student.syllabus.index' 
    },
    { 
        label: 'Subjects', 
        icon: 'pi pi-tags',
        route: 'student.subjects.index' 
    },
    { 
        label: 'Class Routine', 
        icon: 'pi pi-calendar',
        route: 'student.class-routine.index' 
    },
    {
        label: 'Exam Routine',
        icon: 'pi pi-calendar-times',
        route: 'student.exam-routine.index'
    }
];

const isActive = (routeName) => {
    if (!routeName) return false;
    if (route().has(routeName)) {
        return route().current(routeName) || route().current(`${routeName}.*`);
    }
    return false;
};

const isGroupActive = (group) => {
    if (group.route && isActive(group.route)) return true;
    if (group.items && group.items.some((item) => isActive(item.route))) return true;
    return false;
};

const openGroups = ref({});

onMounted(() => {
    menu.forEach((group, index) => {
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
                <div class="text-slate-400 text-xs">Student Portal</div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <div v-for="(group, index) in menu" :key="index">
                <template v-if="!group.items">
                    <Link
                        v-if="route().has(group.route)"
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
                    <a v-else
                        href="#"
                        @click.prevent="onNavigate"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors mb-1"
                        :class="isActive(group.route)
                            ? 'bg-indigo-500/15 text-indigo-300'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white'"
                    >
                        <i v-if="group.icon" :class="group.icon" class="text-base" />
                        <span>{{ group.label }}</span>
                    </a>
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
                        <template v-for="item in group.items" :key="item.route">
                            <Link
                                v-if="route().has(item.route)"
                                :href="route(item.route)"
                                @click="onNavigate"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors"
                                :class="isActive(item.route)
                                    ? 'bg-indigo-500/15 text-indigo-300'
                                    : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                            >
                                <i v-if="item.icon" :class="item.icon" class="text-[13px]" />
                                <span>{{ item.label }}</span>
                            </Link>
                            <a v-else
                                href="#"
                                @click.prevent="onNavigate"
                                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors"
                                :class="isActive(item.route)
                                    ? 'bg-indigo-500/15 text-indigo-300'
                                    : 'text-slate-400 hover:bg-slate-800 hover:text-white'"
                            >
                                <i v-if="item.icon" :class="item.icon" class="text-[13px]" />
                                <span>{{ item.label }}</span>
                            </a>
                        </template>
                    </div>
                </template>
            </div>
            
            <Link
                v-if="route().has('logout')"
                :href="route('logout')"
                method="post"
                as="button"
                @click="onNavigate"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors mb-1 text-slate-300 hover:bg-slate-800 hover:text-white mt-4"
            >
                <i class="pi pi-sign-out text-base" />
                <span>Logout</span>
            </Link>
            <a v-else
                href="#"
                @click.prevent="onNavigate"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-colors mb-1 text-slate-300 hover:bg-slate-800 hover:text-white mt-4"
            >
                <i class="pi pi-sign-out text-base" />
                <span>Logout</span>
            </a>
        </nav>
    </div>
</template>
