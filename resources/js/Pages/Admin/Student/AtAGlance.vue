<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Card from 'primevue/card';

const props = defineProps({
    students: {
        type: Array,
        default: () => []
    }
});

const getPictureUrl = (student) => {
    return student.picture ? `/storage/${student.picture}` : 'https://via.placeholder.com/50';
};
</script>

<template>
    <Head title="At A Glance" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
                    <div class="text-sm text-gray-500 mt-1">Home - At-a-glance</div>
                </div>
            </div>

            <Card>
                <template #content>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-500 uppercase tracking-wider">Student List</h3>
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Total Found : {{ students.length }}
                        </div>
                    </div>
                    
                    <DataTable :value="students" stripedRows paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm">
                        <template #empty>
                            <div class="text-center p-4 text-gray-500">No students found.</div>
                        </template>

                        <Column field="id" header="STUDENT ID" sortable></Column>
                        <Column field="roll_no" header="ROLL NO." sortable></Column>
                        <Column field="admission_number" header="ADMISSION NUMBER" sortable></Column>
                        <Column header="NAME">
                            <template #body="slotProps">
                                <div class="flex items-center gap-4">
                                    <img :src="getPictureUrl(slotProps.data)" alt="Photo" class="w-12 h-16 object-cover rounded shadow-sm border" />
                                    <span class="font-medium text-gray-900">{{ slotProps.data.first_name }} {{ slotProps.data.last_name }}</span>
                                </div>
                            </template>
                        </Column>
                        <Column field="class_id" header="CLASS" sortable>
                            <template #body="slotProps">
                                Class {{ slotProps.data.class_id || '-' }}
                            </template>
                        </Column>
                        <Column field="section_id" header="SECTION" sortable>
                            <template #body="slotProps">
                                Section {{ slotProps.data.section_id || '-' }}
                            </template>
                        </Column>
                        <Column field="gender" header="GENDER" sortable>
                            <template #body="slotProps">
                                <span class="capitalize">{{ slotProps.data.gender || '-' }}</span>
                            </template>
                        </Column>
                        <Column field="guardian_phone" header="G.MOBILE" sortable>
                            <template #body="slotProps">
                                {{ slotProps.data.guardian_phone || '-' }}
                            </template>
                        </Column>
                    </DataTable>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
