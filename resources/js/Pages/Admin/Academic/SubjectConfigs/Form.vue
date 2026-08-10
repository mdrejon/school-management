<script setup>
import { ref, computed } from 'vue';
import { useForm, Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Checkbox from 'primevue/checkbox';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    configs: Array,
    classes: Array,
    groups: Array,
    subjects: Array,
});

const confirm = useConfirm();

const selectedClass = ref(null);
const selectedGroup = ref(null);
const selectedSubjects = ref([]);

const form = useForm({
    academic_class_id: null,
    academic_group_id: null,
    subject_ids: [],
});

const currentConfigs = computed(() => {
    return props.configs.filter(c => 
        c.academic_class_id === selectedClass.value && 
        c.academic_group_id === selectedGroup.value
    );
});

const availableSubjects = computed(() => {
    // Show subjects that belong to the selected class (or have no class assigned?)
    // Actually, usually a school assigns specific subjects to specific classes.
    // Let's just show all subjects or subjects matching the class
    const existingSubjectIds = currentConfigs.value.map(c => c.subject_id);
    return props.subjects.filter(s => !existingSubjectIds.includes(s.id));
});

const submit = () => {
    if (!selectedClass.value) return;

    form.academic_class_id = selectedClass.value;
    form.academic_group_id = selectedGroup.value;
    form.subject_ids = selectedSubjects.value;

    form.post(route('admin.academic.subject-configs.store'), {
        onSuccess: () => {
            selectedSubjects.value = [];
        }
    });
};

const updateConfig = (config) => {
    router.put(route('admin.academic.subject-configs.update', config.id), {
        subject_type: config.subject_type,
        serial_no: config.serial_no,
        merge_id: config.merge_id,
    }, {
        preserveScroll: true,
    });
};

const deleteConfig = (config) => {
    confirm.require({
        message: 'Are you sure you want to remove this subject configuration?',
        header: 'Confirm Deletion',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.delete(route('admin.academic.subject-configs.destroy', config.id), {
                preserveScroll: true,
            });
        }
    });
};
</script>

<template>
    <AdminLayout title="Subject Config">
        <Head title="Subject Config" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Subject Config</h1>
            <p class="text-sm text-slate-500 mt-1">Home - Subject-config - Create</p>
        </div>

        <Card class="shadow-sm border-none mb-6">
            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Class</label>
                        <Dropdown v-model="selectedClass" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-slate-50 border-slate-200" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1.5">Group</label>
                        <Dropdown v-model="selectedGroup" :options="groups" optionLabel="name" optionValue="id" placeholder="Select Group" class="w-full bg-slate-50 border-slate-200" showClear />
                    </div>
                </div>

                <div v-if="selectedClass">
                    <label class="block text-sm font-medium text-red-500 mb-4">Subject Choice *</label>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div v-for="subject in availableSubjects" :key="subject.id" class="flex items-center">
                            <Checkbox v-model="selectedSubjects" :inputId="'subject' + subject.id" name="subject" :value="subject.id" />
                            <label :for="'subject' + subject.id" class="ml-2 text-sm text-slate-700">{{ subject.name }} - {{ subject.code }}</label>
                        </div>
                        <div v-if="availableSubjects.length === 0" class="text-sm text-slate-500">
                            No additional subjects available to add for this class.
                        </div>
                    </div>

                    <Button label="Save" class="!bg-sky-500 !border-sky-500 px-8" @click="submit" :loading="form.processing" :disabled="selectedSubjects.length === 0" />
                </div>
                <div v-else class="text-sm text-slate-500 text-center py-4">
                    Please select a Class to configure subjects.
                </div>
            </template>
        </Card>

        <Card class="shadow-sm border-none" v-if="selectedClass && currentConfigs.length > 0">
            <template #content>
                <DataTable :value="currentConfigs" class="p-datatable-sm mt-4">
                    <Column header="Subject">
                        <template #body="{ data }">
                            {{ data.subject?.name }} - {{ data.subject?.code }}
                        </template>
                    </Column>
                    <Column header="Subject Type">
                        <template #body="{ data }">
                            <InputText v-model="data.subject_type" class="w-full bg-slate-50 border-slate-200" @blur="updateConfig(data)" />
                        </template>
                    </Column>
                    <Column header="Subject Serial">
                        <template #body="{ data }">
                            <InputText v-model="data.serial_no" class="w-full bg-slate-50 border-slate-200" @blur="updateConfig(data)" />
                        </template>
                    </Column>
                    <Column header="Merge ID">
                        <template #body="{ data }">
                            <InputText v-model="data.merge_id" class="w-full bg-slate-50 border-slate-200" @blur="updateConfig(data)" />
                        </template>
                    </Column>
                    <Column header="Action" :exportable="false" style="width: 10%">
                        <template #body="{ data }">
                            <Button icon="pi pi-trash" severity="danger" size="small" @click="deleteConfig(data)" />
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </AdminLayout>
</template>
