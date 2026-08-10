<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const props = defineProps({
    migrations: {
        type: Array,
        default: () => []
    },
    filters: Object
});

const sectionOptions = [
    { label: 'All', value: 'all' },
    { label: 'A', value: 1 },
    { label: 'B', value: 2 },
    { label: 'C', value: 3 }
];

const academicYearOptions = [
    { label: '2024', value: '2024' },
    { label: '2024-2025', value: '2024-2025' },
    { label: '2025-2026', value: '2025-2026' }
];

const selectedYear = ref(props.filters?.academic_year || '2024');
const selectedSection = ref(props.filters?.section_id || 'all');

const search = () => {
    router.get(route('admin.students.migrated-list'), {
        academic_year: selectedYear.value,
        section_id: selectedSection.value
    }, { preserveState: true });
};

const getPictureUrl = (student) => {
    return (student && student.picture) ? `/storage/${student.picture}` : 'https://via.placeholder.com/50';
};
</script>

<template>
    <Head title="Migration List" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Migration List</h2>
                    <div class="text-sm text-blue-500 mt-1">Home - Migrated-list</div>
                </div>
            </div>

            <Card class="mb-6">
                <template #content>
                    <div class="flex flex-col md:flex-row gap-6 items-end">
                        <div class="flex flex-col gap-2 w-full md:w-1/3">
                            <label class="text-sm font-medium text-gray-700">Academic Year</label>
                            <Dropdown v-model="selectedYear" :options="academicYearOptions" optionLabel="label" optionValue="value" placeholder="Select Year" class="w-full" />
                        </div>
                        <div class="flex flex-col gap-2 w-full md:w-1/3">
                            <label class="text-sm font-medium text-gray-700">Section</label>
                            <Dropdown v-model="selectedSection" :options="sectionOptions" optionLabel="label" optionValue="value" placeholder="Select Section" class="w-full" />
                        </div>
                        <div class="w-full md:w-auto">
                            <Button label="Search" @click="search" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 border-none text-white rounded-lg shadow-md font-medium" />
                        </div>
                    </div>
                </template>
            </Card>

            <Card v-if="migrations.length > 0">
                <template #content>
                    <DataTable :value="migrations" stripedRows paginator :rows="10" class="p-datatable-sm">
                        <Column header="NAME">
                            <template #body="slotProps">
                                <div v-if="slotProps.data.student" class="flex items-center gap-3">
                                    <img :src="getPictureUrl(slotProps.data.student)" alt="Photo" class="w-10 h-10 object-cover rounded-full" />
                                    <span>{{ slotProps.data.student.first_name }} {{ slotProps.data.student.last_name }}</span>
                                </div>
                                <span v-else class="text-gray-400">Deleted Student</span>
                            </template>
                        </Column>
                        <Column field="from_class_id" header="FROM CLASS">
                            <template #body="slotProps">Class {{ slotProps.data.from_class_id || '-' }}</template>
                        </Column>
                        <Column field="to_class_id" header="TO CLASS">
                            <template #body="slotProps">Class {{ slotProps.data.to_class_id || '-' }}</template>
                        </Column>
                        <Column field="migration_type" header="TYPE">
                            <template #body="slotProps">
                                <span class="capitalize">{{ slotProps.data.migration_type || '-' }}</span>
                            </template>
                        </Column>
                        <Column field="migration_date" header="DATE">
                            <template #body="slotProps">
                                {{ new Date(slotProps.data.created_at).toLocaleDateString() }}
                            </template>
                        </Column>
                    </DataTable>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
