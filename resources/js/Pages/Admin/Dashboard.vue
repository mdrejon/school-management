<script setup>
import { ref, computed } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Chart from 'primevue/chart';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Tag from 'primevue/tag';
import Avatar from 'primevue/avatar';

const props = defineProps({
    studentsCount: String,
    teachersCount: String,
    staffCount: String,
    pendingCount: String,
    recentAdmissions: Array,
    chartData: Object,
});

const stats = computed(() => [
    { label: 'Students', value: props.studentsCount, icon: 'pi pi-users', color: 'bg-indigo-500' },
    { label: 'Teachers', value: props.teachersCount, icon: 'pi pi-user', color: 'bg-emerald-500' },
    { label: 'Staff', value: props.staffCount, icon: 'pi pi-id-card', color: 'bg-amber-500' },
    { label: 'Pending Admissions', value: props.pendingCount, icon: 'pi pi-inbox', color: 'bg-rose-500' },
]);

const chartOptions = ref({
    plugins: { legend: { display: false } },
    scales: {
        x: { grid: { display: false } },
        y: { grid: { color: '#f1f5f9' } },
    },
});

const getStatusSeverity = (status) => {
    switch (status?.toLowerCase()) {
        case 'approved': return 'success';
        case 'pending': return 'warning';
        case 'rejected': return 'danger';
        default: return 'info';
    }
};
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
                                <Tag :value="data.status" :severity="getStatusSeverity(data.status)" />
                            </template>
                        </Column>
                    </DataTable>
                    </div>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
