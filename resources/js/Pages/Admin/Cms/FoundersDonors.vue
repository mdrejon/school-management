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
    founders: {
        type: Array,
        required: true,
    },
    donors: {
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

const activeMainTab = ref('founders');

const defaultText = (item, field) => {
    const defaultCode = defaultLangCode.value;
    return item[field]?.[defaultCode] ?? Object.values(item[field] ?? {})[0] ?? '—';
};

/* ---------------------------------------------------------------------- */
/* Founder CRUD (Dialog)                                                    */
/* ---------------------------------------------------------------------- */

const showFounderDialog = ref(false);
const editingFounder = ref(null);
const activeFounderLang = ref(defaultLangCode.value);

const founderForm = useForm({
    name: emptyTranslatable(),
    designation: emptyTranslatable(),
    year: '',
    is_active: true,
});

const openCreateFounder = () => {
    editingFounder.value = null;
    activeFounderLang.value = defaultLangCode.value;
    founderForm.reset();
    founderForm.clearErrors();
    founderForm.name = emptyTranslatable();
    founderForm.designation = emptyTranslatable();
    founderForm.year = '';
    founderForm.is_active = true;
    showFounderDialog.value = true;
};

const openEditFounder = (founder) => {
    editingFounder.value = founder;
    activeFounderLang.value = defaultLangCode.value;
    founderForm.clearErrors();
    founderForm.name = { ...emptyTranslatable(), ...founder.name };
    founderForm.designation = { ...emptyTranslatable(), ...founder.designation };
    founderForm.year = founder.year ?? '';
    founderForm.is_active = founder.is_active;
    showFounderDialog.value = true;
};

const submitFounder = () => {
    if (editingFounder.value) {
        founderForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.founders-donors.founders.update', editingFounder.value.id), {
            onSuccess: () => (showFounderDialog.value = false),
        });
    } else {
        founderForm.post(route('admin.cms.founders-donors.founders.store'), {
            onSuccess: () => (showFounderDialog.value = false),
        });
    }
};

const toggleFounderActive = (founder) => {
    router.patch(route('admin.cms.founders-donors.founders.toggle', founder.id), {}, { preserveScroll: true });
};
const moveFounderUp = (founder) => {
    router.patch(route('admin.cms.founders-donors.founders.moveUp', founder.id), {}, { preserveScroll: true });
};
const moveFounderDown = (founder) => {
    router.patch(route('admin.cms.founders-donors.founders.moveDown', founder.id), {}, { preserveScroll: true });
};
const confirmDeleteFounder = (founder) => {
    confirm.require({
        message: 'Remove this founder? This can\'t be undone.',
        header: 'Remove founder',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.founders-donors.founders.destroy', founder.id), { preserveScroll: true }),
    });
};

/* ---------------------------------------------------------------------- */
/* Donor CRUD (Dialog)                                                      */
/* ---------------------------------------------------------------------- */

const showDonorDialog = ref(false);
const editingDonor = ref(null);
const activeDonorLang = ref(defaultLangCode.value);

const donorForm = useForm({
    name: emptyTranslatable(),
    contribution: emptyTranslatable(),
    year: '',
    is_active: true,
});

const openCreateDonor = () => {
    editingDonor.value = null;
    activeDonorLang.value = defaultLangCode.value;
    donorForm.reset();
    donorForm.clearErrors();
    donorForm.name = emptyTranslatable();
    donorForm.contribution = emptyTranslatable();
    donorForm.year = '';
    donorForm.is_active = true;
    showDonorDialog.value = true;
};

const openEditDonor = (donor) => {
    editingDonor.value = donor;
    activeDonorLang.value = defaultLangCode.value;
    donorForm.clearErrors();
    donorForm.name = { ...emptyTranslatable(), ...donor.name };
    donorForm.contribution = { ...emptyTranslatable(), ...donor.contribution };
    donorForm.year = donor.year ?? '';
    donorForm.is_active = donor.is_active;
    showDonorDialog.value = true;
};

