<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import DatePicker from 'primevue/datepicker';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    event: {
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

const normalizeContentBlocks = (items) =>
    (items ?? []).map((item) => ({
        title: { ...emptyTranslatable(), ...item.title },
        description: { ...emptyTranslatable(), ...item.description },
    }));

const imagePreview = ref(props.event?.image_url ?? null);
const galleryImage1Preview = ref(props.event?.gallery_image_1_url ?? null);
const galleryImage2Preview = ref(props.event?.gallery_image_2_url ?? null);
const organizerPhotoPreview = ref(props.event?.organizer_photo_url ?? null);

const form = useForm({
    slug: props.event?.slug ?? '',
    image: null,
    title: { ...emptyTranslatable(), ...props.event?.title },
    location: { ...emptyTranslatable(), ...props.event?.location },
    event_date: props.event?.event_date ? new Date(props.event.event_date) : null,
    event_time: props.event?.event_time ?? '',
    short_description: { ...emptyTranslatable(), ...props.event?.short_description },
    content_blocks: normalizeContentBlocks(props.event?.content_blocks),
    gallery_image_1: null,
    gallery_image_2: null,
    map_embed_url: props.event?.map_embed_url ?? '',
    sidebar_intro: { ...emptyTranslatable(), ...props.event?.sidebar_intro },
    cost: props.event?.cost ?? '',
    button_text: { ...emptyTranslatable(), ...props.event?.button_text },
    button_url: props.event?.button_url ?? '',
    organizer_name: { ...emptyTranslatable(), ...props.event?.organizer_name },
    organizer_photo: null,
    organizer_bio: { ...emptyTranslatable(), ...props.event?.organizer_bio },
    is_active: props.event?.is_active ?? true,
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

const onOrganizerPhotoSelected = (file) => {
    form.organizer_photo = file;
    form.clearErrors('organizer_photo');
    organizerPhotoPreview.value = URL.createObjectURL(file);
};
const onOrganizerPhotoRemoved = () => {
    form.organizer_photo = null;
    organizerPhotoPreview.value = null;
};

const addContentBlock = () => {
    form.content_blocks.push({ title: emptyTranslatable(), description: emptyTranslatable() });
};
const removeContentBlock = (index) => {
    form.content_blocks.splice(index, 1);
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

    if (props.event) {
        form.transform((data) => ({ ...transform(data), _method: 'put' })).post(route('admin.cms.events.update', props.event.id), {
            forceFormData: true,
        });
    } else {
        form.transform(transform).post(route('admin.cms.events.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="event ? 'Edit Event' : 'Add Event'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ event ? 'Update this event.' : 'Add a new event shown on the homepage teaser and the public events pages.' }}
            </p>
            <Link :href="route('admin.cms.events.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to events</Link>
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
                                    hint="Card image shown on the homepage and events list"
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
                                    <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. High School Program 2024" />
                                    <p v-if="form.errors[`title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Location</label>
                                    <InputText v-model="form.location[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Slug (URL)</label>
                                    <InputText v-model="form.slug" class="w-full" placeholder="auto-generated from title if left blank" />
                                    <p v-if="form.errors.slug" class="text-xs text-red-500 mt-1">{{ form.errors.slug }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Date</label>
                                <DatePicker v-model="form.event_date" date-format="yy-mm-dd" show-icon icon-display="input" class="w-full" input-class="w-full" />
                                <p v-if="form.errors.event_date" class="text-xs text-red-500 mt-1">{{ form.errors.event_date }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Time</label>
                                <InputText v-model="form.event_time" class="w-full" placeholder="e.g. 09:00 AM" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Cost</label>
                                <InputText v-model="form.cost" class="w-full" placeholder="e.g. Free / $50" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Short description</label>
                            <Textarea v-model="form.short_description[activeLang]" :dir="currentLang?.direction" rows="2" class="w-full" />
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-semibold text-slate-800">Detail page content blocks</h3>
                            <Button label="Add block" icon="pi pi-plus" text size="small" @click="addContentBlock" />
                        </div>
                        <p class="text-xs text-slate-400 mb-3">e.g. "About The Event", "Where The Event?", "Who This Event Is For?" — add as many as you need.</p>
                        <p v-if="!form.content_blocks.length" class="text-sm text-slate-400">No blocks yet — add one above.</p>
                        <div v-else class="flex flex-col gap-3">
                            <div v-for="(block, index) in form.content_blocks" :key="index" class="rounded-lg border border-slate-100 p-3">
                                <div class="flex items-start gap-2 mb-2">
                                    <div class="flex-1">
                                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Block title</label>
                                        <InputText v-model="block.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="About The Event" />
                                    </div>
                                    <Button icon="pi pi-trash" text severity="danger" aria-label="Remove block" class="mt-5" @click="removeContentBlock(index)" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                    <Textarea v-model="block.description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Gallery &amp; map</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-4">
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
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Google Maps embed URL</label>
                            <InputText v-model="form.map_embed_url" class="w-full" placeholder="https://www.google.com/maps/embed?..." />
                            <p class="text-xs text-slate-400 mt-1">Paste the "src" URL from a Google Maps embed &lt;iframe&gt;. Optional.</p>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Sidebar</h3>
                        <div class="flex flex-col gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Sidebar intro</label>
                                <Textarea v-model="form.sidebar_intro[activeLang]" :dir="currentLang?.direction" rows="2" class="w-full" />
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Button label</label>
                                    <InputText v-model="form.button_text[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Book Now" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Button link</label>
                                    <InputText v-model="form.button_url" class="w-full" placeholder="/contact" />
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Organizer</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Photo</label>
                                <ImageDropzone
                                    :preview-url="organizerPhotoPreview"
                                    hint="Optional"
                                    width-class="w-full" height-class="h-28"
                                    @select="onOrganizerPhotoSelected"
                                    @remove="onOrganizerPhotoRemoved"
                                />
                            </div>
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Name</label>
                                    <InputText v-model="form.organizer_name[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Bio</label>
                                    <Textarea v-model="form.organizer_bio[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
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
                    <Link :href="route('admin.cms.events.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
