<script setup>
import { ref, computed, watch } from 'vue';
import draggable from 'vuedraggable';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Select from 'primevue/select';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    node: {
        type: Object,
        required: true,
    },
    languages: {
        type: Array,
        required: true,
    },
    defaultLangCode: {
        type: String,
        required: true,
    },
    index: {
        type: Number,
        default: 0,
    },
    parentList: {
        type: Array,
        default: () => [],
    },
    parentNode: {
        type: Object,
        default: null,
    },
    depth: {
        type: Number,
        default: 0,
    },
});

const emit = defineEmits([
    'save',
    'delete',
    'toggle',
    'move-up',
    'move-down',
    'indent',
    'outdent',
]);

const expanded = ref(false);
const activeLang = ref(props.defaultLangCode);
const currentLang = computed(() => props.languages.find((lang) => lang.code === activeLang.value));

// Collapse toggle for the children list
const hasChildren = computed(() => (props.node.children ?? []).length > 0);
const childrenCollapsed = ref(false);

// Auto-expand when a child item is added
watch(
    () => props.node.children?.length,
    (newLen, oldLen) => {
        if (newLen > (oldLen ?? 0)) {
            childrenCollapsed.value = false;
        }
    },
);

const typeBadge = computed(() => {
    if (props.node.type === 'custom') return 'Custom Link';
    if (props.node.type === 'route') return 'Page';
    if (props.node.type === 'model') {
        const key = props.node.linkable_type ?? '';
        return key ? key.charAt(0).toUpperCase() + key.slice(1) : 'Item';
    }
    return props.node.type;
});

const defaultLabel = computed(() => props.node.label?.[props.defaultLangCode] ?? Object.values(props.node.label ?? {}).find(Boolean) ?? '(untitled)');

const targetOptions = [
    { label: 'Same tab', value: '_self' },
    { label: 'New tab', value: '_blank' },
];

const saving = ref(false);
const save = () => {
    saving.value = true;
    emit(
        'save',
        props.node,
        () => {
            saving.value = false;
            expanded.value = false;
        },
        () => {
            saving.value = false;
        },
    );
};
</script>

