<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import Textarea from 'primevue/textarea';
import Password from 'primevue/password';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    student: Object,
    classes: {
        type: Array,
        default: () => []
    }
});

const page = usePage();
const languages = computed(() => page.props.languages || [
    { code: 'en', native_name: 'English', is_default: true, direction: 'ltr' },
    { code: 'bn', native_name: 'বাংলা', is_default: false, direction: 'ltr' }
]);
const defaultLangCode = computed(() => languages.value.find((l) => l.is_default)?.code || 'en');

const emptyTranslatable = () => Object.fromEntries(languages.value.map((l) => [l.code, '']));

const activeLang = ref(defaultLangCode.value);
const currentLang = computed(() => languages.value.find((l) => l.code === activeLang.value));

const normalizeTranslatable = (val) => {
    const empty = emptyTranslatable();
    if (!val) return empty;
    if (typeof val === 'string') {
        try {
            const parsed = JSON.parse(val);
            if (typeof parsed === 'object' && parsed !== null) {
                return { ...empty, ...parsed };
            }
        } catch (e) {}
        empty[defaultLangCode.value] = val;
        return empty;
    }
    return { ...empty, ...val };
};

const form = useForm({
    _method: 'PUT',
    first_name: normalizeTranslatable(props.student.first_name),
    last_name: normalizeTranslatable(props.student.last_name),
    father_name: normalizeTranslatable(props.student.father_name),
    mother_name: normalizeTranslatable(props.student.mother_name),
    guardian_name: normalizeTranslatable(props.student.guardian_name),
    address: normalizeTranslatable(props.student.address),
    guardian_address: normalizeTranslatable(props.student.guardian_address),

    class_id: props.student.class_id || null,
    section_id: props.student.section_id || null,
    group: props.student.group || '',
    gender: props.student.gender || '',
    roll_no: props.student.roll_no || '',
    registration_no: props.student.registration_no || '',
    blood_group: props.student.blood_group || '',
    religion: props.student.religion || '',
    admission_number: props.student.admission_number || '',

    guardian_email: props.student.guardian_email || '',
    guardian_phone: props.student.guardian_phone || '',
    guardian_relationship: props.student.guardian_relationship || '',

    email: props.student.user?.email || '',
    phone: props.student.user?.phone || '',
    password: '',
    password_confirmation: '',
    picture: null
});

// Dynamic classes & sections from backend
const classOptions = computed(() => {
    if (props.classes && props.classes.length > 0) {
        return props.classes.map(c => ({ label: c.name, value: c.id }));
    }
    return [
        { label: 'Class 1', value: 1 },
        { label: 'Class 2', value: 2 },
        { label: 'Class 3', value: 3 },
    ];
});

const sectionOptions = computed(() => {
    if (props.classes && props.classes.length > 0 && form.class_id) {
        const found = props.classes.find(c => c.id === form.class_id);
        if (found && found.sections) {
            return found.sections.map(s => ({ label: s.name, value: s.id }));
        }
    }
    return [
        { label: 'A', value: 1 },
        { label: 'B', value: 2 },
    ];
});

const genderOptions = [
    { label: 'Male', value: 'Male' },
    { label: 'Female', value: 'Female' },
    { label: 'Other', value: 'Other' }
];

const submit = () => {
    form.post(route('admin.students.update', props.student.id), {
        preserveScroll: true
    });
};
</script>

