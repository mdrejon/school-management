<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Select from 'primevue/select';
import ToggleSwitch from 'primevue/toggleswitch';
import Tag from 'primevue/tag';

const props = defineProps({
    allLanguages: {
        type: Array,
        required: true,
    },
});

const confirm = useConfirm();

const directionOptions = [
    { label: 'Left to right (LTR)', value: 'ltr' },
    { label: 'Right to left (RTL)', value: 'rtl' },
];

const presets = [
    { label: 'English', code: 'en', name: 'English', native_name: 'English', direction: 'ltr' },
    { label: 'Bangla', code: 'bn', name: 'Bangla', native_name: 'বাংলা', direction: 'ltr' },
    { label: 'Arabic', code: 'ar', name: 'Arabic', native_name: 'العربية', direction: 'rtl' },
    { label: 'Hindi', code: 'hi', name: 'Hindi', native_name: 'हिन्दी', direction: 'ltr' },
    { label: 'Urdu', code: 'ur', name: 'Urdu', native_name: 'اردو', direction: 'rtl' },
    { label: 'French', code: 'fr', name: 'French', native_name: 'Français', direction: 'ltr' },
    { label: 'Spanish', code: 'es', name: 'Spanish', native_name: 'Español', direction: 'ltr' },
];

const showDialog = ref(false);
const editing = ref(null);
const selectedPreset = ref(null);

const form = useForm({
    code: '',
    name: '',
    native_name: '',
    direction: 'ltr',
    is_active: true,
});

const openCreate = () => {
    editing.value = null;
    selectedPreset.value = null;
    form.reset();
    form.clearErrors();
    showDialog.value = true;
};

const openEdit = (language) => {
    editing.value = language;
    selectedPreset.value = null;
    form.clearErrors();
    form.code = language.code;
    form.name = language.name;
    form.native_name = language.native_name;
    form.direction = language.direction;
    form.is_active = language.is_active;
    showDialog.value = true;
};

const applyPreset = (preset) => {
    if (!preset) return;
    form.code = preset.code;
    form.name = preset.name;
    form.native_name = preset.native_name;
    form.direction = preset.direction;
};

const submit = () => {
    if (editing.value) {
        form.put(route('admin.settings.languages.update', editing.value.id), {
            onSuccess: () => (showDialog.value = false),
        });
    } else {
        form.post(route('admin.settings.languages.store'), {
            onSuccess: () => (showDialog.value = false),
        });
    }
};

const toggleActive = (language) => {
    router.patch(route('admin.settings.languages.toggle', language.id), {}, { preserveScroll: true });
};

const makeDefault = (language) => {
    router.patch(route('admin.settings.languages.default', language.id), {}, { preserveScroll: true });
};

const moveUp = (language) => {
    router.patch(route('admin.settings.languages.moveUp', language.id), {}, { preserveScroll: true });
};

const moveDown = (language) => {
    router.patch(route('admin.settings.languages.moveDown', language.id), {}, { preserveScroll: true });
};

const confirmDelete = (language) => {
    confirm.require({
        message: `Remove ${language.name}? Content already translated into this language will keep its data, but it won't be editable from here unless the language is added back.`,
        header: 'Remove language',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.settings.languages.destroy', language.id), { preserveScroll: true }),
    });
};
</script>

