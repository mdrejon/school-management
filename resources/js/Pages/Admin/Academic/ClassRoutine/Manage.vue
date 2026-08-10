<script setup>
import { ref, watch, onMounted } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { useToast } from 'primevue/usetoast';
import axios from 'axios';

const props = defineProps({
    academicClass: Object,
    section: Object,
    subjects: Array,
    teachers: Array,
    routineData: Object,
});

const toast = useToast();
const days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

// We need a form for each day to save independently as per the mockup
const dayForms = ref({});

const initForms = () => {
    days.forEach(day => {
        let routines = [];
        if (props.routineData && props.routineData[day] && props.routineData[day].length > 0) {
            routines = props.routineData[day].map(r => ({
                id: r.id,
                subject_id: r.subject_id,
                start_time: r.start_time ? r.start_time.substring(0,5) : '', // assuming HH:MM:SS
                end_time: r.end_time ? r.end_time.substring(0,5) : '',
                teacher_id: r.teacher_id,
                room: r.room,
            }));
        } else {
            // Give them one empty row by default
            routines = [{ id: null, subject_id: null, start_time: '', end_time: '', teacher_id: null, room: '' }];
        }

        dayForms.value[day] = useForm({
            class_id: props.academicClass.id,
            section_id: props.section ? props.section.id : null,
            day_of_week: day,
            routines: routines
        });
    });
};

onMounted(() => {
    initForms();
});

const addRow = (day) => {
    dayForms.value[day].routines.push({ id: null, subject_id: null, start_time: '', end_time: '', teacher_id: null, room: '' });
};

const removeRow = (day, index) => {
    dayForms.value[day].routines.splice(index, 1);
};

const saveRoutine = (day) => {
    dayForms.value[day].post(route('admin.class-routine.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Success', detail: `${day} routine saved successfully`, life: 3000 });
        },
        onError: (errors) => {
            console.error(errors);
            toast.add({ severity: 'error', summary: 'Error', detail: 'Failed to save routine', life: 3000 });
        }
    });
};

const formatTeacherName = (t) => {
    if(!t) return '';
    return t.first_name ? `${t.first_name} ${t.last_name || ''}` : (t.name || `User ${t.id}`);
};

</script>

<template>
    <AdminLayout title="Manage Class Routine">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Class Routine</h1>
            <p class="text-sm text-gray-500">Home - Class-routines-manage - {{ academicClass.id }} - {{ section ? section.id : '' }}</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white mb-6">
            <template #title>
                <div class="flex items-center gap-2 text-lg font-bold text-gray-800 mb-2">
                    Class: <span class="text-[#0ea5e9]">{{ academicClass.name }}</span> 
                    <span v-if="section" class="ml-4">Section: <span class="text-[#0ea5e9]">{{ section.name }}</span></span>
                </div>
            </template>
            <template #content>
                <Accordion :activeIndex="0">
                    <AccordionTab v-for="day in days" :key="day" :header="day">
                        <form @submit.prevent="saveRoutine(day)" v-if="dayForms[day]">
                            <div class="overflow-x-auto mb-4">
                                <table class="w-full text-sm text-left">
                                    <thead class="text-xs text-gray-600 border-b">
                                        <tr>
                                            <th class="py-2 px-2 w-48">Subject</th>
                                            <th class="py-2 px-2 w-32">Start Time</th>
                                            <th class="py-2 px-2 w-32">End Time</th>
                                            <th class="py-2 px-2 w-64">Assign Teacher</th>
                                            <th class="py-2 px-2 w-32">Room</th>
                                            <th class="py-2 px-2 w-16"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in dayForms[day].routines" :key="index" class="border-b">
                                            <td class="py-3 px-2">
                                                <Dropdown v-model="row.subject_id" :options="subjects" optionLabel="name" optionValue="id" placeholder="Select Subject" class="w-full" />
                                            </td>
                                            <td class="py-3 px-2">
                                                <input type="time" v-model="row.start_time" class="p-inputtext p-component w-full" />
                                            </td>
                                            <td class="py-3 px-2">
                                                <input type="time" v-model="row.end_time" class="p-inputtext p-component w-full" />
                                            </td>
                                            <td class="py-3 px-2">
                                                <Dropdown v-model="row.teacher_id" :options="teachers" :optionLabel="formatTeacherName" optionValue="id" placeholder="Select One" class="w-full" filter />
                                            </td>
                                            <td class="py-3 px-2">
                                                <InputText v-model="row.room" placeholder="Room" class="w-full" />
                                            </td>
                                            <td class="py-3 px-2 text-center">
                                                <Button type="button" icon="pi pi-times" class="p-button-danger p-button-text p-button-sm" @click="removeRow(day, index)" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <Button type="button" label="Add Row" icon="pi pi-plus" class="p-button-text p-button-sm" @click="addRow(day)" />
                                <Button type="submit" :label="'Save ' + day + ' Routine'" :loading="dayForms[day].processing" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600" />
                            </div>
                        </form>
                    </AccordionTab>
                </Accordion>
            </template>
        </Card>
    </AdminLayout>
</template>
