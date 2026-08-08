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
const breadcrumbImagePreview = ref(props.pageSettings.breadcrumb_image_url);

const form = useForm({
    tagline: { ...emptyTranslatable(), ...props.pageSettings.tagline },
    title: { ...emptyTranslatable(), ...props.pageSettings.title },
    highlight: { ...emptyTranslatable(), ...props.pageSettings.highlight },
    description: { ...emptyTranslatable(), ...props.pageSettings.description },
    breadcrumb_title: { ...emptyTranslatable(), ...props.pageSettings.breadcrumb_title },
    breadcrumb_image: null,
    seo_title: { ...emptyTranslatable(), ...props.pageSettings.seo_title },
    seo_description: { ...emptyTranslatable(), ...props.pageSettings.seo_description },
    seo_keywords: { ...emptyTranslatable(), ...props.pageSettings.seo_keywords },
});

const onBreadcrumbImageSelected = (file) => {
    form.breadcrumb_image = file;
    form.clearErrors('breadcrumb_image');
    breadcrumbImagePreview.value = URL.createObjectURL(file);
};

const onBreadcrumbImageRemoved = () => {
    form.breadcrumb_image = null;
    breadcrumbImagePreview.value = null;
};

const submit = () => {
    form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.campus-tour.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Campus Tour Settings">
        <p class="text-sm text-slate-500 mb-6">
            Manage section heading, tagline, intro text, and SEO for the /campus-tour page (Gallery photos are managed under Website CMS → Gallery).
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
                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Campus Tour Header Content</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                <InputText v-model="form.tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Campus Tour" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlight Word(s)</label>
                                <InputText v-model="form.highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Campus" />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Main Title</label>
                                <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Take A Look At Our Campus" />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Intro Description</label>
                                <Textarea v-model="form.description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" placeholder="Explore our state-of-the-art campus facilities..." />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Breadcrumb & SEO</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Breadcrumb Title</label>
                                <InputText v-model="form.breadcrumb_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Campus Tour" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Breadcrumb Background Image</label>
                                <ImageDropzone
                                    :preview-url="breadcrumbImagePreview"
                                    hint="Recommended: 1920x400"
                                    width-class="w-full" height-class="h-32"
                                    @select="onBreadcrumbImageSelected"
                                    @remove="onBreadcrumbImageRemoved"
                                />
                            </div>
                            <div class="sm:col-span-2 max-w-lg">
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">SEO Title</label>
                                <InputText v-model="form.seo_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Campus Tour | School Name" />
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
