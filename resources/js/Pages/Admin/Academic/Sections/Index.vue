<script setup>
import { ref } from 'vue';
import { useForm, Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    sections: Array,
    classes: Array,
    groups: Array,
});

const confirm = useConfirm();

const form = useForm({
    id: null,
    academic_class_id: null,
    academic_group_id: null,
    name: '',
    room_no: '',
});

const isEditing = ref(false);

const submit = () => {
    if (isEditing.value) {
        form.put(route('admin.academic.sections.update', form.id), {
            onSuccess: () => {
                form.reset();
                isEditing.value = false;
            }
        });
    } else {
        form.post(route('admin.academic.sections.store'), {
            onSuccess: () => form.reset()
        });
    }
};

const editSection = (section) => {
    isEditing.value = true;
    form.id = section.id;
    form.academic_class_id = section.academic_class_id;
    form.academic_group_id = section.academic_group_id;
    form.name = section.name;
    form.room_no = section.room_no;
};

const deleteSection = (section) => {
    confirm.require({
        message: 'Are you sure you want to delete this section?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.sections.destroy', section.id));
        }
    });
};
</script>

<template>
    <AdminLayout title="Sections">
        <Head title="Sections" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Sections</h1>
            <p class="text-sm text-slate-500 mt-1">Home - Sections</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Column -->
            <div class="lg:col-span-1">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">{{ isEditing ? 'Edit Section' : 'Add New Section' }}</span>
                    </template>
                    <template #content>
                        <form @submit.prevent="submit" class="flex flex-col gap-5 mt-2">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Class</label>
                                <Dropdown v-model="form.academic_class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.academic_class_id }" />
                                <p v-if="form.errors.academic_class_id" class="text-xs text-red-500 mt-1">{{ form.errors.academic_class_id }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Section Name</label>
                                <InputText v-model="form.name" class="w-full bg-slate-50 border-slate-200" placeholder="Section Name" :class="{ 'p-invalid': form.errors.name }" />
                                <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Group Name</label>
                                <Dropdown v-model="form.academic_group_id" :options="groups" optionLabel="name" optionValue="id" placeholder="Select Group Name" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.academic_group_id }" showClear />
                                <p v-if="form.errors.academic_group_id" class="text-xs text-red-500 mt-1">{{ form.errors.academic_group_id }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Room No/Name</label>
                                <InputText v-model="form.room_no" class="w-full bg-slate-50 border-slate-200" placeholder="Room No/Name" :class="{ 'p-invalid': form.errors.room_no }" />
                                <p v-if="form.errors.room_no" class="text-xs text-red-500 mt-1">{{ form.errors.room_no }}</p>
                            </div>

                            <div class="flex gap-2">
                                <Button type="submit" :label="isEditing ? 'Update Section' : 'Add Section'" :loading="form.processing" />
                                <Button v-if="isEditing" type="button" label="Cancel" severity="secondary" @click="() => { isEditing = false; form.reset(); }" />
                            </div>
                        </form>
                    </template>
                </Card>
            </div>

            <!-- List Column -->
            <div class="lg:col-span-2">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold">Section List</span>
                            <!-- <Dropdown :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-48 bg-slate-50 border-slate-200" /> -->
                        </div>
                    </template>
                    <template #content>
                        <DataTable :value="sections" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-2">
                            <Column header="Class Name" sortable sortField="academic_class_id">
                                <template #body="{ data }">
                                    {{ data.academic_class?.name || data.academicClass?.name }}
                                </template>
                            </Column>
                            <Column field="name" header="Section Name" sortable></Column>
                            <Column header="Group" sortable sortField="academic_group_id">
                                <template #body="{ data }">
                                    {{ data.academic_group?.name || data.academicGroup?.name || 'N/A' }}
                                </template>
                            </Column>
                            <Column header="Action" :exportable="false" style="width: 20%">
                                <template #body="{ data }">
                                    <div class="flex gap-2">
                                        <Button icon="pi pi-pencil" severity="warning" size="small" @click="editSection(data)" />
                                        <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteSection(data)" />
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
