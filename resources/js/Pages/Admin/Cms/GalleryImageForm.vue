<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    galleryImage: {
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

const imagePreview = ref(props.galleryImage?.image_url ?? null);

const form = useForm({
    image: null,
    caption: { ...emptyTranslatable(), ...props.galleryImage?.caption },
    is_active: props.galleryImage?.is_active ?? true,
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

const submit = () => {
    if (!imagePreview.value) {
        form.setError('image', 'Please add an image before saving.');
        return;
    }

    if (props.galleryImage) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.gallery.update', props.galleryImage.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.cms.gallery.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="galleryImage ? 'Edit Image' : 'Add Image'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ galleryImage ? 'Update this gallery image.' : 'Add a new image shown on the homepage teaser and the public gallery page.' }}
            </p>
            <Link :href="route('admin.cms.gallery.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to gallery</Link>
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
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Image</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Photo</label>
                                <ImageDropzone
                                    :preview-url="imagePreview"
                                    hint="Shown in the homepage teaser and the gallery page"
                                    width-class="w-full" height-class="h-32"
                                    @select="onImageSelected"
                                    @remove="onImageRemoved"
                                />
                                <p v-if="form.errors.image" class="text-xs text-red-500 mt-1">{{ form.errors.image }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Caption</label>
                                <InputText v-model="form.caption[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Optional" />
                                <p v-if="form.errors[`caption.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`caption.${activeLang}`] }}</p>
                            </div>
                        </div>
                    </section>

                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="form.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-200 flex justify-end gap-2">
                    <Link :href="route('admin.cms.gallery.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
