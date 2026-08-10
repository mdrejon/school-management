<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Card from 'primevue/card';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Button from 'primevue/button';
import { useToast } from 'primevue/usetoast';
import InputError from '@/Components/InputError.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);
const toast = useToast();

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            toast.add({ severity: 'success', summary: 'Success', detail: 'Password updated successfully', life: 3000 });
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <Card class="shadow-sm border border-slate-100 rounded-xl bg-white overflow-hidden h-full">
        <template #header>
            <div class="bg-slate-900 text-white px-4 py-3 font-semibold flex items-center gap-2">
                <i class="pi pi-lock text-sm" /> 
            </div>
        </template>
        <template #content>
            <form @submit.prevent="updatePassword" class="space-y-6 mt-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <InputText
                        id="current_password"
                        ref="currentPasswordInput"
                        v-model="form.current_password"
                        type="password"
                        class="w-full"
                        placeholder="Current password"
                        autocomplete="current-password"
                    />
                    <InputError :message="form.errors.current_password" class="mt-2" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <InputText
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="w-full"
                        placeholder="New password"
                        autocomplete="new-password"
                    />
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <InputText
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="w-full"
                        placeholder="Confirm password"
                        autocomplete="new-password"
                    />
                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
                </div>

                <div>
                    <Button type="submit" label="Update Password" icon="pi pi-key" :loading="form.processing" class="w-full bg-slate-900 border-none text-white hover:bg-slate-800" />
                </div>
            </form>
        </template>
    </Card>
</template>
