<script setup>
import { ref, computed } from 'vue';
import { useForm, router, usePage } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Tag from 'primevue/tag';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

defineProps({
    sliders: {
        type: Array,
        required: true,
    },
});

const page = usePage();
const languages = computed(() => page.props.languages);
const confirm = useConfirm();

const showDialog = ref(false);
const editing = ref(null);
const imagePreview = ref(null);
const activeTab = ref('');

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const form = useForm({
    image: null,
    sub_title: emptyTranslatable(),
    title: emptyTranslatable(),
    highlight: emptyTranslatable(),
    description: emptyTranslatable(),
    button_text: emptyTranslatable(),
    button_url: '',
    button2_text: emptyTranslatable(),
    button2_url: '',
    is_active: true,
});

const openCreate = () => {
    editing.value = null;
    imagePreview.value = null;
    activeTab.value = languages.value.find((l) => l.is_default)?.code ?? languages.value[0]?.code;
    form.reset();
    form.clearErrors();
    form.sub_title = emptyTranslatable();
    form.title = emptyTranslatable();
    form.highlight = emptyTranslatable();
    form.description = emptyTranslatable();
    form.button_text = emptyTranslatable();
    form.button2_text = emptyTranslatable();
    form.is_active = true;
    showDialog.value = true;
};

const openEdit = (slider) => {
    editing.value = slider;
    imagePreview.value = slider.image_url;
    activeTab.value = languages.value.find((l) => l.is_default)?.code ?? languages.value[0]?.code;
    form.clearErrors();
    form.image = null;
    form.sub_title = { ...emptyTranslatable(), ...slider.sub_title };
    form.title = { ...emptyTranslatable(), ...slider.title };
    form.highlight = { ...emptyTranslatable(), ...slider.highlight };
    form.description = { ...emptyTranslatable(), ...slider.description };
    form.button_text = { ...emptyTranslatable(), ...slider.button_text };
    form.button_url = slider.button_url ?? '';
    form.button2_text = { ...emptyTranslatable(), ...slider.button2_text };
    form.button2_url = slider.button2_url ?? '';
    form.is_active = slider.is_active;
    showDialog.value = true;
};

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

    if (editing.value) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(
            route('admin.cms.sliders.update', editing.value.id),
            {
                forceFormData: true,
                onSuccess: () => (showDialog.value = false),
            },
        );
    } else {
        form.post(route('admin.cms.sliders.store'), {
            forceFormData: true,
            onSuccess: () => (showDialog.value = false),
        });
    }
};

const toggleActive = (slider) => {
    router.patch(route('admin.cms.sliders.toggle', slider.id), {}, { preserveScroll: true });
};

const moveUp = (slider) => {
    router.patch(route('admin.cms.sliders.moveUp', slider.id), {}, { preserveScroll: true });
};

const moveDown = (slider) => {
    router.patch(route('admin.cms.sliders.moveDown', slider.id), {}, { preserveScroll: true });
};

const confirmDelete = (slider) => {
    confirm.require({
        message: 'Remove this slide? This can\'t be undone.',
        header: 'Remove slide',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.sliders.destroy', slider.id), { preserveScroll: true }),
    });
};

const defaultText = (slider, field) => {
    const defaultCode = languages.value.find((l) => l.is_default)?.code;
    return slider[field]?.[defaultCode] ?? Object.values(slider[field] ?? {})[0] ?? '—';
};
</script>

