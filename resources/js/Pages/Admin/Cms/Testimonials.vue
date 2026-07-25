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
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

const props = defineProps({
    testimonials: {
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

const activeMainTab = ref('testimonials');

/* ---------------------------------------------------------------------- */
/* Testimonial CRUD (Dialog)                                               */
/* ---------------------------------------------------------------------- */

const showDialog = ref(false);
const editing = ref(null);
const photoPreview = ref(null);
const activeItemLang = ref(defaultLangCode.value);

const itemForm = useForm({
    quote: emptyTranslatable(),
    rating: 5,
    author_name: emptyTranslatable(),
    author_role: emptyTranslatable(),
    author_photo: null,
});

const openCreate = () => {
    editing.value = null;
    photoPreview.value = null;
    activeItemLang.value = defaultLangCode.value;
    itemForm.reset();
    itemForm.clearErrors();
    itemForm.quote = emptyTranslatable();
    itemForm.author_name = emptyTranslatable();
    itemForm.author_role = emptyTranslatable();
    itemForm.rating = 5;
    showDialog.value = true;
};

const openEdit = (testimonial) => {
    editing.value = testimonial;
    photoPreview.value = testimonial.author_photo_url;
    activeItemLang.value = defaultLangCode.value;
    itemForm.clearErrors();
    itemForm.quote = { ...emptyTranslatable(), ...testimonial.quote };
    itemForm.rating = testimonial.rating;
    itemForm.author_name = { ...emptyTranslatable(), ...testimonial.author_name };
    itemForm.author_role = { ...emptyTranslatable(), ...testimonial.author_role };
    itemForm.author_photo = null;
    showDialog.value = true;
};

const onPhotoSelected = (file) => {
    itemForm.author_photo = file;
    itemForm.clearErrors('author_photo');
    photoPreview.value = URL.createObjectURL(file);
};
const onPhotoRemoved = () => {
    itemForm.author_photo = null;
    photoPreview.value = null;
};

const submitItem = () => {
    if (editing.value) {
        itemForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.testimonials.update', editing.value.id), {
            forceFormData: true,
            onSuccess: () => (showDialog.value = false),
        });
    } else {
        itemForm.post(route('admin.cms.testimonials.store'), {
            forceFormData: true,
            onSuccess: () => (showDialog.value = false),
        });
    }
};

const toggleActive = (testimonial) => {
    router.patch(route('admin.cms.testimonials.toggle', testimonial.id), {}, { preserveScroll: true });
};
const moveUp = (testimonial) => {
    router.patch(route('admin.cms.testimonials.moveUp', testimonial.id), {}, { preserveScroll: true });
};
const moveDown = (testimonial) => {
    router.patch(route('admin.cms.testimonials.moveDown', testimonial.id), {}, { preserveScroll: true });
};
const confirmDelete = (testimonial) => {
    confirm.require({
        message: 'Remove this testimonial? This can\'t be undone.',
        header: 'Remove testimonial',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.testimonials.destroy', testimonial.id), { preserveScroll: true }),
    });
};

const defaultText = (testimonial, field) => {
    const defaultCode = defaultLangCode.value;
    return testimonial[field]?.[defaultCode] ?? Object.values(testimonial[field] ?? {})[0] ?? '—';
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
    settingsForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.testimonials.settings.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Testimonials">
        <p class="text-sm text-slate-500 mb-6">
            Manage the testimonials shown on the homepage teaser and the public testimonials page, and that page's own heading, breadcrumb, and SEO config.
        </p>

        <Tabs v-model:value="activeMainTab">
            <TabList>
                <Tab value="testimonials">Testimonials</Tab>
                <Tab value="settings">Page Settings</Tab>
            </TabList>
            <TabPanels>
                <!-- Testimonials -->
                <TabPanel value="testimonials">
                    <Card class="shadow-sm">
                        <template #title>
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-lg font-semibold">Testimonials</div>
                                    <p class="text-sm font-normal text-slate-500 mt-1">
                                        Shown on the homepage teaser and the public testimonials page.
                                    </p>
                                </div>
                                <Button label="Add Testimonial" icon="pi pi-plus" @click="openCreate" />
                            </div>
                        </template>
                        <template #content>
                            <div class="overflow-x-auto">
                                <DataTable :value="testimonials" data-key="id" size="small">
                                    <Column header="Order" style="width: 90px">
                                        <template #body="{ data, index }">
                                            <div class="flex items-center gap-1">
                                                <Button icon="pi pi-angle-up" text rounded size="small" :disabled="index === 0" @click="moveUp(data)" />
                                                <Button icon="pi pi-angle-down" text rounded size="small" :disabled="index === testimonials.length - 1" @click="moveDown(data)" />
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="Photo" style="width: 90px">
                                        <template #body="{ data }">
                                            <img :src="data.author_photo_url ?? '/frontend/assets/img/testimonial/01.jpg'" class="w-14 h-14 object-cover bg-slate-100 rounded-full border border-slate-200" alt="" />
                                        </template>
                                    </Column>

                                    <Column header="Testimonial">
                                        <template #body="{ data }">
                                            <div class="font-medium text-slate-800">{{ defaultText(data, 'author_name') }}</div>
                                            <div class="text-xs text-slate-500 mt-1">{{ defaultText(data, 'author_role') }} · {{ data.rating }}/5</div>
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
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Homepage section heading</h3>
                                    <div class="flex flex-col gap-4 max-w-lg">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                            <InputText v-model="settingsForm.section_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Testimonials" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.section_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. What Our Students Say's" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlighted word</label>
                                            <InputText v-model="settingsForm.section_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Say's" />
                                            <p class="text-xs text-slate-400 mt-1">The word within Title to show in orange — must match exactly.</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                            <Textarea v-model="settingsForm.section_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                        </div>
                                    </div>
                                </section>

                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Breadcrumb</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.breadcrumb_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Testimonials" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Background image</label>
                                            <ImageDropzone
                                                :preview-url="breadcrumbImagePreview"
                                                hint="Shown behind the page title on the testimonials page"
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

        <Dialog v-model:visible="showDialog" modal :header="editing ? 'Edit testimonial' : 'Add testimonial'" class="w-full max-w-2xl">
            <div class="flex flex-col gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Photo</label>
                    <ImageDropzone
                        :preview-url="photoPreview"
                        hint="Optional"
                        width-class="w-full" height-class="h-28"
                        @select="onPhotoSelected"
                        @remove="onPhotoRemoved"
                    />
                    <p v-if="itemForm.errors.author_photo" class="text-xs text-red-500 mt-1">{{ itemForm.errors.author_photo }}</p>
                </div>

                <Tabs v-model:value="activeItemLang">
                    <TabList>
                        <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                    </TabList>
                    <TabPanels>
                        <TabPanel v-for="lang in languages" :key="lang.code" :value="lang.code">
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1">
                                        Quote {{ lang.is_default ? '(required)' : '' }}
                                    </label>
                                    <Textarea v-model="itemForm.quote[lang.code]" :dir="lang.direction" rows="3" class="w-full" />
                                    <p v-if="itemForm.errors[`quote.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ itemForm.errors[`quote.${lang.code}`] }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">
                                            Author name {{ lang.is_default ? '(required)' : '' }}
                                        </label>
                                        <InputText v-model="itemForm.author_name[lang.code]" :dir="lang.direction" class="w-full" />
                                        <p v-if="itemForm.errors[`author_name.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ itemForm.errors[`author_name.${lang.code}`] }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">Author role</label>
                                        <InputText v-model="itemForm.author_role[lang.code]" :dir="lang.direction" class="w-full" placeholder="e.g. Student" />
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                    </TabPanels>
                </Tabs>

                <div class="max-w-[140px]">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Rating</label>
                    <InputNumber v-model="itemForm.rating" class="w-full" input-class="w-full" :min="1" :max="5" />
                    <p v-if="itemForm.errors.rating" class="text-xs text-red-500 mt-1">{{ itemForm.errors.rating }}</p>
                </div>
            </div>

            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showDialog = false" />
                <Button label="Save" :loading="itemForm.processing" @click="submitItem" />
            </template>
        </Dialog>
    </AdminLayout>
</template>
