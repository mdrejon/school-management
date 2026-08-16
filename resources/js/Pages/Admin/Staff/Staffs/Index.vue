<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Tag from 'primevue/tag';
import Avatar from 'primevue/avatar';

const props = defineProps({
    staffs: {
        type: Array,
        default: () => [],
    },
});

const filters = ref({
    global: { value: null, matchMode: 'contains' },
});

</script>

<template>
    <AdminLayout title="staffs List">
        <Head title="staffs List" />

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">staffs</h1>
            <Link :href="route('admin.staff.staffs.create')">
                <Button label="Add New staff" icon="pi pi-plus" />
            </Link>
        </div>

        <Card class="shadow-sm border-none">
            <template #content>
                <div class="flex justify-end mb-4">
                    <span class="p-input-icon-left w-full sm:w-auto">
                        <i class="pi pi-search" />
                        <InputText v-model="filters['global'].value" placeholder="Search..." class="w-full" />
                    </span>
                </div>

                <DataTable
                    :value="staffs"
                    :paginator="true"
                    :rows="10"
                    dataKey="id"
                    :filters="filters"
                    responsiveLayout="scroll"
                    class="p-datatable-sm"
                >
                    <template #empty>
                        <div class="p-4 text-center text-slate-500">No staffs found.</div>
                    </template>

                    <Column field="photo" header="Profile" style="width: 5%">
                        <template #body="{ data }">
                            <Avatar :image="data.photo_url || '/images/default-avatar.png'" shape="circle" size="large" />
                        </template>
                    </Column>

                    <Column field="name" header="Name" sortable>
                        <template #body="{ data }">
                            <span class="font-medium text-slate-900">{{ typeof data.name === 'object' ? (data.name['en'] || data.name[Object.keys(data.name)[0]]) : data.name }}</span>
                        </template>
                    </Column>

                    <Column field="phone" header="Phone"></Column>

                    <Column field="email" header="Email"></Column>

                    <Column field="department.title" header="Department" sortable>
                        <template #body="{ data }">
                            {{ data.department ? (typeof data.department.title === 'object' ? (data.department.title['en'] || data.department.title[Object.keys(data.department.title)[0]]) : data.department.title) : '-' }}
                        </template>
                    </Column>

                    <Column field="designation" header="Designation" sortable>
                        <template #body="{ data }">
                            {{ typeof data.designation === 'object' ? (data.designation['en'] || data.designation[Object.keys(data.designation)[0]]) : data.designation }}
                        </template>
                    </Column>

                    <Column field="blood_group" header="Blood Group"></Column>

                    <Column field="is_active" header="Status" sortable>
                        <template #body="{ data }">
                            <Tag :severity="data.is_active ? 'success' : 'danger'" :value="data.is_active ? 'Active' : 'Inactive'" />
                        </template>
                    </Column>

                    <Column header="Action" style="width: 10%">
                        <template #body="{ data }">
                            <div class="flex gap-2">
                                <Link :href="route('admin.staff.staffs.edit', data.id)">
                                    <Button icon="pi pi-pencil" text rounded aria-label="Edit" />
                                </Link>
                                <Link :href="route('admin.staff.staffs.destroy', data.id)" method="delete" as="button">
                                    <Button icon="pi pi-trash" text rounded severity="danger" aria-label="Delete" />
                                </Link>
                            </div>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </AdminLayout>
</template>
