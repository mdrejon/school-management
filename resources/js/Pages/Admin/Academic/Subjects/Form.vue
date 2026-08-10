<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    subject: Object,
    classes: Array,
    groups: Array,
});

const form = useForm({
    academic_class_id: props.subject?.academic_class_id || null,
    academic_group_id: props.subject?.academic_group_id || null,
    name: props.subject?.name || '',
    code: props.subject?.code || '',
    short_form: props.subject?.short_form || '',
    type: props.subject?.type || 'Compulsory',
    serial_no: props.subject?.serial_no || '',
});

const subjectTypes = [
    { label: 'Compulsory', value: 'Compulsory' },
    { label: 'Optional', value: 'Optional' },
];

const submit = () => {
    if (props.subject) {
        form.put(route('admin.academic.subjects.update', props.subject.id));
    } else {
        form.post(route('admin.academic.subjects.store'));
    }
};
</script>

<template>
    <AdminLayout :title="subject ? 'Edit Subject' : 'Add New Subject'">
        <Head :title="subject ? 'Edit Subject' : 'Add New Subject'" />

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Subject</h1>
                <p class="text-sm text-slate-500 mt-1">Home - Subjects - {{ subject ? 'Edit' : 'Create' }}</p>
            </div>
            <Link :href="route('admin.academic.subjects.create')" v-if="subject">
                <Button label="Add New Subject" class="!bg-sky-500 !border-sky-500" />
            </Link>
        </div>

        <Card class="shadow-sm border-none">
            <template #title>
                <span class="text-lg font-semibold">{{ subject ? 'Edit Subject' : 'Add New Subject' }}</span>
            </template>
            <template #content>
                <form @submit.prevent="submit" class="mt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Class</label>
                            <Dropdown v-model="form.academic_class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.academic_class_id }" />
                            <p v-if="form.errors.academic_class_id" class="text-xs text-red-500 mt-1">{{ form.errors.academic_class_id }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Group</label>
                            <Dropdown v-model="form.academic_group_id" :options="groups" optionLabel="name" optionValue="id" placeholder="Select Group" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.academic_group_id }" showClear />
                            <p v-if="form.errors.academic_group_id" class="text-xs text-red-500 mt-1">{{ form.errors.academic_group_id }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Subject Name</label>
                            <InputText v-model="form.name" class="w-full bg-slate-50 border-slate-200" placeholder="Subject Name" :class="{ 'p-invalid': form.errors.name }" />
                            <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Subject Code</label>
                            <InputText v-model="form.code" class="w-full bg-slate-50 border-slate-200" placeholder="Subject Code" :class="{ 'p-invalid': form.errors.code }" />
                            <p v-if="form.errors.code" class="text-xs text-red-500 mt-1">{{ form.errors.code }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Subject Short Form</label>
                            <InputText v-model="form.short_form" class="w-full bg-slate-50 border-slate-200" placeholder="Subject Short Form" :class="{ 'p-invalid': form.errors.short_form }" />
                            <p v-if="form.errors.short_form" class="text-xs text-red-500 mt-1">{{ form.errors.short_form }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Subject Type</label>
                            <Dropdown v-model="form.type" :options="subjectTypes" optionLabel="label" optionValue="value" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.type }" />
                            <p v-if="form.errors.type" class="text-xs text-red-500 mt-1">{{ form.errors.type }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="col-span-1 md:col-start-2">
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">SL No</label>
                            <InputText v-model="form.serial_no" class="w-full bg-slate-50 border-slate-200" placeholder="sl no" :class="{ 'p-invalid': form.errors.serial_no }" />
                            <p v-if="form.errors.serial_no" class="text-xs text-red-500 mt-1">{{ form.errors.serial_no }}</p>
                        </div>
                    </div>

                    <div>
                        <Button type="submit" :label="subject ? 'Update Subject' : 'Add Subject'" :loading="form.processing" class="!bg-sky-500 !border-sky-500 px-8" />
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
