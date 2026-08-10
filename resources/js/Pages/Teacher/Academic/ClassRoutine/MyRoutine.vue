<script setup>
import { ref } from 'vue';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';

const props = defineProps({
    routineData: Object,
});

const days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

const formatTime = (time) => {
    if (!time) return '';
    const [h, m] = time.split(':');
    let hours = parseInt(h);
    let ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    return `${hours < 10 ? '0'+hours : hours}:${m} ${ampm}`;
};
</script>

<template>
    <TeacherLayout title="My Schedule">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">My Class Routine</h1>
            <p class="text-sm text-gray-500">Home - My Routine</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white mb-6" v-for="day in days" :key="day">
            <template #title>
                <h3 class="text-lg font-bold text-[#0ea5e9] mb-2">{{ day }}</h3>
            </template>
            <template #content>
                <div v-if="routineData[day] && routineData[day].length > 0" class="overflow-x-auto">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead class="text-xs text-gray-600 bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3">Class & Section</th>
                                <th class="px-4 py-3">Subject</th>
                                <th class="px-4 py-3">Time</th>
                                <th class="px-4 py-3">Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="r in routineData[day]" :key="r.id" class="border-b hover:bg-gray-50">
                                <td class="px-4 py-4 font-semibold text-gray-800">
                                    {{ r.academic_class?.name }} <span v-if="r.section">({{ r.section.name }})</span>
                                </td>
                                <td class="px-4 py-4 text-[#0ea5e9] font-medium">{{ r.subject?.name }}</td>
                                <td class="px-4 py-4">{{ formatTime(r.start_time) }} - {{ formatTime(r.end_time) }}</td>
                                <td class="px-4 py-4">{{ r.room || '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="text-gray-400 p-4 bg-gray-50 rounded-lg text-center text-sm">
                    No classes scheduled for {{ day }}.
                </div>
            </template>
        </Card>
    </TeacherLayout>
</template>
