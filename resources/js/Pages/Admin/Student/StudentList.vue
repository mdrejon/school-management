<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import { useToast } from 'primevue/usetoast';

const props = defineProps({
    students: Object
});

const toast = useToast();

const dt = ref();
const filters = ref({
    global: { value: null, matchMode: 'contains' },
});

const confirmDelete = (id) => {
    if (confirm('Are you sure you want to delete this student?')) {
        router.delete(route('admin.students.destroy', id), {
            onSuccess: () => {
                toast.add({ severity: 'success', summary: 'Success', detail: 'Student deleted successfully', life: 3000 });
            }
        });
    }
};
</script>

<template>
    <AdminLayout title="Students">
        <div class="mb-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-slate-800">Student List</h2>
            <Link :href="route('admin.students.create')">
                <Button label="Add Student" icon="pi pi-plus" size="small" />
            </Link>
        </div>

        <Card class="shadow-sm">
            <template #content>
                <DataTable
                    ref="dt"
                    :value="students.data"
                    :paginator="true"
                    :rows="10"
                    :filters="filters"
                    filterDisplay="menu"
                    :globalFilterFields="['first_name', 'last_name', 'roll_no', 'user.email']"
                    emptyMessage="No students found."
                >
                    <template #header>
                        <div class="flex justify-end">
                            <span class="p-input-icon-left">
                                <i class="pi pi-search" />
                                <InputText v-model="filters['global'].value" placeholder="Search..." />
                            </span>
                        </div>
                    </template>
                    
                    <Column field="roll_no" header="Roll No" sortable style="width: 15%"></Column>
                    <Column header="Name" sortable style="width: 25%">
                        <template #body="{ data }">
                            {{ data.first_name }} {{ data.last_name }}
                        </template>
                    </Column>
                    <Column field="class_id" header="Class" sortable style="width: 15%"></Column>
                    <Column field="section_id" header="Section" sortable style="width: 15%"></Column>
                    <Column field="gender" header="Gender" sortable style="width: 10%"></Column>
                    <Column header="Actions" :exportable="false" style="min-width:8rem">
                        <template #body="slotProps">
                            <Link :href="route('admin.students.edit', slotProps.data.id)">
                                <Button icon="pi pi-pencil" outlined rounded class="mr-2" />
                            </Link>
                            <Button icon="pi pi-trash" outlined rounded severity="danger" @click="confirmDelete(slotProps.data.id)" />
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </AdminLayout>
</template>
