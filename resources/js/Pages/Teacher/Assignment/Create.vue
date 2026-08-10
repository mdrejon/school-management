<script setup>
import { useForm, router } from '@inertiajs/vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';

const props = defineProps({
    classes: Array,
    sections: Array,
    subjects: Array,
    filters: Object,
});

const form = useForm({
    title: '',
    description: '',
    deadline: '',
    class_id: props.filters?.class_id || '',
    section_id: '',
    subject_id: '',
    files: [null, null, null, null],
});

const fetchSections = () => {
    if (form.class_id) {
        router.get(route('teacher.assignments.create'), {
            class_id: form.class_id,
        }, { preserveState: true, only: ['sections', 'filters'] });
        form.section_id = ''; // reset section when class changes
    }
};

const handleFileChange = (event, index) => {
    form.files[index] = event.target.files[0];
};

const submit = () => {
    // Convert date object to string if necessary
    const submissionData = { ...form };
    if (submissionData.deadline && typeof submissionData.deadline !== 'string') {
        submissionData.deadline = submissionData.deadline.toISOString().slice(0, 10);
    }

    form.transform((data) => ({
        ...data,
        deadline: submissionData.deadline,
    })).post(route('teacher.assignments.store'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <TeacherLayout title="Add New Assignment">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-sm text-gray-500">Home - Teacher - Create-assignment</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white max-w-4xl">
            <template #title>
                <h2 class="text-xl font-bold text-slate-800 pb-2">Add New Assignment</h2>
            </template>
            <template #content>
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <InputText v-model="form.title" class="w-full" required />
                        <div v-if="form.errors.title" class="text-red-500 text-xs mt-1">{{ form.errors.title }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <Textarea v-model="form.description" rows="5" class="w-full" />
                        <div v-if="form.errors.description" class="text-red-500 text-xs mt-1">{{ form.errors.description }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deadline</label>
                        <Calendar v-model="form.deadline" dateFormat="yy-mm-dd" showIcon class="w-full md:w-1/2" required />
                        <div v-if="form.errors.deadline" class="text-red-500 text-xs mt-1">{{ form.errors.deadline }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                        <Dropdown v-model="form.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full md:w-1/2 bg-gray-50" @change="fetchSections" required />
                        <div v-if="form.errors.class_id" class="text-red-500 text-xs mt-1">{{ form.errors.class_id }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                        <Dropdown v-model="form.section_id" :options="sections" optionLabel="name" optionValue="id" placeholder="Select Section" class="w-full md:w-1/2 bg-gray-50" required :disabled="!form.class_id" />
                        <div v-if="form.errors.section_id" class="text-red-500 text-xs mt-1">{{ form.errors.section_id }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <Dropdown v-model="form.subject_id" :options="subjects" optionLabel="name" optionValue="id" placeholder="Select Subject" class="w-full md:w-1/2 bg-gray-50" required />
                        <div v-if="form.errors.subject_id" class="text-red-500 text-xs mt-1">{{ form.errors.subject_id }}</div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">File</label>
                            <input type="file" @change="e => handleFileChange(e, 0)" class="w-full border border-gray-300 rounded-md p-2 bg-white" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">File (Optional)</label>
                            <input type="file" @change="e => handleFileChange(e, 1)" class="w-full border border-gray-300 rounded-md p-2 bg-white" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">File (Optional)</label>
                            <input type="file" @change="e => handleFileChange(e, 2)" class="w-full border border-gray-300 rounded-md p-2 bg-white" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">File (Optional)</label>
                            <input type="file" @change="e => handleFileChange(e, 3)" class="w-full border border-gray-300 rounded-md p-2 bg-white" />
                        </div>
                        <div v-if="form.errors.files" class="text-red-500 text-xs mt-1">{{ form.errors.files }}</div>
                    </div>

                    <div class="mt-4">
                        <Button type="submit" label="Add Assignment" :loading="form.processing" class="bg-blue-500 border-none" />
                    </div>
                </form>
            </template>
        </Card>
    </TeacherLayout>
</template>
