<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    configs: Array
});

const confirm = useConfirm();

const deleteConfig = (config) => {
    confirm.require({
        message: 'Are you sure you want to delete this optional subject configuration?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.optional-subject-configs.destroy', config.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Optional Subject Configuration">
        <Head title="Optional Subject Configuration" />

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Optional Subject Configuration</h1>
                <p class="text-sm text-slate-500 mt-1">Home - Optional-subject-config</p>
            </div>
            <Link :href="route('admin.academic.optional-subject-configs.create')">
                <Button label="Add Optional Subject" class="!bg-sky-500 !border-sky-500" />
            </Link>
        </div>

        <Card class="shadow-sm border-none">
            <template #title>
                <span class="text-lg font-semibold">Optional Subject List</span>
            </template>
            <template #content>
                <DataTable :value="configs" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-4">
                    <Column field="name" header="Name" sortable></Column>
                    <Column header="Class" sortable sortField="academic_class_id">
                        <template #body="{ data }">
                            {{ data.academic_class?.name || 'All' }}
                        </template>
                    </Column>
                    <Column header="Group" sortable sortField="academic_group_id">
                        <template #body="{ data }">
                            {{ data.academic_group?.name || 'All' }}
                        </template>
                    </Column>
                    <Column header="Subjects">
                        <template #body="{ data }">
                            <div class="flex flex-wrap gap-1">
                                <span v-for="subject in data.subjects" :key="subject.id" class="px-2 py-1 text-xs bg-sky-500 text-white rounded-md">
                                    {{ subject.name }}
                                </span>
                            </div>
                        </template>
                    </Column>
                    <Column field="limit" header="Limit" sortable></Column>
                    <Column header="Action" :exportable="false" style="width: 15%">
                        <template #body="{ data }">
                            <div class="flex gap-2">
                                <Link :href="route('admin.academic.optional-subject-configs.edit', data.id)">
                                    <Button icon="pi pi-pencil" severity="warning" size="small" />
                                </Link>
                                <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteConfig(data)" />
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </AdminLayout>
</template>
