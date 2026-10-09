<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    videoGallery: {
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

const form = useForm({
    video_url: props.videoGallery?.video_url ?? '',
    caption: { ...emptyTranslatable(), ...(props.videoGallery?.caption ?? {}) },
    is_active: props.videoGallery?.is_active ?? true,
});

const submit = () => {
    if (props.videoGallery) {
        form.put(route('admin.cms.video-gallery.update', props.videoGallery.id));
    } else {
        form.post(route('admin.cms.video-gallery.store'));
    }
};
</script>

<template>
    <AdminLayout :title="videoGallery ? 'Edit Video' : 'Add Video'">
        <div class="max-w-2xl mx-auto">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">{{ videoGallery ? 'Edit Video' : 'Add Video' }}</h1>
                    <p class="text-sm text-slate-500 mt-1">
                        Provide a YouTube or Vimeo URL to embed.
                    </p>
                </div>
                <Link :href="route('admin.cms.video-gallery.index')">
                    <Button label="Back to Gallery" icon="pi pi-arrow-left" text as="span" />
                </Link>
            </div>

            <Card class="shadow-sm">
                <template #content>
                    <div class="mb-6 pb-4 border-b border-slate-100">
                        <Tabs v-model:value="activeLang">
                            <TabList>
                                <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                            </TabList>
                        </Tabs>
                    </div>

                    <form @submit.prevent="submit" class="flex flex-col gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Video Embed URL <span class="text-red-500">*</span></label>
                            <InputText v-model="form.video_url" class="w-full" placeholder="e.g. https://www.youtube.com/embed/dQw4w9WgXcQ" />
                            <p class="text-xs text-slate-500 mt-1">Make sure it is the 'embed' URL if using YouTube.</p>
                            <p v-if="form.errors.video_url" class="text-xs text-red-500 mt-1">{{ form.errors.video_url }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Caption (Optional)</label>
                            <InputText v-model="form.caption[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="Short description of the video" />
                            <p v-if="form.errors[`caption.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`caption.${activeLang}`] }}</p>
                        </div>

                        <div class="flex items-center gap-3 py-2">
                            <ToggleSwitch v-model="form.is_active" />
                            <div>
                                <div class="text-sm font-medium text-slate-700">Active</div>
                                <div class="text-xs text-slate-500">Visible on the public site</div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                            <Link :href="route('admin.cms.video-gallery.index')">
                                <Button label="Cancel" severity="secondary" text as="span" />
                            </Link>
                            <Button type="submit" label="Save Video" icon="pi pi-check" :loading="form.processing" />
                        </div>
                    </form>
                </template>
            </Card>
        </div>
    </AdminLayout>
</template>
