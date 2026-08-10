<script setup>
import { useForm, router, Link } from '@inertiajs/vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from 'primevue/useconfirm';
import { watch } from 'vue';

const props = defineProps({
    assignments: Object,
    filters: Object,
});

const confirm = useConfirm();

const filterForm = useForm({
    search: props.filters?.search || '',
    per_page: props.filters?.per_page || 50,
});

const perPageOptions = [
    { label: '10', value: 10 },
    { label: '25', value: 25 },
    { label: '50', value: 50 },
    { label: '100', value: 100 },
];

const debounce = (fn, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn(...args), delay);
    };
};

const fetchAssignments = debounce(() => {
    router.get(route('teacher.assignments.index'), {
        search: filterForm.search,
        per_page: filterForm.per_page,
    }, { preserveState: true, preserveScroll: true });
}, 300);

watch(() => filterForm.search, fetchAssignments);
watch(() => filterForm.per_page, fetchAssignments);

const deleteAssignment = (id) => {
    confirm.require({
        message: 'Are you sure you want to delete this assignment?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        acceptClass: 'p-button-danger',
        accept: () => {
            router.delete(route('teacher.assignments.destroy', id), {
                preserveScroll: true,
            });
        },
    });
};
</script>

<template>
    <TeacherLayout title="Assignments">
        <ConfirmDialog />
        
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-sm text-gray-500">Home - Teacher - Assignments</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #title>
                <div class="flex items-center justify-between pb-2">
                    <h2 class="text-xl font-bold text-slate-800">Assignments List</h2>
                </div>
            </template>
            <template #content>
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Show</span>
                        <Dropdown v-model="filterForm.per_page" :options="perPageOptions" optionLabel="label" optionValue="value" class="w-24" />
                        <span class="text-sm text-gray-600">Entries</span>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-4">
                        <Link :href="route('teacher.assignments.create')">
                            <Button label="Add New Assignment" class="bg-blue-500 border-none w-full md:w-auto" />
                        </Link>
                        
                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <span class="text-sm text-gray-600">Search</span>
                            <InputText v-model="filterForm.search" placeholder="Search..." class="w-full md:w-auto" />
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Description</th>
                                <th scope="col" class="px-6 py-3">Class</th>
                                <th scope="col" class="px-6 py-3">Section</th>
                                <th scope="col" class="px-6 py-3">Subject</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="assignments.data.length > 0">
                                <tr v-for="assignment in assignments.data" :key="assignment.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ assignment.title }}</td>
                                    <td class="px-6 py-4 max-w-xs truncate" :title="assignment.description">{{ assignment.description || '-' }}</td>
                                    <td class="px-6 py-4">{{ assignment.academic_class?.name || '-' }}</td>
                                    <td class="px-6 py-4">{{ assignment.section?.name || '-' }}</td>
                                    <td class="px-6 py-4">{{ assignment.subject?.name || '-' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Additional actions like view/edit can go here -->
                                            <Button icon="pi pi-trash" class="p-button-danger p-button-sm p-button-rounded" @click="deleteAssignment(assignment.id)" title="Delete" />
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 font-bold">
                                        No Data Found
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
                    <div>
                        Showing {{ assignments.from || 0 }} To {{ assignments.to || 0 }} Of {{ assignments.total }} Entries
                    </div>
                    
                    <div class="flex gap-2">
                        <Link v-for="link in assignments.links" :key="link.label" :href="link.url || '#'" class="px-3 py-1 rounded" :class="[link.active ? 'bg-blue-500 text-white' : 'hover:bg-gray-100', !link.url ? 'opacity-50 cursor-not-allowed' : '']" v-html="link.label" preserve-scroll />
                    </div>
                </div>
            </template>
        </Card>
    </TeacherLayout>
</template>
