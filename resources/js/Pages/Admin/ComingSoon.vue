<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';

defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <AdminLayout :title="title">
        <Card class="shadow-sm">
            <template #content>
                <div class="flex flex-col items-center justify-center text-center py-16">
                    <div class="size-16 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center mb-4">
                        <i class="pi pi-hammer text-3xl" />
                    </div>
                    <h2 class="text-lg font-semibold text-slate-800">{{ title }}</h2>
                    <p class="text-slate-500 mt-1 max-w-md">
                        This module is on the roadmap and not built out yet. The route and navigation are wired up so you can plug in the real feature next.
                    </p>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
