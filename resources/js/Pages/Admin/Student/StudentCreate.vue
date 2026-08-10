<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import Textarea from 'primevue/textarea';
import Password from 'primevue/password';

const form = useForm({
    first_name: '',
    last_name: '',
    father_name: '',
    mother_name: '',
    class_id: null,
    section_id: null,
    group: '',
    gender: '',
    roll_no: '',
    registration_no: '',
    blood_group: '',
    religion: '',
    admission_number: '',
    address: '',
    guardian_name: '',
    guardian_email: '',
    guardian_phone: '',
    guardian_relationship: '',
    guardian_address: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    picture: null
});

// Mocked options (Ideally passed from backend)
const classOptions = [
    { label: 'Class 1', value: 1 },
    { label: 'Class 2', value: 2 },
    { label: 'Class 3', value: 3 },
];
const sectionOptions = [
    { label: 'A', value: 1 },
    { label: 'B', value: 2 },
];
const genderOptions = [
    { label: 'Male', value: 'Male' },
    { label: 'Female', value: 'Female' },
    { label: 'Other', value: 'Other' }
];

const submit = () => {
    form.post(route('admin.students.store'));
};
</script>

<template>
    <AdminLayout title="Add Student">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-slate-800">Add New Student</h2>
        </div>

        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Personal Info -->
                <Card class="shadow-sm">
                    <template #title>Personal Information</template>
                    <template #content>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="first_name">First Name <span class="text-red-500">*</span></label>
                                <InputText id="first_name" v-model="form.first_name" :class="{'p-invalid': form.errors.first_name}" />
                                <small class="text-red-500" v-if="form.errors.first_name">{{ form.errors.first_name }}</small>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="last_name">Last Name</label>
                                <InputText id="last_name" v-model="form.last_name" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="gender">Gender</label>
                                <Dropdown id="gender" v-model="form.gender" :options="genderOptions" optionLabel="label" optionValue="value" placeholder="Select Gender" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="blood_group">Blood Group</label>
                                <InputText id="blood_group" v-model="form.blood_group" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="religion">Religion</label>
                                <InputText id="religion" v-model="form.religion" />
                            </div>
                            <div class="flex flex-col gap-2 sm:col-span-2">
                                <label for="address">Address</label>
                                <Textarea id="address" v-model="form.address" rows="3" />
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
                                <InputText id="group" v-model="form.group" :class="{'p-invalid': form.errors.group}" />
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
                                <label for="password">Password <span class="text-red-500">*</span></label>
                                <Password id="password" v-model="form.password" :feedback="false" toggleMask :class="{'p-invalid': form.errors.password}" />
                                <small class="text-red-500" v-if="form.errors.password">{{ form.errors.password }}</small>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="password_confirmation">Confirm Password <span class="text-red-500">*</span></label>
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
                                <label for="father_name">Father's Name</label>
                                <InputText id="father_name" v-model="form.father_name" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="mother_name">Mother's Name</label>
                                <InputText id="mother_name" v-model="form.mother_name" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="guardian_name">Guardian Name <span class="text-red-500">*</span></label>
                                <InputText id="guardian_name" v-model="form.guardian_name" :class="{'p-invalid': form.errors.guardian_name}" />
                                <small class="text-red-500" v-if="form.errors.guardian_name">{{ form.errors.guardian_name }}</small>
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
                        </div>
                    </template>
                </Card>
                
            </div>
            
            <div class="mt-6 flex justify-end gap-2">
                <Button label="Save Student" icon="pi pi-check" type="submit" :loading="form.processing" />
            </div>
        </form>
    </AdminLayout>
</template>
