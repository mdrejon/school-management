<script setup>
import { ref, computed } from 'vue';
import { useForm, router, usePage } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
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
    campuses: {
        type: Array,
        required: true,
    },
    pageSettings: {
        type: Object,
        required: true,
    },
    defaultLang: String,
});

import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code || props.defaultLang);
const confirm = useConfirm();

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const defaultText = (field) => {
    if (!field) return '—';
    return field[defaultLangCode.value] ?? Object.values(field)[0] ?? '—';
};

const activeMainTab = ref('campuses');

/* ---------------------------------------------------------------------- */
/* Page Settings State                                                    */
/* ---------------------------------------------------------------------- */

const activeSettingsLang = ref(defaultLangCode.value);
const currentSettingsLang = computed(() => languages.value.find((l) => l.code === activeSettingsLang.value));
const breadcrumbImagePreview = ref(props.pageSettings.breadcrumb_image_url);

const settingsForm = useForm({
    breadcrumb_title: { ...emptyTranslatable(), ...props.pageSettings.breadcrumb_title },
    breadcrumb_image: null,
    remove_breadcrumb_image: false,
    seo_title: { ...emptyTranslatable(), ...props.pageSettings.seo_title },
    seo_description: { ...emptyTranslatable(), ...props.pageSettings.seo_description },
    seo_keywords: { ...emptyTranslatable(), ...props.pageSettings.seo_keywords },
});

const onBreadcrumbImageSelected = (file) => {
    settingsForm.breadcrumb_image = file;
    settingsForm.remove_breadcrumb_image = false;
    settingsForm.clearErrors('breadcrumb_image');
    breadcrumbImagePreview.value = URL.createObjectURL(file);
};

const onBreadcrumbImageRemoved = () => {
    settingsForm.breadcrumb_image = null;
    settingsForm.remove_breadcrumb_image = true;
    breadcrumbImagePreview.value = null;
};

const submitSettings = () => {
    settingsForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.education-levels.settings.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};

/* ---------------------------------------------------------------------- */
/* Dialogs State                                                          */
/* ---------------------------------------------------------------------- */

const showCampusDialog = ref(false);
const showLevelDialog = ref(false);
const showClassDialog = ref(false);
const editingItem = ref(null);
const activeTabLang = ref(defaultLangCode.value);
const parentId = ref(null);

const campusForm = useForm({
    name: emptyTranslatable(),
    sort_order: 0,
    is_active: true,
});

const levelForm = useForm({
    campus_id: null,
    name: emptyTranslatable(),
    description: emptyTranslatable(),
    sort_order: 0,
    is_active: true,
});

const classForm = useForm({
    education_level_id: null,
    name: emptyTranslatable(),
    sort_order: 0,
    is_active: true,
});

/* ---------------------------------------------------------------------- */
/* Campus Methods                                                         */
/* ---------------------------------------------------------------------- */

const openCreateCampus = () => {
    editingItem.value = null;
    activeTabLang.value = defaultLangCode.value;
    campusForm.reset();
    campusForm.clearErrors();
    campusForm.name = emptyTranslatable();
    campusForm.is_active = true;
    showCampusDialog.value = true;
};

const openEditCampus = (campus) => {
    editingItem.value = campus;
    activeTabLang.value = defaultLangCode.value;
    campusForm.clearErrors();
    campusForm.name = { ...emptyTranslatable(), ...campus.name };
    campusForm.sort_order = campus.sort_order;
    campusForm.is_active = campus.is_active;
    showCampusDialog.value = true;
};

const submitCampus = () => {
    if (editingItem.value) {
        campusForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.education-levels.campus.update', editingItem.value.id), {
            onSuccess: () => (showCampusDialog.value = false),
        });
    } else {
        campusForm.post(route('admin.cms.education-levels.campus.store'), {
            onSuccess: () => (showCampusDialog.value = false),
        });
    }
};

const deleteCampus = (campus) => {
    confirm.require({
        message: 'Remove this Campus and all its levels and classes? This can\'t be undone.',
        header: 'Remove Campus',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.education-levels.campus.destroy', campus.id), { preserveScroll: true }),
    });
};

/* ---------------------------------------------------------------------- */
/* Level Methods                                                          */
/* ---------------------------------------------------------------------- */

