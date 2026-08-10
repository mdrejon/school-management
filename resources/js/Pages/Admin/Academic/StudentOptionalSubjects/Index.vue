<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    assignments: Array
});

const confirm = useConfirm();

const deleteAssignment = (assignment) => {
    confirm.require({
        message: 'Are you sure you want to remove this optional subject assignment?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.student-optional-subjects.destroy', assignment.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Student Optional Subjects">
        <Head title="Student Optional Subjects" />

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Student Optional Subjects</h1>
                <p class="text-sm text-slate-500 mt-1">Home - Student-optional-subject</p>
            </div>
            <Link :href="route('admin.academic.student-optional-subjects.create')">
                <Button label="Add Student Subject" class="!bg-sky-500 !border-sky-500" />
            </Link>
        </div>

        <Card class="shadow-sm border-none">
            <template #content>
                <DataTable :value="assignments" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-4">
                    <Column header="Student">
                        <template #body="{ data }">
                            {{ data.student?.first_name }} {{ data.student?.last_name }}
                        </template>
                    </Column>
                    <Column header="Subject">
                        <template #body="{ data }">
                            {{ data.subject?.name }}
                        </template>
                    </Column>
                    <Column header="Config">
                        <template #body="{ data }">
                            {{ data.optional_subject_config?.name }}
                        </template>
                    </Column>
                    <Column header="Action" :exportable="false" style="width: 10%">
                        <template #body="{ data }">
                            <div class="flex gap-2">
                                <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteAssignment(data)" />
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </AdminLayout>
</template>
