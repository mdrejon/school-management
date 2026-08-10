<script setup>
import { useForm, router } from '@inertiajs/vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Button from 'primevue/button';
import InputNumber from 'primevue/inputnumber';

const props = defineProps({
    classes: Array,
    sections: Array,
    report: Array,
    filters: Object,
});

const searchForm = useForm({
    class_id: props.filters?.class_id || '',
    section_id: props.filters?.section_id || '',
    from_date: props.filters?.from_date || '',
    to_date: props.filters?.to_date || '',
    percentage: props.filters?.percentage || null,
});

const search = () => {
    router.get(route('teacher.attendance-report.index'), {
        class_id: searchForm.class_id,
        section_id: searchForm.section_id,
        from_date: typeof searchForm.from_date === 'string' ? searchForm.from_date : searchForm.from_date?.toISOString().slice(0, 10),
        to_date: typeof searchForm.to_date === 'string' ? searchForm.to_date : searchForm.to_date?.toISOString().slice(0, 10),
        percentage: searchForm.percentage,
    }, { preserveState: true });
};

const fetchSections = () => {
    if (searchForm.class_id) {
        router.get(route('teacher.attendance-report.index'), {
            class_id: searchForm.class_id,
            section_id: searchForm.section_id,
            from_date: typeof searchForm.from_date === 'string' ? searchForm.from_date : searchForm.from_date?.toISOString().slice(0, 10),
            to_date: typeof searchForm.to_date === 'string' ? searchForm.to_date : searchForm.to_date?.toISOString().slice(0, 10),
            percentage: searchForm.percentage,
        }, { preserveState: true, only: ['sections', 'filters'] });
    }
};
</script>

<template>
    <TeacherLayout title="Attendance Report">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-sm text-gray-500">Home - Reports-student Attendance Date To Date - View</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white mb-6">
            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                        <Dropdown v-model="searchForm.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full" @change="fetchSections" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                        <Dropdown v-model="searchForm.section_id" :options="sections" optionLabel="name" optionValue="id" placeholder="Select Section" class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <Calendar v-model="searchForm.from_date" dateFormat="yy-mm-dd" showIcon class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <Calendar v-model="searchForm.to_date" dateFormat="yy-mm-dd" showIcon class="w-full" />
                    </div>
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">% Greater-than (Optional)</label>
                        <div class="flex gap-2">
                            <InputNumber v-model="searchForm.percentage" placeholder="0" class="w-full" />
                            <Button label="Search" @click="search" class="w-full md:w-auto bg-blue-500 border-none" />
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center" v-if="searchForm.class_id && searchForm.section_id && searchForm.from_date && searchForm.to_date">
                    <h2 class="text-xl font-bold text-slate-800">eSign SMS</h2>
                    <p class="font-bold text-slate-800">Attendance For Class : {{ classes.find(c => c.id == searchForm.class_id)?.name }}</p>
                    <p class="font-bold text-slate-800">Section : {{ sections.find(s => s.id == searchForm.section_id)?.name }}</p>
                    <p class="font-bold text-slate-800">From Date {{ typeof searchForm.from_date === 'string' ? searchForm.from_date : searchForm.from_date.toISOString().slice(0, 10) }}</p>
                    <p class="font-bold text-slate-800 mb-6">To Date {{ typeof searchForm.to_date === 'string' ? searchForm.to_date : searchForm.to_date.toISOString().slice(0, 10) }}</p>

                    <div v-if="report && report.length > 0" class="overflow-x-auto text-left">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Admission Number</th>
                                    <th scope="col" class="px-6 py-3">Roll No.</th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3 text-center">Present Days</th>
                                    <th scope="col" class="px-6 py-3 text-center">Absent Days</th>
                                    <th scope="col" class="px-6 py-3 text-center">Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in report" :key="row.student.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ row.student.admission_number || '-' }}</td>
                                    <td class="px-6 py-4">{{ row.student.roll_no }}</td>
                                    <td class="px-6 py-4">{{ row.student.first_name }} {{ row.student.last_name }}</td>
                                    <td class="px-6 py-4 text-center text-green-600 font-bold">{{ row.present_count }}</td>
                                    <td class="px-6 py-4 text-center text-red-600 font-bold">{{ row.absent_count }}</td>
                                    <td class="px-6 py-4 text-center font-bold">{{ row.percentage }}%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-red-500 font-bold mt-8 text-lg">
                        No Records Found !
                    </div>
                </div>
            </template>
        </Card>
    </TeacherLayout>
</template>
