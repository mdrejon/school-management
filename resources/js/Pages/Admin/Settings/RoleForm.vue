<script setup>
import { reactive, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Checkbox from 'primevue/checkbox';

const props = defineProps({
    role: {
        type: Object,
        default: null,
    },
    catalog: {
        type: Array,
        required: true,
    },
});

// One column per action that appears ANYWHERE in the catalog, so the matrix
// stays visually aligned even though most resources only support a subset
// (e.g. Website Options has no create/delete) — a resource just leaves that
// cell blank rather than every resource needing all four.
const actionColumns = ['view', 'create', 'edit', 'delete'];

const actionFor = (resource, action) => resource.actions.find((a) => a.action === action);

// Flat { "courses.view": true, ... } map driving the checkboxes, seeded from
// the catalog's `granted` flags (already computed server-side per role).
const checked = reactive(
    Object.fromEntries(
        props.catalog.flatMap((resource) => resource.actions.map((a) => [a.permission, a.granted])),
    ),
);

const allChecked = computed({
    get: () => Object.values(checked).every(Boolean),
    set: (value) => Object.keys(checked).forEach((key) => (checked[key] = value)),
});

const form = useForm({
    name: props.role?.name ?? '',
});

const submit = () => {
    const permissions = Object.keys(checked).filter((key) => checked[key]);

    if (props.role) {
        form.transform((data) => ({ ...data, permissions, _method: 'put' })).post(
            route('admin.settings.permissions.update', props.role.id),
        );
    } else {
        form.transform((data) => ({ ...data, permissions })).post(route('admin.settings.permissions.store'));
    }
};
</script>

<template>
    <AdminLayout :title="role ? `Edit Role — ${role.name}` : 'Add Role'">
        <Card class="shadow-sm">
            <template #title>
                <div class="text-lg font-semibold">{{ role ? 'Edit role' : 'Add role' }}</div>
                <p class="text-sm font-normal text-slate-500 mt-1">
                    Pick exactly what this role is allowed to view, create, edit, or delete across the admin
                    panel — a module a role has no permission for simply won't show that action.
                </p>
            </template>
            <template #content>
                <div class="max-w-sm mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Role name</label>
                    <InputText v-model="form.name" class="w-full" placeholder="e.g. content_editor" />
                    <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                </div>

                <div class="flex items-center gap-2 mb-3">
                    <Checkbox v-model="allChecked" :binary="true" input-id="select-all" />
                    <label for="select-all" class="text-sm text-slate-600">Select / clear all</label>
                </div>

                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
                            <tr>
                                <th class="text-left px-4 py-2.5 font-medium">Module</th>
                                <th v-for="col in actionColumns" :key="col" class="px-4 py-2.5 font-medium text-center">{{ col }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="resource in catalog" :key="resource.key" class="border-t border-slate-100">
                                <td class="px-4 py-2.5 text-slate-700">{{ resource.label }}</td>
                                <td v-for="col in actionColumns" :key="col" class="px-4 py-2.5 text-center">
                                    <Checkbox
                                        v-if="actionFor(resource, col)"
                                        v-model="checked[actionFor(resource, col).permission]"
                                        :binary="true"
                                    />
                                    <span v-else class="text-slate-300">—</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pt-5 flex justify-end gap-2">
                    <a :href="route('admin.settings.permissions.index')" class="inline-flex">
                        <Button label="Cancel" text severity="secondary" as="span" />
                    </a>
                    <Button label="Save Role" icon="pi pi-check" :loading="form.processing" @click="submit" />
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
