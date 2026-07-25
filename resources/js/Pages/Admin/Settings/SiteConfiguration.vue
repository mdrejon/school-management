<script setup>
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import ToggleSwitch from 'primevue/toggleswitch';
import Tag from 'primevue/tag';

const props = defineProps({
    modules: {
        type: Array,
        required: true,
    },
});

// One shared form array keyed the same order as props.modules — each row's
// `is_enabled`/`show_on_homepage` are bound directly as v-model targets, and
// the whole array is submitted in one PUT on save (no per-row round-trip).
const form = useForm({
    modules: props.modules.map((module) => ({
        key: module.key,
        is_enabled: module.is_enabled,
        show_on_homepage: module.show_on_homepage,
    })),
});

const sectionRows = computed(() => form.modules.filter((_, index) => props.modules[index].section));
const standaloneRows = computed(() => form.modules.filter((_, index) => !props.modules[index].section));

const metaFor = (key) => props.modules.find((module) => module.key === key);

// Disabling a module also implies it can't show on the homepage — keep the
// two toggles consistent client-side rather than letting them drift until save.
const onToggleEnabled = (row, value) => {
    row.is_enabled = value;
    if (!value) {
        row.show_on_homepage = false;
    }
};

const submit = () => {
    form.put(route('admin.settings.modules.update'), { preserveScroll: true });
};
</script>

<template>
    <AdminLayout title="Site Configuration">
        <Card class="shadow-sm">
            <template #title>
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <div class="text-lg font-semibold">Site Configuration</div>
                        <p class="text-sm font-normal text-slate-500 mt-1">
                            Developer-level switches for which modules exist on this site at all, and — for
                            homepage sections — whether they show on the homepage. Disabling a module hides it
                            from the admin sidebar and 404s its public (and admin) routes entirely; it isn't a
                            per-user permission, it's a kill switch for features this client's site doesn't use.
                        </p>
                    </div>
                    <Button label="Save Changes" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
            <template #content>
                <div class="mb-8">
                    <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-wide mb-2">Homepage Sections</h3>
                    <p class="text-xs text-slate-500 mb-3">
                        These also have their own list/detail pages — turning off "Show on Homepage" only hides
                        the homepage teaser, the module and its pages stay reachable. Turning off "Enabled"
                        removes the module entirely, including its homepage teaser.
                    </p>
                    <div class="overflow-x-auto">
                        <DataTable :value="sectionRows" data-key="key" size="small">
                            <Column header="Module">
                                <template #body="{ data }">
                                    <div class="font-medium text-slate-800">{{ metaFor(data.key).label }}</div>
                                    <Tag v-if="metaFor(data.key).route" value="Has public pages" severity="secondary" class="mt-1" />
                                </template>
                            </Column>
                            <Column header="Enabled" style="width: 160px">
                                <template #body="{ data }">
                                    <ToggleSwitch
                                        :model-value="data.is_enabled"
                                        @update:model-value="(v) => onToggleEnabled(data, v)"
                                    />
                                </template>
                            </Column>
                            <Column header="Show on Homepage" style="width: 180px">
                                <template #body="{ data }">
                                    <ToggleSwitch v-model="data.show_on_homepage" :disabled="!data.is_enabled" />
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-slate-700 uppercase tracking-wide mb-2">Standalone Modules</h3>
                    <p class="text-xs text-slate-500 mb-3">
                        No homepage teaser to toggle separately — enabled or fully off.
                    </p>
                    <div class="overflow-x-auto">
                        <DataTable :value="standaloneRows" data-key="key" size="small">
                            <Column header="Module">
                                <template #body="{ data }">
                                    <div class="font-medium text-slate-800">{{ metaFor(data.key).label }}</div>
                                </template>
                            </Column>
                            <Column header="Enabled" style="width: 160px">
                                <template #body="{ data }">
                                    <ToggleSwitch
                                        :model-value="data.is_enabled"
                                        @update:model-value="(v) => onToggleEnabled(data, v)"
                                    />
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