<template>
    <AdminLayout title="Sliders & Banners">
        <Card class="shadow-sm">
            <template #title>
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <div class="text-lg font-semibold">Homepage Hero Slider</div>
                        <p class="text-sm font-normal text-slate-500 mt-1">
                            Manage the slides shown in the homepage hero banner, in every active language.
                        </p>
                    </div>
                    <Button label="Add Slide" icon="pi pi-plus" @click="openCreate" />
                </div>
            </template>
            <template #content>
                <div class="overflow-x-auto">
                <DataTable :value="sliders" data-key="id" size="small">
                    <Column header="Order" style="width: 90px">
                        <template #body="{ data, index }">
                            <div class="flex items-center gap-1">
                                <Button icon="pi pi-angle-up" text rounded size="small" :disabled="index === 0" @click="moveUp(data)" />
                                <Button icon="pi pi-angle-down" text rounded size="small" :disabled="index === sliders.length - 1" @click="moveDown(data)" />
                            </div>
                        </template>
                    </Column>

                    <Column header="Preview" style="width: 140px">
                        <template #body="{ data }">
                            <img :src="data.image_url" class="w-28 h-16 object-contain bg-slate-100 rounded-md border border-slate-200" alt="" />
                        </template>
                    </Column>

                    <Column header="Title">
                        <template #body="{ data }">
                            <div class="font-medium text-slate-800">{{ defaultText(data, 'title') }}</div>
                            <div class="text-xs text-slate-500">{{ defaultText(data, 'sub_title') }}</div>
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
                                <Button icon="pi pi-pencil" text rounded @click="openEdit(data)" />
                                <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDelete(data)" />
                            </div>
                        </template>
                    </Column>
                </DataTable>
                </div>
            </template>
        </Card>

        <Dialog v-model:visible="showDialog" modal :header="editing ? 'Edit slide' : 'Add slide'" class="w-full max-w-3xl">
            <div class="flex flex-col gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Background image</label>
                    <ImageDropzone
                        :preview-url="imagePreview"
                        hint="Drag & drop an image here, or click to browse"
                        @select="onImageSelected"
                        @remove="onImageRemoved"
                    />
                    <p v-if="form.errors.image" class="text-xs text-red-500 mt-1">{{ form.errors.image }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Text content (per language)</label>
                    <Tabs v-model:value="activeTab">
                        <TabList>
                            <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                        </TabList>
                        <TabPanels>
                            <TabPanel v-for="lang in languages" :key="lang.code" :value="lang.code">
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">Sub-title (small line above the title)</label>
                                        <InputText v-model="form.sub_title[lang.code]" :dir="lang.direction" class="w-full" placeholder="Welcome To Our School !" />
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">
                                                Title {{ lang.is_default ? '(required)' : '' }}
                                            </label>
                                            <InputText v-model="form.title[lang.code]" :dir="lang.direction" class="w-full" placeholder="Start Your Beautiful And Bright Future" />
                                            <p v-if="form.errors[`title.${lang.code}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${lang.code}`] }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">Highlighted word/phrase in title</label>
                                            <InputText v-model="form.highlight[lang.code]" :dir="lang.direction" class="w-full" placeholder="Bright" />
                                            <p class="text-xs text-slate-400 mt-1">Must match a substring of the title above — it's shown in the theme color.</p>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-1">Description</label>
                                        <Textarea v-model="form.description[lang.code]" :dir="lang.direction" rows="3" class="w-full" />
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">Button 1 label</label>
                                            <InputText v-model="form.button_text[lang.code]" :dir="lang.direction" class="w-full" placeholder="About More" />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-slate-600 mb-1">Button 2 label</label>
                                            <InputText v-model="form.button2_text[lang.code]" :dir="lang.direction" class="w-full" placeholder="Learn More" />
                                        </div>
                                    </div>
                                </div>
                            </TabPanel>
                        </TabPanels>
                    </Tabs>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Button 1 link</label>
                        <InputText v-model="form.button_url" class="w-full" placeholder="/about" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Button 2 link</label>
                        <InputText v-model="form.button2_url" class="w-full" placeholder="/contact" />
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <ToggleSwitch v-model="form.is_active" />
                    <span class="text-sm text-slate-600">Active</span>
                </div>
            </div>

            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showDialog = false" />
                <Button label="Save" :loading="form.processing" @click="submit" />
            </template>
        </Dialog>
    </AdminLayout>
</template>
