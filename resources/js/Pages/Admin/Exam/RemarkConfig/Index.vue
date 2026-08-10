<script setup>
import { ref, computed } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
import { useToast } from 'primevue/usetoast';

const props = defineProps({
    remarks: Array,
});

const toast = useToast();

const form = useForm({
    title: '',
    remarks: '',
});

const editingId = ref(null);

const submit = () => {
    if (editingId.value) {
        form.put(route('admin.exam-remarks.update', editingId.value), {
            onSuccess: () => {
                form.reset();
                editingId.value = null;
            }
        });
    } else {
        form.post(route('admin.exam-remarks.store'), {
            onSuccess: () => {
                form.reset();
            }
        });
    }
};

const editRemark = (remark) => {
    editingId.value = remark.id;
    form.title = remark.title;
    form.remarks = remark.remarks;
};

const cancelEdit = () => {
    editingId.value = null;
    form.reset();
    form.clearErrors();
};

const deleteRemark = (id) => {
    if (confirm('Are you sure you want to delete this remark?')) {
        router.delete(route('admin.exam-remarks.destroy', id));
    }
};

const search = ref('');
const filteredRemarks = computed(() => {
    if (!search.value) return props.remarks;
    const lower = search.value.toLowerCase();
    return props.remarks.filter(r => 
        r.title.toLowerCase().includes(lower) || 
        r.remarks.toLowerCase().includes(lower)
    );
});
</script>

<template>
    <AdminLayout title="Remark Config">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Remark Config</h1>
            <p class="text-sm text-gray-500">Home - Remarks-config</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left: Form -->
            <div class="lg:col-span-1">
                <Card class="shadow-sm border border-slate-100 rounded-xl bg-white h-full">
                    <template #title>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ editingId ? 'Edit Remark' : 'Add New Remarks' }}</h3>
                    </template>
                    <template #content>
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Remark Title</label>
                                <InputText v-model="form.title" placeholder="Remark Title" class="w-full" required />
                                <div v-if="form.errors.title" class="text-red-500 text-xs mt-1">{{ form.errors.title }}</div>
                            </div>
                            
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                                <Textarea v-model="form.remarks" placeholder="Remarks" rows="5" class="w-full" required />
                                <div v-if="form.errors.remarks" class="text-red-500 text-xs mt-1">{{ form.errors.remarks }}</div>
                            </div>

                            <div class="flex items-center gap-2">
                                <Button type="submit" :label="editingId ? 'Update Remarks' : 'Create Remarks'" :loading="form.processing" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600" />
                                <Button v-if="editingId" @click="cancelEdit" type="button" label="Cancel" class="p-button-secondary p-button-outlined" />
                            </div>
                        </form>
                    </template>
                </Card>
            </div>
            
            <!-- Right: Datatable -->
            <div class="lg:col-span-2">
                <Card class="shadow-sm border border-slate-100 rounded-xl bg-white h-full">
                    <template #title>
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Remarks Config List</h3>
                    </template>
                    <template #content>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-600">Show</span>
                                <Dropdown :options="[{label:'50', value:50}]" modelValue="50" optionLabel="label" optionValue="value" class="w-20 p-inputtext-sm" />
                                <span class="text-sm text-gray-600">Entries</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-600">Search</span>
                                <InputText v-model="search" class="p-inputtext-sm" />
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 border-collapse">
                                <thead class="text-xs text-gray-600 font-semibold bg-transparent border-b">
                                    <tr>
                                        <th class="px-4 py-3 w-16">SL NO.</th>
                                        <th class="px-4 py-3 w-32">Title</th>
                                        <th class="px-4 py-3">Remarks</th>
                                        <th class="px-4 py-3 text-right w-24">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, index) in filteredRemarks" :key="row.id" class="border-b">
                                        <td class="px-4 py-4 text-center">{{ index + 1 }}</td>
                                        <td class="px-4 py-4 font-semibold text-gray-800">{{ row.title }}</td>
                                        <td class="px-4 py-4">{{ row.remarks }}</td>
                                        <td class="px-4 py-4 text-right whitespace-nowrap">
                                            <Button @click="editRemark(row)" icon="pi pi-pencil" class="p-button-rounded p-button-warning p-button-sm mr-2 w-8 h-8" />
                                            <Button @click="deleteRemark(row.id)" icon="pi pi-trash" class="p-button-rounded p-button-danger p-button-sm w-8 h-8" />
                                        </td>
                                    </tr>
                                    <tr v-if="filteredRemarks.length === 0">
                                        <td colspan="4" class="text-center py-4">No data available</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </AdminLayout>
</template>
