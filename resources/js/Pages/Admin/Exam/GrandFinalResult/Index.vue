<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { useToast } from 'primevue/usetoast';

const props = defineProps({
    classes: Array,
    sections: Array,
});

const toast = useToast();

const filterForm = useForm({
    class_id: null,
    section_id: null,
    from_roll: null,
    to_roll: null,
});

const results = ref([]);
const isSearching = ref(false);
const searchKeyword = ref('');

const searchResults = async () => {
    isSearching.value = true;
    try {
        const response = await axios.post(route('admin.grand-final-result.fetchResults'), {
            class_id: filterForm.class_id,
            section_id: filterForm.section_id,
            from_roll: filterForm.from_roll,
            to_roll: filterForm.to_roll,
        });
        
        results.value = response.data.results;
    } catch (error) {
        console.error(error);
        toast.add({ severity: 'error', summary: 'Error', detail: 'Failed to fetch grand final results.', life: 3000 });
    } finally {
        isSearching.value = false;
    }
};

const filteredResults = computed(() => {
    if (!searchKeyword.value) return results.value;
    const lower = searchKeyword.value.toLowerCase();
    return results.value.filter(r => 
        r.name.toLowerCase().includes(lower) || 
        (r.roll_no && r.roll_no.toString().includes(lower))
    );
});
</script>

<template>
    <AdminLayout title="Grand Final Result">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Grand Final Result</h1>
            <p class="text-sm text-gray-500">Home - Grand-final-result</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white mb-6">
            <template #title>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Filter Students</h3>
            </template>
            <template #content>
                <form @submit.prevent="searchResults" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                        <Dropdown v-model="filterForm.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select One" class="w-full" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                        <Dropdown v-model="filterForm.section_id" :options="sections" optionLabel="name" optionValue="id" placeholder="Select One" class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Roll No. (Optional)</label>
                        <InputText v-model="filterForm.from_roll" type="number" class="w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Roll No. (Optional)</label>
                        <InputText v-model="filterForm.to_roll" type="number" class="w-full" />
                    </div>
                    <div class="md:col-span-2">
                        <Button type="submit" label="Find Students" icon="pi pi-search" :loading="isSearching" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600" />
                    </div>
                </form>
            </template>
        </Card>

        <Card v-if="results.length > 0" class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #title>
                <h3 class="text-lg font-bold text-gray-800 mb-4">Grand Final Result List</h3>
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
                        <InputText v-model="searchKeyword" class="p-inputtext-sm" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 border-collapse">
                        <thead class="text-xs text-gray-600 font-semibold bg-transparent border-b">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">ROLL</th>
                                <th class="px-4 py-3">NAME</th>
                                <th class="px-4 py-3 text-center">TOTAL MARKS (ALL EXAMS)</th>
                                <th class="px-4 py-3 text-center">OVERALL GRADE POINT</th>
                                <th class="px-4 py-3 text-center">OVERALL GRADE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="r in filteredResults" :key="r.student_id" class="border-b hover:bg-gray-50">
                                <td class="px-4 py-4">{{ r.student_id }}</td>
                                <td class="px-4 py-4">{{ r.roll_no }}</td>
                                <td class="px-4 py-4 font-semibold text-gray-800">{{ r.name }}</td>
                                <td class="px-4 py-4 text-center font-bold text-sky-600">{{ r.total_marks }}</td>
                                <td class="px-4 py-4 text-center">{{ r.grade_point }}</td>
                                <td class="px-4 py-4 text-center font-bold" :class="r.grade === 'F' ? 'text-red-500' : 'text-green-500'">{{ r.grade }}</td>
                            </tr>
                            <tr v-if="filteredResults.length === 0">
                                <td colspan="6" class="text-center py-4">No records found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </Card>
        <Card v-else-if="!isSearching && filterForm.class_id" class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #content>
                <div class="h-48 flex items-center justify-center text-gray-400">
                    <p>No results found for the selected criteria.</p>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
