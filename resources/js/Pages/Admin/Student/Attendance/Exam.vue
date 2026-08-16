<script setup>
import { ref, watch } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import RadioButton from 'primevue/radiobutton';

const props = defineProps({
    classes: Array,
    sections: Array,
    subjects: Array,
    exams: Array,
    students: Array,
    attendances: Object,
    filters: Object,
});

const searchForm = useForm({
    class_id: props.filters?.class_id || '',
    section_id: props.filters?.section_id || '',
    subject_id: props.filters?.subject_id || '',
    exam_id: props.filters?.exam_id || '',
});

const attendanceForm = useForm({
    class_id: '',
    section_id: '',
    subject_id: '',
    exam_id: '',
    attendances: []
});

watch(() => props.students, (newStudents) => {
    if (newStudents && newStudents.length > 0) {
        attendanceForm.class_id = searchForm.class_id;
        attendanceForm.section_id = searchForm.section_id;
        attendanceForm.subject_id = searchForm.subject_id;
        attendanceForm.exam_id = searchForm.exam_id;
        
        attendanceForm.attendances = newStudents.map(student => {
            const existing = props.attendances ? props.attendances[student.id] : null;
            return {
                student_id: student.id,
                status: existing ? existing.status : 'present' 
            };
        });
    }
}, { immediate: true });

const search = () => {
    router.get(route('admin.students.exam-attendance.index'), {
        class_id: searchForm.class_id,
        section_id: searchForm.section_id,
        subject_id: searchForm.subject_id,
        exam_id: searchForm.exam_id,
    }, { preserveState: true });
};

const fetchSections = () => {
    if (searchForm.class_id) {
        router.get(route('admin.students.exam-attendance.index'), {
            class_id: searchForm.class_id,
            section_id: searchForm.section_id,
            subject_id: searchForm.subject_id,
            exam_id: searchForm.exam_id,
        }, { preserveState: true, only: ['sections', 'filters'] });
    }
};

const submitAttendance = () => {
    attendanceForm.post(route('admin.students.exam-attendance.store'), {
        preserveScroll: true,
    });
};

const setAllStatus = (status) => {
    attendanceForm.attendances.forEach(a => a.status = status);
};
</script>

<template>
    <AdminLayout title="Exam Attendance">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Exam Attendance</h1>
            <p class="text-sm text-gray-500">Home - Exams-attendance</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white mb-6">
            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                        <Dropdown v-model="searchForm.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full" @change="fetchSections" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                        <Dropdown v-model="searchForm.section_id" :options="sections" optionLabel="name" optionValue="id" placeholder="Select Section" class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <Dropdown v-model="searchForm.subject_id" :options="subjects" optionLabel="name" optionValue="id" placeholder="Select Subject" class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Exam</label>
                        <Dropdown v-model="searchForm.exam_id" :options="exams" optionLabel="name" optionValue="id" placeholder="Select Exam" class="w-full" />
                    </div>
                    <div>
                        <Button label="Next" @click="search" class="w-full md:w-auto bg-blue-500 border-none" />
                    </div>
                </div>
            </template>
        </Card>

        <Card v-if="students && students.length > 0" class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #title>
                <div class="text-center pb-4">
                    <h2 class="text-xl font-bold text-slate-800">Exam Attendance</h2>
                    <p class="font-medium">Class : {{ classes.find(c => c.id == searchForm.class_id)?.name }}</p>
                    <p class="font-medium">Section : {{ sections.find(s => s.id == searchForm.section_id)?.name }}</p>
                    <p class="font-medium">Exam : {{ exams.find(e => e.id == searchForm.exam_id)?.name }}</p>
                </div>
            </template>
            <template #content>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Admission Number</th>
                                <th scope="col" class="px-6 py-3">Roll No.</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Present
                                    <input type="radio" name="mark_all" @click="setAllStatus('present')" class="ml-2">
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Absent
                                    <input type="radio" name="mark_all" @click="setAllStatus('absent')" class="ml-2">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(student, index) in students" :key="student.id" class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ student.admission_number || '-' }}</td>
                                <td class="px-6 py-4">{{ student.roll_no }}</td>
                                <td class="px-6 py-4">{{ student.first_name }} {{ student.last_name }}</td>
                                <td class="px-6 py-4 text-center">
                                    <RadioButton v-model="attendanceForm.attendances[index].status" inputId="present" name="status" value="present" />
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <RadioButton v-model="attendanceForm.attendances[index].status" inputId="absent" name="status" value="absent" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <Button label="Save Exam Attendance" @click="submitAttendance" :loading="attendanceForm.processing" class="bg-blue-500 border-none" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
