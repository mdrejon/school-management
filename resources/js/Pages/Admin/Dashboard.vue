<script setup>
import { ref } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Chart from 'primevue/chart';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Tag from 'primevue/tag';
import Avatar from 'primevue/avatar';

const stats = [
    { label: 'Students', value: '1,284', icon: 'pi pi-users', color: 'bg-indigo-500' },
    { label: 'Teachers', value: '86', icon: 'pi pi-user', color: 'bg-emerald-500' },
    { label: 'Staff', value: '42', icon: 'pi pi-id-card', color: 'bg-amber-500' },
    { label: 'Pending Admissions', value: '17', icon: 'pi pi-inbox', color: 'bg-rose-500' },
];

const chartData = ref({
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    datasets: [
        {
            label: 'New Admissions',
            data: [28, 34, 41, 36, 52, 47, 60],
            fill: true,
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99, 102, 241, 0.15)',
            tension: 0.4,
        },
    ],
});

const chartOptions = ref({
    plugins: { legend: { display: false } },
    scales: {
        x: { grid: { display: false } },
        y: { grid: { color: '#f1f5f9' } },
    },
});

const recentAdmissions = ref([
    { name: 'Ayesha Rahman', class: 'Class 6', date: '2026-07-18', status: 'Pending' },
    { name: 'Fahim Hasan', class: 'Class 9', date: '2026-07-17', status: 'Approved' },
    { name: 'Nusrat Jahan', class: 'Class 3', date: '2026-07-17', status: 'Approved' },
    { name: 'Tanvir Ahmed', class: 'Class 11', date: '2026-07-16', status: 'Rejected' },
]);

const statusSeverity = (status) => ({
    Pending: 'warn',
    Approved: 'success',
    Rejected: 'danger',
}[status] ?? 'secondary');
</script>

<template>
    <AdminLayout title="Dashboard">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
            <Card v-for="stat in stats" :key="stat.label" class="shadow-sm">
                <template #content>
                    <div class="flex items-center gap-4">
                        <div :class="stat.color" class="size-12 rounded-lg flex items-center justify-center text-white">
                            <i :class="stat.icon" class="text-xl" />
                        </div>
                        <div>
                            <div class="text-2xl font-semibold text-slate-800">{{ stat.value }}</div>
                            <div class="text-sm text-slate-500">{{ stat.label }}</div>
                        </div>
                    </div>
                </template>
            </Card>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
            <Card class="xl:col-span-2 shadow-sm">
                <template #title>Admissions Overview</template>
                <template #content>
                    <Chart type="line" :data="chartData" :options="chartOptions" class="h-72" />
                </template>
            </Card>

            <Card class="shadow-sm">
                <template #title>Recent Admissions</template>
                <template #content>
                    <div class="overflow-x-auto">
                    <DataTable :value="recentAdmissions" size="small">
                        <Column field="name" header="Name">
                            <template #body="{ data }">
                                <div class="flex items-center gap-2">
                                    <Avatar :label="data.name.charAt(0)" shape="circle" size="normal" />
                                    <span>{{ data.name }}</span>
                                </div>
                            </template>
                        </Column>
                        <Column field="class" header="Class" />
                        <Column field="status" header="Status">
                            <template #body="{ data }">
                                <Tag :value="data.status" :severity="statusSeverity(data.status)" />
                            </template>
                        </Column>
                    </DataTable>
                    </div>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
