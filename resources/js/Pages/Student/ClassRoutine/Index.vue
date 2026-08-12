<script setup>
import { Head } from '@inertiajs/vue3';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';

const props = defineProps({
    routines: Object,
    studentClass: String,
    studentSection: String,
});
</script>

<template>
    <StudentLayout title="Class Routine">
        <Head title="Class Routine" />
        
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-slate-800">Class Routine</h2>
        </div>

        <Card class="shadow-sm">
            <template #content>
                <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-4">
                    <h3 class="text-lg font-medium text-slate-800">
                        Class Routine Of Class{{ studentClass }}Section{{ studentSection }}
                    </h3>
                    <Button label="Print Routine" icon="pi pi-print" class="!bg-[#0ea5e9] !border-[#0ea5e9] hover:!bg-[#0284c7]" size="small" />
                </div>
                
                <div class="text-center mb-6">
                    <div class="text-slate-700">eSign SMS</div>
                    <div class="text-slate-700">Class Routine</div>
                    <div class="text-slate-700">Class: {{ studentClass }} | Section: {{ studentSection }}</div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600">
                        <tbody>
                            <tr v-for="(dayRoutines, day) in routines" :key="day" class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                <td class="px-2 py-6 align-top w-24">
                                    {{ day }}
                                </td>
                                <td class="px-2 py-6">
                                    <div class="flex flex-wrap gap-8">
                                        <div v-if="dayRoutines.length === 0" class="text-slate-400 italic py-1">No classes scheduled</div>
                                        <div v-for="routine in dayRoutines" :key="routine.id" class="min-w-[200px]">
                                            <div class="text-slate-800 font-medium">{{ routine.subject?.name || '-' }}</div>
                                            <div class="text-slate-600 mt-0.5">Teacher - {{ routine.teacher?.name || '-' }}</div>
                                            <div class="text-slate-600 mt-0.5">{{ routine.start_time }} - {{ routine.end_time }}</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </Card>
    </StudentLayout>
</template>