const submitDonor = () => {
    if (editingDonor.value) {
        donorForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.founders-donors.donors.update', editingDonor.value.id), {
            onSuccess: () => (showDonorDialog.value = false),
        });
    } else {
        donorForm.post(route('admin.cms.founders-donors.donors.store'), {
            onSuccess: () => (showDonorDialog.value = false),
        });
    }
};

const toggleDonorActive = (donor) => {
    router.patch(route('admin.cms.founders-donors.donors.toggle', donor.id), {}, { preserveScroll: true });
};
const moveDonorUp = (donor) => {
    router.patch(route('admin.cms.founders-donors.donors.moveUp', donor.id), {}, { preserveScroll: true });
};
const moveDonorDown = (donor) => {
    router.patch(route('admin.cms.founders-donors.donors.moveDown', donor.id), {}, { preserveScroll: true });
};
const confirmDeleteDonor = (donor) => {
    confirm.require({
        message: 'Remove this donor? This can\'t be undone.',
        header: 'Remove donor',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.founders-donors.donors.destroy', donor.id), { preserveScroll: true }),
    });
};

/* ---------------------------------------------------------------------- */
/* Page settings                                                           */
/* ---------------------------------------------------------------------- */

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));
const breadcrumbImagePreview = ref(props.pageSettings.breadcrumb_image_url);

