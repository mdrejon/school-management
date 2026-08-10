<script setup>
import { ref, watch, onMounted } from 'vue';
import { useForm, router, usePage } from '@inertiajs/vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Button from 'primevue/button';
import InputSwitch from 'primevue/inputswitch';
import RadioButton from 'primevue/radiobutton';

const props = defineProps({
    classes: Array,
    sections: Array,
    students: Array,
    attendances: Object,
    filters: Object,
});

const searchForm = useForm({
    class_id: props.filters?.class_id || '',
    section_id: props.filters?.section_id || '',
    date: props.filters?.date || new Date().toISOString().slice(0, 10),
});

const attendanceForm = useForm({
    class_id: '',
    section_id: '',
    date: '',
    sms_sent: false,
    attendances: []
});

watch(() => props.students, (newStudents) => {
    if (newStudents && newStudents.length > 0) {
        attendanceForm.class_id = searchForm.class_id;
        attendanceForm.section_id = searchForm.section_id;
        attendanceForm.date = searchForm.date;
        attendanceForm.sms_sent = false;
        
        attendanceForm.attendances = newStudents.map(student => {
            const existing = props.attendances ? props.attendances[student.id] : null;
            return {
                student_id: student.id,
                // Default to present if no existing record, or use existing status
                status: existing ? existing.status : 'present' 
            };
        });
    }
}, { immediate: true });

const search = () => {
    router.get(route('teacher.attendance.index'), {
        class_id: searchForm.class_id,
        section_id: searchForm.section_id,
        date: typeof searchForm.date === 'string' ? searchForm.date : searchForm.date.toISOString().slice(0, 10),
    }, { preserveState: true });
};

const fetchSections = () => {
    if (searchForm.class_id) {
        router.get(route('teacher.attendance.index'), {
            class_id: searchForm.class_id,
            section_id: searchForm.section_id,
            date: typeof searchForm.date === 'string' ? searchForm.date : searchForm.date.toISOString().slice(0, 10),
        }, { preserveState: true, only: ['sections', 'filters'] });
    }
};

const submitAttendance = () => {
    attendanceForm.post(route('teacher.attendance.store'), {
        preserveScroll: true,
        onSuccess: () => {
            // Success toast is handled by layout
        }
    });
};

const setAllStatus = (status) => {
    attendanceForm.attendances.forEach(a => a.status = status);
};
</script>

<template>
    <TeacherLayout title="Student Attendance">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Student Attendance</h1>
            <p class="text-sm text-gray-500">Home - Student-attendance</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white mb-6">
            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                        <Dropdown v-model="searchForm.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full" @change="fetchSections" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                        <Dropdown v-model="searchForm.section_id" :options="sections" optionLabel="name" optionValue="id" placeholder="Select Section" class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <Calendar v-model="searchForm.date" dateFormat="yy-mm-dd" showIcon class="w-full" />
                    </div>
                    <div>
                        <Button label="Search" @click="search" class="w-full md:w-auto" />
                    </div>
                </div>
            </template>
        </Card>

        <Card v-if="students && students.length > 0" class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #title>
                <div class="text-center pb-4">
                    <h2 class="text-xl font-bold text-slate-800">eSign SMS</h2>
                    <p class="font-medium">Attendance For Class : {{ classes.find(c => c.id == searchForm.class_id)?.name }}</p>
                    <p class="font-medium">Section : {{ sections.find(s => s.id == searchForm.section_id)?.name }}</p>
                    <p class="font-medium">Date : {{ typeof searchForm.date === 'string' ? searchForm.date : searchForm.date.toISOString().slice(0, 10) }}</p>
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
                
                <div class="mt-6 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <InputSwitch v-model="attendanceForm.sms_sent" />
                        <span class="text-sm font-medium text-gray-700">Sent SMS</span>
                    </div>
                    <Button label="Take Attendance" @click="submitAttendance" :loading="attendanceForm.processing" />
                </div>
            </template>
        </Card>
    </TeacherLayout>
</template>