<template>
    <AdminLayout title="Edit Student">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-slate-800">Edit Student</h2>
            <p class="text-xs text-slate-500 mt-1">Update student records in multiple languages (English & বাংলা).</p>
        </div>

        <form @submit.prevent="submit">
            <!-- Language Selector Tabs -->
            <div class="mb-5 pb-3 border-b border-slate-200">
                <Tabs v-model:value="activeLang">
                    <TabList>
                        <Tab v-for="lang in languages" :key="lang.code" :value="lang.code">
                            {{ lang.native_name }}
                        </Tab>
                    </TabList>
                </Tabs>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Personal Info -->
                <Card class="shadow-sm">
                    <template #title>Personal Information</template>
                    <template #content>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="first_name">
                                    First Name ({{ currentLang?.native_name }}) <span class="text-red-500">*</span>
                                </label>
                                <InputText 
                                    id="first_name" 
                                    v-model="form.first_name[activeLang]" 
                                    :dir="currentLang?.direction"
                                    :class="{'p-invalid': form.errors[`first_name.${activeLang}`] || form.errors.first_name}" 
                                />
                                <small class="text-red-500" v-if="form.errors[`first_name.${activeLang}`]">{{ form.errors[`first_name.${activeLang}`] }}</small>
                                <small class="text-red-500" v-else-if="form.errors.first_name">{{ form.errors.first_name }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="last_name">
                                    Last Name ({{ currentLang?.native_name }})
                                </label>
                                <InputText 
                                    id="last_name" 
                                    v-model="form.last_name[activeLang]" 
                                    :dir="currentLang?.direction"
                                />
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="gender">Gender</label>
                                <Dropdown id="gender" v-model="form.gender" :options="genderOptions" optionLabel="label" optionValue="value" placeholder="Select Gender" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="blood_group">Blood Group</label>
                                <InputText id="blood_group" v-model="form.blood_group" placeholder="e.g. A+, B+, O+" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="religion">Religion</label>
                                <InputText id="religion" v-model="form.religion" placeholder="e.g. Islam, Hinduism" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="picture">Profile Picture</label>
                                <input id="picture" type="file" @input="e => form.picture = e.target.files[0]" class="p-inputtext p-component p-2" accept="image/*" />
                                <small class="text-red-500" v-if="form.errors.picture">{{ form.errors.picture }}</small>
                                <div v-if="props.student.picture" class="mt-2">
                                    <img :src="props.student.picture.startsWith('http') || props.student.picture.startsWith('/') ? props.student.picture : '/storage/' + props.student.picture" alt="Current Picture" class="w-16 h-16 object-cover rounded-full" />
                                </div>
                            </div>

                            <div class="flex flex-col gap-2 sm:col-span-2">
                                <label for="address">Address ({{ currentLang?.native_name }})</label>
                                <Textarea 
                                    id="address" 
                                    v-model="form.address[activeLang]" 
                                    :dir="currentLang?.direction"
                                    rows="3" 
                                    placeholder="Present / Permanent Address"
                                />
                            </div>
                        </div>
                    </template>
                </Card>

                <!-- Academic Info -->
                <Card class="shadow-sm">
                    <template #title>Academic Information</template>
                    <template #content>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="class_id">Class <span class="text-red-500">*</span></label>
                                <Dropdown id="class_id" v-model="form.class_id" :options="classOptions" optionLabel="label" optionValue="value" placeholder="Select Class" :class="{'p-invalid': form.errors.class_id}" />
                                <small class="text-red-500" v-if="form.errors.class_id">{{ form.errors.class_id }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="section_id">Section <span class="text-red-500">*</span></label>
                                <Dropdown id="section_id" v-model="form.section_id" :options="sectionOptions" optionLabel="label" optionValue="value" placeholder="Select Section" :class="{'p-invalid': form.errors.section_id}" />
                                <small class="text-red-500" v-if="form.errors.section_id">{{ form.errors.section_id }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="group">Group <span class="text-red-500">*</span></label>
                                <InputText id="group" v-model="form.group" placeholder="e.g. Science, General" :class="{'p-invalid': form.errors.group}" />
                                <small class="text-red-500" v-if="form.errors.group">{{ form.errors.group }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="roll_no">Roll No <span class="text-red-500">*</span></label>
                                <InputText id="roll_no" v-model="form.roll_no" :class="{'p-invalid': form.errors.roll_no}" />
                                <small class="text-red-500" v-if="form.errors.roll_no">{{ form.errors.roll_no }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="admission_number">Admission Number</label>
                                <InputText id="admission_number" v-model="form.admission_number" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="registration_no">Registration Number</label>
                                <InputText id="registration_no" v-model="form.registration_no" />
                            </div>
                        </div>
                    </template>
                </Card>

                <!-- Login Info -->
                <Card class="shadow-sm">
                    <template #title>Account Information</template>
                    <template #content>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="email">Email <span class="text-red-500">*</span></label>
                                <InputText id="email" type="email" v-model="form.email" :class="{'p-invalid': form.errors.email}" />
                                <small class="text-red-500" v-if="form.errors.email">{{ form.errors.email }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="phone">Phone <span class="text-red-500">*</span></label>
                                <InputText id="phone" v-model="form.phone" :class="{'p-invalid': form.errors.phone}" />
                                <small class="text-red-500" v-if="form.errors.phone">{{ form.errors.phone }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="password">Password (Leave blank to keep current)</label>
                                <Password id="password" v-model="form.password" :feedback="false" toggleMask :class="{'p-invalid': form.errors.password}" />
                                <small class="text-red-500" v-if="form.errors.password">{{ form.errors.password }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="password_confirmation">Confirm Password</label>
                                <Password id="password_confirmation" v-model="form.password_confirmation" :feedback="false" toggleMask />
                            </div>
                        </div>
                    </template>
                </Card>

                <!-- Parent Info -->
                <Card class="shadow-sm">
                    <template #title>Guardian Information</template>
                    <template #content>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="father_name">Father's Name ({{ currentLang?.native_name }})</label>
                                <InputText id="father_name" v-model="form.father_name[activeLang]" :dir="currentLang?.direction" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="mother_name">Mother's Name ({{ currentLang?.native_name }})</label>
                                <InputText id="mother_name" v-model="form.mother_name[activeLang]" :dir="currentLang?.direction" />
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="guardian_name">Guardian Name ({{ currentLang?.native_name }}) <span class="text-red-500">*</span></label>
                                <InputText 
                                    id="guardian_name" 
                                    v-model="form.guardian_name[activeLang]" 
                                    :dir="currentLang?.direction" 
                                    :class="{'p-invalid': form.errors[`guardian_name.${activeLang}`] || form.errors.guardian_name}" 
                                />
                                <small class="text-red-500" v-if="form.errors[`guardian_name.${activeLang}`]">{{ form.errors[`guardian_name.${activeLang}`] }}</small>
                                <small class="text-red-500" v-else-if="form.errors.guardian_name">{{ form.errors.guardian_name }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="guardian_relationship">Relationship <span class="text-red-500">*</span></label>
                                <InputText id="guardian_relationship" v-model="form.guardian_relationship" :class="{'p-invalid': form.errors.guardian_relationship}" />
                                <small class="text-red-500" v-if="form.errors.guardian_relationship">{{ form.errors.guardian_relationship }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="guardian_phone">Guardian Phone <span class="text-red-500">*</span></label>
                                <InputText id="guardian_phone" v-model="form.guardian_phone" :class="{'p-invalid': form.errors.guardian_phone}" />
                                <small class="text-red-500" v-if="form.errors.guardian_phone">{{ form.errors.guardian_phone }}</small>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="guardian_email">Guardian Email</label>
                                <InputText id="guardian_email" type="email" v-model="form.guardian_email" />
                            </div>

                            <div class="flex flex-col gap-2 sm:col-span-2">
                                <label for="guardian_address">Guardian Address ({{ currentLang?.native_name }})</label>
                                <Textarea 
                                    id="guardian_address" 
                                    v-model="form.guardian_address[activeLang]" 
                                    :dir="currentLang?.direction"
                                    rows="2" 
                                    placeholder="Guardian Address"
                                />
                            </div>
                        </div>
                    </template>
                </Card>
                
            </div>
            
            <div class="mt-6 flex justify-end gap-2">
                <Button label="Update Student" icon="pi pi-check" type="submit" :loading="form.processing" />
            </div>
        </form>
    </AdminLayout>
</template>
