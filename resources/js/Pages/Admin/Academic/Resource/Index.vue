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
    resources: Object,
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

const fetchResources = debounce(() => {
    router.get(route('admin.academic.resources.index'), {
        search: filterForm.search,
        per_page: filterForm.per_page,
    }, { preserveState: true, preserveScroll: true });
}, 300);

watch(() => filterForm.search, fetchResources);
watch(() => filterForm.per_page, fetchResources);

const deleteResource = (id) => {
    confirm.require({
        message: 'Are you sure you want to delete this resource?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        acceptClass: 'p-button-danger',
        accept: () => {
            router.delete(route('admin.academic.resources.destroy', id), {
                preserveScroll: true,
            });
        },
    });
};
</script>

<template>
    <AdminLayout title="Resource">
        <ConfirmDialog />
        
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Resource</h1>
            <p class="text-sm text-gray-500">Home - Resources</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white relative">
            <template #title>
                <div class="absolute top-4 right-4">
                    <Link :href="route('admin.academic.resources.create')">
                        <Button label="Resource Create" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600" />
                    </Link>
                </div>
            </template>
            <template #content>
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4 mt-6">
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
                                <th scope="col" class="px-6 py-3">Resources <i class="pi pi-sort-alt text-[10px] ml-1"></i></th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="resources.data.length > 0">
                                <tr v-for="(resource, index) in resources.data" :key="resource.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ (resources.current_page - 1) * resources.per_page + index + 1 }}</td>
                                    <td class="px-6 py-4">{{ resource.date }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ resource.title }}</td>
                                    <td class="px-6 py-4">{{ resource.session?.name || '-' }}</td>
                                    <td class="px-6 py-4">{{ resource.academic_class?.name || '-' }}</td>
                                    <td class="px-6 py-4">{{ resource.section?.name || '-' }}</td>
                                    <td class="px-6 py-4 text-blue-500">
                                        {{ resource.files ? resource.files.length + ' File(s)' : '0 Files' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <Button icon="pi pi-trash" class="p-button-danger p-button-sm p-button-text" @click="deleteResource(resource.id)" title="Delete" />
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
                        Showing {{ resources.from || 0 }} to {{ resources.to || 0 }} of {{ resources.total }} entries
                    </div>
                    
                    <div class="flex gap-1 items-center">
                        <Link :href="resources.prev_page_url || '#'" class="px-2 py-1 text-gray-400 hover:text-gray-700" :class="{ 'pointer-events-none opacity-50': !resources.prev_page_url }">&laquo;</Link>
                        <Link :href="resources.prev_page_url || '#'" class="px-2 py-1 text-gray-400 hover:text-gray-700" :class="{ 'pointer-events-none opacity-50': !resources.prev_page_url }">&lsaquo;</Link>
                        <Link :href="resources.next_page_url || '#'" class="px-2 py-1 text-gray-400 hover:text-gray-700" :class="{ 'pointer-events-none opacity-50': !resources.next_page_url }">&rsaquo;</Link>
                        <Link :href="resources.next_page_url || '#'" class="px-2 py-1 text-gray-400 hover:text-gray-700" :class="{ 'pointer-events-none opacity-50': !resources.next_page_url }">&raquo;</Link>
                    </div>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
