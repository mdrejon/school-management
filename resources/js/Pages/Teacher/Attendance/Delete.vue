<script setup>
import { useForm, router } from '@inertiajs/vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Button from 'primevue/button';
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    classes: Array,
    sections: Array,
    periods: Array,
    filters: Object,
});

const confirm = useConfirm();

const deleteForm = useForm({
    class_id: props.filters?.class_id || '',
    section_id: props.filters?.section_id || '',
    period_id: props.filters?.period_id || '',
    date: props.filters?.date || '',
});

const fetchSections = () => {
    if (deleteForm.class_id) {
        router.get(route('teacher.attendance.delete'), {
            class_id: deleteForm.class_id,
            section_id: deleteForm.section_id,
            period_id: deleteForm.period_id,
            date: typeof deleteForm.date === 'string' ? deleteForm.date : deleteForm.date?.toISOString().slice(0, 10),
        }, { preserveState: true, only: ['sections', 'filters'] });
    }
};

const confirmDelete = () => {
    if (!deleteForm.class_id || !deleteForm.section_id || !deleteForm.date) {
        // Validation handled somewhat here, but let controller catch it too.
        return;
    }
    
    confirm.require({
        message: 'Are you sure you want to delete attendance records for this criteria?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        acceptClass: 'p-button-danger',
        accept: () => {
            deleteForm.transform((data) => ({
                ...data,
                date: typeof data.date === 'string' ? data.date : (data.date ? data.date.toISOString().slice(0, 10) : '')
            })).delete(route('teacher.attendance.destroy'));
        },
    });
};
</script>

<template>
    <TeacherLayout title="Student Attendance Delete">
        <ConfirmDialog />
        
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Student Attendance Delete</h1>
            <p class="text-sm text-gray-500">Home - Student Attendance - Delete</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white mb-6">
            <template #content>
                <div class="max-w-xl flex flex-col gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                        <Dropdown v-model="deleteForm.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full" @change="fetchSections" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                        <Dropdown v-model="deleteForm.section_id" :options="sections" optionLabel="name" optionValue="id" placeholder="Select Section" class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                        <Dropdown v-model="deleteForm.period_id" :options="periods" optionLabel="name" optionValue="id" placeholder="Select Period" class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <Calendar v-model="deleteForm.date" dateFormat="yy-mm-dd" showIcon class="w-full" />
                    </div>
                    <div class="mt-2">
                        <Button label="Search (Delete)" @click="confirmDelete" :loading="deleteForm.processing" class="bg-blue-500 border-none" />
                    </div>
                </div>
            </template>
        </Card>
    </TeacherLayout>
</template>