const openCreateLevel = (campus_id) => {
    editingItem.value = null;
    activeTabLang.value = defaultLangCode.value;
    levelForm.reset();
    levelForm.clearErrors();
    levelForm.campus_id = campus_id;
    levelForm.name = emptyTranslatable();
    levelForm.description = emptyTranslatable();
    levelForm.is_active = true;
    showLevelDialog.value = true;
};

const openEditLevel = (level) => {
    editingItem.value = level;
    activeTabLang.value = defaultLangCode.value;
    levelForm.clearErrors();
    levelForm.campus_id = level.campus_id;
    levelForm.name = { ...emptyTranslatable(), ...level.name };
    levelForm.description = { ...emptyTranslatable(), ...level.description };
    levelForm.sort_order = level.sort_order;
    levelForm.is_active = level.is_active;
    showLevelDialog.value = true;
};

const submitLevel = () => {
    if (editingItem.value) {
        levelForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.education-levels.level.update', editingItem.value.id), {
            onSuccess: () => (showLevelDialog.value = false),
        });
    } else {
        levelForm.post(route('admin.cms.education-levels.level.store'), {
            onSuccess: () => (showLevelDialog.value = false),
        });
    }
};

const deleteLevel = (level) => {
    confirm.require({
        message: 'Remove this Level and all its classes? This can\'t be undone.',
        header: 'Remove Level',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.education-levels.level.destroy', level.id), { preserveScroll: true }),
    });
};

/* ---------------------------------------------------------------------- */
/* Class Methods                                                          */
/* ---------------------------------------------------------------------- */

const openCreateClass = (level_id) => {
    editingItem.value = null;
    activeTabLang.value = defaultLangCode.value;
    classForm.reset();
    classForm.clearErrors();
    classForm.education_level_id = level_id;
    classForm.name = emptyTranslatable();
    classForm.is_active = true;
    showClassDialog.value = true;
};

const openEditClass = (cls) => {
    editingItem.value = cls;
    activeTabLang.value = defaultLangCode.value;
    classForm.clearErrors();
    classForm.education_level_id = cls.education_level_id;
    classForm.name = { ...emptyTranslatable(), ...cls.name };
    classForm.sort_order = cls.sort_order;
    classForm.is_active = cls.is_active;
    showClassDialog.value = true;
};

const submitClass = () => {
    if (editingItem.value) {
        classForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.education-levels.class.update', editingItem.value.id), {
            onSuccess: () => (showClassDialog.value = false),
        });
    } else {
        classForm.post(route('admin.cms.education-levels.class.store'), {
            onSuccess: () => (showClassDialog.value = false),
        });
    }
};

const deleteClass = (cls) => {
    confirm.require({
        message: 'Remove this Class? This can\'t be undone.',
        header: 'Remove Class',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.education-levels.class.destroy', cls.id), { preserveScroll: true }),
    });
};

</script>

