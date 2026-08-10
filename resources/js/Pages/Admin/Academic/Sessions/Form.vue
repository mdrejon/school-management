<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import ToggleSwitch from 'primevue/toggleswitch';

const props = defineProps({
    session: Object
});

const form = useForm({
    name: props.session?.name || '',
    year: props.session?.year || '',
    is_active: props.session?.is_active ? true : false,
});

const submit = () => {
    if (props.session) {
        form.put(route('admin.academic.sessions.update', props.session.id));
    } else {
        form.post(route('admin.academic.sessions.store'));
    }
};

const reset = () => {
    form.reset();
};
</script>

<template>
    <AdminLayout :title="session ? 'Edit Session' : 'Create Session'">
        <Head :title="session ? 'Edit Session' : 'Create Session'" />

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Academic/Session Year</h1>
                <p class="text-sm text-slate-500 mt-1">Home - Academic-years - {{ session ? 'Edit' : 'Create' }}</p>
            </div>
        </div>

        <Card class="shadow-sm border-none max-w-2xl">
            <template #content>
                <form @submit.prevent="submit" class="flex flex-col gap-5">
                    
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Session Name</label>
                        <InputText v-model="form.name" class="w-full bg-slate-50 border-slate-200" placeholder="e.g. 2025" :class="{ 'p-invalid': form.errors.name }" />
                        <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Academic Year</label>
                        <InputText v-model="form.year" class="w-full bg-slate-50 border-slate-200" placeholder="e.g. 2024-2025" :class="{ 'p-invalid': form.errors.year }" />
                        <p v-if="form.errors.year" class="text-xs text-red-500 mt-1">{{ form.errors.year }}</p>
                    </div>

                    <div class="flex items-center gap-2 mt-2">
                        <ToggleSwitch v-model="form.is_active" />
                        <span class="text-sm text-slate-600">Active Session</span>
                    </div>

                    <div class="mt-4 flex gap-2">
                        <Button type="button" label="Reset" severity="danger" @click="reset" />
                        <Button type="submit" label="Save" :loading="form.processing" />
                    </div>
                </form>
            </template>
        </Card>
    </AdminLayout>
</template>
