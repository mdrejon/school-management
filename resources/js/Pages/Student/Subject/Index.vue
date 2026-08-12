<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    subjects: Object
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
    <StudentLayout title="My Subjects">
        <Head title="My Subjects" />
        
        <Card class="shadow-sm mt-4">
            <template #title>
                <div class="flex items-center gap-2">
                    <span class="text-white bg-[#0ea5e9] px-3 py-1 rounded-sm text-lg font-semibold">My Subjects</span>
                </div>
            </template>
            <template #content>
                <div class="flex justify-between items-center mb-4 mt-2">
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
                    :value="subjects.data"
                    :paginator="true"
                    :rows="entriesOption"
                    :filters="filters"
                    filterDisplay="menu"
                    :globalFilterFields="['name', 'code', 'academic_class.name']"
                    emptyMessage="No Data Found"
                    class="p-datatable-sm"
                >
                    <Column header="SL No." style="width: 15%">
                        <template #body="{ index }">
                            {{ index + 1 + ((subjects.current_page - 1) * subjects.per_page) }}
                        </template>
                    </Column>
                    <Column field="name" header="Subject Name" sortable style="width: 35%"></Column>
                    <Column field="code" header="Subject Code" sortable style="width: 25%"></Column>
                    <Column field="academic_class.name" header="Class" sortable style="width: 25%"></Column>
                </DataTable>
                
                <div class="mt-4 text-sm text-slate-600 flex justify-between items-center">
                    <div>Showing {{ subjects.from || 0 }} to {{ subjects.to || 0 }} of {{ subjects.total }} entries</div>
                </div>
            </template>
        </Card>
    </StudentLayout>
</template>