<template>
    <AdminLayout title="Languages">
        <Card class="shadow-sm">
            <template #title>
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <div class="text-lg font-semibold">Languages</div>
                        <p class="text-sm font-normal text-slate-500 mt-1">
                            Add, edit, activate, or reorder the languages your site content can be translated into.
                            The default language is used whenever a translation is missing.
                        </p>
                    </div>
                    <Button label="Add Language" icon="pi pi-plus" @click="openCreate" />
                </div>
            </template>
            <template #content>
                <div class="overflow-x-auto">
                <DataTable :value="allLanguages" data-key="id" size="small">
                    <Column header="Order" style="width: 90px">
                        <template #body="{ data, index }">
                            <div class="flex items-center gap-1">
                                <Button
                                    icon="pi pi-angle-up"
                                    text
                                    rounded
                                    size="small"
                                    :disabled="index === 0"
                                    @click="moveUp(data)"
                                />
                                <Button
                                    icon="pi pi-angle-down"
                                    text
                                    rounded
                                    size="small"
                                    :disabled="index === allLanguages.length - 1"
                                    @click="moveDown(data)"
                                />
                            </div>
                        </template>
                    </Column>

                    <Column header="Language">
                        <template #body="{ data }">
                            <div class="font-medium text-slate-800">{{ data.native_name }}</div>
                            <div class="text-xs text-slate-500">{{ data.name }}</div>
                        </template>
                    </Column>

                    <Column header="Code">
                        <template #body="{ data }">
                            <code class="text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded">{{ data.code }}</code>
                        </template>
                    </Column>

                    <Column header="Direction">
                        <template #body="{ data }">
                            <Tag :value="data.direction.toUpperCase()" severity="secondary" />
                        </template>
                    </Column>

                    <Column header="Status">
                        <template #body="{ data }">
                            <div class="flex items-center gap-2">
                                <ToggleSwitch
                                    :model-value="data.is_active"
                                    :disabled="data.is_default"
                                    v-tooltip.top="data.is_default ? 'The default language stays active' : ''"
                                    @update:model-value="() => toggleActive(data)"
                                />
                                <span class="text-xs text-slate-500">{{ data.is_active ? 'Active' : 'Inactive' }}</span>
                            </div>
                        </template>
                    </Column>

                    <Column header="Default">
                        <template #body="{ data }">
                            <Tag v-if="data.is_default" value="Default" severity="success" />
                            <Button
                                v-else
                                label="Set default"
                                text
                                size="small"
                                :disabled="!data.is_active"
                                @click="makeDefault(data)"
                            />
                        </template>
                    </Column>

                    <Column header="" style="width: 100px">
                        <template #body="{ data }">
                            <div class="flex items-center gap-1 justify-end">
                                <Button icon="pi pi-pencil" text rounded @click="openEdit(data)" />
                                <Button
                                    icon="pi pi-trash"
                                    text
                                    rounded
                                    severity="danger"
                                    :disabled="data.is_default"
                                    @click="confirmDelete(data)"
                                />
                            </div>
                        </template>
                    </Column>
                </DataTable>
                </div>
            </template>
        </Card>

        <Dialog v-model:visible="showDialog" modal :header="editing ? 'Edit language' : 'Add language'" class="w-full max-w-md">
            <div class="flex flex-col gap-4">
                <div v-if="!editing">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Quick fill (optional)</label>
                    <Select
                        v-model="selectedPreset"
                        :options="presets"
                        option-label="label"
                        placeholder="Choose a common language..."
                        class="w-full"
                        show-clear
                        @update:model-value="applyPreset"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Code</label>
                    <InputText v-model="form.code" :disabled="!!editing" placeholder="en, bn, ar..." class="w-full" />
                    <p v-if="editing" class="text-xs text-slate-400 mt-1">Code can't be changed after content has been translated with it.</p>
                    <p v-if="form.errors.code" class="text-xs text-red-500 mt-1">{{ form.errors.code }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Name (English label)</label>
                    <InputText v-model="form.name" placeholder="Bangla" class="w-full" />
                    <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Native name</label>
                    <InputText v-model="form.native_name" :dir="form.direction" placeholder="বাংলা" class="w-full" />
                    <p v-if="form.errors.native_name" class="text-xs text-red-500 mt-1">{{ form.errors.native_name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Direction</label>
                    <Select v-model="form.direction" :options="directionOptions" option-label="label" option-value="value" class="w-full" />
                    <p v-if="form.errors.direction" class="text-xs text-red-500 mt-1">{{ form.errors.direction }}</p>
                </div>

                <div class="flex items-center gap-2">
                    <ToggleSwitch v-model="form.is_active" :disabled="editing?.is_default" />
                    <span class="text-sm text-slate-600">Active</span>
                    <p v-if="form.errors.is_active" class="text-xs text-red-500">{{ form.errors.is_active }}</p>
                </div>
            </div>

            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showDialog = false" />
                <Button label="Save" :loading="form.processing" @click="submit" />
            </template>
        </Dialog>
    </AdminLayout>
</template>
