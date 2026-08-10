<script setup>
import { ref } from 'vue';
import { useForm, Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import FileUpload from 'primevue/fileupload';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    signatures: Array
});

const confirm = useConfirm();

const form = useForm({
    id: null,
    place_at: '',
    title: '',
    signature_file: null,
});

const isEditing = ref(false);

const submit = () => {
    if (isEditing.value) {
        form.post(route('admin.academic.signatures.update', form.id), {
            forceFormData: true,
            onSuccess: () => {
                form.reset();
                isEditing.value = false;
            }
        });
    } else {
        form.post(route('admin.academic.signatures.store'), {
            onSuccess: () => form.reset()
        });
    }
};

const editSignature = (signature) => {
    isEditing.value = true;
    form.id = signature.id;
    form.place_at = signature.place_at;
    form.title = signature.title;
    form.signature_file = null;
    // For updates with file uploads in Inertia, we need to send as POST with _method=PUT
    form._method = 'PUT';
};

const cancelEdit = () => {
    isEditing.value = false;
    form.reset();
    delete form._method;
};

const deleteSignature = (signature) => {
    confirm.require({
        message: 'Are you sure you want to delete this signature?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.signatures.destroy', signature.id));
        }
    });
};

const onFileSelect = (event) => {
    form.signature_file = event.files[0];
};
</script>

<template>
    <AdminLayout title="Signature">
        <Head title="Signature" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Signature</h1>
            <p class="text-sm text-slate-500 mt-1">Home - Signatures</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Column -->
            <div class="md:col-span-1">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">{{ isEditing ? 'Edit Signature' : 'Add New Signature' }}</span>
                    </template>
                    <template #content>
                        <form @submit.prevent="submit" class="flex flex-col gap-5 mt-2">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Place At</label>
                                <InputText v-model="form.place_at" class="w-full bg-slate-50 border-slate-200" placeholder="Place At" :class="{ 'p-invalid': form.errors.place_at }" />
                                <p v-if="form.errors.place_at" class="text-xs text-red-500 mt-1">{{ form.errors.place_at }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                <InputText v-model="form.title" class="w-full bg-slate-50 border-slate-200" placeholder="Title" :class="{ 'p-invalid': form.errors.title }" />
                                <p v-if="form.errors.title" class="text-xs text-red-500 mt-1">{{ form.errors.title }}</p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Signature</label>
                                <FileUpload mode="basic" name="signature_file" accept="image/*" :maxFileSize="2000000" @select="onFileSelect" :auto="false" chooseLabel="Browse..." class="w-full" :class="{ 'p-invalid': form.errors.signature_file }" />
                                <p class="text-xs text-slate-400 mt-1" v-if="!form.signature_file">No file selected.</p>
                                <p class="text-xs text-green-500 mt-1" v-else>{{ form.signature_file.name }}</p>
                                <p v-if="form.errors.signature_file" class="text-xs text-red-500 mt-1">{{ form.errors.signature_file }}</p>
                            </div>

                            <div class="flex gap-2 mt-2">
                                <Button type="submit" :label="isEditing ? 'Update Signature' : 'Add Signature'" :loading="form.processing" class="!bg-sky-500 !border-sky-500" />
                                <Button v-if="isEditing" type="button" label="Cancel" severity="secondary" @click="cancelEdit" />
                            </div>
                        </form>
                    </template>
                </Card>
            </div>

            <!-- List Column -->
            <div class="md:col-span-2">
                <Card class="shadow-sm border-none">
                    <template #title>
                        <span class="text-lg font-semibold">Signature List</span>
                    </template>
                    <template #content>
                        <DataTable :value="signatures" paginator :rows="10" :rowsPerPageOptions="[10, 20, 50]" class="p-datatable-sm mt-2">
                            <Column field="place_at" header="Place At" sortable></Column>
                            <Column field="title" header="Title" sortable></Column>
                            <Column header="Signature">
                                <template #body="{ data }">
                                    <img v-if="data.signature_path" :src="data.signature_path" alt="signature" class="h-10 object-contain" />
                                    <span v-else class="text-slate-400 text-sm">No Image</span>
                                </template>
                            </Column>
                            <Column header="Action" :exportable="false" style="width: 20%">
                                <template #body="{ data }">
                                    <div class="flex gap-2">
                                        <Button icon="pi pi-pencil" severity="warning" size="small" @click="editSignature(data)" />
                                        <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteSignature(data)" />
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
