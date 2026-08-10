<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const props = defineProps({
    students: {
        type: Array,
        default: () => []
    }
});

const classOptions = [
    { label: 'Class 1', value: 1 },
    { label: 'Class 2', value: 2 },
    { label: 'Class 3', value: 3 },
    { label: 'Class 4', value: 4 },
    { label: 'Class 5', value: 5 }
];

const sectionOptions = [
    { label: 'A', value: 1 },
    { label: 'B', value: 2 },
    { label: 'C', value: 3 }
];

const migrationTypeOptions = [
    { label: 'Promotion', value: 'promotion' },
    { label: 'Demotion', value: 'demotion' }
];

const form = useForm({
    from_class_id: null,
    from_section_id: null,
    to_class_id: null,
    to_section_id: null,
    academic_year: '2024-2025',
    migration_type: 'promotion',
    student_ids: []
});

const selectedStudents = ref([]);

const submit = () => {
    form.student_ids = selectedStudents.value.map(s => s.id);
    form.post(route('admin.students.migration.process'), {
        preserveScroll: true,
        onSuccess: () => {
            selectedStudents.value = [];
            form.reset('student_ids');
        }
    });
};

const getPictureUrl = (student) => {
    return student.picture ? `/storage/${student.picture}` : 'https://via.placeholder.com/50';
};
</script>

<template>
    <Head title="Migration" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Migration</h2>
                    <div class="text-sm text-blue-500 mt-1">Home - Student-migration</div>
                </div>
            </div>

            <Card class="mb-6">
                <template #content>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700">Select Class</label>
                            <Dropdown v-model="form.to_class_id" :options="classOptions" optionLabel="label" optionValue="value" placeholder="Select Class" class="w-full" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700">Select Section</label>
                            <Dropdown v-model="form.to_section_id" :options="sectionOptions" optionLabel="label" optionValue="value" placeholder="Select Section" class="w-full" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700">Migration Type</label>
                            <Dropdown v-model="form.migration_type" :options="migrationTypeOptions" optionLabel="label" optionValue="value" placeholder="---Select---" class="w-full" />
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">User List</h3>
                    
                    <DataTable v-model:selection="selectedStudents" :value="students" dataKey="id" stripedRows paginator :rows="10">
                        <template #empty>
                            <div class="text-center p-4">No students to display.</div>
                        </template>

                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column field="id" header="ID"></Column>
                        <Column field="roll_no" header="ROLL NO."></Column>
                        <Column header="NAME">
                            <template #body="slotProps">
                                <div class="flex items-center gap-3">
                                    <img :src="getPictureUrl(slotProps.data)" alt="Photo" class="w-10 h-10 object-cover rounded-full" />
                                    <span>{{ slotProps.data.first_name }} {{ slotProps.data.last_name }}</span>
                                </div>
                            </template>
                        </Column>
                        <Column field="class_id" header="CURRENT CLASS">
                            <template #body="slotProps">Class {{ slotProps.data.class_id || '-' }}</template>
                        </Column>
                        <Column field="section_id" header="CURRENT SECTION">
                            <template #body="slotProps">{{ slotProps.data.section_id || '-' }}</template>
                        </Column>
                    </DataTable>

                    <div class="mt-6 flex">
                        <Button label="Process" @click="submit" :loading="form.processing" class="px-8 py-2 bg-blue-500 hover:bg-blue-600 border-none text-white rounded-lg shadow-md font-medium" />
                    </div>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