<template>
    <div class="rounded-lg border border-slate-200 bg-white transition-all shadow-sm">
        <div class="flex items-center gap-1.5 p-2.5">
            <span class="wexnix-drag-handle cursor-move text-slate-400 hover:text-slate-700 px-1 py-1" v-tooltip.top="'Drag to reorder or nest'">
                <i class="pi pi-bars text-sm"></i>
            </span>

            <Button
                v-if="hasChildren"
                :icon="childrenCollapsed ? 'pi pi-chevron-right' : 'pi pi-chevron-down'"
                text
                rounded
                size="small"
                aria-label="Toggle submenu"
                class="!p-1 !w-7 !h-7 text-slate-500"
                @click="childrenCollapsed = !childrenCollapsed"
            />

            <div class="flex-1 min-w-0 flex items-center gap-2">
                <span class="font-medium text-slate-800 text-sm truncate">{{ defaultLabel }}</span>
                <span class="text-xs px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 shrink-0">{{ typeBadge }}</span>
                <span v-if="node.is_new" class="text-xs px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-medium shrink-0">New</span>
                <span v-if="hasChildren" class="text-xs text-indigo-600 font-medium shrink-0 bg-indigo-50 px-2 py-0.5 rounded-full">
                    {{ node.children.length }} sub-item{{ node.children.length === 1 ? '' : 's' }}
                </span>
            </div>

            <!-- Quick Hierarchy Actions (Move Up, Move Down, Nest / Indent, Outdent) -->
            <div class="flex items-center gap-0.5 border border-slate-200 rounded-lg p-0.5 bg-slate-50/80">
                <Button
                    v-if="index > 0"
                    icon="pi pi-arrow-up"
                    text
                    rounded
                    size="small"
                    class="!w-7 !h-7 !p-0 text-slate-500 hover:text-slate-800"
                    v-tooltip.top="'Move up'"
                    @click="$emit('move-up', parentList, index)"
                />
                <Button
                    v-if="index < parentList.length - 1"
                    icon="pi pi-arrow-down"
                    text
                    rounded
                    size="small"
                    class="!w-7 !h-7 !p-0 text-slate-500 hover:text-slate-800"
                    v-tooltip.top="'Move down'"
                    @click="$emit('move-down', parentList, index)"
                />
                <Button
                    v-if="index > 0 && depth < 2"
                    icon="pi pi-arrow-right"
                    text
                    rounded
                    size="small"
                    class="!w-7 !h-7 !p-0 text-indigo-600 hover:bg-indigo-100"
                    v-tooltip.top="'Nest under item above'"
                    @click="$emit('indent', parentList, index)"
                />
                <Button
                    v-if="parentNode !== null"
                    icon="pi pi-arrow-left"
                    text
                    rounded
                    size="small"
                    class="!w-7 !h-7 !p-0 text-indigo-600 hover:bg-indigo-100"
                    v-tooltip.top="'Move out to parent level'"
                    @click="$emit('outdent', parentList, index, parentNode)"
                />
            </div>

            <div class="flex items-center gap-1.5 shrink-0 ml-1" v-tooltip.top="node.is_active ? 'Visible on the site' : 'Hidden from the site'">
                <ToggleSwitch :model-value="node.is_active" @update:model-value="$emit('toggle', node)" />
                <span class="text-xs hidden sm:inline" :class="node.is_active ? 'text-slate-500' : 'text-red-500'">{{ node.is_active ? 'Visible' : 'Hidden' }}</span>
            </div>

            <Button icon="pi pi-pencil" text rounded size="small" class="!w-8 !h-8 !p-0 text-slate-600" v-tooltip.top="'Edit item'" @click="expanded = !expanded" />
            <Button icon="pi pi-trash" text rounded size="small" severity="danger" class="!w-8 !h-8 !p-0" v-tooltip.top="'Remove item'" @click="$emit('delete', node)" />
        </div>

        <div v-if="expanded" class="px-3 pb-3 border-t border-slate-100 pt-3">
            <Tabs v-model:value="activeLang" class="mb-3">
                <TabList>
                    <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name || lang.name || lang.code.toUpperCase() }}</Tab>
                </TabList>
            </Tabs>
            <div class="flex flex-col gap-3 max-w-md">
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">
                        Label {{ currentLang?.is_default ? '(required)' : '' }}
                    </label>
                    <InputText v-model="node.label[activeLang]" :dir="currentLang?.direction" class="w-full" />
                </div>
                <div v-if="node.type === 'custom'">
                    <label class="block text-xs font-medium text-slate-600 mb-1">URL</label>
                    <InputText v-model="node.url" class="w-full" placeholder="/about or https://..." />
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Open in</label>
                    <Select v-model="node.target" :options="targetOptions" option-label="label" option-value="value" class="w-full" placeholder="Same tab" />
                </div>
                <div class="flex justify-end">
                    <Button label="Save item" size="small" :loading="saving" @click="save" />
                </div>
            </div>
        </div>

        <!-- Nested Children Dropdown Container -->
        <draggable
            v-show="!hasChildren || !childrenCollapsed"
            v-model="node.children"
            item-key="id"
            group="menu-items"
            handle=".wexnix-drag-handle"
            :animation="150"
            :empty-insert-threshold="40"
            :fallback-on-body="true"
            :swap-threshold="0.65"
            :invert-swap="true"
            ghost-class="wexnix-sortable-ghost"
            drag-class="wexnix-sortable-drag"
            class="ms-6 my-1.5 flex flex-col gap-2 transition-all"
            :class="[
                node.children.length
                    ? 'p-2 rounded-lg bg-slate-50/80 border border-slate-100'
                    : 'min-h-[50px] p-2 rounded-lg border-2 border-dashed border-indigo-200/90 bg-indigo-50/25 hover:border-indigo-400 hover:bg-indigo-50/50 flex items-center justify-center'
            ]"
        >
            <template #header v-if="!node.children.length">
                <div class="pointer-events-none select-none text-xs text-indigo-600 font-medium flex items-center justify-center gap-1.5 py-1">
                    <i class="pi pi-arrow-down-right text-indigo-500 text-xs"></i>
                    <span>Drop here to nest under <strong>{{ defaultLabel }}</strong></span>
                </div>
            </template>
            <template #item="{ element: childElement, index: childIndex }">
                <MenuItemNode
                    :node="childElement"
                    :index="childIndex"
                    :parent-list="node.children"
                    :parent-node="node"
                    :depth="depth + 1"
                    :languages="languages"
                    :default-lang-code="defaultLangCode"
                    @save="(...args) => $emit('save', ...args)"
                    @delete="$emit('delete', $event)"
                    @toggle="$emit('toggle', $event)"
                    @move-up="(list, idx) => $emit('move-up', list, idx)"
                    @move-down="(list, idx) => $emit('move-down', list, idx)"
                    @indent="(list, idx) => $emit('indent', list, idx)"
                    @outdent="(list, idx, parent) => $emit('outdent', list, idx, parent)"
                />
            </template>
        </draggable>
    </div>
</template>
