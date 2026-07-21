<script setup>
import { ref, computed } from 'vue';
import { useForm, router, usePage, Link } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
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
    events: {
        type: Array,
        required: true,
    },
    pageSettings: {
        type: Object,
        required: true,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code);
const confirm = useConfirm();

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));

const activeMainTab = ref('events');

const toggleActive = (event) => {
    router.patch(route('admin.cms.events.toggle', event.id), {}, { preserveScroll: true });
};
const moveUp = (event) => {
    router.patch(route('admin.cms.events.moveUp', event.id), {}, { preserveScroll: true });
};
const moveDown = (event) => {
    router.patch(route('admin.cms.events.moveDown', event.id), {}, { preserveScroll: true });
};
const confirmDelete = (event) => {
    confirm.require({
        message: 'Remove this event? This can\'t be undone.',
        header: 'Remove event',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.events.destroy', event.id), { preserveScroll: true }),
    });
};

const defaultText = (event, field) => {
    const defaultCode = defaultLangCode.value;
    return event[field]?.[defaultCode] ?? Object.values(event[field] ?? {})[0] ?? '—';
};

/* ---------------------------------------------------------------------- */
/* Page settings                                                           */
/* ---------------------------------------------------------------------- */

const breadcrumbImagePreview = ref(props.pageSettings.breadcrumb_image_url);

const settingsForm = useForm({
    section_tagline: { ...emptyTranslatable(), ...props.pageSettings.section_tagline },
    section_title: { ...emptyTranslatable(), ...props.pageSettings.section_title },
    section_highlight: { ...emptyTranslatable(), ...props.pageSettings.section_highlight },
    section_description: { ...emptyTranslatable(), ...props.pageSettings.section_description },
    breadcrumb_title: { ...emptyTranslatable(), ...props.pageSettings.breadcrumb_title },
    breadcrumb_image: null,
    seo_title: { ...emptyTranslatable(), ...props.pageSettings.seo_title },
    seo_description: { ...emptyTranslatable(), ...props.pageSettings.seo_description },
    seo_keywords: { ...emptyTranslatable(), ...props.pageSettings.seo_keywords },
});

const onBreadcrumbImageSelected = (file) => {
    settingsForm.breadcrumb_image = file;
    settingsForm.clearErrors('breadcrumb_image');
    breadcrumbImagePreview.value = URL.createObjectURL(file);
};
const onBreadcrumbImageRemoved = () => {
    settingsForm.breadcrumb_image = null;
    breadcrumbImagePreview.value = null;
};

