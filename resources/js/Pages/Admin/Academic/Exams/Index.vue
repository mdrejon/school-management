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
    exams: Array
});

const confirm = useConfirm();

const form = useForm({
    id: null,
    name: '',
    code: ''
});

const isEditing = ref(false);

const submit = () => {
    if (isEditing.value) {
        form.put(route('admin.academic.exams.update', form.id), {
            onSuccess: () => {
                form.reset();
                isEditing.value = false;
            }
        });
    } else {
        form.post(route('admin.academic.exams.store'), {
            onSuccess: () => form.reset()
        });
    }
};

const editExam = (exam) => {
    isEditing.value = true;
    form.id = exam.id;
    form.name = exam.name;
    form.code = exam.code;
};

const deleteExam = (exam) => {
    confirm.require({
        message: 'Are you sure you want to delete this exam?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.exams.destroy', exam.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Exam">
        <Head title="Exam" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Exam</h1>
            <p class="text-sm text-slate-500 mt-1">Home - Exams</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Column -->
            <div class="md:col-span-1">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">{{ isEditing ? 'Edit Exam' : 'Add New Exam' }}</span>
                    </template>
                    <template #content>
                        <form @submit.prevent="submit" class="flex flex-col gap-5 mt-2">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Name</label>
                                <InputText v-model="form.name" class="w-full bg-slate-50 border-slate-200" placeholder="Exam" :class="{ 'p-invalid': form.errors.name }" />
                                <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Exam Code</label>
                                <InputText v-model="form.code" class="w-full bg-slate-50 border-slate-200" placeholder="Exam code" :class="{ 'p-invalid': form.errors.code }" />
                                <p v-if="form.errors.code" class="text-xs text-red-500 mt-1">{{ form.errors.code }}</p>
                            </div>

                            <div class="flex gap-2">
                                <Button type="submit" :label="isEditing ? 'Update Exam' : 'Add Exam'" :loading="form.processing" class="!bg-sky-500 !border-sky-500" />
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
                        <span class="text-lg font-semibold">Exam List</span>
                    </template>
                    <template #content>
                        <DataTable :value="exams" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-2">
                            <Column field="name" header="Exam" sortable></Column>
                            <Column field="code" header="Code" sortable></Column>
                            <Column header="Action" :exportable="false" style="width: 20%">
                                <template #body="{ data }">
                                    <div class="flex gap-2">
                                        <Button icon="pi pi-pencil" severity="warning" size="small" @click="editExam(data)" />
                                        <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteExam(data)" />
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
