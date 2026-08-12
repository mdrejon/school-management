<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    submissions: Object
});

const filters = ref({
    global: { value: null, matchMode: 'contains' },
});

const entriesOption = ref(50);
const entriesOptions = [
    { label: '10', value: 10 },
    { label: '25', value: 25 },
    { label: '50', value: 50 },
    { label: '100', value: 100 },
];
</script>

<template>
    <StudentLayout title="Submit Assignment">
        <Head title="Submit Assignment" />
        
        <div class="mb-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-slate-800">Submit Assignment</h2>
            <Link :href="route('student.assignments.create')">
                <Button label="Submit Assignment" class="!bg-[#0ea5e9] !border-[#0ea5e9] hover:!bg-[#0284c7]" />
            </Link>
        </div>

        <Card class="shadow-sm">
            <template #content>
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-600">Show</span>
                        <Dropdown v-model="entriesOption" :options="entriesOptions" optionLabel="label" optionValue="value" class="w-20" size="small" />
                        <span class="text-sm text-slate-600">Entries</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-600">Search</span>
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <InputText v-model="filters['global'].value" placeholder="" class="w-48" size="small" />
                        </span>
                    </div>
                </div>

                <DataTable
                    :value="submissions.data"
                    :paginator="true"
                    :rows="entriesOption"
                    :filters="filters"
                    filterDisplay="menu"
                    :globalFilterFields="['assignment.title', 'assignment.academicClass.name', 'assignment.section.name', 'assignment.subject.name', 'assignment.deadline', 'status']"
                    emptyMessage="No Data Found"
                    class="p-datatable-sm"
                >
                    <Column field="assignment.title" header="Title" sortable></Column>
                    <Column field="assignment.academicClass.name" header="Class" sortable></Column>
                    <Column field="assignment.section.name" header="Section" sortable></Column>
                    <Column field="assignment.subject.name" header="Subject" sortable></Column>
                    <Column field="assignment.deadline" header="Dateline" sortable></Column>
                    <Column field="reviewer.name" header="Review By" sortable></Column>
                    <Column field="notes" header="Comment" sortable>
                        <template #body="{ data }">
                            <div class="truncate max-w-[100px]" :title="data.notes">{{ data.notes || '-' }}</div>
                        </template>
                    </Column>
                    <Column field="marks" header="Marks" sortable>
                        <template #body="{ data }">
                            {{ data.marks || '-' }}
                        </template>
                    </Column>
                    <Column header="Action">
                        <template #body="{ data }">
                            <Button icon="pi pi-eye" outlined size="small" class="p-button-rounded p-button-info" />
                        </template>
                    </Column>
                </DataTable>
                
                <div class="mt-4 text-sm text-slate-600 flex justify-between items-center">
                    <div>Showing {{ submissions.from || 0 }} to {{ submissions.to || 0 }} of {{ submissions.total }} entries</div>
                </div>
            </template>
        </Card>
    </StudentLayout>
</template>
