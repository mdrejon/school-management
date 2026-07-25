<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Editor from 'primevue/editor';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    facility: {
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

const imagePreview = ref(props.facility?.image_url ?? null);
const galleryImage1Preview = ref(props.facility?.gallery_image_1_url ?? null);
const galleryImage2Preview = ref(props.facility?.gallery_image_2_url ?? null);

const form = useForm({
    slug: props.facility?.slug ?? '',
    image: null,
    title: { ...emptyTranslatable(), ...props.facility?.title },
    short_description: { ...emptyTranslatable(), ...props.facility?.short_description },
    description: { ...emptyTranslatable(), ...props.facility?.description },
    gallery_image_1: null,
    gallery_image_2: null,
    is_active: props.facility?.is_active ?? true,
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

const submit = () => {
    if (!imagePreview.value) {
        form.setError('image', 'Please add an image before saving.');
        return;
    }

    if (props.facility) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.facilities.update', props.facility.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.cms.facilities.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="facility ? 'Edit Facility' : 'Add Facility'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ facility ? 'Update this facility.' : 'Add a new facility shown on the public facilities pages.' }}
            </p>
            <Link :href="route('admin.cms.facilities.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to facilities</Link>
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
                                    hint="Card image shown on the facilities list"
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
                                    <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Library Facility" />
                                    <p v-if="form.errors[`title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Slug (URL)</label>
                                    <InputText v-model="form.slug" class="w-full" placeholder="auto-generated from title if left blank" />
                                    <p v-if="form.errors.slug" class="text-xs text-red-500 mt-1">{{ form.errors.slug }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Short description</label>
                            <Textarea v-model="form.short_description[activeLang]" :dir="currentLang?.direction" rows="2" class="w-full" />
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

                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="form.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-200 flex justify-end gap-2">
                    <Link :href="route('admin.cms.facilities.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
