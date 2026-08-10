<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import Editor from 'primevue/editor';
import ToggleSwitch from 'primevue/toggleswitch';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    teacher: {
        type: Object,
        default: null,
    },
    departments: {
        type: Array,
        default: () => [],
    }
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

const genderOptions = [
    { label: 'Male', value: 'Male' },
    { label: 'Female', value: 'Female' },
    { label: 'Other', value: 'Other' },
];

const bloodGroupOptions = [
    { label: 'A+', value: 'A+' },
    { label: 'A-', value: 'A-' },
    { label: 'B+', value: 'B+' },
    { label: 'B-', value: 'B-' },
    { label: 'AB+', value: 'AB+' },
    { label: 'AB-', value: 'AB-' },
    { label: 'O+', value: 'O+' },
    { label: 'O-', value: 'O-' },
];

const form = useForm({
    slug: props.teacher?.slug ?? '',
    photo: null,
    name: { ...emptyTranslatable(), ...props.teacher?.name },
    designation: { ...emptyTranslatable(), ...props.teacher?.designation },
    short_intro: { ...emptyTranslatable(), ...props.teacher?.short_intro },
    address: { ...emptyTranslatable(), ...props.teacher?.address },
    department_id: props.teacher?.department_id || null,
    gender: props.teacher?.gender || null,
    religion: props.teacher?.religion || '',
    blood_group: props.teacher?.blood_group || null,
    serial_no: props.teacher?.serial_no || '',
    joining_date: props.teacher?.joining_date ? new Date(props.teacher.joining_date) : null,
    email: props.teacher?.user?.email || props.teacher?.email || '',
    phone: props.teacher?.phone ?? '',
    password: '',
    password_confirmation: '',
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
    if (props.teacher) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.staff.teachers.update', props.teacher.id), {
            forceFormData: true,
        });
    } else {
        if (!photoPreview.value) {
            form.setError('photo', 'Please add a photo before saving.');
            return;
        }
        form.post(route('admin.staff.teachers.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="teacher ? 'Edit Teacher' : 'Add Teacher'">
        <Head :title="teacher ? 'Edit Teacher' : 'Add Teacher'" />
        
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">{{ teacher ? 'Edit Teacher' : 'Add New Teacher' }}</h1>
            <Link :href="route('admin.staff.teachers.index')">
                <Button label="Back" icon="pi pi-arrow-left" text />
            </Link>
        </div>

        <Card class="shadow-sm border-none max-w-5xl">
            <template #content>
                <div class="mb-5 pb-5 border-b border-slate-100">
                    <Tabs v-model:value="activeLang">
                        <TabList>
                            <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.native_name }}</Tab>
                        </TabList>
                    </Tabs>
                </div>

                <form @submit.prevent="submit" class="flex flex-col gap-5">
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
                                    <InputText v-model="form.name[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Rasel Ahmed" :class="{ 'p-invalid': form.errors[`name.${activeLang}`] }" />
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
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">HR & Personal Details</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Department *</label>
                                <Dropdown v-model="form.department_id" :options="departments" optionLabel="title" optionValue="id" placeholder="Select a Department" class="w-full" :class="{ 'p-invalid': form.errors.department_id }" />
                                <small v-if="form.errors.department_id" class="p-error">{{ form.errors.department_id }}</small>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Gender (optional)</label>
                                <Dropdown v-model="form.gender" :options="genderOptions" optionLabel="label" optionValue="value" placeholder="Select Gender" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Religion (optional)</label>
                                <InputText v-model="form.religion" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Blood Group (optional)</label>
                                <Dropdown v-model="form.blood_group" :options="bloodGroupOptions" optionLabel="label" optionValue="value" placeholder="Select Blood Group" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Serial No (optional)</label>
                                <InputText v-model="form.serial_no" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Joining Date (optional)</label>
                                <Calendar v-model="form.joining_date" dateFormat="yy-mm-dd" class="w-full" />
                            </div>
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
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Email *</label>
                                <InputText v-model="form.email" type="email" class="w-full" :class="{ 'p-invalid': form.errors.email }" />
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
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Login Details</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Password {{ teacher ? '(Leave blank to keep unchanged)' : '*' }}</label>
                                <Password v-model="form.password" :toggleMask="true" :feedback="false" class="w-full" inputClass="w-full" :class="{ 'p-invalid': form.errors.password }" />
                                <p v-if="form.errors.password" class="text-xs text-red-500 mt-1">{{ form.errors.password }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Confirm Password</label>
                                <Password v-model="form.password_confirmation" :toggleMask="true" :feedback="false" class="w-full" inputClass="w-full" />
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

                    <div class="mt-4 pt-5 border-t border-slate-200 flex justify-end gap-2">
                        <Link :href="route('admin.staff.teachers.index')" class="inline-flex">
                            <Button label="Cancel" text severity="secondary" />
                        </Link>
                        <Button type="submit" label="Save" icon="pi pi-check" :loading="form.processing" />
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
