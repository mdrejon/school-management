<script setup>
import { useForm, router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import { watch } from 'vue';

const props = defineProps({
    classes: Array,
    sections: Array,
    students: Array,
    filters: Object,
});

const form = useForm({
    title: '',
    date: '',
    class_id: props.filters?.class_id || '',
    section_id: props.filters?.section_id || '',
    student_id: '',
    note: '',
    attachment: null,
});

const fetchSections = () => {
    if (form.class_id) {
        router.get(route('admin.academic.behaviors.create'), {
            class_id: form.class_id,
        }, { preserveState: true, only: ['sections', 'students', 'filters'] });
        form.section_id = ''; // reset section
        form.student_id = ''; // reset student
    }
};

const fetchStudents = () => {
    if (form.class_id && form.section_id) {
        router.get(route('admin.academic.behaviors.create'), {
            class_id: form.class_id,
            section_id: form.section_id,
        }, { preserveState: true, only: ['students', 'filters'] });
        form.student_id = ''; // reset student
    }
};

const handleFileChange = (event) => {
    form.attachment = event.target.files[0];
};

const submit = () => {
    const submissionData = { ...form };
    if (submissionData.date && typeof submissionData.date !== 'string') {
        submissionData.date = submissionData.date.toISOString().slice(0, 10);
    }

    form.transform((data) => ({
        ...data,
        date: submissionData.date,
    })).post(route('admin.academic.behaviors.store'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Behavior Create">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Behavior</h1>
                <p class="text-sm text-gray-500">Home - Behaviors - Create</p>
            </div>
            <Link :href="route('admin.academic.behaviors.index')">
                <Button label="Behavior List" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600" />
            </Link>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white max-w-5xl">
            <template #content>
                <form @submit.prevent="submit" class="flex flex-col gap-6 pt-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <InputText v-model="form.title" class="w-full border-gray-300" required />
                            <div v-if="form.errors.title" class="text-red-500 text-xs mt-1">{{ form.errors.title }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <Calendar v-model="form.date" dateFormat="yy-mm-dd" showIcon class="w-full" required />
                            <div v-if="form.errors.date" class="text-red-500 text-xs mt-1">{{ form.errors.date }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                            <Dropdown v-model="form.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-gray-50" @change="fetchSections" required />
                            <div v-if="form.errors.class_id" class="text-red-500 text-xs mt-1">{{ form.errors.class_id }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                            <Dropdown v-model="form.section_id" :options="sections" optionLabel="name" optionValue="id" placeholder="Select Section" class="w-full bg-gray-50" @change="fetchStudents" required :disabled="!form.class_id" />
                            <div v-if="form.errors.section_id" class="text-red-500 text-xs mt-1">{{ form.errors.section_id }}</div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
                        <Dropdown v-model="form.student_id" :options="students" optionLabel="first_name" optionValue="id" placeholder="Select Student" class="w-full bg-gray-50" required :disabled="!form.section_id">
                            <template #option="slotProps">
                                {{ slotProps.option.first_name }} {{ slotProps.option.last_name }}
                            </template>
                            <template #value="slotProps">
                                <span v-if="slotProps.value">
                                    {{ students.find(s => s.id === slotProps.value)?.first_name }} {{ students.find(s => s.id === slotProps.value)?.last_name }}
                                </span>
                                <span v-else>
                                    Select Student
                                </span>
                            </template>
                        </Dropdown>
                        <div v-if="form.errors.student_id" class="text-red-500 text-xs mt-1">{{ form.errors.student_id }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                        <Textarea v-model="form.note" rows="5" class="w-full border-gray-300" />
                        <div v-if="form.errors.note" class="text-red-500 text-xs mt-1">{{ form.errors.note }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Attachment</label>
                        <input type="file" @change="handleFileChange" class="w-full border border-gray-300 rounded-md p-2 bg-white text-sm" />
                        <div v-if="form.errors.attachment" class="text-red-500 text-xs mt-1">{{ form.errors.attachment }}</div>
                    </div>

                    <div class="mt-4">
                        <Button type="submit" label="Create" :loading="form.processing" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600 px-8" />
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
