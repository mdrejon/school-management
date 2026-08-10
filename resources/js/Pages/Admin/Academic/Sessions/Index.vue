<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import { useConfirm } from 'primevue/useconfirm';
import { router } from '@inertiajs/vue3';

defineProps({
    sessions: Array
});

const confirm = useConfirm();

const deleteSession = (session) => {
    confirm.require({
        message: 'Are you sure you want to delete this session?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.sessions.destroy', session.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Academic Sessions">
        <Head title="Academic Sessions" />

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Academic/Session Year</h1>
                <p class="text-sm text-slate-500 mt-1">Home - Academic-years</p>
            </div>
            <Link :href="route('admin.academic.sessions.create')">
                <Button label="Add Session" icon="pi pi-plus" />
            </Link>
        </div>

        <Card class="shadow-sm border-none">
            <template #content>
                <DataTable :value="sessions" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm">
                    <Column field="name" header="Session Name" sortable>
                        <template #body="{ data }">
                            {{ data.name }} <span v-if="data.is_active" class="text-green-600 font-medium">(Active)</span>
                        </template>
                    </Column>
                    <Column field="year" header="Academic Year" sortable></Column>
                    <Column header="Action" :exportable="false" style="width: 15%">
                        <template #body="{ data }">
                            <div class="flex gap-2">
                                <Link :href="route('admin.academic.sessions.edit', data.id)">
                                    <Button icon="pi pi-pencil" severity="warning" size="small" />
                                </Link>
                                <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteSession(data)" />
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </AdminLayout>
</template>
