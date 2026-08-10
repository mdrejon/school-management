import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

const props = defineProps({
    classes: Array,
});

const search = ref('');

const filteredClasses = computed(() => {
    if (!search.value) return props.classes;
    return props.classes.filter(c => c.name.toLowerCase().includes(search.value.toLowerCase()));
});

const goToForm = (classId) => {
    router.get(route('teacher.exam-module.mark-input.show', classId));
};
</script>

<template>
    <TeacherLayout title="Mark Input (Section Wise)">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Mark Input (Section Wise)</h1>
            <p class="text-sm text-gray-500">Home - Mark-input-section-wise</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #title>
                <h3 class="text-lg font-bold text-gray-800 mb-4">Class List</h3>
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
                                <th class="px-4 py-3 text-right w-24">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="c in filteredClasses" :key="c.id" class="border-b">
                                <td class="px-4 py-4 font-semibold text-gray-800">{{ c.name }}</td>
                                <td class="px-4 py-4">N/A</td> <!-- Assuming section not strictly required for now based on screenshot -->
                                <td class="px-4 py-4 text-right">
                                    <Button @click="goToForm(c.id)" icon="pi pi-pencil" class="p-button-rounded p-button-warning p-button-sm w-8 h-8" />
                                </td>
                            </tr>
                            <tr v-if="filteredClasses.length === 0">
                                <td colspan="3" class="text-center py-4">No data available</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </Card>
    </TeacherLayout>
</template>
