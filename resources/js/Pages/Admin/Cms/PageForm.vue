<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

const props = defineProps({
    page: {
        type: Object,
        default: null,
    },
});

const pageProps = usePage();
const languages = computed(() => pageProps.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);
const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));
const activeMainTab = ref('seo');

const breadcrumbPreview = ref(props.page?.breadcrumb_image_url ?? null);

const form = useForm({
    slug: props.page?.slug ?? '',
    title: { ...emptyTranslatable(), ...props.page?.title },
    breadcrumb_image: null,
    seo_title: { ...emptyTranslatable(), ...props.page?.seo_title },
    seo_description: { ...emptyTranslatable(), ...props.page?.seo_description },
    seo_keywords: { ...emptyTranslatable(), ...props.page?.seo_keywords },
    custom_css: props.page?.custom_css ?? '',
    is_active: props.page?.is_active ?? true,
});

const onBreadcrumbSelected = (file) => {
    form.breadcrumb_image = file;
    form.clearErrors('breadcrumb_image');
    breadcrumbPreview.value = URL.createObjectURL(file);
};
const onBreadcrumbRemoved = () => {
    form.breadcrumb_image = null;
    breadcrumbPreview.value = null;
};

const submit = () => {
    const options = { forceFormData: true, preserveScroll: true };

    if (props.page) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.pages.update', props.page.id), options);
    } else {
        form.post(route('admin.cms.pages.store'), options);
    }
};
</script>

<template>
    <AdminLayout :title="page ? 'Edit Page' : 'Add Page'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ page ? 'Update this page\'s title, SEO, and breadcrumb.' : 'Start by naming the page — you\'ll build its content visually right after saving.' }}
            </p>
            <Link :href="route('admin.cms.pages.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to pages</Link>
        </div>

        <Card v-if="page" class="shadow-sm mb-4 border-l-4 border-l-indigo-400">
            <template #content>
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Page content</p>
                        <p class="text-xs text-slate-500">Build and edit this page's body visually — drag-and-drop blocks, edit text in place.</p>
                    </div>
                    <a :href="route('admin.cms.pages.builder.edit', page.id)" target="_blank">
                        <Button label="Open Visual Builder" icon="pi pi-external-link" iconPos="right" as="span" />
                    </a>
                </div>
            </template>
        </Card>

        <Card class="shadow-sm mb-4">
            <template #content>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">
                            Title {{ currentLang?.is_default ? '(required)' : '' }}
                        </label>
                        <Tabs v-model:value="activeLang" class="mb-2">
                            <TabList>
                                <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                            </TabList>
                        </Tabs>
                        <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. About Us" />
                        <p v-if="form.errors[`title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${activeLang}`] }}</p>
                    </div>
                    <div class="flex flex-col gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Slug (URL)</label>
                            <InputText v-model="form.slug" class="w-full" placeholder="auto-generated from title if left blank" />
                            <p v-if="form.errors.slug" class="text-xs text-red-500 mt-1">{{ form.errors.slug }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <ToggleSwitch v-model="form.is_active" />
                            <span class="text-sm text-slate-600">Active</span>
                        </div>
                    </div>
                </div>
            </template>
        </Card>

        <Tabs v-model:value="activeMainTab" class="mb-4">
            <TabList>
                <Tab value="seo">SEO &amp; Breadcrumb</Tab>
                <Tab value="css">Custom CSS</Tab>
            </TabList>
            <TabPanels>
                <!-- SEO & breadcrumb -->
                <TabPanel value="seo">
                    <Card class="shadow-sm">
                        <template #content>
                            <div class="mb-5 pb-5 border-b border-slate-100">
                                <Tabs v-model:value="activeLang">
                                    <TabList>
                                        <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                                    </TabList>
                                </Tabs>
                            </div>

                            <div class="flex flex-col gap-5">
                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Breadcrumb</h3>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Background image</label>
                                    <ImageDropzone
                                        :preview-url="breadcrumbPreview"
                                        hint="Shown behind the page title"
                                        width-class="w-full sm:w-80" height-class="h-32"
                                        @select="onBreadcrumbSelected"
                                        @remove="onBreadcrumbRemoved"
                                    />
                                    <p v-if="form.errors.breadcrumb_image" class="text-xs text-red-500 mt-1">{{ form.errors.breadcrumb_image }}</p>
                                </section>

                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">SEO</h3>
                                    <div class="flex flex-col gap-4 max-w-lg">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta title</label>
                                            <InputText v-model="form.seo_title[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta description</label>
                                            <Textarea v-model="form.seo_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta keywords</label>
                                            <InputText v-model="form.seo_keywords[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="comma, separated, keywords" />
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </template>
                    </Card>
                </TabPanel>

                <!-- Custom CSS -->
                <TabPanel value="css">
                    <Card class="shadow-sm">
                        <template #content>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Custom CSS for this page</label>
                            <Textarea v-model="form.custom_css" rows="14" class="w-full font-mono text-sm" placeholder=".my-class { color: #222; }" />
                            <p v-if="form.errors.custom_css" class="text-xs text-red-500 mt-1">{{ form.errors.custom_css }}</p>
                        </template>
                    </Card>
                </TabPanel>
            </TabPanels>
        </Tabs>

        <div class="mt-6 pt-5 border-t border-slate-200 flex justify-end gap-2">
            <Link :href="route('admin.cms.pages.index')" class="inline-flex">
                <Button label="Cancel" text severity="secondary" />
            </Link>
            <Button :label="page ? 'Save Page' : 'Save & Build Content'" icon="pi pi-check" :loading="form.processing" @click="submit" />
        </div>
    </AdminLayout>
</template>
