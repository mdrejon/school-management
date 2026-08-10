<script setup>
import { ref, computed } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    subjects: Array,
    classes: Array,
});

const confirm = useConfirm();
const selectedClass = ref(null);

const filteredSubjects = computed(() => {
    if (!selectedClass.value) return props.subjects;
    return props.subjects.filter(s => s.academic_class_id === selectedClass.value);
});

const deleteSubject = (subject) => {
    confirm.require({
        message: 'Are you sure you want to delete this subject?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.subjects.destroy', subject.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Subjects List">
        <Head title="Subjects List" />

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Subjects List</h1>
                <p class="text-sm text-slate-500 mt-1">Home - Subjects</p>
            </div>
            <Link :href="route('admin.academic.subjects.create')">
                <Button label="Add New Subject" class="!bg-sky-500 !border-sky-500" />
            </Link>
        </div>

        <Card class="shadow-sm border-none">
            <template #content>
                <div class="flex justify-center mb-6 mt-4">
                    <div class="w-full max-w-md">
                        <label class="block text-sm font-medium text-slate-700 text-center mb-2">Select Class</label>
                        <Dropdown v-model="selectedClass" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-slate-50 border-slate-200" showClear />
                    </div>
                </div>

                <DataTable :value="filteredSubjects" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-4">
                    <Column field="name" header="Subject Name" sortable></Column>
                    <Column field="code" header="Subject Code" sortable></Column>
                    <Column header="Class" sortable sortField="academic_class_id">
                        <template #body="{ data }">
                            {{ data.academic_class?.name || 'N/A' }}
                        </template>
                    </Column>
                    <Column header="Action" :exportable="false" style="width: 15%">
                        <template #body="{ data }">
                            <div class="flex gap-2">
                                <Link :href="route('admin.academic.subjects.edit', data.id)">
                                    <Button icon="pi pi-pencil" severity="warning" size="small" />
                                </Link>
                                <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteSubject(data)" />
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </AdminLayout>
</template>
