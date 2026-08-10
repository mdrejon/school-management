<script setup>
import { ref, computed } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    students: Array,
    configs: Array,
    subjects: Array,
});

const form = useForm({
    student_id: null,
    optional_subject_config_id: null,
    subject_id: null,
});

const availableSubjects = computed(() => {
    if (!form.optional_subject_config_id) return [];
    const config = props.configs.find(c => c.id === form.optional_subject_config_id);
    if (!config) return [];
    return config.subjects || [];
});

const submit = () => {
    form.post(route('admin.academic.student-optional-subjects.store'));
};
</script>

<template>
    <AdminLayout title="Add Student Optional Subject">
        <Head title="Add Student Optional Subject" />

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Add Student Optional Subject</h1>
                <p class="text-sm text-slate-500 mt-1">Home - Student-optional-subject - Create</p>
            </div>
            <Link :href="route('admin.academic.student-optional-subjects.index')">
                <Button label="Student Optional List" class="!bg-sky-500 !border-sky-500" />
            </Link>
        </div>

        <Card class="shadow-sm border-none">
            <template #title>
                <span class="text-lg font-semibold">Assign Optional Subject To Student</span>
            </template>
            <template #content>
                <form @submit.prevent="submit" class="mt-4">
                    <div class="grid grid-cols-1 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Student</label>
                            <Dropdown v-model="form.student_id" :options="students" optionLabel="first_name" optionValue="id" placeholder="Select Student" filter class="w-full md:w-1/2 bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.student_id }">
                                <template #option="slotProps">
                                    {{ slotProps.option.first_name }} {{ slotProps.option.last_name }}
                                </template>
                                <template #value="slotProps">
                                    <span v-if="slotProps.value">
                                        {{ students.find(s => s.id === slotProps.value)?.first_name }} {{ students.find(s => s.id === slotProps.value)?.last_name }}
                                    </span>
                                    <span v-else>Select Student</span>
                                </template>
                            </Dropdown>
                            <p v-if="form.errors.student_id" class="text-xs text-red-500 mt-1">{{ form.errors.student_id }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Optional Subject Config</label>
                            <Dropdown v-model="form.optional_subject_config_id" :options="configs" optionLabel="name" optionValue="id" placeholder="Select Config" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.optional_subject_config_id }" />
                            <p v-if="form.errors.optional_subject_config_id" class="text-xs text-red-500 mt-1">{{ form.errors.optional_subject_config_id }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Subject</label>
                            <Dropdown v-model="form.subject_id" :options="availableSubjects" optionLabel="name" optionValue="id" placeholder="Select Subject" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.subject_id }" :disabled="!form.optional_subject_config_id" />
                            <p v-if="form.errors.subject_id" class="text-xs text-red-500 mt-1">{{ form.errors.subject_id }}</p>
                        </div>
                    </div>

                    <div>
                        <Button type="submit" label="Save" :loading="form.processing" class="!bg-sky-500 !border-sky-500 px-8" />
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
