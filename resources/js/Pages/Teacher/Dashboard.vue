<script setup>
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';

defineProps({
    totalStudents: Number,
    todayAttendance: Number,
    present: Number,
    absent: Number,
    classRoutine: Array,
});
</script>

<template>
    <TeacherLayout title="Dashboard">
        <!-- Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <Card class="shadow-sm border border-slate-100 rounded-xl overflow-hidden bg-white text-center">
                <template #content>
                    <div class="py-2">
                        <div class="text-slate-400 text-sm font-medium mb-2">Total Students</div>
                        <div class="text-[2.5rem] font-bold text-blue-500 leading-none">{{ totalStudents }}</div>
                    </div>
                </template>
            </Card>

            <Card class="shadow-sm border border-slate-100 rounded-xl overflow-hidden bg-white text-center">
                <template #content>
                    <div class="py-2">
                        <div class="text-slate-400 text-sm font-medium mb-2">Today's Attendance</div>
                        <div class="text-[2.5rem] font-bold text-slate-800 leading-none">{{ todayAttendance }}</div>
                    </div>
                </template>
            </Card>

            <Card class="shadow-sm border border-slate-100 rounded-xl overflow-hidden bg-white text-center">
                <template #content>
                    <div class="py-2">
                        <div class="text-green-500 text-sm font-medium mb-2">Present</div>
                        <div class="text-[2.5rem] font-bold text-green-500 leading-none">{{ present }}</div>
                    </div>
                </template>
            </Card>

            <Card class="shadow-sm border border-slate-100 rounded-xl overflow-hidden bg-white text-center">
                <template #content>
                    <div class="py-2">
                        <div class="text-red-500 text-sm font-medium mb-2">Absent</div>
                        <div class="text-[2.5rem] font-bold text-red-500 leading-none">{{ absent }}</div>
                    </div>
                </template>
            </Card>
        </div>

        <!-- Today's Class Routine -->
        <Card class="shadow-sm border border-slate-100 rounded-xl overflow-hidden bg-white mb-6">
            <template #title>
                <div class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-4 px-2">
                    Today's Class Routine
                </div>
            </template>
            <template #content>
                <div class="flex items-center justify-center py-16 text-slate-400 font-medium text-sm">
                    No classes scheduled today
                </div>
            </template>
        </Card>
    </TeacherLayout>
</template>
