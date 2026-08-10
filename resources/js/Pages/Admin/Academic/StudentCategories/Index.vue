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
    categories: Array
});

const confirm = useConfirm();

const form = useForm({
    id: null,
    name: ''
});

const isEditing = ref(false);

const submit = () => {
    if (isEditing.value) {
        form.put(route('admin.academic.student-categories.update', form.id), {
            onSuccess: () => {
                form.reset();
                isEditing.value = false;
            }
        });
    } else {
        form.post(route('admin.academic.student-categories.store'), {
            onSuccess: () => form.reset()
        });
    }
};

const editCategory = (category) => {
    isEditing.value = true;
    form.id = category.id;
    form.name = category.name;
};

const deleteCategory = (category) => {
    confirm.require({
        message: 'Are you sure you want to delete this category?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.student-categories.destroy', category.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Student Category">
        <Head title="Student Category" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Student Category</h1>
            <p class="text-sm text-slate-500 mt-1">Home - Student-categories</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Column -->
            <div class="md:col-span-1">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">{{ isEditing ? 'Edit Category' : 'Add New Category' }}</span>
                    </template>
                    <template #content>
                        <form @submit.prevent="submit" class="flex flex-col gap-5 mt-2">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Category Name</label>
                                <InputText v-model="form.name" class="w-full bg-slate-50 border-slate-200" placeholder="Category name" :class="{ 'p-invalid': form.errors.name }" />
                                <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                            </div>

                            <div class="flex gap-2">
                                <Button type="submit" :label="isEditing ? 'Update Category' : 'Add Category'" :loading="form.processing" class="!bg-sky-500 !border-sky-500" />
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
                        <span class="text-lg font-semibold">Category List</span>
                    </template>
                    <template #content>
                        <DataTable :value="categories" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-2">
                            <Column field="name" header="Category Name" sortable></Column>
                            <Column header="Action" :exportable="false" style="width: 20%">
                                <template #body="{ data }">
                                    <div class="flex gap-2">
                                        <Button icon="pi pi-pencil" severity="warning" size="small" @click="editCategory(data)" />
                                        <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteCategory(data)" />
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
