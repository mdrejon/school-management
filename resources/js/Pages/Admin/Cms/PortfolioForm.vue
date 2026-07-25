<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import Editor from 'primevue/editor';
import DatePicker from 'primevue/datepicker';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    portfolio: {
        type: Object,
        default: null,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));

const normalizeHighlightItems = (items) => (items ?? []).map((item) => ({ text: { ...emptyTranslatable(), ...item.text } }));

const imagePreview = ref(props.portfolio?.image_url ?? null);
const galleryImage1Preview = ref(props.portfolio?.gallery_image_1_url ?? null);
const galleryImage2Preview = ref(props.portfolio?.gallery_image_2_url ?? null);

const form = useForm({
    slug: props.portfolio?.slug ?? '',
    image: null,
    title: { ...emptyTranslatable(), ...props.portfolio?.title },
    category: { ...emptyTranslatable(), ...props.portfolio?.category },
    description: { ...emptyTranslatable(), ...props.portfolio?.description },
    gallery_image_1: null,
    gallery_image_2: null,
    highlight_title: { ...emptyTranslatable(), ...props.portfolio?.highlight_title },
    highlight_items: normalizeHighlightItems(props.portfolio?.highlight_items),
    overview_title: { ...emptyTranslatable(), ...props.portfolio?.overview_title },
    overview_description: { ...emptyTranslatable(), ...props.portfolio?.overview_description },
    client_name: props.portfolio?.client_name ?? '',
    event_date: props.portfolio?.event_date ? new Date(props.portfolio.event_date) : null,
    cost: props.portfolio?.cost ?? '',
    manager_name: props.portfolio?.manager_name ?? '',
    location: props.portfolio?.location ?? '',
    website_url: props.portfolio?.website_url ?? '',
    rating: props.portfolio?.rating ?? null,
    is_active: props.portfolio?.is_active ?? true,
});

const onImageSelected = (file) => {
    form.image = file;
    form.clearErrors('image');
    imagePreview.value = URL.createObjectURL(file);
};
const onImageRemoved = () => {
    form.image = null;
    imagePreview.value = null;
};

const onGalleryImage1Selected = (file) => {
    form.gallery_image_1 = file;
    form.clearErrors('gallery_image_1');
    galleryImage1Preview.value = URL.createObjectURL(file);
};
const onGalleryImage1Removed = () => {
    form.gallery_image_1 = null;
    galleryImage1Preview.value = null;
};

const onGalleryImage2Selected = (file) => {
    form.gallery_image_2 = file;
    form.clearErrors('gallery_image_2');
    galleryImage2Preview.value = URL.createObjectURL(file);
};
const onGalleryImage2Removed = () => {
    form.gallery_image_2 = null;
    galleryImage2Preview.value = null;
};

const addHighlightItem = () => {
    form.highlight_items.push({ text: emptyTranslatable() });
};
const removeHighlightItem = (index) => {
    form.highlight_items.splice(index, 1);
};

const submit = () => {
    if (!imagePreview.value) {
        form.setError('image', 'Please add an image before saving.');
        return;
    }

    const transform = (data) => ({
        ...data,
        event_date: data.event_date ? new Date(data.event_date).toISOString().slice(0, 10) : null,
    });

    if (props.portfolio) {
        form.transform((data) => ({ ...transform(data), _method: 'put' })).post(route('admin.cms.portfolios.update', props.portfolio.id), {
            forceFormData: true,
        });
    } else {
        form.transform(transform).post(route('admin.cms.portfolios.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="portfolio ? 'Edit Portfolio Item' : 'Add Portfolio Item'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ portfolio ? 'Update this portfolio item.' : 'Add a new portfolio item shown on the public portfolio pages.' }}
            </p>
            <Link :href="route('admin.cms.portfolios.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to portfolio</Link>
        </div>

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
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Basic info</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Image</label>
                                <ImageDropzone
                                    :preview-url="imagePreview"
                                    hint="Card image shown on the portfolio list"
                                    width-class="w-full" height-class="h-32"
                                    @select="onImageSelected"
                                    @remove="onImageRemoved"
                                />
                                <p v-if="form.errors.image" class="text-xs text-red-500 mt-1">{{ form.errors.image }}</p>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">
                                        Title {{ currentLang?.is_default ? '(required)' : '' }}
                                    </label>
                                    <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Student Health Care" />
                                    <p v-if="form.errors[`title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Category</label>
                                    <InputText v-model="form.category[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Health" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Slug (URL)</label>
                                    <InputText v-model="form.slug" class="w-full" placeholder="auto-generated from title if left blank" />
                                    <p v-if="form.errors.slug" class="text-xs text-red-500 mt-1">{{ form.errors.slug }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Detail page content</h3>
                        <div class="mb-4">
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">
                                Description {{ currentLang?.is_default ? '(required)' : '' }}
                            </label>
                            <Editor v-model="form.description[activeLang]" :editor-style="`height: 260px; direction: ${currentLang?.direction ?? 'ltr'};`" />
                            <p v-if="form.errors[`description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`description.${activeLang}`] }}</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Gallery image 1</label>
                                <ImageDropzone
                                    :preview-url="galleryImage1Preview"
                                    hint="Optional"
                                    width-class="w-full" height-class="h-28"
                                    @select="onGalleryImage1Selected"
                                    @remove="onGalleryImage1Removed"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Gallery image 2</label>
                                <ImageDropzone
                                    :preview-url="galleryImage2Preview"
                                    hint="Optional"
                                    width-class="w-full" height-class="h-28"
                                    @select="onGalleryImage2Selected"
                                    @remove="onGalleryImage2Removed"
                                />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Highlights</h3>
                        <div class="mb-3">
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Block title</label>
                            <InputText v-model="form.highlight_title[activeLang]" :dir="currentLang?.direction" class="w-full max-w-sm" placeholder="e.g. Health Care Tips" />
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-slate-600">Bullet points</span>
                            <Button label="Add item" icon="pi pi-plus" text size="small" @click="addHighlightItem" />
                        </div>
                        <p v-if="!form.highlight_items.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                        <div v-else class="flex flex-col gap-2">
                            <div v-for="(item, index) in form.highlight_items" :key="index" class="flex items-start gap-2">
                                <InputText v-model="item.text[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeHighlightItem(index)" />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Overview</h3>
                        <div class="flex flex-col gap-3 max-w-lg">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Block title</label>
                                <InputText v-model="form.overview_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Overview And Challenge" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                <Textarea v-model="form.overview_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Sidebar details</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Client name</label>
                                <InputText v-model="form.client_name" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Date</label>
                                <DatePicker v-model="form.event_date" date-format="yy-mm-dd" show-icon icon-display="input" class="w-full" input-class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Total cost</label>
                                <InputText v-model="form.cost" class="w-full" placeholder="e.g. $1250.00" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Manager name</label>
                                <InputText v-model="form.manager_name" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Location</label>
                                <InputText v-model="form.location" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Website</label>
                                <InputText v-model="form.website_url" class="w-full" placeholder="example.com" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Rating</label>
                                <InputNumber v-model="form.rating" class="w-full" input-class="w-full" :min="0" :max="5" />
                            </div>
                        </div>
                    </section>

                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="form.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-200 flex justify-end gap-2">
                    <Link :href="route('admin.cms.portfolios.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
