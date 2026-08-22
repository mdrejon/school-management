<script setup>
import { ref, computed } from 'vue';
import { useForm, router, usePage, Link } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import ToggleSwitch from 'primevue/toggleswitch';
import Dropdown from 'primevue/dropdown';
import Dialog from 'primevue/dialog';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';
import DatePicker from 'primevue/datepicker';

const props = defineProps({
    events: {
        type: Array,
        required: true,
    },
    currentYear: {
        type: Number,
        required: true,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);
const confirm = useConfirm();

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));

const yearOptions = computed(() => {
    const startYear = 2020;
    const endYear = new Date().getFullYear() + 5;
    const years = [];
    for (let y = startYear; y <= endYear; y++) {
        years.push({ label: y.toString(), value: y });
    }
    return years.reverse();
});

const selectedYear = ref(props.currentYear);

const onYearChange = () => {
    router.get(route('admin.cms.academic-calendars.index'), { year: selectedYear.value }, { preserveState: true });
};

const eventTypes = [
    { label: 'Academic Event', value: 'academic_event' },
    { label: 'Govt Holiday', value: 'govt_holiday' },
    { label: 'Other', value: 'other' }
];

const getEventTypeName = (val) => {
    return eventTypes.find(t => t.value === val)?.label || val;
};

const defaultText = (item, field) => {
    const defaultCode = defaultLangCode.value;
    return item[field]?.[defaultCode] ?? Object.values(item[field] ?? {})[0] ?? '—';
};

const showDialog = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
    date: null,
    title: emptyTranslatable(),
    type: 'academic_event',
    description: emptyTranslatable(),
    is_active: true,
});

const openCreateDialog = () => {
    isEditing.value = false;
    form.reset();
    form.date = new Date(selectedYear.value, 0, 1);
    form.clearErrors();
    showDialog.value = true;
};

const openEditDialog = (eventData) => {
    isEditing.value = true;
    editingId.value = eventData.id;
    form.date = new Date(eventData.date);
    form.title = { ...emptyTranslatable(), ...eventData.title };
    form.type = eventData.type;
    form.description = { ...emptyTranslatable(), ...eventData.description };
    form.is_active = Boolean(eventData.is_active);
    form.clearErrors();
    showDialog.value = true;
};

const submitForm = () => {
    // Format date to YYYY-MM-DD
    const dateObj = form.date;
    const dateStr = dateObj ? `${dateObj.getFullYear()}-${String(dateObj.getMonth() + 1).padStart(2, '0')}-${String(dateObj.getDate()).padStart(2, '0')}` : null;
    
    const dataToSend = { ...form.data(), date: dateStr };
    
    if (isEditing.value) {
        form.transform(() => ({ ...dataToSend, _method: 'put' })).post(route('admin.cms.academic-calendars.update', editingId.value), {
            onSuccess: () => { showDialog.value = false; },
        });
    } else {
        form.transform(() => dataToSend).post(route('admin.cms.academic-calendars.store'), {
            onSuccess: () => { showDialog.value = false; },
        });
    }
};

const toggleActive = (eventData) => {
    router.patch(route('admin.cms.academic-calendars.toggle', eventData.id), {}, { preserveScroll: true });
};

const confirmDelete = (eventData) => {
    confirm.require({
        message: 'Delete this event? This can\'t be undone.',
        header: 'Delete Event',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Delete', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.academic-calendars.destroy', eventData.id), { preserveScroll: true }),
    });
};
</script>

<template>
    <AdminLayout title="Academic Calendar">
        <p class="text-sm text-slate-500 mb-6">
            Manage academic events, holidays, and other significant dates.
        </p>

        <Card class="shadow-sm">
            <template #title>
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="text-lg font-semibold">Events</div>
                        <Dropdown v-model="selectedYear" :options="yearOptions" optionLabel="label" optionValue="value" @change="onYearChange" class="w-32" />
                    </div>
                    <Button label="Add Event" icon="pi pi-plus" @click="openCreateDialog" />
                </div>
            </template>
            <template #content>
                <div class="overflow-x-auto">
                    <DataTable :value="events" data-key="id" size="small" :paginator="true" :rows="20">
                        <Column header="Date" style="width: 140px">
                            <template #body="{ data }">
                                <span class="font-medium text-slate-800">{{ data.date }}</span>
                            </template>
                        </Column>
                        <Column header="Title">
                            <template #body="{ data }">
                                <span class="text-slate-800">{{ defaultText(data, 'title') }}</span>
                            </template>
                        </Column>
                        <Column header="Type" style="width: 160px">
                            <template #body="{ data }">
                                <span class="text-sm text-slate-600">{{ getEventTypeName(data.type) }}</span>
                            </template>
                        </Column>
                        <Column header="Status" style="width: 120px">
                            <template #body="{ data }">
                                <div class="flex items-center gap-2">
                                    <ToggleSwitch :model-value="data.is_active" @update:model-value="() => toggleActive(data)" />
                                    <span class="text-xs text-slate-500">{{ data.is_active ? 'Active' : 'Hidden' }}</span>
                                </div>
                            </template>
                        </Column>
                        <Column header="" style="width: 100px">
                            <template #body="{ data }">
                                <div class="flex items-center gap-1 justify-end">
                                    <Button icon="pi pi-pencil" text rounded @click="openEditDialog(data)" />
                                    <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDelete(data)" />
                                </div>
                            </template>
                        </Column>
                        <template #empty>
                            <div class="text-center py-8 text-slate-500">No events found for the selected year.</div>
                        </template>
                    </DataTable>
                </div>
            </template>
        </Card>

        <Dialog v-model:visible="showDialog" :header="isEditing ? 'Edit Event' : 'Add Event'" :modal="true" :style="{ width: '50vw' }" :breakpoints="{ '960px': '75vw', '640px': '90vw' }">
            <div class="flex flex-col gap-5 pt-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Date <span class="text-red-500">*</span></label>
                        <DatePicker v-model="form.date" dateFormat="yy-mm-dd" class="w-full" />
                        <p v-if="form.errors.date" class="text-xs text-red-500 mt-1">{{ form.errors.date }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Event Type <span class="text-red-500">*</span></label>
                        <Dropdown v-model="form.type" :options="eventTypes" optionLabel="label" optionValue="value" class="w-full" />
                        <p v-if="form.errors.type" class="text-xs text-red-500 mt-1">{{ form.errors.type }}</p>
                    </div>
                </div>

                <div class="border rounded-lg p-4 bg-slate-50">
                    <Tabs v-model:value="activeLang">
                        <TabList>
                            <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                        </TabList>
                    </Tabs>
                    <div class="mt-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Title <span v-if="activeLang === defaultLangCode" class="text-red-500">*</span></label>
                            <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" />
                            <p v-if="form.errors[`title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${activeLang}`] }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Description (Optional)</label>
                            <Textarea v-model="form.description[activeLang]" :dir="currentLang?.direction" rows="4" class="w-full" />
                            <p v-if="form.errors[`description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`description.${activeLang}`] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <template #footer>
                <div class="flex justify-end gap-2 mt-4">
                    <Button label="Cancel" text severity="secondary" @click="showDialog = false" />
                    <Button :label="isEditing ? 'Save Changes' : 'Create Event'" icon="pi pi-check" :loading="form.processing" @click="submitForm" />
                </div>
            </template>
        </Dialog>
    </AdminLayout>
</template>
