<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Calendar from 'primevue/calendar';

const form = useForm({
    date: '',
    subject: '',
    note: '',
    file: null,
});

const handleFileChange = (event) => {
    form.file = event.target.files[0];
};

const submit = () => {
    // Convert date object to string if necessary
    const submissionData = { ...form };
    if (submissionData.date && typeof submissionData.date !== 'string') {
        submissionData.date = submissionData.date.toISOString().slice(0, 10);
    }

    form.transform((data) => ({
        ...data,
        date: submissionData.date,
    })).post(route('teacher.prayers.store'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <TeacherLayout title="Application for prayer">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Prayer</h1>
                <p class="text-sm text-gray-500">Home - Prayers - Create</p>
            </div>
            <Link :href="route('teacher.prayers.index')">
                <Button label="Prayer List" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600" />
            </Link>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white max-w-4xl">
            <template #title>
                <h2 class="text-xl font-bold text-slate-800 pb-2">Application for prayer</h2>
            </template>
            <template #content>
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <Calendar v-model="form.date" dateFormat="yy-mm-dd" showIcon class="w-full md:w-1/2" required />
                        <div v-if="form.errors.date" class="text-red-500 text-xs mt-1">{{ form.errors.date }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <InputText v-model="form.subject" class="w-full border-gray-300" required />
                        <div v-if="form.errors.subject" class="text-red-500 text-xs mt-1">{{ form.errors.subject }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                        <Textarea v-model="form.note" rows="5" class="w-full border-gray-300" />
                        <div v-if="form.errors.note" class="text-red-500 text-xs mt-1">{{ form.errors.note }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">File</label>
                        <input type="file" @change="handleFileChange" class="w-full md:w-1/2 border border-gray-300 rounded-md p-2 bg-white text-sm" />
                        <div v-if="form.errors.file" class="text-red-500 text-xs mt-1">{{ form.errors.file }}</div>
                    </div>

                    <div class="mt-4">
                        <Button type="submit" label="Prayer" :loading="form.processing" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600 px-8" />
                    </div>
                </form>
            </template>
        </Card>
    </TeacherLayout>
</template>
