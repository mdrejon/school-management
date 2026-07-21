<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
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
    teacher: {
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

const normalizeSkills = (items) =>
    (items ?? []).map((item) => ({
        label: { ...emptyTranslatable(), ...item.label },
        percentage: item.percentage ?? '',
    }));

const photoPreview = ref(props.teacher?.photo_url ?? null);

const form = useForm({
    slug: props.teacher?.slug ?? '',
    photo: null,
    name: { ...emptyTranslatable(), ...props.teacher?.name },
    designation: { ...emptyTranslatable(), ...props.teacher?.designation },
    short_intro: { ...emptyTranslatable(), ...props.teacher?.short_intro },
    address: { ...emptyTranslatable(), ...props.teacher?.address },
    email: props.teacher?.email ?? '',
    phone: props.teacher?.phone ?? '',
    facebook_url: props.teacher?.facebook_url ?? '',
    whatsapp_url: props.teacher?.whatsapp_url ?? '',
    behance_url: props.teacher?.behance_url ?? '',
    pinterest_url: props.teacher?.pinterest_url ?? '',
    linkedin_url: props.teacher?.linkedin_url ?? '',
    biography: { ...emptyTranslatable(), ...props.teacher?.biography },
    skills: normalizeSkills(props.teacher?.skills),
    is_active: props.teacher?.is_active ?? true,
});

const onPhotoSelected = (file) => {
    form.photo = file;
    form.clearErrors('photo');
    photoPreview.value = URL.createObjectURL(file);
};
const onPhotoRemoved = () => {
    form.photo = null;
    photoPreview.value = null;
};

const addSkill = () => {
    form.skills.push({ label: emptyTranslatable(), percentage: '' });
};
const removeSkill = (index) => {
    form.skills.splice(index, 1);
};

const submit = () => {
    if (!photoPreview.value) {
        form.setError('photo', 'Please add a photo before saving.');
        return;
    }

    if (props.teacher) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.cms.teachers.update', props.teacher.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.cms.teachers.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="teacher ? 'Edit Teacher' : 'Add Teacher'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ teacher ? 'Update this teacher.' : 'Add a new teacher shown on the homepage teaser and the public teachers pages.' }}
            </p>
            <Link :href="route('admin.cms.teachers.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to teachers</Link>
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
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Photo</label>
                                <ImageDropzone
                                    :preview-url="photoPreview"
                                    hint="Card + detail page photo"
                                    width-class="w-full" height-class="h-32"
                                    @select="onPhotoSelected"
                                    @remove="onPhotoRemoved"
                                />
                                <p v-if="form.errors.photo" class="text-xs text-red-500 mt-1">{{ form.errors.photo }}</p>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">
                                        Name {{ currentLang?.is_default ? '(required)' : '' }}
                                    </label>
                                    <InputText v-model="form.name[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Rasel Ahmed" />
                                    <p v-if="form.errors[`name.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`name.${activeLang}`] }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Designation</label>
                                    <InputText v-model="form.designation[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Mathematics Teacher" />
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Slug (URL)</label>
                                    <InputText v-model="form.slug" class="w-full" placeholder="auto-generated from name if left blank" />
                                    <p v-if="form.errors.slug" class="text-xs text-red-500 mt-1">{{ form.errors.slug }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Short intro</label>
                            <Textarea v-model="form.short_intro[activeLang]" :dir="currentLang?.direction" rows="2" class="w-full" />
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Contact &amp; social</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Address</label>
                                <InputText v-model="form.address[activeLang]" :dir="currentLang?.direction" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Email</label>
                                <InputText v-model="form.email" type="email" class="w-full" />
                                <p v-if="form.errors.email" class="text-xs text-red-500 mt-1">{{ form.errors.email }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Phone</label>
                                <InputText v-model="form.phone" class="w-full" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Facebook URL</label>
                                <InputText v-model="form.facebook_url" class="w-full" placeholder="https://facebook.com/..." />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">WhatsApp URL</label>
                                <InputText v-model="form.whatsapp_url" class="w-full" placeholder="https://wa.me/..." />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Behance URL</label>
                                <InputText v-model="form.behance_url" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Pinterest URL</label>
                                <InputText v-model="form.pinterest_url" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">LinkedIn URL</label>
                                <InputText v-model="form.linkedin_url" class="w-full" />
                            </div>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Biography</h3>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">
                            Biography {{ currentLang?.is_default ? '(required)' : '' }}
                        </label>
                        <Editor v-model="form.biography[activeLang]" :editor-style="`height: 260px; direction: ${currentLang?.direction ?? 'ltr'};`" />
                        <p v-if="form.errors[`biography.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`biography.${activeLang}`] }}</p>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-semibold text-slate-800">Professional skills</h3>
                            <Button label="Add item" icon="pi pi-plus" text size="small" @click="addSkill" />
                        </div>
                        <p v-if="!form.skills.length" class="text-sm text-slate-400">No items yet — add one above.</p>
                        <div v-else class="flex flex-col gap-3">
                            <div
                                v-for="(item, index) in form.skills"
                                :key="index"
                                class="grid grid-cols-1 sm:grid-cols-[1fr_auto_auto] gap-3 sm:items-start rounded-lg border border-slate-100 p-3"
                            >
                                <div>
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Label</label>
                                    <InputText
                                        v-model="item.label[activeLang]"
                                        :dir="currentLang?.direction"
                                        class="w-full"
                                        :placeholder="currentLang?.is_default ? 'Required, e.g. Teaching' : 'Optional'"
                                    />
                                    <p v-if="form.errors[`skills.${index}.label.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skills.${index}.label.${activeLang}`] }}</p>
                                </div>
                                <div class="sm:w-24">
                                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Percent</label>
                                    <InputNumber v-model="item.percentage" class="w-full" input-class="w-full" :min="0" :max="100" />
                                    <p v-if="form.errors[`skills.${index}.percentage`]" class="text-xs text-red-500 mt-1">{{ form.errors[`skills.${index}.percentage`] }}</p>
                                </div>
                                <div class="flex sm:justify-end sm:pt-6">
                                    <Button icon="pi pi-trash" text severity="danger" aria-label="Remove item" @click="removeSkill(index)" />
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
                    <Link :href="route('admin.cms.teachers.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
