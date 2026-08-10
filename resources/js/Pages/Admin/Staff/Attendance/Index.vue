<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const roleOptions = [
    { label: 'Select Role', value: null },
    { label: 'Teacher', value: 'teacher' },
    { label: 'Staff', value: 'staff' },
];

const selectedRole = ref(null);
const selectedDate = ref(null);

const attendanceData = ref([]);

const search = () => {
    // Placeholder for search logic
    console.log('Searching for role:', selectedRole.value, 'date:', selectedDate.value);
};
</script>

<template>
    <AdminLayout title="Staff Attendance">
        <Head title="Staff Attendance" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Staffs Attendance</h1>
        </div>

        <Card class="shadow-sm border-none mb-6">
            <template #content>
                <div class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="w-full sm:w-1/3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Select Role</label>
                        <Dropdown v-model="selectedRole" :options="roleOptions" optionLabel="label" optionValue="value" placeholder="Select Role" class="w-full" />
                    </div>
                    <div class="w-full sm:w-1/3">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Date</label>
                        <Calendar v-model="selectedDate" dateFormat="yy-mm-dd" placeholder="Select Date" class="w-full" />
                    </div>
                    <div class="w-full sm:w-auto">
                        <Button label="Search" icon="pi pi-search" @click="search" class="w-full" />
                    </div>
                </div>
            </template>
        </Card>

        <!-- Placeholder for Attendance Table -->
        <Card class="shadow-sm border-none">
            <template #content>
                <DataTable :value="attendanceData" responsiveLayout="scroll" class="p-datatable-sm">
                    <template #empty>
                        <div class="p-4 text-center text-slate-500">No attendance data found. Please select criteria and search.</div>
                    </template>
                    <Column field="name" header="Name"></Column>
                    <Column field="designation" header="Designation"></Column>
                    <Column field="status" header="Status"></Column>
                </DataTable>
            </template>
        </Card>
    </AdminLayout>
</template>
