<script setup>
import { useForm, router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from 'primevue/useconfirm';
import { watch } from 'vue';

const props = defineProps({
    syllabuses: Object,
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

const fetchSyllabuses = debounce(() => {
    router.get(route('admin.academic.syllabuses.index'), {
        search: filterForm.search,
        per_page: filterForm.per_page,
    }, { preserveState: true, preserveScroll: true });
}, 300);

watch(() => filterForm.search, fetchSyllabuses);
watch(() => filterForm.per_page, fetchSyllabuses);

const deleteSyllabus = (id) => {
    confirm.require({
        message: 'Are you sure you want to delete this syllabus?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        acceptClass: 'p-button-danger',
        accept: () => {
            router.delete(route('admin.academic.syllabuses.destroy', id), {
                preserveScroll: true,
            });
        },
    });
};

const getFileName = (path) => {
    if (!path) return '';
    const parts = path.split('/');
    return parts[parts.length - 1];
};
</script>

<template>
    <AdminLayout title="Syllabus">
        <ConfirmDialog />
        
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Syllabus</h1>
            <p class="text-sm text-gray-500">Home - Syllabus</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #title>
                <div class="flex items-center justify-end pb-2">
                    <Link :href="route('admin.academic.syllabuses.create')">
                        <Button label="Create Syllabus" class="bg-blue-500 border-none" />
                    </Link>
                </div>
            </template>
            <template #content>
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Show</span>
                        <Dropdown v-model="filterForm.per_page" :options="perPageOptions" optionLabel="label" optionValue="value" class="w-24" />
                        <span class="text-sm text-gray-600">Entries</span>
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <span class="text-sm text-gray-600">Search</span>
                        <InputText v-model="filterForm.search" placeholder="Search..." class="w-full md:w-auto" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Description</th>
                                <th scope="col" class="px-6 py-3">Class</th>
                                <th scope="col" class="px-6 py-3">File</th>
                                <th scope="col" class="px-6 py-3">Teacher</th><th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="syllabuses.data.length > 0">
                                <tr v-for="syllabus in syllabuses.data" :key="syllabus.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ syllabus.title }}</td>
                                    <td class="px-6 py-4 max-w-xs truncate" :title="syllabus.description">{{ syllabus.description || '-' }}</td>
                                    <td class="px-6 py-4">{{ syllabus.academic_class?.name || '-' }}</td>
                                    <td class="px-6 py-4 text-blue-500 max-w-[200px] truncate" :title="getFileName(syllabus.file_path)">
                                        {{ getFileName(syllabus.file_path) }}
                                    </td>
                                    <td class="px-6 py-4">{{ syllabus.teacher?.name || '-' }}</td><td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <a :href="route('admin.academic.syllabuses.download', syllabus.id)" target="_blank">
                                                <Button icon="pi pi-download" class="p-button-info p-button-sm rounded shadow-none" title="Download" />
                                            </a>
                                            <Button icon="pi pi-eye" class="bg-teal-500 border-none text-white p-button-sm rounded shadow-none" title="View" />
                                            <Button icon="pi pi-pencil" class="bg-yellow-400 border-none text-white p-button-sm rounded shadow-none" title="Edit" />
                                            <Button icon="pi pi-trash" class="p-button-danger p-button-sm rounded shadow-none" @click="deleteSyllabus(syllabus.id)" title="Delete" />
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 font-bold">
                                        No Data Found
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
                    <div>
                        Showing {{ syllabuses.from || 0 }} To {{ syllabuses.to || 0 }} Of {{ syllabuses.total }} Entries
                    </div>
                    
                    <div class="flex gap-2">
                        <Link v-for="link in syllabuses.links" :key="link.label" :href="link.url || '#'" class="px-3 py-1 rounded" :class="[link.active ? 'bg-blue-500 text-white' : 'hover:bg-gray-100', !link.url ? 'opacity-50 cursor-not-allowed' : '']" v-html="link.label" preserve-scroll />
                    </div>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
