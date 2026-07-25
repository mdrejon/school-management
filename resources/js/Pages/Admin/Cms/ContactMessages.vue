<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Tag from 'primevue/tag';

const props = defineProps({
    messages: {
        type: Array,
        required: true,
    },
});

const confirm = useConfirm();

const showDialog = ref(false);
const viewing = ref(null);

const open = (message) => {
    viewing.value = message;
    showDialog.value = true;
    if (!message.read_at) {
        router.patch(route('admin.cms.contact-messages.read', message.id), {}, {
            preserveScroll: true,
            onSuccess: () => { message.read_at = new Date().toISOString(); },
        });
    }
};

const confirmDelete = (message) => {
    confirm.require({
        message: 'Remove this message? This can\'t be undone.',
        header: 'Remove message',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.cms.contact-messages.destroy', message.id), { preserveScroll: true }),
    });
};

const formatDate = (value) => new Date(value).toLocaleString(undefined, {
    year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit',
});
</script>

<template>
    <AdminLayout title="Contact Messages">
        <p class="text-sm text-slate-500 mb-6">
            Submissions from the public /contact page's "Get In Touch" form.
        </p>

        <Card class="shadow-sm">
            <template #title>
                <div class="text-lg font-semibold">Inbox</div>
            </template>
            <template #content>
                <div class="overflow-x-auto">
                    <DataTable :value="messages" data-key="id" size="small">
                        <Column header="" style="width: 40px">
                            <template #body="{ data }">
                                <span v-if="!data.read_at" class="block w-2 h-2 rounded-full bg-indigo-500" title="Unread"></span>
                            </template>
                        </Column>

                        <Column header="From">
                            <template #body="{ data }">
                                <div :class="['text-sm', !data.read_at ? 'font-semibold text-slate-800' : 'text-slate-600']">{{ data.name }}</div>
                                <div class="text-xs text-slate-400">{{ data.email }}</div>
                            </template>
                        </Column>

                        <Column header="Subject">
                            <template #body="{ data }">
                                <span :class="!data.read_at ? 'font-semibold text-slate-800' : 'text-slate-600'">{{ data.subject }}</span>
                            </template>
                        </Column>

                        <Column header="Received" style="width: 180px">
                            <template #body="{ data }">
                                <span class="text-xs text-slate-500">{{ formatDate(data.created_at) }}</span>
                            </template>
                        </Column>

                        <Column header="" style="width: 100px">
                            <template #body="{ data }">
                                <div class="flex items-center gap-1 justify-end">
                                    <Button icon="pi pi-eye" text rounded @click="open(data)" />
                                    <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDelete(data)" />
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                    <p v-if="!messages.length" class="text-sm text-slate-400 text-center py-6">No messages yet.</p>
                </div>
            </template>
        </Card>

        <Dialog v-model:visible="showDialog" modal header="Message" class="w-full max-w-xl">
            <div v-if="viewing" class="flex flex-col gap-3">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-slate-800">{{ viewing.name }}</div>
                        <a :href="`mailto:${viewing.email}`" class="text-xs text-indigo-600 hover:underline">{{ viewing.email }}</a>
                    </div>
                    <Tag v-if="viewing.read_at" value="Read" severity="secondary" />
                    <Tag v-else value="Unread" severity="info" />
                </div>
                <div>
                    <div class="text-xs font-medium text-slate-500 mb-1">Subject</div>
                    <div class="text-sm text-slate-800">{{ viewing.subject }}</div>
                </div>
                <div>
                    <div class="text-xs font-medium text-slate-500 mb-1">Message</div>
                    <p class="text-sm text-slate-700 whitespace-pre-line">{{ viewing.message }}</p>
                </div>
                <div class="text-xs text-slate-400">Received {{ formatDate(viewing.created_at) }}</div>
            </div>
        </Dialog>
    </AdminLayout>
</template>
