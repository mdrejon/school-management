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
    cmsPages: {
        type: Array,
        default: () => [],
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

const toggleItem = (node) => {
    router.patch(route('admin.cms.menus.items.toggle', node.id), {}, { preserveScroll: true });
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

const addCmsPageItem = (pageItem) => {
    const label = emptyTranslatable();
    const pageTitle = pageItem.title[defaultLangCode.value] ?? Object.values(pageItem.title ?? {})[0] ?? pageItem.slug;
    label[defaultLangCode.value] = pageTitle;
    router.post(route('admin.cms.menus.items.store'), {
        menu_id: props.menu.id,
        parent_id: null,
        type: 'model',
        label,
        linkable_type: 'page',
        linkable_id: pageItem.id,
        target: '_self',
        is_active: true,
    }, { preserveScroll: true });
};

/* ------------------------------------------------------------------ */
/* Drag-and-Drop Clone Generators (Left Sidebar to Right Tree)        */
/* ------------------------------------------------------------------ */

const prepareCmsPageClone = (pageItem) => {
    const label = emptyTranslatable();
    const pageTitle = pageItem.title[defaultLangCode.value] ?? Object.values(pageItem.title ?? {})[0] ?? pageItem.slug;
    label[defaultLangCode.value] = pageTitle;
    return {
        id: 'new-' + Date.now() + '-' + Math.random().toString(36).substr(2, 5),
        menu_id: props.menu.id,
        parent_id: null,
        type: 'model',
        label,
        linkable_type: 'page',
        linkable_id: pageItem.id,
        target: '_self',
        is_active: true,
        children: [],
        is_new: true,
    };
};

const prepareBuiltInRouteClone = (item) => {
    const label = emptyTranslatable();
    label[defaultLangCode.value] = item.title;
    return {
        id: 'new-' + Date.now() + '-' + Math.random().toString(36).substr(2, 5),
        menu_id: props.menu.id,
        parent_id: null,
        type: 'route',
        label,
        route_name: item.routeName,
        target: '_self',
        is_active: true,
        children: [],
        is_new: true,
    };
};

const prepareModuleClone = (record) => {
    const label = emptyTranslatable();
    label[defaultLangCode.value] = record.title;
    return {
        id: 'new-' + Date.now() + '-' + Math.random().toString(36).substr(2, 5),
        menu_id: props.menu.id,
        parent_id: null,
        type: 'model',
        label,
        linkable_type: addTab.value,
        linkable_id: record.id,
        target: '_self',
        is_active: true,
        children: [],
        is_new: true,
    };
};

const builtInRoutesList = computed(() => {
    return Object.entries(props.builtInRoutes).map(([routeName, title]) => ({
        id: routeName,
        routeName,
        title,
    }));
});

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

        <div class="grid grid-cols-1 lg:grid-cols-[360px_1fr] gap-6">
            <!-- Add items -->
            <Card class="shadow-sm lg:sticky lg:top-6 lg:self-start">
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
                                <div class="flex flex-col gap-4">
                                    <!-- Dynamic CMS Pages -->
                                    <div v-if="cmsPages.length" class="flex flex-col gap-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Dynamic CMS Pages</span>
                                            <span class="text-[11px] text-indigo-600 font-medium">Drag to place anywhere</span>
                                        </div>
                                        <draggable
                                            :list="cmsPages"
                                            item-key="id"
                                            :group="{ name: 'menu-items', pull: 'clone', put: false }"
                                            :clone="prepareCmsPageClone"
                                            :sort="false"
                                            class="flex flex-col gap-2"
                                        >
                                            <template #item="{ element: pageItem }">
                                                <div class="flex items-center justify-between gap-2 rounded border border-indigo-100 bg-indigo-50/50 px-2.5 py-2 cursor-grab active:cursor-grabbing hover:border-indigo-300 transition-colors">
                                                    <div class="flex items-center gap-2 overflow-hidden">
                                                        <i class="pi pi-bars text-slate-400 text-xs shrink-0" />
                                                        <div class="flex flex-col overflow-hidden">
                                                            <span class="text-sm font-medium text-slate-800 truncate">{{ pageItem.title[defaultLangCode] ?? Object.values(pageItem.title)[0] }}</span>
                                                            <span class="text-[11px] text-slate-400 font-mono">/{{ pageItem.slug }}</span>
                                                        </div>
                                                    </div>
                                                    <Button icon="pi pi-plus" text rounded size="small" title="Add to Menu" @click="addCmsPageItem(pageItem)" />
                                                </div>
                                            </template>
                                        </draggable>
                                    </div>

                                    <!-- System Pages -->
                                    <div class="flex flex-col gap-2">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">System Pages</span>
                                            <span class="text-[11px] text-indigo-600 font-medium">Drag to place anywhere</span>
                                        </div>
                                        <draggable
                                            :list="builtInRoutesList"
                                            item-key="id"
                                            :group="{ name: 'menu-items', pull: 'clone', put: false }"
                                            :clone="prepareBuiltInRouteClone"
                                            :sort="false"
                                            class="flex flex-col gap-2"
                                        >
                                            <template #item="{ element: item }">
                                                <div class="flex items-center justify-between gap-2 rounded border border-slate-100 bg-white px-2.5 py-2 cursor-grab active:cursor-grabbing hover:border-slate-300 transition-colors">
                                                    <div class="flex items-center gap-2 overflow-hidden">
                                                        <i class="pi pi-bars text-slate-400 text-xs shrink-0" />
                                                        <span class="text-sm text-slate-700 font-medium truncate">{{ item.title }}</span>
                                                    </div>
                                                    <Button icon="pi pi-plus" text rounded size="small" title="Add to Menu" @click="addBuiltInRoute(item.routeName, item.title)" />
                                                </div>
                                            </template>
                                        </draggable>
                                    </div>
                                </div>
                            </TabPanel>

                            <TabPanel v-for="(label, key) in linkableTypes" :key="key" :value="key">
                                <div class="flex flex-col gap-2">
                                    <InputText v-model="linkableSearch" class="w-full" :placeholder="`Search ${label}...`" @input="searchLinkables" />
                                    <p v-if="linkableLoading" class="text-xs text-slate-400">Searching…</p>
                                    <p v-else-if="!linkableResults.length" class="text-xs text-slate-400">No results.</p>
                                    <div v-else class="max-h-72 overflow-y-auto pr-1">
                                        <draggable
                                            :list="linkableResults"
                                            item-key="id"
                                            :group="{ name: 'menu-items', pull: 'clone', put: false }"
                                            :clone="prepareModuleClone"
                                            :sort="false"
                                            class="flex flex-col gap-2"
                                        >
                                            <template #item="{ element: record }">
                                                <div class="flex items-center justify-between gap-2 rounded border border-slate-100 bg-white px-2.5 py-2 cursor-grab active:cursor-grabbing hover:border-slate-300 transition-colors">
                                                    <div class="flex items-center gap-2 overflow-hidden">
                                                        <i class="pi pi-bars text-slate-400 text-xs shrink-0" />
                                                        <span class="text-sm text-slate-700 font-medium truncate">{{ record.title }}</span>
                                                    </div>
                                                    <Button icon="pi pi-plus" text rounded size="small" title="Add to Menu" @click="addModuleItem(key, record)" />
                                                </div>
                                            </template>
                                        </draggable>
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
                            <MenuItemNode :node="element" :languages="languages" :default-lang-code="defaultLangCode" @save="saveItem" @delete="deleteItem" @toggle="toggleItem" />
                        </template>
                    </draggable>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
