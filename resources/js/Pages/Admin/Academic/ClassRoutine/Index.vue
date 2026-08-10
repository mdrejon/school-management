<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const props = defineProps({
    classes: Array,
    routinesList: Array,
});

const search = ref('');

const filteredRoutines = computed(() => {
    if (!search.value) return props.routinesList;
    const lower = search.value.toLowerCase();
    return props.routinesList.filter(r => 
        r.class_name.toLowerCase().includes(lower) || 
        r.section_name.toLowerCase().includes(lower)
    );
});

const manageRoutine = (classId, sectionId) => {
    router.get(route('admin.class-routine.manage', { classId, sectionId }));
};

const viewRoutine = (classId, sectionId) => {
    router.get(route('admin.class-routine.manage', { classId, sectionId })); // For now, just go to manage page
};
</script>

<template>
    <AdminLayout title="Class Routines">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Class Routines</h1>
            <p class="text-sm text-gray-500">Home - Class Routines</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #title>
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Routine List</h3>
                    <Dropdown :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-32 p-inputtext-sm" />
                </div>
            </template>
            <template #content>
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Show</span>
                        <Dropdown :options="[{label:'50', value:50}]" modelValue="50" optionLabel="label" optionValue="value" class="w-20 p-inputtext-sm" />
                        <span class="text-sm text-gray-600">Entries</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Search</span>
                        <InputText v-model="search" class="p-inputtext-sm" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 border-collapse">
                        <thead class="text-xs text-gray-600 font-semibold bg-transparent border-b">
                            <tr>
                                <th class="px-4 py-3">Class</th>
                                <th class="px-4 py-3">Section</th>
                                <th class="px-4 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="r in filteredRoutines" :key="r.class_id + '_' + r.section_id" class="border-b hover:bg-gray-50">
                                <td class="px-4 py-4 font-semibold text-gray-800">{{ r.class_name }}</td>
                                <td class="px-4 py-4">{{ r.section_name }}</td>
                                <td class="px-4 py-4 text-right">
                                    <Button @click="manageRoutine(r.class_id, r.section_id)" label="Manage Routine" icon="pi pi-pencil" class="p-button-sm bg-[#0ea5e9] border-none text-white mr-2" />
                                    <Button @click="viewRoutine(r.class_id, r.section_id)" label="View Routine" icon="pi pi-search" class="p-button-sm bg-[#0ea5e9] border-none text-white" />
                                </td>
                            </tr>
                            <tr v-if="filteredRoutines.length === 0">
                                <td colspan="3" class="text-center py-4">No data available</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
