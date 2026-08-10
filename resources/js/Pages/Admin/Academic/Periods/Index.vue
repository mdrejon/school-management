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
    periods: Array
});

const confirm = useConfirm();

const form = useForm({
    id: null,
    name: '',
    serial_no: ''
});

const isEditing = ref(false);

const submit = () => {
    if (isEditing.value) {
        form.put(route('admin.academic.periods.update', form.id), {
            onSuccess: () => {
                form.reset();
                isEditing.value = false;
            }
        });
    } else {
        form.post(route('admin.academic.periods.store'), {
            onSuccess: () => form.reset()
        });
    }
};

const editPeriod = (period) => {
    isEditing.value = true;
    form.id = period.id;
    form.name = period.name;
    form.serial_no = period.serial_no;
};

const deletePeriod = (period) => {
    confirm.require({
        message: 'Are you sure you want to delete this period?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.periods.destroy', period.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Periods">
        <Head title="Period" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Period</h1>
            <p class="text-sm text-slate-500 mt-1">Home - Periods - {{ isEditing ? 'Edit' : 'Create' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Column -->
            <div class="md:col-span-1">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">{{ isEditing ? 'Edit Period' : 'Add Period' }}</span>
                    </template>
                    <template #content>
                        <form @submit.prevent="submit" class="flex flex-col gap-5 mt-2">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Period</label>
                                <InputText v-model="form.name" class="w-full bg-slate-50 border-slate-200" placeholder="Period" :class="{ 'p-invalid': form.errors.name }" />
                                <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Serial No</label>
                                <InputText v-model="form.serial_no" class="w-full bg-slate-50 border-slate-200" placeholder="SL NO." :class="{ 'p-invalid': form.errors.serial_no }" />
                                <p v-if="form.errors.serial_no" class="text-xs text-red-500 mt-1">{{ form.errors.serial_no }}</p>
                            </div>

                            <div class="flex gap-2">
                                <Button type="button" label="Reset" severity="danger" @click="() => { isEditing = false; form.reset(); }" />
                                <Button type="submit" :label="isEditing ? 'Update' : 'Save'" :loading="form.processing" class="!bg-sky-500 !border-sky-500" />
                            </div>
                        </form>
                    </template>
                </Card>
            </div>

            <!-- List Column -->
            <div class="md:col-span-2">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">Period List</span>
                    </template>
                    <template #content>
                        <DataTable :value="periods" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-2">
                            <Column field="name" header="Period Name" sortable></Column>
                            <Column field="serial_no" header="Serial No" sortable></Column>
                            <Column header="Action" :exportable="false" style="width: 20%">
                                <template #body="{ data }">
                                    <div class="flex gap-2">
                                        <Button icon="pi pi-pencil" severity="warning" size="small" @click="editPeriod(data)" />
                                        <Button icon="pi pi-trash" severity="danger" size="small" @click="deletePeriod(data)" />
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
