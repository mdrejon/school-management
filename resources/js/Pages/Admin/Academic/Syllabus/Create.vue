<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';

const props = defineProps({
    classes: Array,
    teachers: Array,
});

const form = useForm({
    class_id: '',
    teacher_id: null,
    title: '',
    description: '',
    file: null,
});

const handleFileChange = (event) => {
    form.file = event.target.files[0];
};

const submit = () => {
    form.post(route('admin.academic.syllabuses.store'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Create Syllabus">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Syllabus</h1>
            <p class="text-sm text-gray-500">Home - Admin - Syllabus - Create</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white max-w-4xl relative">
            <template #title>
                <div class="absolute top-4 right-4">
                    <Link :href="route('admin.academic.syllabuses.index')">
                        <Button label="Syllabus List" class="bg-blue-500 border-none" />
                    </Link>
                </div>
            </template>
            <template #content>
                <form @submit.prevent="submit" class="flex flex-col gap-6 mt-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teacher (Optional)</label>
                        <Dropdown v-model="form.teacher_id" :options="teachers" optionLabel="name" optionValue="id" placeholder="Select Teacher" class="w-full bg-gray-50" filter />
                        <div v-if="form.errors.teacher_id" class="text-red-500 text-xs mt-1">{{ form.errors.teacher_id }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                        <Dropdown v-model="form.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-gray-50" required />
                        <div v-if="form.errors.class_id" class="text-red-500 text-xs mt-1">{{ form.errors.class_id }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <InputText v-model="form.title" class="w-full" required />
                        <div v-if="form.errors.title" class="text-red-500 text-xs mt-1">{{ form.errors.title }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <Textarea v-model="form.description" rows="5" class="w-full" required />
                        <div v-if="form.errors.description" class="text-red-500 text-xs mt-1">{{ form.errors.description }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">File</label>
                        <input type="file" @change="handleFileChange" class="w-full border border-gray-300 rounded-md p-2 bg-white" required />
                        <div v-if="form.errors.file" class="text-red-500 text-xs mt-1">{{ form.errors.file }}</div>
                    </div>

                    <div class="mt-4">
                        <Button type="submit" label="Create Syllabus" :loading="form.processing" class="bg-blue-500 border-none" />
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
