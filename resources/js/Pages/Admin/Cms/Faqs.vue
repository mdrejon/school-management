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
    faqs: {
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

const activeMainTab = ref('faqs');

/* ---------------------------------------------------------------------- */
/* FAQ CRUD (Dialog)                                                        */
/* ---------------------------------------------------------------------- */

const showDialog = ref(false);
const editing = ref(null);
const activeItemLang = ref(defaultLangCode.value);

const itemForm = useForm({
    question: emptyTranslatable(),
    answer: emptyTranslatable(),
    is_active: true,
});

const openCreate = () => {
    editing.value = null;
    activeItemLang.value = defaultLangCode.value;
    itemForm.reset();
    itemForm.clearErrors();
    itemForm.question = emptyTranslatable();
    itemForm.answer = emptyTranslatable();
    itemForm.is_active = true;
    showDialog.value = true;
};

const openEdit = (faq) => {
    editing.value = faq;
    activeItemLang.value = defaultLangCode.value;
    itemForm.clearErrors();
    itemForm.question = { ...emptyTranslatable(), ...faq.question };
    itemForm.answer = { ...emptyTranslatable(), ...faq.answer };
    itemForm.is_active = faq.is_active;
    showDialog.value = true;
};

const submitItem = () => {
    if (editing.value) {
        itemForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.faq.update', editing.value.id), {
            onSuccess: () => (showDialog.value = false),
        });
    } else {
        itemForm.post(route('admin.cms.faq.store'), {
            onSuccess: () => (showDialog.value = false),
        });
    }
};

const toggleActive = (faq) => {
    router.patch(route('admin.cms.faq.toggle', faq.id), {}, { preserveScroll: true });
};
const moveUp = (faq) => {
    router.patch(route('admin.cms.faq.moveUp', faq.id), {}, { preserveScroll: true });
};
const moveDown = (faq) => {
    router.patch(route('admin.cms.faq.moveDown', faq.id), {}, { preserveScroll: true });
};
const confirmDelete = (faq) => {
    confirm.require({
        message: 'Remove this FAQ? This can\'t be undone.',
        header: 'Remove FAQ',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.faq.destroy', faq.id), { preserveScroll: true }),
    });
};

const defaultText = (faq, field) => {
    const defaultCode = defaultLangCode.value;
    return faq[field]?.[defaultCode] ?? Object.values(faq[field] ?? {})[0] ?? '—';
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
    cta_button_text: { ...emptyTranslatable(), ...props.pageSettings.cta_button_text },
    cta_button_url: props.pageSettings.cta_button_url ?? '',
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
    settingsForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.faq.settings.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="FAQ">
        <p class="text-sm text-slate-500 mb-6">
            Manage the frequently asked questions shown on the public FAQ page, and that page's own intro heading, breadcrumb, and SEO config.
        </p>

        <Tabs v-model:value="activeMainTab">
            <TabList>
                <Tab value="faqs">Questions</Tab>
                <Tab value="settings">Page Settings</Tab>
            </TabList>
            <TabPanels>
                <!-- FAQs -->
                <TabPanel value="faqs">
                    <Card class="shadow-sm">
                        <template #title>
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-lg font-semibold">Questions</div>
                                    <p class="text-sm font-normal text-slate-500 mt-1">
                                        Shown on the public FAQ page as an accordion, in this order.
                                    </p>
                                </div>
                                <Button label="Add Question" icon="pi pi-plus" @click="openCreate" />
                            </div>
                        </template>
                        <template #content>
                            <div class="overflow-x-auto">
                                <DataTable :value="faqs" data-key="id" size="small">
                                    <Column header="Order" style="width: 90px">
                                        <template #body="{ data, index }">
                                            <div class="flex items-center gap-1">
                                                <Button icon="pi pi-angle-up" text rounded size="small" :disabled="index === 0" @click="moveUp(data)" />
                                                <Button icon="pi pi-angle-down" text rounded size="small" :disabled="index === faqs.length - 1" @click="moveDown(data)" />
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="Question">
                                        <template #body="{ data }">
                                            <div class="font-medium text-slate-800">{{ defaultText(data, 'question') }}</div>
                                            <div class="text-xs text-slate-500 mt-1 truncate max-w-md">{{ defaultText(data, 'answer') }}</div>
                                        </template>
                                    </Column>

                                    <Column header="Status">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-2">
                                                <ToggleSwitch :model-value="data.is_active" @update:model-value="() => toggleActive(data)" />
                                                <span class="text-xs text-slate-500">{{ data.is_active ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="" style="width: 100px">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-1 justify-end">
                                                <Button icon="pi pi-pencil" text rounded @click="openEdit(data)" />
                                                <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDelete(data)" />
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
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Page intro (left column)</h3>
                                    <div class="flex flex-col gap-4 max-w-lg">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                            <InputText v-model="settingsForm.section_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Faq's" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.section_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. General frequently asked questions" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlighted word</label>
                                            <InputText v-model="settingsForm.section_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. frequently" />
                                            <p class="text-xs text-slate-400 mt-1">The word within Title to show in orange — must match exactly.</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                            <Textarea v-model="settingsForm.section_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-medium text-slate-600 mb-1.5">CTA button label</label>
                                                <InputText v-model="settingsForm.cta_button_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Have Any Question ?" />
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-slate-600 mb-1.5">CTA button link</label>
                                                <InputText v-model="settingsForm.cta_button_url" class="w-full" placeholder="/contact" />
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Breadcrumb</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.breadcrumb_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Faq's" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Background image</label>
                                            <ImageDropzone
                                                :preview-url="breadcrumbImagePreview"
                                                hint="Shown behind the page title on the FAQ page"
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

        <Dialog v-model:visible="showDialog" modal :header="editing ? 'Edit FAQ' : 'Add FAQ'" class="w-full max-w-2xl">
            <Tabs v-model:value="activeItemLang">
                <TabList>
                    <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel v-for="lang in languages" :key="lang.code" :value="lang.code">
                        <div class="flex flex-col gap-3">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">
                                    Question {{ lang.is_default ? '(required)' : '' }}
                                </label>
                                <InputText v-model="itemForm.question[lang.code]" :dir="lang.direction" class="w-full" />
                                <p v-if="itemForm.errors[`question.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ itemForm.errors[`question.${lang.code}`] }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1">
                                    Answer {{ lang.is_default ? '(required)' : '' }}
                                </label>
                                <Textarea v-model="itemForm.answer[lang.code]" :dir="lang.direction" rows="4" class="w-full" />
                                <p v-if="itemForm.errors[`answer.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ itemForm.errors[`answer.${lang.code}`] }}</p>
                            </div>
                        </div>
                    </TabPanel>
                </TabPanels>
            </Tabs>

            <div class="flex items-center gap-2 mt-4">
                <ToggleSwitch v-model="itemForm.is_active" />
                <span class="text-sm text-slate-600">Active</span>
            </div>

            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showDialog = false" />
                <Button label="Save" :loading="itemForm.processing" @click="submitItem" />
            </template>
        </Dialog>
    </AdminLayout>
</template>
