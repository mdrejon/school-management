<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Dropdown from 'primevue/dropdown';
import Calendar from 'primevue/calendar';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    staff: {
        type: Object,
        default: null,
    },
    departments: {
        type: Array,
        default: () => [],
    },
    roles: {
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

const photoPreview = ref(props.staff?.photo_url ?? null);

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
    photo: null,
    name: { ...emptyTranslatable(), ...props.staff?.name },
    designation: { ...emptyTranslatable(), ...props.staff?.designation },
    address: { ...emptyTranslatable(), ...props.staff?.address },
    department_id: props.staff?.department_id || null,
    role: props.staff?.user?.roles?.[0]?.name || '',
    gender: props.staff?.gender || null,
    religion: props.staff?.religion || '',
    blood_group: props.staff?.blood_group || null,
    serial_no: props.staff?.serial_no || '',
    joining_date: props.staff?.joining_date ? new Date(props.staff.joining_date) : null,
    email: props.staff?.user?.email || props.staff?.email || '',
    phone: props.staff?.phone ?? '',
    password: '',
    password_confirmation: '',
    is_active: props.staff?.is_active ?? true,
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

const submit = () => {
    if (props.staff) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.staff.staffs.update', props.staff.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.staff.staffs.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="staff ? 'Edit Staff' : 'Staffs - Create'">
        <Head :title="staff ? 'Edit Staff' : 'Staffs - Create'" />
        
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">{{ staff ? 'Edit Staff' : 'Staffs' }}</h1>
                <p class="text-sm text-slate-500 mt-1">
                    Home - Staffs - {{ staff ? 'Edit' : 'Create' }}
                </p>
            </div>
            <Link :href="route('admin.staff.staffs.index')">
                <Button label="Staffs List" />
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
                    
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <InputText v-model="form.name[activeLang]" :dir="currentLang?.direction" class="w-full bg-slate-50 border-slate-200" placeholder="Name" :class="{ 'p-invalid': form.errors[`name.${activeLang}`] }" />
                        <p v-if="form.errors[`name.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`name.${activeLang}`] }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Designation <span class="text-red-500">*</span></label>
                            <InputText v-model="form.designation[activeLang]" :dir="currentLang?.direction" class="w-full bg-slate-50 border-slate-200" placeholder="Department Head" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Department <span class="text-red-500">*</span></label>
                            <Dropdown v-model="form.department_id" :options="departments" optionLabel="title" optionValue="id" placeholder="Select Department" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.department_id }" />
                            <small v-if="form.errors.department_id" class="p-error">{{ form.errors.department_id }}</small>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Gender <span class="text-purple-600">(optional)</span></label>
                            <Dropdown v-model="form.gender" :options="genderOptions" optionLabel="label" optionValue="value" placeholder="Select One" class="w-full bg-slate-50 border-slate-200" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Role <span class="text-red-500">*</span></label>
                            <Dropdown v-model="form.role" :options="roles" optionLabel="name" optionValue="name" placeholder="-- Select Role --" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.role }" />
                            <small v-if="form.errors.role" class="p-error">{{ form.errors.role }}</small>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Religion <span class="text-purple-600">(optional)</span></label>
                            <InputText v-model="form.religion" class="w-full bg-slate-50 border-slate-200" placeholder="Islam" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Blood Group <span class="text-purple-600">(optional)</span></label>
                            <Dropdown v-model="form.blood_group" :options="bloodGroupOptions" optionLabel="label" optionValue="value" placeholder="Select Blood Group" class="w-full bg-slate-50 border-slate-200" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Serial No <span class="text-purple-600">(optional)</span></label>
                            <InputText v-model="form.serial_no" class="w-full bg-slate-50 border-slate-200" placeholder="Serial No" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Joining Date <span class="text-purple-600">(optional)</span></label>
                            <Calendar v-model="form.joining_date" dateFormat="yy-mm-dd" class="w-full bg-slate-50 border-slate-200" placeholder="mm / dd / yyyy" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Address <span class="text-purple-600">(optional)</span></label>
                        <InputText v-model="form.address[activeLang]" :dir="currentLang?.direction" class="w-full bg-slate-50 border-slate-200 h-24" />
                    </div>

                    <div class="flex items-center justify-center my-6">
                        <h2 class="text-xl font-bold text-sky-500 flex items-center gap-2">
                            <i class="pi pi-lock text-slate-400"></i> Login Details
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Email <span class="text-red-500">*</span></label>
                            <InputText v-model="form.email" type="email" class="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.email }" />
                            <p v-if="form.errors.email" class="text-xs text-red-500 mt-1">{{ form.errors.email }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Phone Number <span class="text-red-500">*</span></label>
                            <InputText v-model="form.phone" class="w-full bg-slate-50 border-slate-200" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Password <span class="text-red-500">*</span></label>
                            <Password v-model="form.password" :toggleMask="true" :feedback="false" class="w-full" inputClass="w-full bg-slate-50 border-slate-200" :class="{ 'p-invalid': form.errors.password }" placeholder="123456" />
                            <p v-if="form.errors.password" class="text-xs text-red-500 mt-1">{{ form.errors.password }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Confirm Password <span class="text-red-500">*</span></label>
                            <Password v-model="form.password_confirmation" :toggleMask="true" :feedback="false" class="w-full" inputClass="w-full bg-slate-50 border-slate-200" placeholder="123456" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-base font-bold text-slate-800 mb-4">Staff Picture <span class="text-purple-600 text-sm font-medium">(optional)</span></label>
                        <div class="flex flex-col items-center justify-center">
                            <ImageDropzone
                                :preview-url="photoPreview"
                                width-class="w-40" height-class="h-40"
                                @select="onPhotoSelected"
                                @remove="onPhotoRemoved"
                            />
                            <p v-if="form.errors.photo" class="text-xs text-red-500 mt-1">{{ form.errors.photo }}</p>
                            <p class="text-xs text-slate-400 mt-4">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mt-4">
                        <ToggleSwitch v-model="form.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>

                    <div class="mt-4 flex gap-2">
                        <Button type="submit" label="Save" class="px-8" :loading="form.processing" />
                        <Link :href="route('admin.staff.staffs.index')" class="inline-flex">
                            <Button label="Cancel" text severity="secondary" />
                        </Link>
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
