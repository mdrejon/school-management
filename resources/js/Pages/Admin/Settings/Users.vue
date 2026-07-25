<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Select from 'primevue/select';
import Tag from 'primevue/tag';

const props = defineProps({
    users: {
        type: Array,
        required: true,
    },
    roles: {
        type: Array,
        required: true,
    },
});

const confirm = useConfirm();

const showDialog = ref(false);
const editing = ref(null);

const form = useForm({
    name: '',
    email: '',
    password: '',
    role: null,
});

const openCreate = () => {
    editing.value = null;
    form.reset();
    form.clearErrors();
    showDialog.value = true;
};

const openEdit = (user) => {
    editing.value = user;
    form.clearErrors();
    form.name = user.name;
    form.email = user.email;
    form.password = '';
    form.role = user.role ?? null;
    showDialog.value = true;
};

const submit = () => {
    if (editing.value) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.settings.users.update', editing.value.id), {
            onSuccess: () => (showDialog.value = false),
        });
    } else {
        form.post(route('admin.settings.users.store'), {
            onSuccess: () => (showDialog.value = false),
        });
    }
};

const confirmDelete = (user) => {
    confirm.require({
        message: `Remove ${user.name}? They'll immediately lose access to the admin panel.`,
        header: 'Remove user',
        icon: 'pi pi-exclamation-triangle',
        acceptProps: { label: 'Remove', severity: 'danger' },
        rejectProps: { label: 'Cancel', severity: 'secondary', outlined: true },
        accept: () => router.delete(route('admin.settings.users.destroy', user.id), { preserveScroll: true }),
    });
};
</script>

<template>
    <AdminLayout title="Users & Roles">
        <Card class="shadow-sm">
            <template #title>
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <div class="text-lg font-semibold">Users & Roles</div>
                        <p class="text-sm font-normal text-slate-500 mt-1">
                            Admin panel accounts and the role each one is assigned. Manage what each role can
                            actually do on the <a :href="route('admin.settings.permissions.index')" class="text-indigo-600 hover:underline">Permissions</a> page.
                        </p>
                    </div>
                    <Button label="Add User" icon="pi pi-plus" @click="openCreate" />
                </div>
            </template>
            <template #content>
                <div class="overflow-x-auto">
                    <DataTable :value="users" data-key="id" size="small">
                        <Column header="User">
                            <template #body="{ data }">
                                <div class="font-medium text-slate-800">{{ data.name }}</div>
                                <div class="text-xs text-slate-500">{{ data.email }}</div>
                            </template>
                        </Column>

                        <Column header="Role">
                            <template #body="{ data }">
                                <Tag v-if="data.is_system_admin" value="System Admin" severity="warn" />
                                <Tag v-else-if="data.role" :value="data.role" severity="secondary" />
                                <span v-else class="text-xs text-slate-400">No role assigned</span>
                            </template>
                        </Column>

                        <Column header="" style="width: 100px">
                            <template #body="{ data }">
                                <div class="flex items-center gap-1 justify-end">
                                    <Button icon="pi pi-pencil" text rounded @click="openEdit(data)" />
                                    <Button
                                        icon="pi pi-trash"
                                        text
                                        rounded
                                        severity="danger"
                                        @click="confirmDelete(data)"
                                    />
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </template>
        </Card>

        <Dialog v-model:visible="showDialog" modal :header="editing ? 'Edit user' : 'Add user'" class="w-full max-w-md">
            <div class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                    <InputText v-model="form.name" class="w-full" />
                    <p v-if="form.errors.name" class="text-xs text-red-500 mt-1">{{ form.errors.name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <InputText v-model="form.email" type="email" class="w-full" />
                    <p v-if="form.errors.email" class="text-xs text-red-500 mt-1">{{ form.errors.email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Password {{ editing ? '(leave blank to keep current password)' : '' }}
                    </label>
                    <Password v-model="form.password" toggle-mask :feedback="false" class="w-full" input-class="w-full" />
                    <p v-if="form.errors.password" class="text-xs text-red-500 mt-1">{{ form.errors.password }}</p>
                </div>

                <div v-if="!editing?.is_system_admin">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                    <Select v-model="form.role" :options="roles" placeholder="Select a role" class="w-full" />
                    <p v-if="form.errors.role" class="text-xs text-red-500 mt-1">{{ form.errors.role }}</p>
                </div>
                <p v-else class="text-xs text-slate-400">
                    This account is a System Administrator — its access can't be changed from here.
                </p>
            </div>

            <template #footer>
                <Button label="Cancel" text severity="secondary" @click="showDialog = false" />
                <Button label="Save" :loading="form.processing" @click="submit" />
            </template>
        </Dialog>
    </AdminLayout>
</template>
