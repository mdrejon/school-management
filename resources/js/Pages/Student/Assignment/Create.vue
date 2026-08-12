<script setup>
import { ref, computed } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import Card from 'primevue/card';
import Dropdown from 'primevue/dropdown';
import Textarea from 'primevue/textarea';
import Button from 'primevue/button';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';

const props = defineProps({
    assignments: Array
});

const toast = useToast();

const assignmentOptions = computed(() => {
    return props.assignments.map(a => ({
        label: `${a.title} - ${a.subject?.name || 'No Subject'}`,
        value: a.id
    }));
});

const form = useForm({
    assignment_id: null,
    notes: '',
    files: [null, null] // Array with two elements for the two file inputs
});

const fileInputs = ref([null, null]);

const handleFileUpload = (event, index) => {
    const file = event.target.files[0];
    if (file) {
        form.files[index] = file;
    } else {
        form.files[index] = null;
    }
};

const submit = () => {
    // Filter out nulls from files array before submitting
    const dataToSubmit = {
        assignment_id: form.assignment_id,
        notes: form.notes,
        files: form.files.filter(f => f !== null)
    };

    // Need to use manual router post or form.post with transform?
    // transform is cleaner
    form.transform((data) => ({
        ...data,
        files: data.files.filter(f => f !== null)
    })).post(route('student.assignments.store'), {
        preserveScroll: true,
        onSuccess: () => {
            // Reset form but keep assignment dropdown maybe?
            form.reset('notes', 'files');
            // reset file input DOM elements
            fileInputs.value.forEach(input => {
                if (input) input.value = '';
            });
            toast.add({ severity: 'success', summary: 'Success', detail: 'Assignment submitted successfully', life: 3000 });
        },
        onError: () => {
            toast.add({ severity: 'error', summary: 'Error', detail: 'Failed to submit assignment', life: 3000 });
        }
    });
};
</script>

<template>
    <StudentLayout title="Assignment Submit">
        <Head title="Assignment Submit" />
        <Toast />
        
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-slate-800">Assignment</h2>
        </div>

        <Card class="shadow-sm">
            <template #title>Assignment</template>
            <template #content>
                <form @submit.prevent="submit" class="space-y-4">
                    
                    <div>
                        <Dropdown 
                            v-model="form.assignment_id" 
                            :options="assignmentOptions" 
                            optionLabel="label" 
                            optionValue="value" 
                            placeholder="-- Selected Assignment --" 
                            class="w-full"
                            :class="{'p-invalid': form.errors.assignment_id}"
                        />
                        <small class="text-red-500 block mt-1" v-if="form.errors.assignment_id">{{ form.errors.assignment_id }}</small>
                    </div>

                    <div>
                        <Textarea 
                            v-model="form.notes" 
                            rows="4" 
                            class="w-full" 
                            placeholder="Enter your notes or assignment content here..."
                            :class="{'p-invalid': form.errors.notes}"
                        />
                        <small class="text-red-500 block mt-1" v-if="form.errors.notes">{{ form.errors.notes }}</small>
                    </div>

                    <!-- Looks like screenshot repeats Selected Assignment, but maybe it's just a visual artifact. 
                         I'll put the file inputs. -->
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-slate-700">File (Optional)</label>
                        <div class="flex items-center gap-4">
                            <input 
                                type="file" 
                                @change="e => handleFileUpload(e, 0)" 
                                ref="fileInputs" 
                                class="text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-slate-100 file:text-slate-700
                                hover:file:bg-slate-200"
                            />
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-medium text-slate-700">File (Optional)</label>
                        <div class="flex items-center gap-4">
                            <input 
                                type="file" 
                                @change="e => handleFileUpload(e, 1)" 
                                ref="fileInputs" 
                                class="text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-slate-100 file:text-slate-700
                                hover:file:bg-slate-200"
                            />
                        </div>
                    </div>

                    <div class="pt-4">
                        <Button 
                            label="Submit Assignment" 
                            type="submit" 
                            :loading="form.processing" 
                            class="!bg-[#0ea5e9] !border-[#0ea5e9] hover:!bg-[#0284c7]" 
                        />
                    </div>
                </form>
            </template>
        </Card>
    </StudentLayout>
</template>