const settingsForm = useForm({
    section_tagline: { ...emptyTranslatable(), ...props.pageSettings.section_tagline },
    section_title: { ...emptyTranslatable(), ...props.pageSettings.section_title },
    section_highlight: { ...emptyTranslatable(), ...props.pageSettings.section_highlight },
    section_description: { ...emptyTranslatable(), ...props.pageSettings.section_description },
    founders_table_title: { ...emptyTranslatable(), ...props.pageSettings.founders_table_title },
    donors_table_title: { ...emptyTranslatable(), ...props.pageSettings.donors_table_title },
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
    settingsForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.founders-donors.settings.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Founder & Donor List">
        <p class="text-sm text-slate-500 mb-6">
            Manage the founding members and donors shown on the public Founder & Donor List page, and that page's own intro heading, table titles, breadcrumb, and SEO config.
        </p>

        <Tabs v-model:value="activeMainTab">
            <TabList>
                <Tab value="founders">Founding Members</Tab>
                <Tab value="donors">Donors</Tab>
                <Tab value="settings">Page Settings</Tab>
            </TabList>
            <TabPanels>
                <!-- Founders -->
                <TabPanel value="founders">
                    <Card class="shadow-sm">
                        <template #title>
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-lg font-semibold">Founding Members</div>
                                    <p class="text-sm font-normal text-slate-500 mt-1">
                                        Shown in the "Founding Members" table on the public page, in this order.
                                    </p>
                                </div>
                                <Button label="Add Founder" icon="pi pi-plus" @click="openCreateFounder" />
                            </div>
                        </template>
                        <template #content>
                            <div class="overflow-x-auto">
                                <DataTable :value="founders" data-key="id" size="small">
                                    <Column header="Order" style="width: 90px">
                                        <template #body="{ data, index }">
                                            <div class="flex items-center gap-1">
                                                <Button icon="pi pi-angle-up" text rounded size="small" :disabled="index === 0" @click="moveFounderUp(data)" />
                                                <Button icon="pi pi-angle-down" text rounded size="small" :disabled="index === founders.length - 1" @click="moveFounderDown(data)" />
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="Name">
                                        <template #body="{ data }">
                                            <div class="font-medium text-slate-800">{{ defaultText(data, 'name') }}</div>
                                            <div class="text-xs text-slate-500 mt-1">{{ defaultText(data, 'designation') }}</div>
                                        </template>
                                    </Column>

                                    <Column header="Year" style="width: 100px">
                                        <template #body="{ data }">
                                            {{ data.year || '—' }}
                                        </template>
                                    </Column>

                                    <Column header="Status">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-2">
                                                <ToggleSwitch :model-value="data.is_active" @update:model-value="() => toggleFounderActive(data)" />
                                                <span class="text-xs text-slate-500">{{ data.is_active ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="" style="width: 100px">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-1 justify-end">
                                                <Button icon="pi pi-pencil" text rounded @click="openEditFounder(data)" />
                                                <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDeleteFounder(data)" />
                                            </div>
                                        </template>
                                    </Column>
                                </DataTable>
                            </div>
                        </template>
                    </Card>
                </TabPanel>

                <!-- Donors -->
                <TabPanel value="donors">
                    <Card class="shadow-sm">
                        <template #title>
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-lg font-semibold">Donors</div>
                                    <p class="text-sm font-normal text-slate-500 mt-1">
                                        Shown in the "Honorable Donors" table on the public page, in this order.
                                    </p>
                                </div>
                                <Button label="Add Donor" icon="pi pi-plus" @click="openCreateDonor" />
                            </div>
                        </template>
                        <template #content>
                            <div class="overflow-x-auto">
                                <DataTable :value="donors" data-key="id" size="small">
                                    <Column header="Order" style="width: 90px">
                                        <template #body="{ data, index }">
                                            <div class="flex items-center gap-1">
                                                <Button icon="pi pi-angle-up" text rounded size="small" :disabled="index === 0" @click="moveDonorUp(data)" />
                                                <Button icon="pi pi-angle-down" text rounded size="small" :disabled="index === donors.length - 1" @click="moveDonorDown(data)" />
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="Name">
                                        <template #body="{ data }">
                                            <div class="font-medium text-slate-800">{{ defaultText(data, 'name') }}</div>
                                            <div class="text-xs text-slate-500 mt-1">{{ defaultText(data, 'contribution') }}</div>
                                        </template>
                                    </Column>

                                    <Column header="Year" style="width: 100px">
                                        <template #body="{ data }">
                                            {{ data.year || '—' }}
                                        </template>
                                    </Column>

                                    <Column header="Status">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-2">
                                                <ToggleSwitch :model-value="data.is_active" @update:model-value="() => toggleDonorActive(data)" />
                                                <span class="text-xs text-slate-500">{{ data.is_active ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="" style="width: 100px">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-1 justify-end">
                                                <Button icon="pi pi-pencil" text rounded @click="openEditDonor(data)" />
                                                <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDeleteDonor(data)" />
                                            </div>
                                        </template>
                                    </Column>
                                </DataTable>
                            </div>
                        </template>
                    </Card>
                </TabPanel>

                <!-- Page Settings -->
                <TabPanel value="settings">
                    <Card class="shadow-sm">
                        <template #content>
                            <div class="mb-6 pb-5 border-b border-slate-100">
                                <Tabs v-model:value="activeLang">
                                    <TabList>
                                        <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                                    </TabList>
                                </Tabs>
                            </div>

                            <div class="flex flex-col gap-5">
                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Page intro heading</h3>
                                    <div class="flex flex-col gap-4 max-w-lg">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                            <InputText v-model="settingsForm.section_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Our Contributors" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.section_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Founder & Donor List" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlighted word</label>
                                            <InputText v-model="settingsForm.section_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Donor" />
                                            <p class="text-xs text-slate-400 mt-1">The word within Title to show in orange — must match exactly.</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                            <Textarea v-model="settingsForm.section_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                        </div>
                                    </div>
                                </section>

                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Table titles</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-lg">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Founders table heading</label>
                                            <InputText v-model="settingsForm.founders_table_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Founding Members" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Donors table heading</label>
                                            <InputText v-model="settingsForm.donors_table_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Honorable Donors" />
                                        </div>
                                    </div>
                                </section>

                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Breadcrumb</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.breadcrumb_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Founder & Donor List" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Background image</label>
                                            <ImageDropzone
                                                :preview-url="breadcrumbImagePreview"
                                                hint="Shown behind the page title on the Founder & Donor List page"
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
                                            <InputText v-model="settingsForm.seo_title[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta description</label>
                                            <Textarea v-model="settingsForm.seo_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta keywords</label>
                                            <InputText v-model="settingsForm.seo_keywords[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="comma, separated, keywords" />
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

        <!-- Founder Dialog -->
        <Dialog v-model:visible="showFounderDialog" modal :header="editingFounder ? 'Edit founder' : 'Add founder'" class="w-full max-w-2xl">
            <Tabs v-model:value="activeFounderLang">
                <TabList>
                    <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel v-for="lang in languages" :key="lang.code" :value="lang.code">
                        <div class="flex flex-col gap-3">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">
                                    Name {{ lang.is_default ? '(required)' : '' }}
                                </label>
                                <InputText v-model="founderForm.name[lang.code]" :dir="lang.direction" class="w-full" />
                                <p v-if="founderForm.errors[`name.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ founderForm.errors[`name.${lang.code}`] }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Designation</label>
                                <InputText v-model="founderForm.designation[lang.code]" :dir="lang.direction" class="w-full" placeholder="e.g. Founder & Chairman" />
                            </div>
                        </div>
                    </TabPanel>
                </TabPanels>
            </Tabs>

            <div class="mt-3 max-w-[160px]">
                <label class="block text-xs font-medium text-slate-600 mb-1">Year</label>
                <InputText v-model="founderForm.year" class="w-full" placeholder="e.g. 1918" />
                <p v-if="founderForm.errors.year" class="text-xs text-red-500 mt-1">{{ founderForm.errors.year }}</p>
            </div>

            <div class="flex items-center gap-2 mt-4">
                <ToggleSwitch v-model="founderForm.is_active" />
                <span class="text-sm text-slate-600">Active</span>
            </div>

            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showFounderDialog = false" />
                <Button label="Save" :loading="founderForm.processing" @click="submitFounder" />
            </template>
        </Dialog>

        <!-- Donor Dialog -->
        <Dialog v-model:visible="showDonorDialog" modal :header="editingDonor ? 'Edit donor' : 'Add donor'" class="w-full max-w-2xl">
            <Tabs v-model:value="activeDonorLang">
                <TabList>
                    <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel v-for="lang in languages" :key="lang.code" :value="lang.code">
                        <div class="flex flex-col gap-3">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">
                                    Name {{ lang.is_default ? '(required)' : '' }}
                                </label>
                                <InputText v-model="donorForm.name[lang.code]" :dir="lang.direction" class="w-full" />
                                <p v-if="donorForm.errors[`name.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ donorForm.errors[`name.${lang.code}`] }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">Contribution</label>
                                <InputText v-model="donorForm.contribution[lang.code]" :dir="lang.direction" class="w-full" placeholder="e.g. Library Building" />
                            </div>
                        </div>
                    </TabPanel>
                </TabPanels>
            </Tabs>

            <div class="mt-3 max-w-[160px]">
                <label class="block text-xs font-medium text-slate-600 mb-1">Year</label>
                <InputText v-model="donorForm.year" class="w-full" placeholder="e.g. 1925" />
                <p v-if="donorForm.errors.year" class="text-xs text-red-500 mt-1">{{ donorForm.errors.year }}</p>
            </div>

            <div class="flex items-center gap-2 mt-4">
                <ToggleSwitch v-model="donorForm.is_active" />
                <span class="text-sm text-slate-600">Active</span>
            </div>

            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showDonorDialog = false" />
                <Button label="Save" :loading="donorForm.processing" @click="submitDonor" />
            </template>
        </Dialog>
    </AdminLayout>
</template>
