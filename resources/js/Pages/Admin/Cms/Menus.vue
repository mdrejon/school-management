<script setup>
import { ref, computed, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import draggable from 'vuedraggable';
import { useToast } from 'primevue/usetoast';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MenuItemNode from '@/Components/Admin/MenuItemNode.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Select from 'primevue/select';
import Tabs from 'primevue/tabs';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

const props = defineProps({
    menu: {
        type: Object,
        required: true,
    },
    items: {
        type: Array,
        required: true,
    },
    linkableTypes: {
        type: Object,
        required: true,
    },
    builtInRoutes: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const toast = useToast();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((lang) => lang.is_default)?.code);
const emptyTranslatable = () => Object.fromEntries(languages.value.map((lang) => [lang.code, '']));

/* ------------------------------------------------------------------ */
/* Live drag-and-drop working tree                                      */
/* ------------------------------------------------------------------ */

const cloneTree = (nodes) => nodes.map((node) => ({ ...node, children: cloneTree(node.children ?? []) }));

const tree = ref(cloneTree(props.items));
watch(() => props.items, (value) => { tree.value = cloneTree(value); });

const saving = ref(false);
const flatten = (nodes, parentId = null) => {
    const rows = [];
    nodes.forEach((node, index) => {
        rows.push({ id: node.id, parent_id: parentId, sort_order: index });
        rows.push(...flatten(node.children ?? [], node.id));
    });
    return rows;
};

const saveOrder = () => {
    saving.value = true;
    router.patch(route('admin.cms.menus.reorder'), { items: flatten(tree.value) }, {
        preserveScroll: true,
        onFinish: () => (saving.value = false),
    });
};

const saveItem = (node, onSuccess, onError) => {
    router.put(route('admin.cms.menus.items.update', node.id), {
        type: node.type,
        label: node.label,
        url: node.url,
        route_name: node.route_name,
        linkable_type: node.linkable_type,
        linkable_id: node.linkable_id,
        target: node.target,
        is_active: node.is_active,
    }, {
        preserveScroll: true,
        onSuccess: () => onSuccess?.(),
        onError: (errors) => {
            const message = Object.values(errors)[0] ?? 'Could not save this menu item — please check the fields and try again.';
            toast.add({ severity: 'error', summary: 'Not saved', detail: message, life: 6000 });
            onError?.();
        },
    });
};

const deleteItem = (node) => {
    if (! confirm('Remove this menu item? Any children under it will be removed too.')) {
        return;
    }
    router.delete(route('admin.cms.menus.items.destroy', node.id), { preserveScroll: true });
};

/* ------------------------------------------------------------------ */
/* Add items panel                                                      */
/* ------------------------------------------------------------------ */

const addTab = ref('custom');
const addTabOptions = computed(() => [
    { label: 'Custom Link', value: 'custom' },
    { label: 'Pages', value: 'pages' },
    ...Object.entries(props.linkableTypes).map(([value, label]) => ({ label, value })),
]);

// Custom link
const customForm = ref({ label: emptyTranslatable(), url: '', target: '_self' });
const addCustomLink = () => {
    if (! customForm.value.label[defaultLangCode.value] || ! customForm.value.url) {
        return;
    }
    router.post(route('admin.cms.menus.items.store'), {
        menu_id: props.menu.id,
        parent_id: null,
        type: 'custom',
        label: customForm.value.label,
        url: customForm.value.url,
        target: customForm.value.target,
        is_active: true,
    }, {
        preserveScroll: true,
        onSuccess: () => { customForm.value = { label: emptyTranslatable(), url: '', target: '_self' }; },
    });
};

// Built-in pages
const addBuiltInRoute = (routeName, title) => {
    const label = emptyTranslatable();
    label[defaultLangCode.value] = title;
    router.post(route('admin.cms.menus.items.store'), {
        menu_id: props.menu.id,
        parent_id: null,
        type: 'route',
        label,
        route_name: routeName,
        target: '_self',
        is_active: true,
    }, { preserveScroll: true });
};

// Module items (Course/Teacher/Event/Department/Notice)
const linkableSearch = ref('');
const linkableResults = ref([]);
const linkableLoading = ref(false);
let searchTimer = null;

const searchLinkables = () => {
    if (addTab.value === 'custom' || addTab.value === 'pages') {
        return;
    }
    clearTimeout(searchTimer);
    searchTimer = setTimeout(async () => {
        linkableLoading.value = true;
        try {
            const response = await fetch(route('admin.cms.menus.linkables', { type: addTab.value, q: linkableSearch.value }));
            linkableResults.value = response.ok ? await response.json() : [];
        } finally {
            linkableLoading.value = false;
        }
    }, 300);
};

watch(addTab, () => {
    linkableSearch.value = '';
    linkableResults.value = [];
    if (addTab.value !== 'custom' && addTab.value !== 'pages') {
        searchLinkables();
    }
});

const addModuleItem = (type, record) => {
    const label = emptyTranslatable();
    label[defaultLangCode.value] = record.title;
    router.post(route('admin.cms.menus.items.store'), {
        menu_id: props.menu.id,
        parent_id: null,
        type: 'model',
        label,
        linkable_type: type,
        linkable_id: record.id,
        target: '_self',
        is_active: true,
    }, { preserveScroll: true });
};

const targetOptions = [
    { label: 'Same tab', value: '_self' },
    { label: 'New tab', value: '_blank' },
];
</script>

<template>
    <AdminLayout title="Menus">
        <p class="text-sm text-slate-500 mb-6">
            Build the site's header navigation — add custom links or link straight to a course, teacher, event,
            department, or notice, drag to reorder, and drag onto another item to nest it as a submenu.
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-[360px_1fr] gap-6 items-start">
            <!-- Add items -->
            <Card class="shadow-sm">
                <template #title>
                    <div class="text-base font-semibold">Add menu items</div>
                </template>
                <template #content>
                    <Select
                        v-model="addTab"
                        :options="addTabOptions"
                        option-label="label"
                        option-value="value"
                        class="w-full mb-4"
                    />
                    <Tabs v-model:value="addTab">
                        <TabPanels>
                            <TabPanel value="custom">
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">
                                            Label ({{ languages.find((l) => l.is_default)?.native_name }})
                                        </label>
                                        <InputText v-model="customForm.label[defaultLangCode]" class="w-full" placeholder="e.g. About Us" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">URL</label>
                                        <InputText v-model="customForm.url" class="w-full" placeholder="/about or https://..." />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">Open in</label>
                                        <Select v-model="customForm.target" :options="targetOptions" option-label="label" option-value="value" class="w-full" />
                                    </div>
                                    <Button label="Add to Menu" icon="pi pi-plus" size="small" @click="addCustomLink" />
                                </div>
                            </TabPanel>

                            <TabPanel value="pages">
                                <div class="flex flex-col gap-2">
                                    <div v-for="(title, routeName) in builtInRoutes" :key="routeName" class="flex items-center justify-between gap-2 rounded border border-slate-100 px-2 py-1.5">
                                        <span class="text-sm text-slate-700">{{ title }}</span>
                                        <Button icon="pi pi-plus" text rounded size="small" @click="addBuiltInRoute(routeName, title)" />
                                    </div>
                                </div>
                            </TabPanel>

                            <TabPanel v-for="(label, key) in linkableTypes" :key="key" :value="key">
                                <div class="flex flex-col gap-2">
                                    <InputText v-model="linkableSearch" class="w-full" :placeholder="`Search ${label}...`" @input="searchLinkables" />
                                    <p v-if="linkableLoading" class="text-xs text-slate-400">Searching…</p>
                                    <p v-else-if="!linkableResults.length" class="text-xs text-slate-400">No results.</p>
                                    <div v-else class="flex flex-col gap-2 max-h-72 overflow-y-auto">
                                        <div v-for="record in linkableResults" :key="record.id" class="flex items-center justify-between gap-2 rounded border border-slate-100 px-2 py-1.5">
                                            <span class="text-sm text-slate-700 truncate">{{ record.title }}</span>
                                            <Button icon="pi pi-plus" text rounded size="small" @click="addModuleItem(key, record)" />
                                        </div>
                                    </div>
                                </div>
                            </TabPanel>
                        </TabPanels>
                    </Tabs>
                </template>
            </Card>

            <!-- Tree -->
            <Card class="shadow-sm">
                <template #title>
                    <div class="flex items-center justify-between gap-4">
                        <div class="text-base font-semibold">{{ menu.name }}</div>
                        <Button label="Save Menu Structure" icon="pi pi-check" size="small" :loading="saving" @click="saveOrder" />
                    </div>
                </template>
                <template #content>
                    <p v-if="!tree.length" class="text-sm text-slate-400">No menu items yet — add some from the left panel.</p>
                    <draggable
                        v-model="tree"
                        item-key="id"
                        group="menu-items"
                        handle=".wexnix-drag-handle"
                        class="flex flex-col gap-2"
                    >
                        <template #item="{ element }">
                            <MenuItemNode :node="element" :languages="languages" :default-lang-code="defaultLangCode" @save="saveItem" @delete="deleteItem" />
                        </template>
                    </draggable>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
