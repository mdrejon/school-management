<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Editor from 'primevue/editor';
import DatePicker from 'primevue/datepicker';
import ToggleSwitch from 'primevue/toggleswitch';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';

const props = defineProps({
    notice: {
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

const form = useForm({
    slug: props.notice?.slug ?? '',
    title: { ...emptyTranslatable(), ...props.notice?.title },
    description: { ...emptyTranslatable(), ...props.notice?.description },
    pdf: null,
    published_at: props.notice?.published_at ? new Date(props.notice.published_at) : new Date(),
    is_active: props.notice?.is_active ?? true,
});

const existingPdfName = ref(props.notice?.pdf ? props.notice.pdf.split('/').pop() : null);
const onPdfSelected = (event) => {
    const file = event.target.files?.[0];
    if (file) {
        form.pdf = file;
        form.clearErrors('pdf');
        existingPdfName.value = file.name;
    }
};

const submit = () => {
    const transform = (data) => ({
        ...data,
        published_at: data.published_at ? new Date(data.published_at).toISOString().slice(0, 10) : null,
    });

    if (props.notice) {
        form.transform((data) => ({ ...transform(data), _method: 'put' })).post(route('admin.cms.notices.update', props.notice.id), {
            forceFormData: true,
        });
    } else {
        form.transform(transform).post(route('admin.cms.notices.store'), {
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AdminLayout :title="notice ? 'Edit Notice' : 'Add Notice'">
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-slate-500">
                {{ notice ? 'Update this notice.' : 'Add a new notice shown in the header ticker and the public notices pages.' }}
            </p>
            <Link :href="route('admin.cms.notices.index')" class="text-sm text-indigo-600 hover:underline">&larr; Back to notices</Link>
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
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">
                                    Title {{ currentLang?.is_default ? '(required)' : '' }}
                                </label>
                                <InputText v-model="form.title[activeLang]" :dir="currentLang?.direction" class="w-full" placeholder="e.g. Mid-Term Examination Routine 2026" />
                                <p v-if="form.errors[`title.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`title.${activeLang}`] }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1.5">Publish date (required)</label>
                                <DatePicker v-model="form.published_at" date-format="yy-mm-dd" show-icon icon-display="input" class="w-full" input-class="w-full" />
                                <p v-if="form.errors.published_at" class="text-xs text-red-500 mt-1">{{ form.errors.published_at }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1.5">Slug (URL)</label>
                            <InputText v-model="form.slug" class="w-full max-w-sm" placeholder="auto-generated from title if left blank" />
                            <p v-if="form.errors.slug" class="text-xs text-red-500 mt-1">{{ form.errors.slug }}</p>
                        </div>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Description</h3>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">
                            Description {{ currentLang?.is_default ? '(required)' : '' }}
                        </label>
                        <Editor v-model="form.description[activeLang]" :editor-style="`height: 260px; direction: ${currentLang?.direction ?? 'ltr'};`" />
                        <p v-if="form.errors[`description.${activeLang}`]" class="text-xs text-red-500 mt-1">{{ form.errors[`description.${activeLang}`] }}</p>
                    </section>

                    <section class="rounded-xl border border-slate-200 p-5">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Attachment</h3>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">PDF document</label>
                        <input type="file" class="w-full text-sm" accept=".pdf" @change="onPdfSelected" />
                        <p v-if="existingPdfName" class="text-xs text-slate-500 mt-1">Current: {{ existingPdfName }}</p>
                        <p class="text-xs text-slate-400 mt-1">Optional — lets visitors download the full notice as a PDF from the list and detail pages.</p>
                        <p v-if="form.errors.pdf" class="text-xs text-red-500 mt-1">{{ form.errors.pdf }}</p>
                    </section>

                    <div class="flex items-center gap-2">
                        <ToggleSwitch v-model="form.is_active" />
                        <span class="text-sm text-slate-600">Active</span>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-200 flex justify-end gap-2">
                    <Link :href="route('admin.cms.notices.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" />
                    </Link>
                    <Button label="Save" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
