<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    syllabuses: Object
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
    <StudentLayout title="My Syllabus">
        <Head title="My Syllabus" />
        
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-slate-800">My Syllabus</h2>
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
                    :value="syllabuses.data"
                    :paginator="true"
                    :rows="entriesOption"
                    :filters="filters"
                    filterDisplay="menu"
                    :globalFilterFields="['title', 'description', 'academic_class.name']"
                    emptyMessage="No Data Found"
                    class="p-datatable-sm"
                >
                    <Column field="title" header="Title" sortable style="width: 20%"></Column>
                    <Column field="description" header="Description" sortable style="width: 25%">
                        <template #body="{ data }">
                            <div class="truncate max-w-[150px]" :title="data.description">{{ data.description || '-' }}</div>
                        </template>
                    </Column>
                    <Column field="academic_class.name" header="Class" sortable style="width: 15%"></Column>
                    <Column field="file_path" header="File" sortable style="width: 25%">
                        <template #body="{ data }">
                            <div class="truncate max-w-[150px]" :title="data.file_path">
                                {{ data.file_path ? data.file_path.split('/').pop() : '-' }}
                            </div>
                        </template>
                    </Column>
                    <Column header="View Details" style="width: 15%">
                        <template #body="{ data }">
                            <div class="flex gap-2">
                                <a v-if="data.file_path" :href="'/storage/' + data.file_path" target="_blank" download>
                                    <Button icon="pi pi-download" size="small" class="p-button-info !bg-[#0ea5e9] !border-[#0ea5e9] hover:!bg-[#0284c7]" />
                                </a>
                                <a v-if="data.file_path" :href="'/storage/' + data.file_path" target="_blank">
                                    <Button icon="pi pi-eye" size="small" class="p-button-info !bg-[#0ea5e9] !border-[#0ea5e9] hover:!bg-[#0284c7]" />
                                </a>
                            </div>
                        </template>
                    </Column>
                </DataTable>
                
                <div class="mt-4 text-sm text-slate-600 flex justify-between items-center">
                    <div>Showing {{ syllabuses.from || 0 }} to {{ syllabuses.to || 0 }} of {{ syllabuses.total }} entries</div>
                </div>
            </template>
        </Card>
    </StudentLayout>
</template>