const submitSettings = () => {
    settingsForm.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.events.settings.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout title="Events">
        <p class="text-sm text-slate-500 mb-6">
            Manage the events shown on the public site, and the events list page's own heading, breadcrumb, and SEO config.
        </p>

        <Tabs v-model:value="activeMainTab">
            <TabList>
                <Tab value="events">Events</Tab>
                <Tab value="settings">Page Settings</Tab>
            </TabList>
            <TabPanels>
                <!-- Events -->
                <TabPanel value="events">
                    <Card class="shadow-sm">
                        <template #title>
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-lg font-semibold">Events</div>
                                    <p class="text-sm font-normal text-slate-500 mt-1">
                                        Shown on the homepage teaser and the public events list/detail pages.
                                    </p>
                                </div>
                                <Link :href="route('admin.cms.events.create')">
                                    <Button label="Add Event" icon="pi pi-plus" as="span" />
                                </Link>
                            </div>
                        </template>
                        <template #content>
                            <div class="overflow-x-auto">
                                <DataTable :value="events" data-key="id" size="small">
                                    <Column header="Order" style="width: 90px">
                                        <template #body="{ data, index }">
                                            <div class="flex items-center gap-1">
                                                <Button icon="pi pi-angle-up" text rounded size="small" :disabled="index === 0" @click="moveUp(data)" />
                                                <Button icon="pi pi-angle-down" text rounded size="small" :disabled="index === events.length - 1" @click="moveDown(data)" />
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="Image" style="width: 110px">
                                        <template #body="{ data }">
                                            <img :src="data.image_url" class="w-20 h-14 object-cover bg-slate-100 rounded-md border border-slate-200" alt="" />
                                        </template>
                                    </Column>

                                    <Column header="Event">
                                        <template #body="{ data }">
                                            <div class="font-medium text-slate-800">{{ defaultText(data, 'title') }}</div>
                                            <div class="text-xs text-slate-500 mt-1">{{ defaultText(data, 'location') }}</div>
                                        </template>
                                    </Column>

                                    <Column header="Date / Time">
                                        <template #body="{ data }">
                                            <div class="text-sm text-slate-700">{{ data.event_date || '—' }}</div>
                                            <div class="text-xs text-slate-500">{{ data.event_time || '—' }}</div>
                                        </template>
                                    </Column>

                                    <Column header="Status">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-2">
                                                <ToggleSwitch :model-value="data.is_active" @update:model-value="() => toggleActive(data)" />
                                                <span class="text-xs text-slate-500">{{ data.is_active ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </template>
                                    </Column>

                                    <Column header="" style="width: 100px">
                                        <template #body="{ data }">
                                            <div class="flex items-center gap-1 justify-end">
                                                <Link :href="route('admin.cms.events.edit', data.id)">
                                                    <Button icon="pi pi-pencil" text rounded as="span" />
                                                </Link>
                                                <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDelete(data)" />
                                            </div>
                                        </template>
                                    </Column>
                                </DataTable>
                            </div>
                        </template>
                    </Card>
                </TabPanel>

                <!-- Page Settings -->
                <TabPanel value="settings">
                    <Card class="shadow-sm">
                        <template #content>
                            <div class="mb-6 pb-5 border-b border-slate-100">
                                <Tabs v-model:value="activeLang">
                                    <TabList>
                                        <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                                    </TabList>
                                </Tabs>
                            </div>

                            <div class="flex flex-col gap-5">
                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Homepage section heading</h3>
                                    <div class="flex flex-col gap-4 max-w-lg">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Tagline</label>
                                            <InputText v-model="settingsForm.section_tagline[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Events" />
                                            <p v-if="settingsForm.errors[`section_tagline.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ settingsForm.errors[`section_tagline.${activeLang}`] }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.section_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Our Upcoming Events" />
                                            <p v-if="settingsForm.errors[`section_title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ settingsForm.errors[`section_title.${activeLang}`] }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Highlighted word</label>
                                            <InputText v-model="settingsForm.section_highlight[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Events" />
                                            <p class="text-xs text-slate-400 mt-1">The word within Title to show in orange — must match exactly.</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Description</label>
                                            <Textarea v-model="settingsForm.section_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                        </div>
                                    </div>
                                </section>

                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">Breadcrumb</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Title</label>
                                            <InputText v-model="settingsForm.breadcrumb_title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Events" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Background image</label>
                                            <ImageDropzone
                                                :preview-url="breadcrumbImagePreview"
                                                hint="Shown behind the page title on the events list page"
                                                width-class="w-full" height-class="h-28"
                                                @select="onBreadcrumbImageSelected"
                                                @remove="onBreadcrumbImageRemoved"
                                            />
                                            <p v-if="settingsForm.errors.breadcrumb_image" class="text-xs text-red-500 mt-1">{{ settingsForm.errors.breadcrumb_image }}</p>
                                        </div>
                                    </div>
                                </section>

                                <section class="rounded-xl border border-slate-200 p-5">
                                    <h3 class="text-sm font-semibold text-slate-800 mb-3">SEO</h3>
                                    <div class="flex flex-col gap-4 max-w-lg">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta title</label>
                                            <InputText v-model="settingsForm.seo_title[activeLang]" :dir="currentLang?.direction" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta description</label>
                                            <Textarea v-model="settingsForm.seo_description[activeLang]" :dir="currentLang?.direction" rows="3" class="w-full" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta keywords</label>
                                            <InputText v-model="settingsForm.seo_keywords[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="comma, separated, keywords" />
                                        </div>
                                    </div>
                                </section>

                                <div class="pt-2 flex justify-end">
                                    <Button label="Save Changes" icon="pi pi-check" :loading="settingsForm.processing" @click="submitSettings" />
                                </div>
                            </div>
                        </template>
                    </Card>
                </TabPanel>
            </TabPanels>
        </Tabs>
    </AdminLayout>
</template>
