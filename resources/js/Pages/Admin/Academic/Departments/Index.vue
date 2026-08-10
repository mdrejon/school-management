<script setup>
import { ref } from 'vue';
import { useForm, Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    departments: Array
});

const confirm = useConfirm();

const form = useForm({
    id: null,
    name: '',
    priority: 0
});

const isEditing = ref(false);

const submit = () => {
    if (isEditing.value) {
        form.put(route('admin.academic.departments.update', form.id), {
            onSuccess: () => {
                form.reset();
                isEditing.value = false;
            }
        });
    } else {
        form.post(route('admin.academic.departments.store'), {
            onSuccess: () => form.reset()
        });
    }
};

const editDepartment = (department) => {
    isEditing.value = true;
    form.id = department.id;
    form.name = department.name;
    form.priority = department.priority;
};

const deleteDepartment = (department) => {
    confirm.require({
        message: 'Are you sure you want to delete this department?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.departments.destroy', department.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Department">
        <Head title="Department" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Department</h1>
            <p class="text-sm text-slate-500 mt-1">Home - Departments</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Column -->
            <div class="md:col-span-1">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">{{ isEditing ? 'Edit Department' : 'Add New Department' }}</span>
                    </template>
                    <template #content>
                        <form @submit.prevent="submit" class="flex flex-col gap-5 mt-2">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Department Name</label>
                                <InputText v-model="form.name" class="w-full bg-slate-50 border-slate-200" placeholder="Department Name" :class="{ 'p-invalid': form.errors.name }" />
                                <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Priority</label>
                                <InputText v-model="form.priority" type="number" class="w-full bg-slate-50 border-slate-200" placeholder="Priority" :class="{ 'p-invalid': form.errors.priority }" />
                                <p v-if="form.errors.priority" class="text-xs text-red-500 mt-1">{{ form.errors.priority }}</p>
                            </div>

                            <div class="flex gap-2">
                                <Button type="submit" :label="isEditing ? 'Update Department' : 'Add Department'" :loading="form.processing" class="!bg-sky-500 !border-sky-500" />
                                <Button v-if="isEditing" type="button" label="Cancel" severity="secondary" @click="() => { isEditing = false; form.reset(); }" />
                            </div>
                        </form>
                    </template>
                </Card>
            </div>

            <!-- List Column -->
            <div class="md:col-span-2">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">Department List</span>
                    </template>
                    <template #content>
                        <DataTable :value="departments" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-2">
                            <Column field="name" header="Department Name" sortable></Column>
                            <Column field="priority" header="Priority" sortable></Column>
                            <Column header="Action" :exportable="false" style="width: 20%">
                                <template #body="{ data }">
                                    <div class="flex gap-2">
                                        <Button icon="pi pi-pencil" severity="warning" size="small" @click="editDepartment(data)" />
                                        <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteDepartment(data)" />
                                    </div>
                                </template>
                            </Column>
                        </DataTable>
                    </template>
                </Card>
            </div>
        </div>
    </AdminLayout>
</template>
