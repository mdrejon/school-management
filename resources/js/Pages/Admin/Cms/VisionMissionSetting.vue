<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    pageSettings: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));

// Image previews
const image1Preview = ref(props.pageSettings.image_1_url);
const missionImage1Preview = ref(props.pageSettings.mission_image_1_url);
const valuesImage1Preview = ref(props.pageSettings.values_image_1_url);
const breadcrumbImagePreview = ref(props.pageSettings.breadcrumb_image_url);

const form = useForm({
    // Vision
    tagline: { ...emptyTranslatable(), ...props.pageSettings.tagline },
    title: { ...emptyTranslatable(), ...props.pageSettings.title },
    highlight: { ...emptyTranslatable(), ...props.pageSettings.highlight },
    description: { ...emptyTranslatable(), ...props.pageSettings.description },
    image_1: null,

    // Mission
    mission_tagline: { ...emptyTranslatable(), ...props.pageSettings.mission_tagline },
    mission_title: { ...emptyTranslatable(), ...props.pageSettings.mission_title },
    mission_highlight: { ...emptyTranslatable(), ...props.pageSettings.mission_highlight },
    mission_description: { ...emptyTranslatable(), ...props.pageSettings.mission_description },
    mission_image_1: null,

    // Values
    values_tagline: { ...emptyTranslatable(), ...props.pageSettings.values_tagline },
    values_title: { ...emptyTranslatable(), ...props.pageSettings.values_title },
    values_highlight: { ...emptyTranslatable(), ...props.pageSettings.values_highlight },
    values_description: { ...emptyTranslatable(), ...props.pageSettings.values_description },
    values_image_1: null,

    // Breadcrumb & SEO
    breadcrumb_title: { ...emptyTranslatable(), ...props.pageSettings.breadcrumb_title },
    breadcrumb_image: null,
    seo_title: { ...emptyTranslatable(), ...props.pageSettings.seo_title },
    seo_description: { ...emptyTranslatable(), ...props.pageSettings.seo_description },
    seo_keywords: { ...emptyTranslatable(), ...props.pageSettings.seo_keywords },
});

const onImageSelected = (file, field, previewRef) => {
    form[field] = file;
    form.clearErrors(field);
    previewRef.value = URL.createObjectURL(file);
};

const onImageRemoved = (field, previewRef) => {
    form[field] = null;
    previewRef.value = null;
};

