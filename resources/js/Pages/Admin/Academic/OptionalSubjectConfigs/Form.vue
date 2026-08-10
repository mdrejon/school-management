<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import MultiSelect from 'primevue/multiselect';

const props = defineProps({
    config: Object,
    classes: Array,
    groups: Array,
    subjects: Array,
});

const form = useForm({
    name: props.config?.name || '',
    academic_class_id: props.config?.academic_class_id || null,
    academic_group_id: props.config?.academic_group_id || null,
    limit: props.config?.limit || 1,
    subject_ids: props.config?.subjects?.map(s => s.id) || [],
});

const submit = () => {
    if (props.config) {
        form.put(route('admin.academic.optional-subject-configs.update', props.config.id));
    } else {
        form.post(route('admin.academic.optional-subject-configs.store'));
    }
};
</script>

<template>
    <AdminLayout :title="config ? 'Edit Optional Subject' : 'Add Optional Subject'">
        <Head :title="config ? 'Edit Optional Subject' : 'Add Optional Subject'" />

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Optional Subject Configuration</h1>
                <p class="text-sm text-slate-500 mt-1">Home - Optional-subject-config - {{ config ? 'Edit' : 'Create' }}</p>
            </div>
        </div>

        <Card class="shadow-sm border-none max-w-4xl mx-auto">
            <template #title>
                <span class="text-lg font-semibold">{{ config ? 'Edit Optional Subject Configuration' : 'Add New Optional Subject Configuration' }}</span>
            </template>
            <template #content>
                <form @submit.prevent="submit" class="mt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Configuration Name</label>
                            <InputText v-model="form.name" class="w-full bg-slate-50 border-slate-200" placeholder="e.g. Drawing Option" :class="{ 'p-invalid': form.errors.name }" />
                            <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Selection Limit</label>
                            <InputText v-model="form.limit" type="number" class="w-full bg-slate-50 border-slate-200" placeholder="e.g. 1" :class="{ 'p-invalid': form.errors.limit }" />
                            <p v-if="form.errors.limit" class="text-xs text-red-500 mt-1">{{ form.errors.limit }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Class</label>
                            <Dropdown v-model="form.academic_class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class (Optional)" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.academic_class_id }" showClear />
                            <p v-if="form.errors.academic_class_id" class="text-xs text-red-500 mt-1">{{ form.errors.academic_class_id }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Group</label>
                            <Dropdown v-model="form.academic_group_id" :options="groups" optionLabel="name" optionValue="id" placeholder="Select Group (Optional)" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.academic_group_id }" showClear />
                            <p v-if="form.errors.academic_group_id" class="text-xs text-red-500 mt-1">{{ form.errors.academic_group_id }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Available Subjects</label>
                        <MultiSelect v-model="form.subject_ids" :options="subjects" optionLabel="name" optionValue="id" placeholder="Select Subjects" :filter="true" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.subject_ids }" display="chip" />
                        <p v-if="form.errors.subject_ids" class="text-xs text-red-500 mt-1">{{ form.errors.subject_ids }}</p>
                    </div>

                    <div class="flex gap-2">
                        <Button type="submit" :label="config ? 'Update Configuration' : 'Save Configuration'" :loading="form.processing" class="!bg-sky-500 !border-sky-500 px-8" />
                        <Link :href="route('admin.academic.optional-subject-configs.index')">
                            <Button type="button" label="Cancel" severity="secondary" />
                        </Link>
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
