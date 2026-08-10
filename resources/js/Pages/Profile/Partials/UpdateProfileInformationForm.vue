<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Avatar from 'primevue/avatar';
import { useToast } from 'primevue/usetoast';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    user: Object,
});

const toast = useToast();

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    photo: null,
});

const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => {
            clearPhotoFileInput();
            toast.add({ severity: 'success', summary: 'Success', detail: 'Profile updated successfully', life: 3000 });
        },
    });
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];
    if (! photo) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };
    reader.readAsDataURL(photo);
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

const userInitials = computed(() => {
    if(!props.user.name) return 'U';
    const parts = props.user.name.split(' ');
    if (parts.length > 1) return parts[0][0] + parts[1][0];
    return parts[0][0];
});

import { computed } from 'vue';
</script>

<template>
    <Card class="shadow-sm border border-slate-100 rounded-xl bg-white overflow-hidden">
        <template #header>
            <div class="bg-[#0ea5e9] text-white px-4 py-3 font-semibold flex items-center gap-2">
                <i class="pi pi-user text-sm" /> Profile Information
            </div>
        </template>
        <template #content>
            <form @submit.prevent="updateProfileInformation">
                <!-- Profile Photo File Input -->
                <input
                    id="photo"
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <div class="flex flex-col items-center justify-center mb-8 mt-4">
                    <div class="relative group cursor-pointer" @click="selectNewPhoto">
                        <Avatar v-if="!photoPreview && props.user.profile_photo_path" :image="user.profile_photo_url" shape="circle" class="w-32 h-32 text-4xl" />
                        <Avatar v-else-if="photoPreview" :image="photoPreview" shape="circle" class="w-32 h-32 text-4xl" />
                        <Avatar v-else :label="userInitials" shape="circle" class="w-32 h-32 text-4xl bg-blue-600 text-white" />
                        
                        <div class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="pi pi-camera text-white text-2xl" />
                        </div>
                    </div>
                    
                    <button type="button" @click="selectNewPhoto" class="mt-4 text-sm font-medium text-gray-700 hover:text-blue-600 flex items-center gap-2">
                        <i class="pi pi-camera" /> Change Photo
                    </button>
                    <InputError :message="form.errors.photo" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <InputText v-model="form.name" class="w-full" required />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <InputText v-model="form.email" type="email" class="w-full" required />
                        <InputError :message="form.errors.email" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end">
                    <Button type="submit" label="Update Profile" icon="pi pi-lock" :loading="form.processing" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600" />
                </div>
            </form>
        </template>
    </Card>
</template>