<template>
    <AdminLayout title="Education Levels">
        <p class="text-sm text-slate-500 mb-6">
            Manage Campuses, Levels, and Classes displayed on the frontend Education Levels page, as well as the page settings.
        </p>

        <Tabs v-model:value="activeMainTab">
            <TabList>
                <Tab value="campuses">Campuses & Classes</Tab>
                <Tab value="settings">Page Settings</Tab>
            </TabList>
            <TabPanels>
                <!-- Campuses Tab -->
                <TabPanel value="campuses">
                    <div class="flex justify-end mb-4">
                        <Button label="Add Campus" icon="pi pi-plus" @click="openCreateCampus" />
                    </div>

                    <div v-if="!campuses.length" class="text-center py-10 text-slate-500 bg-white rounded shadow-sm border border-slate-100">
                        No campuses found. Click "Add Campus" to begin.
                    </div>

                    <Card v-for="campus in campuses" :key="campus.id" class="mb-6 shadow-sm">
                        <template #title>
                            <div class="flex justify-between items-center bg-slate-50 p-4 rounded-t -m-5 mb-0 border-b">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl font-bold">{{ defaultText(campus.name) }}</span>
                                    <span v-if="!campus.is_active" class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded">Inactive</span>
                                </div>
                                <div class="flex gap-2">
                                    <Button icon="pi pi-plus" label="Add Level" size="small" @click="openCreateLevel(campus.id)" />
                                    <Button icon="pi pi-pencil" text rounded size="small" @click="openEditCampus(campus)" />
                                    <Button icon="pi pi-trash" text rounded severity="danger" size="small" @click="deleteCampus(campus)" />
                                </div>
                            </div>
                        </template>
                        <template #content>
                            <div class="pt-4">
                                <div v-if="!campus.levels.length" class="text-sm text-slate-400 italic">No levels added yet.</div>
                                
                                <div v-for="level in campus.levels" :key="level.id" class="border rounded-lg mb-4 bg-white overflow-hidden">
                                    <div class="flex justify-between items-center bg-slate-50 px-4 py-3 border-b">
                                        <div>
                                            <div class="font-semibold text-slate-800 flex items-center gap-2">
                                                {{ defaultText(level.name) }}
                                                <span v-if="!level.is_active" class="text-xs font-normal bg-red-100 text-red-600 px-1.5 py-0.5 rounded">Inactive</span>
                                            </div>
                                            <p class="text-xs text-slate-500 mt-0.5" v-if="defaultText(level.description)">{{ defaultText(level.description) }}</p>
                                        </div>
                                        <div class="flex gap-1 shrink-0">
                                            <Button icon="pi pi-plus" label="Add Class" size="small" outlined @click="openCreateClass(level.id)" />
                                            <Button icon="pi pi-pencil" text rounded size="small" @click="openEditLevel(level)" />
                                            <Button icon="pi pi-trash" text rounded severity="danger" size="small" @click="deleteLevel(level)" />
                                        </div>
                                    </div>

                                    <div class="p-4 bg-slate-50/50">
                                        <div v-if="!level.classes.length" class="text-xs text-slate-400 italic">No classes added to this level.</div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                            <div v-for="cls in level.classes" :key="cls.id" 
                                                class="flex justify-between items-center bg-white border border-slate-200 rounded px-3 py-2 text-sm shadow-sm group">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-slate-700 font-medium">{{ defaultText(cls.name) }}</span>
                                                    <span v-if="!cls.is_active" class="text-[10px] bg-red-100 text-red-600 px-1 py-0.5 rounded">Inactive</span>
                                                </div>
                                                <div class="opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                                                    <Button icon="pi pi-pencil" text rounded size="small" style="width:2rem;height:2rem;padding:0;" @click="openEditClass(cls)" />
                                                    <Button icon="pi pi-trash" text rounded severity="danger" size="small" style="width:2rem;height:2rem;padding:0;" @click="deleteClass(cls)" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </Card>
                </TabPanel>

                <!-- Page Settings Tab -->
                <TabPanel value="settings">
                    <Card class="shadow-sm">
                        <template #content>
                            <div class="mb-6 pb-5 border-b border-slate-100">
                                <Tabs v-model:value="activeSettingsLang">
                                    <TabList>
                                        <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                                    </TabList>
                                </Tabs>
                            </div>

                            <div class="flex flex-col gap-5">
                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Breadcrumb</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.breadcrumb_title[activeSettingsLang]" :dir="currentSettingsLang?.direction" class="w-full" placeholder="e.g. Education Levels" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Background image</label>
                                            <ImageDropzone
                                                :preview-url="breadcrumbImagePreview"
                                                hint="Shown behind the page title on the page"
                                                width-class="w-full" height-class="h-28"
                                                @select="onBreadcrumbImageSelected"
                                                @remove="onBreadcrumbImageRemoved"
                                            />
                                            <p v-if="settingsForm.errors.breadcrumb_image" class="text-xs text-red-500 mt-1">{{ settingsForm.errors.breadcrumb_image }}</p>
                                        </div>
                                    </div>
                                </section>

                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">SEO</h3>
                                    <div class="flex flex-col gap-4 max-w-lg">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta title</label>
                                            <InputText v-model="settingsForm.seo_title[activeSettingsLang]" :dir="currentSettingsLang?.direction" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta description</label>
                                            <Textarea v-model="settingsForm.seo_description[activeSettingsLang]" :dir="currentSettingsLang?.direction" rows="3" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta keywords</label>
                                            <InputText v-model="settingsForm.seo_keywords[activeSettingsLang]" :dir="currentSettingsLang?.direction" class="w-full" placeholder="comma, separated, keywords" />
                                        </div>
                                    </div>
                                </section>

                                <div class="pt-2 flex justify-end">
                                    <Button label="Save Changes" icon="pi pi-check" :loading="settingsForm.processing" @click="submitSettings" />
                                </div>
                            </div>
                        </template>
                    </Card>
                </TabPanel>
            </TabPanels>
        </Tabs>

        <!-- Campus Dialog -->
        <Dialog v-model:visible="showCampusDialog" modal :header="editingItem ? 'Edit Campus' : 'Add Campus'" class="w-full max-w-lg">
            <Tabs v-model:value="activeTabLang">
                <TabList>
                    <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel v-for="lang in languages" :key="lang.code" :value="lang.code">
                        <div class="mb-4">
                            <label class="block text-xs font-medium text-slate-600 mb-1">Campus Name {{ lang.is_default ? '(required)' : '' }}</label>
                            <InputText v-model="campusForm.name[lang.code]" :dir="lang.direction" class="w-full" autofocus />
                            <p v-if="campusForm.errors[`name.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ campusForm.errors[`name.${lang.code}`] }}</p>
                        </div>
                    </TabPanel>
                </TabPanels>
            </Tabs>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Sort Order</label>
                    <InputText type="number" v-model="campusForm.sort_order" class="w-full" />
                </div>
                <div class="flex flex-col justify-end pb-2">
                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="campusForm.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>
            </div>
            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showCampusDialog = false" />
                <Button label="Save" :loading="campusForm.processing" @click="submitCampus" />
            </template>
        </Dialog>

        <!-- Level Dialog -->
        <Dialog v-model:visible="showLevelDialog" modal :header="editingItem ? 'Edit Level' : 'Add Level'" class="w-full max-w-lg">
            <Tabs v-model:value="activeTabLang">
                <TabList>
                    <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel v-for="lang in languages" :key="lang.code" :value="lang.code">
                        <div class="flex flex-col gap-3">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Level Name {{ lang.is_default ? '(required)' : '' }}</label>
                                <InputText v-model="levelForm.name[lang.code]" :dir="lang.direction" class="w-full" autofocus />
                                <p v-if="levelForm.errors[`name.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ levelForm.errors[`name.${lang.code}`] }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Description</label>
                                <Textarea v-model="levelForm.description[lang.code]" :dir="lang.direction" rows="2" class="w-full" />
                            </div>
                        </div>
                    </TabPanel>
                </TabPanels>
            </Tabs>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Sort Order</label>
                    <InputText type="number" v-model="levelForm.sort_order" class="w-full" />
                </div>
                <div class="flex flex-col justify-end pb-2">
                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="levelForm.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>
            </div>
            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showLevelDialog = false" />
                <Button label="Save" :loading="levelForm.processing" @click="submitLevel" />
            </template>
        </Dialog>

        <!-- Class Dialog -->
        <Dialog v-model:visible="showClassDialog" modal :header="editingItem ? 'Edit Class' : 'Add Class'" class="w-full max-w-lg">
            <Tabs v-model:value="activeTabLang">
                <TabList>
                    <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel v-for="lang in languages" :key="lang.code" :value="lang.code">
                        <div class="mb-4">
                            <label class="block text-xs font-medium text-slate-600 mb-1">Class Name {{ lang.is_default ? '(required)' : '' }}</label>
                            <InputText v-model="classForm.name[lang.code]" :dir="lang.direction" class="w-full" autofocus />
                            <p v-if="classForm.errors[`name.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ classForm.errors[`name.${lang.code}`] }}</p>
                        </div>
                    </TabPanel>
                </TabPanels>
            </Tabs>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Sort Order</label>
                    <InputText type="number" v-model="classForm.sort_order" class="w-full" />
                </div>
                <div class="flex flex-col justify-end pb-2">
                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="classForm.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>
            </div>
            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showClassDialog = false" />
                <Button label="Save" :loading="classForm.processing" @click="submitClass" />
            </template>
        </Dialog>

    </AdminLayout>
</template>
