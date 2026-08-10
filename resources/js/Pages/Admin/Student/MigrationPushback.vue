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
    migrations: {
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

const form = useForm({
    migration_ids: []
});

const selectedMigrations = ref([]);

const submit = () => {
    form.migration_ids = selectedMigrations.value.map(m => m.id);
    form.post(route('admin.students.migration.pushback.process'), {
        preserveScroll: true,
        onSuccess: () => {
            selectedMigrations.value = [];
            form.reset('migration_ids');
        }
    });
};

const getPictureUrl = (student) => {
    return (student && student.picture) ? `/storage/${student.picture}` : 'https://via.placeholder.com/50';
};
</script>

<template>
    <Head title="Migration Pushback" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Migration Pushback</h2>
                    <div class="text-sm text-blue-500 mt-1">Home - Student-migration-pushback</div>
                </div>
            </div>

            <Card class="mb-6">
                <template #content>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700">Select Class</label>
                            <Dropdown :options="classOptions" optionLabel="label" optionValue="value" placeholder="Select Class" class="w-full" disabled />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-medium text-gray-700">Select Section</label>
                            <Dropdown :options="sectionOptions" optionLabel="label" optionValue="value" placeholder="Select Section" class="w-full" disabled />
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">User List</h3>
                    
                    <DataTable v-model:selection="selectedMigrations" :value="migrations" dataKey="id" stripedRows paginator :rows="10">
                        <template #empty>
                            <div class="text-center p-4">No recent migrations found.</div>
                        </template>

                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column header="NAME">
                            <template #body="slotProps">
                                <div v-if="slotProps.data.student" class="flex items-center gap-3">
                                    <img :src="getPictureUrl(slotProps.data.student)" alt="Photo" class="w-10 h-10 object-cover rounded-full" />
                                    <span>{{ slotProps.data.student.first_name }} {{ slotProps.data.student.last_name }}</span>
                                </div>
                                <span v-else class="text-gray-400">Student deleted</span>
                            </template>
                        </Column>
                        <Column field="from_class_id" header="FROM CLASS">
                            <template #body="slotProps">Class {{ slotProps.data.from_class_id || '-' }}</template>
                        </Column>
                        <Column field="to_class_id" header="TO CLASS">
                            <template #body="slotProps">Class {{ slotProps.data.to_class_id || '-' }}</template>
                        </Column>
                        <Column field="migration_date" header="DATE">
                            <template #body="slotProps">
                                {{ new Date(slotProps.data.created_at).toLocaleDateString() }}
                            </template>
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
