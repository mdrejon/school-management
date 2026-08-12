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
    assignments: Object
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
    <StudentLayout title="My Assignments">
        <Head title="My Assignments" />
        
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-slate-800">My Assignments</h2>
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
                    :value="assignments.data"
                    :paginator="true"
                    :rows="entriesOption"
                    :filters="filters"
                    filterDisplay="menu"
                    :globalFilterFields="['title', 'description', 'subject.name']"
                    emptyMessage="No Data Found"
                    class="p-datatable-sm"
                >
                    <Column field="title" header="Title" sortable style="width: 25%"></Column>
                    <Column field="description" header="Description" sortable style="width: 35%">
                        <template #body="{ data }">
                            <div class="truncate max-w-xs" :title="data.description">{{ data.description }}</div>
                        </template>
                    </Column>
                    <Column field="subject.name" header="Subject" sortable style="width: 20%"></Column>
                    <Column header="Details" style="width: 20%">
                        <template #body="{ data }">
                            <Button label="View Details" icon="pi pi-eye" outlined size="small" />
                        </template>
                    </Column>
                </DataTable>
                
                <div class="mt-4 text-sm text-slate-600 flex justify-between items-center">
                    <div>Showing {{ assignments.from || 0 }} to {{ assignments.to || 0 }} of {{ assignments.total }} entries</div>
                </div>
            </template>
        </Card>
    </StudentLayout>
</template>
