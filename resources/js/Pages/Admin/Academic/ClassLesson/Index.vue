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
    classLessons: Object,
    filters: Object,
});

const confirm = useConfirm();

const filterForm = useForm({
    search: props.filters?.search || '',
    per_page: props.filters?.per_page || 10,
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

const fetchClassLessons = debounce(() => {
    router.get(route('admin.academic.class-lessons.index'), {
        search: filterForm.search,
        per_page: filterForm.per_page,
    }, { preserveState: true, preserveScroll: true });
}, 300);

watch(() => filterForm.search, fetchClassLessons);
watch(() => filterForm.per_page, fetchClassLessons);

const deleteClassLesson = (id) => {
    confirm.require({
        message: 'Are you sure you want to delete this class lesson?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        acceptClass: 'p-button-danger',
        accept: () => {
            router.delete(route('admin.academic.class-lessons.destroy', id), {
                preserveScroll: true,
            });
        },
    });
};
</script>

<template>
    <AdminLayout title="Classlesson">
        <ConfirmDialog />
        
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Classlesson</h1>
                <p class="text-sm text-gray-500">Home - Classlessons</p>
            </div>
            <Link :href="route('admin.academic.class-lessons.create')">
                <Button label="Classlesson Create" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600" />
            </Link>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #content>
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4 mt-2">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">entries per page</span>
                        <Dropdown v-model="filterForm.per_page" :options="perPageOptions" optionLabel="label" optionValue="value" class="w-20" />
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <span class="text-sm text-gray-600">Search:</span>
                        <InputText v-model="filterForm.search" class="w-full md:w-auto" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 border-collapse">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr class="border-b">
                                <th scope="col" class="px-6 py-3">Sl No <i class="pi pi-sort-alt text-[10px] ml-1"></i></th>
                                <th scope="col" class="px-6 py-3">Date <i class="pi pi-sort-alt text-[10px] ml-1"></i></th>
                                <th scope="col" class="px-6 py-3">Title <i class="pi pi-sort-alt text-[10px] ml-1"></i></th>
                                <th scope="col" class="px-6 py-3">Session <i class="pi pi-sort-alt text-[10px] ml-1"></i></th>
                                <th scope="col" class="px-6 py-3">Class <i class="pi pi-sort-alt text-[10px] ml-1"></i></th>
                                <th scope="col" class="px-6 py-3">Section <i class="pi pi-sort-alt text-[10px] ml-1"></i></th>
                                <th scope="col" class="px-6 py-3">Files <i class="pi pi-sort-alt text-[10px] ml-1"></i></th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="classLessons.data.length > 0">
                                <tr v-for="(classLesson, index) in classLessons.data" :key="classLesson.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ (classLessons.current_page - 1) * classLessons.per_page + index + 1 }}</td>
                                    <td class="px-6 py-4">{{ classLesson.date }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ classLesson.title }}</td>
                                    <td class="px-6 py-4">{{ classLesson.session?.name || '-' }}</td>
                                    <td class="px-6 py-4">{{ classLesson.academic_class?.name || '-' }}</td>
                                    <td class="px-6 py-4">{{ classLesson.section?.name || '-' }}</td>
                                    <td class="px-6 py-4 text-blue-500">
                                        {{ classLesson.files ? classLesson.files.length + ' File(s)' : '0 Files' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <Button icon="pi pi-trash" class="p-button-danger p-button-sm p-button-text" @click="deleteClassLesson(classLesson.id)" title="Delete" />
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                        No data available in table
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
                    <div>
                        Showing {{ classLessons.from || 0 }} to {{ classLessons.to || 0 }} of {{ classLessons.total }} entries
                    </div>
                    
                    <div class="flex gap-1 items-center">
                        <Link :href="classLessons.prev_page_url || '#'" class="px-2 py-1 text-gray-400 hover:text-gray-700" :class="{ 'pointer-events-none opacity-50': !classLessons.prev_page_url }">&laquo;</Link>
                        <Link :href="classLessons.prev_page_url || '#'" class="px-2 py-1 text-gray-400 hover:text-gray-700" :class="{ 'pointer-events-none opacity-50': !classLessons.prev_page_url }">&lsaquo;</Link>
                        <Link :href="classLessons.next_page_url || '#'" class="px-2 py-1 text-gray-400 hover:text-gray-700" :class="{ 'pointer-events-none opacity-50': !classLessons.next_page_url }">&rsaquo;</Link>
                        <Link :href="classLessons.next_page_url || '#'" class="px-2 py-1 text-gray-400 hover:text-gray-700" :class="{ 'pointer-events-none opacity-50': !classLessons.next_page_url }">&raquo;</Link>
                    </div>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
