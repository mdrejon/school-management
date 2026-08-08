<script setup>
import { computed } from 'vue';
import { router, usePage, Link } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import ToggleSwitch from 'primevue/toggleswitch';

const props = defineProps({
    pages: {
        type: Array,
        required: true,
    },
});

const page = usePage();
const defaultLangCode = computed(() => page.props.languages.find((l) => l.is_default)?.code);
const confirm = useConfirm();

const defaultText = (row, field) => row[field]?.[defaultLangCode.value] ?? Object.values(row[field] ?? {})[0] ?? '—';

const toggleActive = (row) => {
    router.patch(route('admin.cms.pages.toggle', row.id), {}, { preserveScroll: true });
};

const confirmDelete = (row) => {
    confirm.require({
        message: 'Remove this page? This can\'t be undone.',
        header: 'Remove page',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.pages.destroy', row.id), { preserveScroll: true }),
    });
};
</script>

<template>
    <AdminLayout title="Pages">
        <p class="text-sm text-slate-500 mb-6">
            Build free-form pages (About Us, Privacy Policy, ...) from drag-and-drop blocks — header, footer, and breadcrumb stay consistent with the rest of the site.
        </p>

        <Card class="shadow-sm">
            <template #title>
                <div class="flex items-center justify-between gap-4">
                    <div class="text-lg font-semibold">Pages</div>
                    <Link :href="route('admin.cms.pages.create')">
                        <Button label="Add Page" icon="pi pi-plus" as="span" />
                    </Link>
                </div>
            </template>
            <template #content>
                <div class="overflow-x-auto">
                    <DataTable :value="pages" data-key="id" size="small">
                        <Column header="Title">
                            <template #body="{ data }">
                                <div class="font-medium text-slate-800">{{ defaultText(data, 'title') }}</div>
                                <div class="text-xs text-slate-500 mt-1">/{{ data.slug }}</div>
                            </template>
                        </Column>

                        <Column header="Status">
                            <template #body="{ data }">
                                <div class="flex items-center gap-2">
                                    <ToggleSwitch :model-value="data.is_active" @update:model-value="() => toggleActive(data)" />
                                    <span class="text-xs text-slate-500">{{ data.is_active ? 'Active' : 'Inactive' }}</span>
                                </div>
                            </template>
                        </Column>

                        <Column header="" style="width: 170px">
                            <template #body="{ data }">
                                <div class="flex items-center gap-1 justify-end">
                                    <a :href="route('pages.show', data.slug)" target="_blank" title="View Frontend Page">
                                        <Button icon="pi pi-eye" text rounded severity="secondary" as="span" />
                                    </a>
                                    <a :href="route('admin.cms.pages.builder.edit', data.id)" target="_blank" title="Edit content visually">
                                        <Button icon="pi pi-objects-column" text rounded as="span" />
                                    </a>
                                    <Link :href="route('admin.cms.pages.edit', data.id)">
                                        <Button icon="pi pi-pencil" text rounded as="span" title="Edit title/SEO" />
                                    </Link>
                                    <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDelete(data)" />
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                    <p v-if="!pages.length" class="text-sm text-slate-400 text-center py-6">No pages yet — add one to get started.</p>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
