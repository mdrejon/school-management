<script setup>
import { Head } from '@inertiajs/vue3';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import Card from 'primevue/card';

defineProps({
    todayClasses: {
        type: Number,
        default: 0
    },
    assignmentsDue: {
        type: Number,
        default: 0
    }
});
</script>

<template>
    <StudentLayout title="Student Dashboard">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-slate-800">Welcome to Student Portal</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <Card class="shadow-sm border-l-4 border-blue-500">
                <template #content>
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-slate-500 text-sm font-medium mb-1">Today's Classes</div>
                            <div class="text-2xl font-bold text-slate-800">{{ todayClasses }}</div>
                        </div>
                        <div class="size-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                            <i class="pi pi-book text-xl"></i>
                        </div>
                    </div>
                </template>
            </Card>

            <Card class="shadow-sm border-l-4 border-green-500">
                <template #content>
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-slate-500 text-sm font-medium mb-1">Assignments Due</div>
                            <div class="text-2xl font-bold text-slate-800">{{ assignmentsDue }}</div>
                        </div>
                        <div class="size-10 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                            <i class="pi pi-file-edit text-xl"></i>
                        </div>
                    </div>
                </template>
            </Card>
            
            <Card class="shadow-sm border-l-4 border-orange-500">
                <template #content>
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-slate-500 text-sm font-medium mb-1">Attendance</div>
                            <div class="text-2xl font-bold text-slate-800">92%</div>
                        </div>
                        <div class="size-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                            <i class="pi pi-check-square text-xl"></i>
                        </div>
                    </div>
                </template>
            </Card>

            <Card class="shadow-sm border-l-4 border-purple-500">
                <template #content>
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-slate-500 text-sm font-medium mb-1">Notice Board</div>
                            <div class="text-2xl font-bold text-slate-800">1</div>
                        </div>
                        <div class="size-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-500">
                            <i class="pi pi-bell text-xl"></i>
                        </div>
                    </div>
                </template>
            </Card>
        </div>
        
    </StudentLayout>
</template>
