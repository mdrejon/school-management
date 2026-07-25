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
import DatePicker from 'primevue/datepicker';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    post: {
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

const normalizeTags = (items) => (items ?? []).map((item) => ({ tag: { ...emptyTranslatable(), ...item.tag } }));

const imagePreview = ref(props.post?.image_url ?? null);
const authorPhotoPreview = ref(props.post?.author_photo_url ?? null);
const galleryImage1Preview = ref(props.post?.gallery_image_1_url ?? null);
const galleryImage2Preview = ref(props.post?.gallery_image_2_url ?? null);

const form = useForm({
    slug: props.post?.slug ?? '',
    image: null,
    title: { ...emptyTranslatable(), ...props.post?.title },
    short_description: { ...emptyTranslatable(), ...props.post?.short_description },
    published_at: props.post?.published_at ? new Date(props.post.published_at) : new Date(),
    author_name: { ...emptyTranslatable(), ...props.post?.author_name },
    author_photo: null,
    author_bio: { ...emptyTranslatable(), ...props.post?.author_bio },
    description: { ...emptyTranslatable(), ...props.post?.description },
    gallery_image_1: null,
    gallery_image_2: null,
    tags: normalizeTags(props.post?.tags),
    is_active: props.post?.is_active ?? true,
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

const onAuthorPhotoSelected = (file) => {
    form.author_photo = file;
    form.clearErrors('author_photo');
    authorPhotoPreview.value = URL.createObjectURL(file);
};
const onAuthorPhotoRemoved = () => {
    form.author_photo = null;
    authorPhotoPreview.value = null;
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

const addTag = () => {
    form.tags.push({ tag: emptyTranslatable() });
};
const removeTag = (index) => {
    form.tags.splice(index, 1);
};

const submit = () => {
    if (!imagePreview.value) {
        form.setError('image', 'Please add an image before saving.');
        return;
    }

    const transform = (data) => ({
        ...data,
        published_at: data.published_at ? new Date(data.published_at).toISOString().slice(0, 10) : null,
    });

    if (props.post) {
        form.transform((data) => ({ ...transform(data), _method: 'put' })).post(route('admin.cms.blog.update', props.post.id), {
            forceFormData: true,
        });
    } else {
        form.transform(transform).post(route('admin.cms.blog.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="post ? 'Edit Post' : 'Add Post'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ post ? 'Update this post.' : 'Add a new post shown on the homepage teaser and the public blog pages.' }}
            </p>
            <Link :href="route('admin.cms.blog.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to blog</Link>
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
                                    hint="Card image shown on the homepage and blog list"
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
                                    <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                    <p v-if="form.errors[`title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Publish date (required)</label>
                                    <DatePicker v-model="form.published_at" date-format="yy-mm-dd" show-icon icon-display="input" class="w-full" input-class="w-full" />
                                    <p v-if="form.errors.published_at" class="text-xs text-red-500 mt-1">{{ form.errors.published_at }}</p>
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
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Author</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Photo</label>
                                <ImageDropzone
                                    :preview-url="authorPhotoPreview"
                                    hint="Optional"
                                    width-class="w-full" height-class="h-28"
                                    @select="onAuthorPhotoSelected"
                                    @remove="onAuthorPhotoRemoved"
                                />
                            </div>
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Name</label>
                                    <InputText v-model="form.author_name[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Bio</label>
                                    <Textarea v-model="form.author_bio[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
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
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-semibold text-slate-800">Tags</h3>
                            <Button label="Add tag" icon="pi pi-plus" text size="small" @click="addTag" />
                        </div>
                        <p v-if="!form.tags.length" class="text-sm text-slate-400">No tags yet — add one above.</p>
                        <div v-else class="flex flex-col gap-2">
                            <div v-for="(item, index) in form.tags" :key="index" class="flex items-start gap-2">
                                <InputText v-model="item.tag[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Students" />
                                <Button icon="pi pi-trash" text severity="danger" aria-label="Remove tag" @click="removeTag(index)" />
                            </div>
                        </div>
                    </section>

                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="form.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-200 flex justify-end gap-2">
                    <Link :href="route('admin.cms.blog.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
