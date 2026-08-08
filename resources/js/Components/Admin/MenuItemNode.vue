<script setup>
import { ref, computed } from 'vue';
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
});

const emit = defineEmits(['save', 'delete', 'toggle']);

const expanded = ref(false);
const activeLang = ref(props.defaultLangCode);
const currentLang = computed(() => props.languages.find((lang) => lang.code === activeLang.value));

// Collapse toggle for the children list — only meaningful once a node
// already has children; an empty children list stays permanently visible
// since it's still a valid drop target for nesting a new item under this
// one (collapsing it would hide the only place to drop onto).
const hasChildren = computed(() => (props.node.children ?? []).length > 0);
const childrenCollapsed = ref(false);

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
    emit('save', props.node,
        () => { saving.value = false; expanded.value = false; },
        () => { saving.value = false; },
    );
};
</script>

<template>
    <div class="rounded-lg border border-slate-200 bg-white">
        <div class="flex items-center gap-2 p-2.5">
            <span class="wexnix-drag-handle cursor-move text-slate-400 px-1"><i class="pi pi-bars"></i></span>
            <Button
                v-if="hasChildren"
                :icon="childrenCollapsed ? 'pi pi-chevron-right' : 'pi pi-chevron-down'"
                text
                rounded
                size="small"
                aria-label="Toggle submenu"
                @click="childrenCollapsed = !childrenCollapsed"
            />
            <div class="flex-1 min-w-0">
                <span class="font-medium text-slate-800 text-sm">{{ defaultLabel }}</span>
                <span class="ml-2 text-xs px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">{{ typeBadge }}</span>
                <span v-if="node.is_new" class="ml-2 text-xs px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-medium">New</span>
                <span v-if="hasChildren" class="ml-2 text-xs text-slate-400">{{ node.children.length }} item{{ node.children.length === 1 ? '' : 's' }}</span>
            </div>
            <div class="flex items-center gap-1.5 shrink-0" v-tooltip.top="node.is_active ? 'Visible on the site — click to hide' : 'Hidden from the site — click to show'">
                <ToggleSwitch :model-value="node.is_active" @update:model-value="$emit('toggle', node)" />
                <span class="text-xs" :class="node.is_active ? 'text-slate-500' : 'text-red-500'">{{ node.is_active ? 'Visible' : 'Hidden' }}</span>
            </div>
            <Button icon="pi pi-pencil" text rounded size="small" @click="expanded = !expanded" />
            <Button icon="pi pi-trash" text rounded size="small" severity="danger" @click="$emit('delete', node)" />
        </div>

        <div v-if="expanded" class="px-3 pb-3 border-t border-slate-100 pt-3">
            <Tabs v-model:value="activeLang" class="mb-3">
                <TabList>
                    <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
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

        <draggable
            v-show="!hasChildren || !childrenCollapsed"
            v-model="node.children"
            item-key="id"
            group="menu-items"
            handle=".wexnix-drag-handle"
            class="ms-6 mb-2 flex flex-col gap-2"
            :class="node.children.length ? 'pt-2' : 'min-h-[10px]'"
        >
            <template #item="{ element }">
                <MenuItemNode :node="element" :languages="languages" :default-lang-code="defaultLangCode" @save="(...args) => $emit('save', ...args)" @delete="$emit('delete', $event)" @toggle="$emit('toggle', $event)" />
            </template>
        </draggable>
    </div>
</template>
