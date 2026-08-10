<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import InputNumber from 'primevue/inputnumber';
import { useToast } from 'primevue/usetoast';

const props = defineProps({
    academicClass: Object,
    exams: Array,
    groups: Array,
    subjects: Array,
    markConfigs: Array, // e.g. Written, MCQ, Practical
});

const toast = useToast();

const filterForm = useForm({
    class_id: props.academicClass.id,
    exam_id: null,
    group_id: null,
    subject_id: null,
});

const students = ref([]);
const marksForm = useForm({
    class_id: props.academicClass.id,
    exam_id: null,
    subject_id: null,
    marks: {} // structure: marks[student_id][mark_config_id] = value
});

const isSearching = ref(false);

const searchStudents = async () => {
    isSearching.value = true;
    try {
        const response = await axios.post(route('teacher.exam-module.mark-input.fetchStudents'), {
            class_id: filterForm.class_id,
            exam_id: filterForm.exam_id,
            group_id: filterForm.group_id,
            subject_id: filterForm.subject_id,
        });
        
        students.value = response.data.students;
        const existingMarks = response.data.existingMarks;

        // Initialize form data
        marksForm.exam_id = filterForm.exam_id;
        marksForm.subject_id = filterForm.subject_id;
        marksForm.marks = {};

        students.value.forEach(student => {
            marksForm.marks[student.id] = {};
            props.markConfigs.forEach(config => {
                let existingValue = 0;
                if (existingMarks[student.id]) {
                    const found = existingMarks[student.id].find(m => m.exam_mark_id === config.id);
                    if (found) {
                        existingValue = parseFloat(found.marks_obtained);
                    }
                }
                marksForm.marks[student.id][config.id] = existingValue;
            });
        });

    } catch (error) {
        console.error(error);
        toast.add({ severity: 'error', summary: 'Error', detail: 'Failed to fetch students.', life: 3000 });
    } finally {
        isSearching.value = false;
    }
};

const saveMarks = () => {
    marksForm.post(route('teacher.exam-module.mark-input.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Success', detail: 'Marks saved successfully', life: 3000 });
        }
    });
};
</script>

<template>
    <TeacherLayout title="Mark Input Form">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Mark Input (Section Wise)</h1>
            <p class="text-sm text-gray-500">Home - Mark-input-section-wise-class - {{ academicClass.id }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Left: Filter Form -->
            <div class="lg:col-span-1">
                <Card class="shadow-sm border border-slate-100 rounded-xl bg-white h-full">
                    <template #title>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Mark Input Form</h3>
                    </template>
                    <template #content>
                        <form @submit.prevent="searchStudents">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-red-500 mb-1">Exam *</label>
                                <Dropdown v-model="filterForm.exam_id" :options="exams" optionLabel="name" optionValue="id" placeholder="Select Exam" class="w-full" required />
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-red-500 mb-1">Group *</label>
                                <Dropdown v-model="filterForm.group_id" :options="groups" optionLabel="name" optionValue="id" placeholder="Select Group" class="w-full" />
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-red-500 mb-1">Subject *</label>
                                <Dropdown v-model="filterForm.subject_id" :options="subjects" optionLabel="name" optionValue="id" placeholder="Select Subject" class="w-full" required />
                            </div>

                            <div class="flex justify-end">
                                <Button type="submit" label="Search" icon="pi pi-search" :loading="isSearching" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600 w-full lg:w-auto" />
                            </div>
                        </form>
                    </template>
                </Card>
            </div>
            
            <!-- Right: Student Grid for Marks -->
            <div class="lg:col-span-3">
                <Card v-if="students.length > 0" class="shadow-sm border border-slate-100 rounded-xl bg-white h-full">
                    <template #title>
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-800">Students List</h3>
                            <Button @click="saveMarks" label="Save Marks" icon="pi pi-check" :loading="marksForm.processing" class="bg-green-500 border-none hover:bg-green-600 text-white" />
                        </div>
                    </template>
                    <template #content>
                        <div class="overflow-x-auto mt-4">
                            <table class="w-full text-sm text-left text-gray-500 border-collapse">
                                <thead class="text-xs text-gray-600 font-semibold bg-transparent border-b">
                                    <tr>
                                        <th class="px-4 py-3">Roll</th>
                                        <th class="px-4 py-3">Name</th>
                                        <th v-for="config in markConfigs" :key="config.id" class="px-4 py-3 text-center">
                                            {{ config.title }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="student in students" :key="student.id" class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ student.roll_no }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-800">{{ student.first_name }} {{ student.last_name }}</td>
                                        <td v-for="config in markConfigs" :key="config.id" class="px-4 py-3 text-center">
                                            <InputNumber v-model="marksForm.marks[student.id][config.id]" :min="0" :maxFractionDigits="2" class="w-24 text-center" inputClass="text-center p-2" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>
                </Card>
                <div v-else-if="!isSearching && students.length === 0" class="h-full flex items-center justify-center border-2 border-dashed border-gray-200 rounded-xl text-gray-400">
                    <p>Select Exam, Group, and Subject to load students.</p>
                </div>
            </div>
        </div>
    </TeacherLayout>
</template>
