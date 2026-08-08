<script setup>
import { ref, computed } from 'vue';
import { useForm, router, usePage } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

const props = defineProps({
    schedules: {
        type: Array,
        required: true,
    },
    pageSettings: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);
const confirm = useConfirm();

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const activeMainTab = ref('items');

const defaultText = (item, field) => {
    const defaultCode = defaultLangCode.value;
    return item[field]?.[defaultCode] ?? Object.values(item[field] ?? {})[0] ?? '—';
};

/* ---------------------------------------------------------------------- */
/* Schedule Item CRUD (Dialog)                                            */
/* ---------------------------------------------------------------------- */

const showScheduleDialog = ref(false);
const editingSchedule = ref(null);
const activeScheduleLang = ref(defaultLangCode.value);

const scheduleForm = useForm({
    title: emptyTranslatable(),
    time_info: emptyTranslatable(),
    is_bullet: false,
    sort_order: 0,
    is_active: true,
});

const openCreateSchedule = () => {
    editingSchedule.value = null;
    activeScheduleLang.value = defaultLangCode.value;
    scheduleForm.reset();
    scheduleForm.clearErrors();
    scheduleForm.title = emptyTranslatable();
    scheduleForm.time_info = emptyTranslatable();
    scheduleForm.is_bullet = false;
    scheduleForm.sort_order = (props.schedules.length + 1) * 10;
    scheduleForm.is_active = true;
    showScheduleDialog.value = true;
};

const openEditSchedule = (schedule) => {
    editingSchedule.value = schedule;
    activeScheduleLang.value = defaultLangCode.value;
    scheduleForm.clearErrors();
    scheduleForm.title = { ...emptyTranslatable(), ...schedule.title };
    scheduleForm.time_info = { ...emptyTranslatable(), ...schedule.time_info };
    scheduleForm.is_bullet = Boolean(schedule.is_bullet);
    scheduleForm.sort_order = schedule.sort_order ?? 0;
    scheduleForm.is_active = Boolean(schedule.is_active);
    showScheduleDialog.value = true;
};

const submitSchedule = () => {
    if (editingSchedule.value) {
        scheduleForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.class-schedules.update', editingSchedule.value.id), {
            onSuccess: () => (showScheduleDialog.value = false),
        });
    } else {
        scheduleForm.post(route('admin.cms.class-schedules.store'), {
            onSuccess: () => (showScheduleDialog.value = false),
        });
    }
};

const toggleScheduleActive = (schedule) => {
    router.patch(route('admin.cms.class-schedules.toggle', schedule.id), {}, { preserveScroll: true });
};

const confirmDeleteSchedule = (schedule) => {
    confirm.require({
        message: `Delete schedule item "${defaultText(schedule, 'title')}"?`,
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        acceptClass: 'p-button-danger',
        accept: () => {
            router.delete(route('admin.cms.class-schedules.destroy', schedule.id), { preserveScroll: true });
        },
    });
};

/* ---------------------------------------------------------------------- */
/* Page Settings Form                                                     */
/* ---------------------------------------------------------------------- */

const activeSettingsLang = ref(defaultLangCode.value);
const breadcrumbImagePreview = ref(props.pageSettings.breadcrumb_image_url);

const settingsForm = useForm({
    section_title: { ...emptyTranslatable(), ...props.pageSettings.section_title },
    section_description: { ...emptyTranslatable(), ...props.pageSettings.section_description },
    breadcrumb_title: { ...emptyTranslatable(), ...props.pageSettings.breadcrumb_title },
    breadcrumb_image: null,
    seo_title: { ...emptyTranslatable(), ...props.pageSettings.seo_title },
    seo_description: { ...emptyTranslatable(), ...props.pageSettings.seo_description },
    seo_keywords: { ...emptyTranslatable(), ...props.pageSettings.seo_keywords },
});

const onBreadcrumbImageSelected = (file) => {
    settingsForm.breadcrumb_image = file;
    settingsForm.clearErrors('breadcrumb_image');
    breadcrumbImagePreview.value = URL.createObjectURL(file);
};

const onBreadcrumbImageRemoved = () => {
    settingsForm.breadcrumb_image = null;
    breadcrumbImagePreview.value = null;
};

