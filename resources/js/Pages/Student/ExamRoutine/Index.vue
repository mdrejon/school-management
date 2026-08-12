<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';

const props = defineProps({
    exams: Array
});

const selectedExam = ref(null);

const viewRoutine = () => {
    if (selectedExam.value) {
        // Implement logic to view the routine for the selected exam.
        // E.g. router.get(route('student.exam-routine.show', selectedExam.value))
        console.log("Viewing routine for exam ID: ", selectedExam.value);
    }
};
</script>

<template>
    <StudentLayout title="Exam Routine">
        <Head title="Exam Routine" />
        
        <Card class="shadow-sm mt-4">
            <template #title>
                <div class="text-base font-medium text-slate-800">Exam Routine</div>
            </template>
            <template #content>
                <div class="max-w-md space-y-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-700">Select Exam</label>
                        <Dropdown 
                            v-model="selectedExam" 
                            :options="exams" 
                            optionLabel="name" 
                            optionValue="id"
                            placeholder="Select an Exam" 
                            class="w-full"
                        />
                    </div>
                    
                    <div class="pt-2">
                        <Button 
                            label="View Routine" 
                            class="!bg-[#0ea5e9] !border-[#0ea5e9] hover:!bg-[#0284c7]" 
                            @click="viewRoutine"
                            :disabled="!selectedExam"
                        />
                    </div>
                </div>
            </template>
        </Card>
    </StudentLayout>
</template>
