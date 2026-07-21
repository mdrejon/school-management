<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import IconPicker from '@/Components/Admin/IconPicker.vue';
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
    department: {
        type: Object,
        default: null,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));
const defaultIcon = () => ({ source: 'lucide', value: 'graduation-cap' });

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));

const normalizeRequirementItems = (items) => (items ?? []).map((item) => ({ text: { ...emptyTranslatable(), ...item.text } }));
const normalizeDownloads = (items) =>
    (items ?? []).map((item) => ({
        label: { ...emptyTranslatable(), ...item.label },
        file: item.file ?? null,
    }));

const imagePreview = ref(props.department?.image_url ?? null);
const galleryImage1Preview = ref(props.department?.gallery_image_1_url ?? null);
const galleryImage2Preview = ref(props.department?.gallery_image_2_url ?? null);

const form = useForm({
    slug: props.department?.slug ?? '',
    icon: props.department?.icon ?? defaultIcon(),
    title: { ...emptyTranslatable(), ...props.department?.title },
    short_description: { ...emptyTranslatable(), ...props.department?.short_description },
    image: null,
    description: { ...emptyTranslatable(), ...props.department?.description },
    gallery_image_1: null,
    gallery_image_2: null,
    requirement_title: { ...emptyTranslatable(), ...props.department?.requirement_title },
    requirement_items: normalizeRequirementItems(props.department?.requirement_items),
    downloads: normalizeDownloads(props.department?.downloads),
    is_active: props.department?.is_active ?? true,
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

const addRequirementItem = () => {
    form.requirement_items.push({ text: emptyTranslatable() });
};
const removeRequirementItem = (index) => {
    form.requirement_items.splice(index, 1);
};

const addDownload = () => {
    form.downloads.push({ label: emptyTranslatable(), file: null });
};
const removeDownload = (index) => {
    form.downloads.splice(index, 1);
};
const onDownloadFileSelected = (index, event) => {
    const file = event.target.files?.[0];
    if (file) {
        form.downloads[index].file = file;
    }
};
const downloadFileName = (item) => {
    if (item.file instanceof File) {
        return item.file.name;
    }
    if (typeof item.file === 'string' && item.file) {
        return item.file.split('/').pop();
    }
    return null;
};

const submit = () => {
    if (props.department) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.departments.update', props.department.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.cms.departments.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="department ? 'Edit Department' : 'Add Department'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ department ? 'Update this department.' : 'Add a new department shown on the homepage teaser and the public departments pages.' }}
            </p>
            <Link :href="route('admin.cms.departments.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to departments</Link>
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
                        <div class="grid grid-cols-1 sm:grid-cols-[auto_1fr] gap-6 mb-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Icon</label>
                                <IconPicker v-model="form.icon" />
                                <p v-if="form.errors['icon.value']" class="text-xs text-red-500 mt-1">{{ form.errors['icon.value'] }}</p>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">
                                        Title {{ currentLang?.is_default ? '(required)' : '' }}
                                    </label>
                                    <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Business And Finance" />
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
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Main image</label>
                            <ImageDropzone
                                :preview-url="imagePreview"
                                hint="Shown at the top of the department detail page"
                                width-class="w-full" height-class="h-32"
                                @select="onImageSelected"
                                @remove="onImageRemoved"
                            />
                            <p v-if="form.errors.image" class="text-xs text-red-500 mt-1">{{ form.errors.image }}</p>
                        </div>
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
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Requirements</h3>
                        <div class="mb-3">
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Block title</label>
                            <InputText v-model="form.requirement_title[activeLang]" :dir="currentLang?.direction" class="w-full max-w-sm" placeholder="How To Prepare For The Exam" />
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
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-semibold text-slate-800">Downloads</h3>
                            <Button label="Add file" icon="pi pi-plus" text size="small" @click="addDownload" />
                        </div>
                        <p v-if="!form.downloads.length" class="text-sm text-slate-400">No files yet — add one above.</p>
                        <div v-else class="flex flex-col gap-3">
                            <div
                                v-for="(item, index) in form.downloads"
                                :key="index"
                                class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3 sm:items-start rounded-lg border border-slate-100 p-3"
                            >
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Label</label>
                                    <InputText
                                        v-model="item.label[activeLang]"
                                        :dir="currentLang?.direction"
                                        class="w-full"
                                        :placeholder="currentLang?.is_default ? 'Required, e.g. Syllabus PDF' : 'Optional'"
                                    />
                                    <p v-if="form.errors[`downloads.${index}.label.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`downloads.${index}.label.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">File</label>
                                    <input type="file" class="w-full text-sm" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip" @change="(e) => onDownloadFileSelected(index, e)" />
                                    <p v-if="downloadFileName(item)" class="text-xs text-slate-500 mt-1">Current: {{ downloadFileName(item) }}</p>
                                    <p v-if="form.errors[`downloads.${index}.file`]" class="text-xs text-red-500 mt-1">{{ form.errors[`downloads.${index}.file`] }}</p>
                                </div>
                                <div class="flex sm:justify-end sm:pt-6">
                                    <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeDownload(index)" />
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
                    <Link :href="route('admin.cms.departments.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
