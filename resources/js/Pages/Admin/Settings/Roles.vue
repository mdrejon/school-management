<script setup>
import { router, Link } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Tag from 'primevue/tag';

defineProps({
    roles: {
        type: Array,
        required: true,
    },
});

const confirm = useConfirm();

const confirmDelete = (role) => {
    confirm.require({
        message: role.users_count > 0
            ? `${role.users_count} user(s) currently have the "${role.name}" role — reassign them first.`
            : `Remove the "${role.name}" role? This can't be undone.`,
        header: 'Remove role',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger', disabled: role.users_count > 0 },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => {
            if (role.users_count === 0) {
                router.delete(route('admin.settings.permissions.destroy', role.id), { preserveScroll: true });
            }
        },
    });
};
</script>

<template>
    <AdminLayout title="Permissions">
        <Card class="shadow-sm">
            <template #title>
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <div class="text-lg font-semibold">Permissions</div>
                        <p class="text-sm font-normal text-slate-500 mt-1">
                            Roles and what each one is allowed to do across the admin panel. Assign a role to a
                            user on the <a :href="route('admin.settings.users.index')" class="text-indigo-600 hover:underline">Users & Roles</a> page.
                        </p>
                    </div>
                    <Link :href="route('admin.settings.permissions.create')">
                        <Button label="Add Role" icon="pi pi-plus" as="span" />
                    </Link>
                </div>
            </template>
            <template #content>
                <div class="overflow-x-auto">
                    <DataTable :value="roles" data-key="id" size="small">
                        <Column header="Role">
                            <template #body="{ data }">
                                <div class="font-medium text-slate-800 capitalize">{{ data.name }}</div>
                            </template>
                        </Column>

                        <Column header="Users">
                            <template #body="{ data }">
                                <Tag :value="data.users_count" severity="secondary" />
                            </template>
                        </Column>

                        <Column header="Permissions granted">
                            <template #body="{ data }">
                                {{ data.permissions_count }}
                            </template>
                        </Column>

                        <Column header="" style="width: 100px">
                            <template #body="{ data }">
                                <div class="flex items-center gap-1 justify-end">
                                    <Link :href="route('admin.settings.permissions.edit', data.id)">
                                        <Button icon="pi pi-pencil" text rounded as="span" />
                                    </Link>
                                    <Button icon="pi pi-trash" text rounded severity="danger" @click="confirmDelete(data)" />
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </template>
        </Card>
    </AdminLayout>
</template>
