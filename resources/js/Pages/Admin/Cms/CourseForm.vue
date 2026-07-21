<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import IconPicker from '@/Components/Admin/IconPicker.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import Editor from 'primevue/editor';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    course: {
        type: Object,
        default: null,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));
const defaultIcon = () => ({ source: 'lucide', value: 'circle' });

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));

const normalizeRequirementItems = (items) => (items ?? []).map((item) => ({ text: { ...emptyTranslatable(), ...item.text } }));
const normalizeFeatures = (items) =>
    (items ?? []).map((item) => ({
        icon: item.icon ?? defaultIcon(),
        label: { ...emptyTranslatable(), ...item.label },
        value: { ...emptyTranslatable(), ...item.value },
    }));

const thumbnailPreview = ref(props.course?.thumbnail_url ?? null);
const galleryImage1Preview = ref(props.course?.gallery_image_1_url ?? null);
const galleryImage2Preview = ref(props.course?.gallery_image_2_url ?? null);
const instructorImagePreview = ref(props.course?.instructor_image_url ?? null);

const form = useForm({
    slug: props.course?.slug ?? '',
    thumbnail: null,
    title: { ...emptyTranslatable(), ...props.course?.title },
    category: { ...emptyTranslatable(), ...props.course?.category },
    short_description: { ...emptyTranslatable(), ...props.course?.short_description },
    lessons_count: props.course?.lessons_count ?? null,
    rating: props.course?.rating ?? null,
    seats: props.course?.seats ?? null,
    duration: { ...emptyTranslatable(), ...props.course?.duration },
    price: props.course?.price ?? '',
    description: { ...emptyTranslatable(), ...props.course?.description },
    gallery_image_1: null,
    gallery_image_2: null,
    instructor_name: { ...emptyTranslatable(), ...props.course?.instructor_name },
    instructor_image: null,
    enrolled_text: { ...emptyTranslatable(), ...props.course?.enrolled_text },
    requirement_title: { ...emptyTranslatable(), ...props.course?.requirement_title },
    requirement_items: normalizeRequirementItems(props.course?.requirement_items),
    experience_title: { ...emptyTranslatable(), ...props.course?.experience_title },
    experience_description: { ...emptyTranslatable(), ...props.course?.experience_description },
    features: normalizeFeatures(props.course?.features),
    is_active: props.course?.is_active ?? true,
});

const onThumbnailSelected = (file) => {
    form.thumbnail = file;
    form.clearErrors('thumbnail');
    thumbnailPreview.value = URL.createObjectURL(file);
};
const onThumbnailRemoved = () => {
    form.thumbnail = null;
    thumbnailPreview.value = null;
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

const onInstructorImageSelected = (file) => {
    form.instructor_image = file;
    form.clearErrors('instructor_image');
    instructorImagePreview.value = URL.createObjectURL(file);
};
const onInstructorImageRemoved = () => {
    form.instructor_image = null;
    instructorImagePreview.value = null;
};

const addRequirementItem = () => {
    form.requirement_items.push({ text: emptyTranslatable() });
};
const removeRequirementItem = (index) => {
    form.requirement_items.splice(index, 1);
};

const addFeature = () => {
    form.features.push({ icon: defaultIcon(), label: emptyTranslatable(), value: emptyTranslatable() });
};
const removeFeature = (index) => {
    form.features.splice(index, 1);
};

const submit = () => {
    if (!thumbnailPreview.value) {
        form.setError('thumbnail', 'Please add a thumbnail before saving.');
        return;
    }

    if (props.course) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.courses.update', props.course.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.cms.courses.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="course ? 'Edit Course' : 'Add Course'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ course ? 'Update this course.' : 'Add a new course shown on the homepage teaser and the public courses pages.' }}
            </p>
            <Link :href="route('admin.cms.courses.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to courses</Link>
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
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Thumbnail</label>
                                <ImageDropzone
                                    :preview-url="thumbnailPreview"
                                    hint="Card image shown on the homepage and courses list"
                                    width-class="w-full" height-class="h-32"
                                    @select="onThumbnailSelected"
                                    @remove="onThumbnailRemoved"
                                />
                                <p v-if="form.errors.thumbnail" class="text-xs text-red-500 mt-1">{{ form.errors.thumbnail }}</p>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">
                                        Title {{ currentLang?.is_default ? '(required)' : '' }}
                                    </label>
                                    <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Acting And Drama" />
                                    <p v-if="form.errors[`title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Category tag</label>
                                    <InputText v-model="form.category[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Drama" />
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
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Card content</h3>
                        <div class="flex flex-col gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Short description</label>
                                <Textarea v-model="form.short_description[activeLang]" :dir="currentLang?.direction" rows="2" class="w-full" />
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Lessons</label>
                                    <InputNumber v-model="form.lessons_count" class="w-full" input-class="w-full" :min="0" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Rating</label>
                                    <InputNumber v-model="form.rating" class="w-full" input-class="w-full" :min="0" :max="5" :max-fraction-digits="1" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Seats</label>
                                    <InputNumber v-model="form.seats" class="w-full" input-class="w-full" :min="0" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Duration</label>
                                    <InputText v-model="form.duration[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="04 Years" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Price</label>
                                    <InputText v-model="form.price" class="w-full" placeholder="$750" />
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Detail page content</h3>
                        <div class="flex flex-col gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">
                                    Full description {{ currentLang?.is_default ? '(required)' : '' }}
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
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Instructor photo</label>
                                    <ImageDropzone
                                        :preview-url="instructorImagePreview"
                                        hint="Optional"
                                        width-class="w-full" height-class="h-28"
                                        @select="onInstructorImageSelected"
                                        @remove="onInstructorImageRemoved"
                                    />
                                </div>
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Instructor name</label>
                                        <InputText v-model="form.instructor_name[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Enrolled text</label>
                                        <InputText v-model="form.enrolled_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="50 Students" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Requirements</h3>
                        <div class="mb-3">
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Block title</label>
                            <InputText v-model="form.requirement_title[activeLang]" :dir="currentLang?.direction" class="w-full max-w-sm" placeholder="Course Requirement" />
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-slate-600">Bullet points</span>
                            <Button label="Add item" icon="pi pi-plus" text size="small" @click="addRequirementItem" />
                        </div>
                        <p v-if="!form.requirement_items.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                        <div v-else class="flex flex-col gap-2">
                            <div v-for="(item, index) in form.requirement_items" :key="index" class="flex items-start gap-2">
                                <InputText v-model="item.text[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeRequirementItem(index)" />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Professional experience</h3>
                        <div class="flex flex-col gap-3 max-w-lg">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Block title</label>
                                <InputText v-model="form.experience_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Professional Experience" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                <Textarea v-model="form.experience_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-semibold text-slate-800">Sidebar features</h3>
                            <Button label="Add item" icon="pi pi-plus" text size="small" @click="addFeature" />
                        </div>
                        <p v-if="!form.features.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                        <div v-else class="flex flex-col gap-3">
                            <div
                                v-for="(item, index) in form.features"
                                :key="index"
                                class="grid grid-cols-1 sm:grid-cols-[auto_1fr_1fr_auto] gap-3 sm:items-start rounded-lg border border-slate-100 p-3"
                            >
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Icon</label>
                                    <IconPicker v-model="item.icon" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Label</label>
                                    <InputText v-model="item.label[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Lectures" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Value</label>
                                    <InputText v-model="item.value[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="20" />
                                </div>
                                <div class="flex sm:justify-end sm:pt-6">
                                    <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeFeature(index)" />
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="form.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-200 flex justify-end gap-2">
                    <Link :href="route('admin.cms.courses.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