const submit = () => {
    form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.vision-mission.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Vision & Mission Settings">
        <p class="text-sm text-slate-500 mb-6">
            Manage content, single photo, and SEO for the 3 sections (Vision, Mission, Core Values) on the /mission-vision page.
        </p>

        <Card class="shadow-sm">
            <template #content>
                <!-- Language Switcher Tabs -->
                <div class="mb-6 pb-5 border-b border-slate-100">
                    <Tabs v-model:value="activeLang">
                        <TabList>
                            <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                        </TabList>
                    </Tabs>
                </div>

                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <!-- SECTION 1: VISION -->
                    <section class="rounded-xl border border-slate-200 p-5 flex flex-col gap-5">
                        <h3 class="text-sm font-semibold text-slate-800 border-b border-slate-100 pb-2">1. Our Vision Section</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                    <InputText v-model="form.tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Our Vision" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlight Word(s)</label>
                                    <InputText v-model="form.highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Brighter Future" />
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Main Heading (Title)</label>
                                    <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Shaping A Brighter Future For Every Student." />
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description Text</label>
                                    <Textarea v-model="form.description[activeLang]" :dir="currentLang?.direction" rows="4" class="w-full" placeholder="Vision description..." />
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Vision Photo</label>
                                <ImageDropzone
                                    :preview-url="image1Preview"
                                    hint="Recommended: 800x600 (Single photo with clean box shadow)"
                                    width-class="w-full" height-class="h-44"
                                    @select="(f) => onImageSelected(f, 'image_1', image1Preview)"
                                    @remove="() => onImageRemoved('image_1', image1Preview)"
                                />
                                <p v-if="form.errors.image_1" class="text-xs text-red-500 mt-1">{{ form.errors.image_1 }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- SECTION 2: MISSION -->
                    <section class="rounded-xl border border-slate-200 p-5 flex flex-col gap-5">
                        <h3 class="text-sm font-semibold text-slate-800 border-b border-slate-100 pb-2">2. Our Mission Section</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                    <InputText v-model="form.mission_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Our Mission" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlight Word(s)</label>
                                    <InputText v-model="form.mission_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Empowering Students" />
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Main Heading (Title)</label>
                                    <InputText v-model="form.mission_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Empowering Students To Achieve Excellence." />
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description Text</label>
                                    <Textarea v-model="form.mission_description[activeLang]" :dir="currentLang?.direction" rows="4" class="w-full" placeholder="Mission description..." />
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Mission Photo</label>
                                <ImageDropzone
                                    :preview-url="missionImage1Preview"
                                    hint="Recommended: 800x600 (Single photo with clean box shadow)"
                                    width-class="w-full" height-class="h-44"
                                    @select="(f) => onImageSelected(f, 'mission_image_1', missionImage1Preview)"
                                    @remove="() => onImageRemoved('mission_image_1', missionImage1Preview)"
                                />
                                <p v-if="form.errors.mission_image_1" class="text-xs text-red-500 mt-1">{{ form.errors.mission_image_1 }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- SECTION 3: CORE VALUES -->
                    <section class="rounded-xl border border-slate-200 p-5 flex flex-col gap-5">
                        <h3 class="text-sm font-semibold text-slate-800 border-b border-slate-100 pb-2">3. Our Core Values Section</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                    <InputText v-model="form.values_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Our Values" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlight Word(s)</label>
                                    <InputText v-model="form.values_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Core Values" />
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Main Heading (Title)</label>
                                    <InputText v-model="form.values_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Guiding Principles That Drive Our Institution." />
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description Text</label>
                                    <Textarea v-model="form.values_description[activeLang]" :dir="currentLang?.direction" rows="4" class="w-full" placeholder="Values description..." />
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Core Values Photo</label>
                                <ImageDropzone
                                    :preview-url="valuesImage1Preview"
                                    hint="Recommended: 800x600 (Single photo with clean box shadow)"
                                    width-class="w-full" height-class="h-44"
                                    @select="(f) => onImageSelected(f, 'values_image_1', valuesImage1Preview)"
                                    @remove="() => onImageRemoved('values_image_1', valuesImage1Preview)"
                                />
                                <p v-if="form.errors.values_image_1" class="text-xs text-red-500 mt-1">{{ form.errors.values_image_1 }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- BREADCRUMB & SEO -->
                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Breadcrumb & SEO</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Breadcrumb Title</label>
                                <InputText v-model="form.breadcrumb_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Vision & Mission" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Breadcrumb Background Image</label>
                                <ImageDropzone
                                    :preview-url="breadcrumbImagePreview"
                                    hint="Recommended: 1920x400"
                                    width-class="w-full" height-class="h-32"
                                    @select="(f) => onImageSelected(f, 'breadcrumb_image', breadcrumbImagePreview)"
                                    @remove="() => onImageRemoved('breadcrumb_image', breadcrumbImagePreview)"
                                />
                                <p v-if="form.errors.breadcrumb_image" class="text-xs text-red-500 mt-1">{{ form.errors.breadcrumb_image }}</p>
                            </div>
                            <div class="sm:col-span-2 max-w-lg">
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">SEO Title</label>
                                <InputText v-model="form.seo_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Vision & Mission | School Name" />
                            </div>
                            <div class="sm:col-span-2 max-w-lg">
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">SEO Description</label>
                                <Textarea v-model="form.seo_description[activeLang]" :dir="currentLang?.direction" rows="2" class="w-full" placeholder="Brief search engine description..." />
                            </div>
                        </div>
                    </section>

                    <div class="flex justify-end">
                        <Button type="submit" label="Save Settings" icon="pi pi-check" :loading="form.processing" />
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