const submitSettings = () => {
    settingsForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.class-schedules.settings.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Class Schedule Management">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-col gap-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Class Schedule</h1>
                    <p class="text-sm text-slate-500 mt-1">Manage daily activity schedules, times, and page content.</p>
                </div>
            </div>

            <!-- Main Tabs -->
            <Tabs v-model:value="activeMainTab">
                <TabList>
                    <Tab value="items" class="flex items-center gap-2">
                        <i class="pi pi-clock" />
                        <span>Schedule Items ({{ schedules.length }})</span>
                    </Tab>
                    <Tab value="settings" class="flex items-center gap-2">
                        <i class="pi pi-cog" />
                        <span>Page Settings</span>
                    </Tab>
                </TabList>

                <TabPanels class="pt-4">
                    <!-- Tab 1: Schedule Items -->
                    <TabPanel value="items">
                        <Card>
                            <template #title>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <span class="text-lg font-semibold text-slate-800">Daily Activities Schedule</span>
                                    <Button label="Add Schedule Item" icon="pi pi-plus" size="small" @click="openCreateSchedule" />
                                </div>
                            </template>
                            <template #content>
                                <DataTable :value="schedules" data-key="id" class="p-datatable-sm" responsive-layout="scroll">
                                    <template #empty>
                                        <div class="text-center py-8 text-slate-400">
                                            <i class="pi pi-calendar-times text-3xl mb-2 block" />
                                            No schedule items added yet. Click "Add Schedule Item" to create one.
                                        </div>
                                    </template>
                                    <Column field="sort_order" header="Order" style="width: 80px">
                                        <template #body="{ data }">
                                            <span class="font-mono text-xs text-slate-500">{{ data.sort_order }}</span>
                                        </template>
                                    </Column>
                                    <Column header="Activity / Title">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-2" :class="{ 'pl-6': data.is_bullet }">
                                                <span v-if="data.is_bullet" class="w-2 h-2 rounded-full bg-indigo-500 shrink-0" />
                                                <i v-else class="pi pi-circle-fill text-[8px] text-slate-400 shrink-0" />
                                                <span class="font-medium text-slate-800">{{ defaultText(data, 'title') }}</span>
                                                <span v-if="data.is_bullet" class="text-[10px] bg-indigo-50 text-indigo-700 px-1.5 py-0.5 rounded font-medium">Sub-item</span>
                                            </div>
                                        </template>
                                    </Column>
                                    <Column header="Time Details">
                                        <template #body="{ data }">
                                            <span class="text-sm text-slate-600 font-mono">{{ defaultText(data, 'time_info') }}</span>
                                        </template>
                                    </Column>
                                    <Column header="Status" style="width: 100px">
                                        <template #body="{ data }">
                                            <ToggleSwitch :model-value="data.is_active" @update:model-value="toggleScheduleActive(data)" />
                                        </template>
                                    </Column>
                                    <Column header="Actions" style="width: 120px" class="text-right">
                                        <template #body="{ data }">
                                            <div class="flex items-center justify-end gap-1">
                                                <Button icon="pi pi-pencil" text rounded size="small" severity="secondary" @click="openEditSchedule(data)" />
                                                <Button icon="pi pi-trash" text rounded size="small" severity="danger" @click="confirmDeleteSchedule(data)" />
                                            </div>
                                        </template>
                                    </Column>
                                </DataTable>
                            </template>
                        </Card>
                    </TabPanel>

                    <!-- Tab 2: Page Settings -->
                    <TabPanel value="settings">
                        <form @submit.prevent="submitSettings" class="flex flex-col gap-6">
                            <!-- Language Switcher for Settings -->
                            <div class="mb-6 pb-5 border-b border-slate-100">
                                <Tabs v-model:value="activeSettingsLang">
                                    <TabList>
                                        <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                                    </TabList>
                                </Tabs>
                            </div>

                            <!-- Page Header Settings -->
                            <Card>
                                <template #title><span class="text-lg font-semibold text-slate-800">Page Header & Intro</span></template>
                                <template #content>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">Section Title (Heading)</label>
                                            <InputText v-model="settingsForm.section_title[activeSettingsLang]" class="w-full" placeholder="Daily Activities" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">Breadcrumb Title</label>
                                            <InputText v-model="settingsForm.breadcrumb_title[activeSettingsLang]" class="w-full" placeholder="Class Schedule" />
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-medium text-slate-600 mb-1">Section Description / Intro</label>
                                            <Textarea v-model="settingsForm.section_description[activeSettingsLang]" rows="2" class="w-full" placeholder="Optional intro paragraph..." />
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-medium text-slate-600 mb-1">Breadcrumb Background Image</label>
                                            <ImageDropzone
                                                :preview-url="breadcrumbImagePreview"
                                                hint="Recommended: 1920x400 JPG/PNG"
                                                width-class="w-full sm:w-80"
                                                height-class="h-36"
                                                @select="onBreadcrumbImageSelected"
                                                @remove="onBreadcrumbImageRemoved"
                                            />
                                        </div>
                                    </div>
                                </template>
                            </Card>

                            <!-- SEO Settings -->
                            <Card>
                                <template #title><span class="text-lg font-semibold text-slate-800">SEO Settings</span></template>
                                <template #content>
                                    <div class="flex flex-col gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">SEO Title</label>
                                            <InputText v-model="settingsForm.seo_title[activeSettingsLang]" class="w-full" placeholder="Class Schedule | School Name" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">SEO Description</label>
                                            <Textarea v-model="settingsForm.seo_description[activeSettingsLang]" rows="2" class="w-full" placeholder="Brief search engine snippet..." />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">SEO Keywords</label>
                                            <InputText v-model="settingsForm.seo_keywords[activeSettingsLang]" class="w-full" placeholder="class schedule, daily activities, school timing" />
                                        </div>
                                    </div>
                                </template>
                            </Card>

                            <!-- Save Button -->
                            <div class="flex justify-end">
                                <Button type="submit" label="Save Page Settings" icon="pi pi-check" :loading="settingsForm.processing" />
                            </div>
                        </form>
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </div>

        <!-- Schedule Item Create/Edit Modal -->
        <Dialog
            v-model:visible="showScheduleDialog"
            :header="editingSchedule ? 'Edit Schedule Item' : 'Add Schedule Item'"
            modal
            class="w-full max-w-lg"
        >
            <form @submit.prevent="submitSchedule" class="flex flex-col gap-4 pt-2">
                <!-- Language Switcher in Dialog -->
                <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Language:</span>
                    <button
                        v-for="lang in languages"
                        :key="lang.code"
                        type="button"
                        class="px-2.5 py-0.5 text-xs rounded-full font-medium transition"
                        :class="activeScheduleLang === lang.code ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        @click="activeScheduleLang = lang.code"
                    >
                        {{ lang.name }}
                    </button>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Activity / Title</label>
                    <InputText v-model="scheduleForm.title[activeScheduleLang]" class="w-full" placeholder="e.g. Gate Closing, Class Starting, Baby & Class 1" />
                    <p v-if="scheduleForm.errors[`title.${activeScheduleLang}`]" class="text-xs text-red-500 mt-1">{{ scheduleForm.errors[`title.${activeScheduleLang}`] }}</p>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Time / Details</label>
                    <InputText v-model="scheduleForm.time_info[activeScheduleLang]" class="w-full" placeholder="e.g. : 8.15 A.M. (Regulars), : 1.05 P.M. (Saturday to Wednesday)" />
                    <p v-if="scheduleForm.errors[`time_info.${activeScheduleLang}`]" class="text-xs text-red-500 mt-1">{{ scheduleForm.errors[`time_info.${activeScheduleLang}`] }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Sort Order</label>
                        <InputText v-model.number="scheduleForm.sort_order" type="number" class="w-full" />
                    </div>
                    <div class="flex flex-col justify-end">
                        <div class="flex items-center gap-2 h-10">
                            <ToggleSwitch v-model="scheduleForm.is_bullet" />
                            <span class="text-xs font-medium text-slate-700">Indent as Sub-item (Bullet)</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <ToggleSwitch v-model="scheduleForm.is_active" />
                    <span class="text-xs font-medium text-slate-700">Active</span>
                </div>

                <div class="flex justify-end gap-2 pt-4 border-t border-slate-100">
                    <Button type="button" label="Cancel" severity="secondary" text @click="showScheduleDialog = false" />
                    <Button type="submit" :label="editingSchedule ? 'Update' : 'Create'" icon="pi pi-check" :loading="scheduleForm.processing" />
                </div>
            </form>
        </Dialog>
    </AdminLayout>
</template>
