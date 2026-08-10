<script setup>
import { ref, computed, watch } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from 'primevue/card';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import Checkbox from 'primevue/checkbox';
import InputText from 'primevue/inputtext';

const props = defineProps({
    classes: Array,
    globalExamCodes: Array,
    globalExamGrades: Array,
    globalExams: Array,
    classExamCodes: Array,
    classExamGrades: Array,
    classExams: Array,
});

// MERIT PROCESS TYPES
const meritProcessTypes = [
    { label: 'Total Mark(Sequential)', value: 'Total Mark(Sequential)' },
    { label: 'Grade Point(Sequential)', value: 'Grade Point(Sequential)' },
];

// FORMS
const formCodes = useForm({
    class_id: '',
    global_exam_code_ids: [],
});

const formGrades = useForm({
    class_id: '',
    global_exam_grade_ids: [],
});

const formExams = useForm({
    class_id: '',
    global_exam_id: '',
    merit_type: '',
});

// WATCHERS TO PRE-FILL CHECKBOXES
watch(() => formCodes.class_id, (newClassId) => {
    if (newClassId) {
        formCodes.global_exam_code_ids = props.classExamCodes
            .filter(c => c.class_id === newClassId)
            .map(c => c.global_exam_code_id);
    } else {
        formCodes.global_exam_code_ids = [];
    }
});

watch(() => formGrades.class_id, (newClassId) => {
    if (newClassId) {
        formGrades.global_exam_grade_ids = props.classExamGrades
            .filter(c => c.class_id === newClassId)
            .map(c => c.global_exam_grade_id);
    } else {
        formGrades.global_exam_grade_ids = [];
    }
});

// DATATABLE SEARCH & ENTRIES
const searchCodes = ref('');
const searchGrades = ref('');
const searchExams = ref('');

const filteredClassExamCodes = computed(() => {
    if (!searchCodes.value) return props.classExamCodes;
    return props.classExamCodes.filter(c => 
        c.academic_class.name.toLowerCase().includes(searchCodes.value.toLowerCase()) ||
        c.global_exam_code.title.toLowerCase().includes(searchCodes.value.toLowerCase())
    );
});

const filteredClassExamGrades = computed(() => {
    if (!searchGrades.value) return props.classExamGrades;
    return props.classExamGrades.filter(c => 
        c.academic_class.name.toLowerCase().includes(searchGrades.value.toLowerCase()) ||
        c.global_exam_grade.grade.toLowerCase().includes(searchGrades.value.toLowerCase())
    );
});

const filteredClassExams = computed(() => {
    if (!searchExams.value) return props.classExams;
    return props.classExams.filter(c => 
        c.academic_class.name.toLowerCase().includes(searchExams.value.toLowerCase()) ||
        c.global_exam.name.toLowerCase().includes(searchExams.value.toLowerCase()) ||
        c.merit_type.toLowerCase().includes(searchExams.value.toLowerCase())
    );
});

// SUBMIT HANDLERS
const submitCodes = () => {
    formCodes.post(route('admin.exam-startup.storeCodes'), { preserveScroll: true });
};

const submitGrades = () => {
    formGrades.post(route('admin.exam-startup.storeGrades'), { preserveScroll: true });
};

const submitExams = () => {
    formExams.post(route('admin.exam-startup.storeExams'), { preserveScroll: true });
};
</script>

<template>
    <AdminLayout title="Exam Startup">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Exam Startup</h1>
            <p class="text-sm text-gray-500">Home - Semester-exam-settings-exam-startup</p>
        </div>

        <Card class="shadow-sm border border-slate-100 rounded-xl bg-white">
            <template #content>
                <TabView>
                    <!-- TAB 1: EXAM CODE -->
                    <TabPanel header="Exam Code">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-4">
                            <!-- Left: Form -->
                            <div class="lg:col-span-1 border-r pr-4">
                                <form @submit.prevent="submitCodes">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Class <span class="text-red-500">*</span></label>
                                        <Dropdown v-model="formCodes.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-gray-50" required />
                                        <div v-if="formCodes.errors.class_id" class="text-red-500 text-xs mt-1">{{ formCodes.errors.class_id }}</div>
                                    </div>

                                    <div class="mb-2">
                                        <label class="block text-sm font-bold text-gray-700 mb-4">Select Global Exam Code List <span class="text-red-500">*</span></label>
                                        <div class="grid grid-cols-4 gap-2 mb-2 font-semibold text-xs text-gray-600">
                                            <div class="col-span-1">Code Title</div>
                                            <div class="col-span-1 text-center">Total Marks</div>
                                            <div class="col-span-1 text-center">Pass Mark</div>
                                            <div class="col-span-1 text-center">Acceptance</div>
                                        </div>
                                        
                                        <div v-for="code in globalExamCodes" :key="code.id" class="grid grid-cols-4 gap-2 mb-3 items-center">
                                            <div class="col-span-1 flex items-center gap-2">
                                                <Checkbox v-model="formCodes.global_exam_code_ids" :value="code.id" />
                                                <label class="text-sm text-gray-700">{{ code.title }}</label>
                                            </div>
                                            <div class="col-span-1 text-center text-sm text-gray-600">{{ Number(code.total_marks).toFixed(2) }}</div>
                                            <div class="col-span-1 text-center text-sm text-gray-600">{{ Number(code.pass_marks).toFixed(2) }}</div>
                                            <div class="col-span-1 text-center text-sm text-gray-600">{{ Number(code.acceptance).toFixed(2) }}</div>
                                        </div>
                                        <div v-if="formCodes.errors.global_exam_code_ids" class="text-red-500 text-xs mt-1">{{ formCodes.errors.global_exam_code_ids }}</div>
                                    </div>
                                    
                                    <div class="flex justify-end mt-6">
                                        <Button type="submit" label="Save" :loading="formCodes.processing" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600 px-6" />
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Right: Datatable -->
                            <div class="lg:col-span-2 pl-2">
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Show</span>
                                        <Dropdown :options="[{label:'50', value:50}]" modelValue="50" optionLabel="label" optionValue="value" class="w-20 p-inputtext-sm" />
                                        <span class="text-sm text-gray-600">Entries</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Search</span>
                                        <InputText v-model="searchCodes" class="p-inputtext-sm" />
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 border-collapse">
                                        <thead class="text-xs text-gray-400 uppercase bg-transparent border-b">
                                            <tr>
                                                <th class="px-4 py-3"><Checkbox disabled /></th>
                                                <th class="px-4 py-3">CLASS</th>
                                                <th class="px-4 py-3">EXAM CODE TITLE</th>
                                                <th class="px-4 py-3 text-center">TOTAL MARKS</th>
                                                <th class="px-4 py-3 text-center">PASS MARKS</th>
                                                <th class="px-4 py-3 text-center">ACCEPTANCE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="row in filteredClassExamCodes" :key="row.id" class="border-b">
                                                <td class="px-4 py-4"><Checkbox disabled /></td>
                                                <td class="px-4 py-4 font-semibold text-gray-700">{{ row.academic_class.name }}</td>
                                                <td class="px-4 py-4"><span class="border rounded px-3 py-1 bg-white">{{ row.global_exam_code.title }}</span></td>
                                                <td class="px-4 py-4 text-center">{{ Number(row.global_exam_code.total_marks).toFixed(2) }}</td>
                                                <td class="px-4 py-4 text-center">{{ Number(row.global_exam_code.pass_marks).toFixed(2) }}</td>
                                                <td class="px-4 py-4 text-center">{{ Number(row.global_exam_code.acceptance).toFixed(2) }}</td>
                                            </tr>
                                            <tr v-if="filteredClassExamCodes.length === 0">
                                                <td colspan="6" class="text-center py-4">No data available</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </TabPanel>

                    <!-- TAB 2: EXAM GRADE -->
                    <TabPanel header="Exam Grade">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-4">
                            <!-- Left: Form -->
                            <div class="lg:col-span-1 border-r pr-4">
                                <form @submit.prevent="submitGrades">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Class <span class="text-red-500">*</span></label>
                                        <Dropdown v-model="formGrades.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-gray-50" required />
                                        <div v-if="formGrades.errors.class_id" class="text-red-500 text-xs mt-1">{{ formGrades.errors.class_id }}</div>
                                    </div>

                                    <div class="mb-2">
                                        <label class="block text-sm font-bold text-gray-700 mb-4">Select Global Exam Grade List <span class="text-red-500">*</span></label>
                                        <div class="grid grid-cols-2 gap-2 mb-2 font-semibold text-xs text-gray-600">
                                            <div class="col-span-1">Grade</div>
                                            <div class="col-span-1">Grade Range</div>
                                        </div>
                                        
                                        <div v-for="grade in globalExamGrades" :key="grade.id" class="grid grid-cols-2 gap-2 mb-3 items-center">
                                            <div class="col-span-1 flex items-center gap-2">
                                                <Checkbox v-model="formGrades.global_exam_grade_ids" :value="grade.id" />
                                                <label class="text-sm text-gray-700">{{ grade.grade }}</label>
                                            </div>
                                            <div class="col-span-1 text-sm text-gray-600">{{ grade.grade_range }}</div>
                                        </div>
                                        <div v-if="formGrades.errors.global_exam_grade_ids" class="text-red-500 text-xs mt-1">{{ formGrades.errors.global_exam_grade_ids }}</div>
                                    </div>
                                    
                                    <div class="flex justify-end mt-6">
                                        <Button type="submit" label="Save" :loading="formGrades.processing" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600 px-6" />
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Right: Datatable -->
                            <div class="lg:col-span-2 pl-2">
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Show</span>
                                        <Dropdown :options="[{label:'50', value:50}]" modelValue="50" optionLabel="label" optionValue="value" class="w-20 p-inputtext-sm" />
                                        <span class="text-sm text-gray-600">Entries</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Search</span>
                                        <InputText v-model="searchGrades" class="p-inputtext-sm" />
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 border-collapse">
                                        <thead class="text-xs text-gray-400 uppercase bg-transparent border-b">
                                            <tr>
                                                <th class="px-4 py-3"><Checkbox disabled /></th>
                                                <th class="px-4 py-3">CLASS</th>
                                                <th class="px-4 py-3 text-center">GRADE</th>
                                                <th class="px-4 py-3 text-center">GRADE RANGE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="row in filteredClassExamGrades" :key="row.id" class="border-b">
                                                <td class="px-4 py-4"><Checkbox disabled /></td>
                                                <td class="px-4 py-4 font-semibold text-gray-700">{{ row.academic_class.name }}</td>
                                                <td class="px-4 py-4 text-center"><span class="border rounded px-3 py-1 bg-white">{{ row.global_exam_grade.grade }}</span></td>
                                                <td class="px-4 py-4 text-center"><span class="border rounded px-3 py-1 bg-white">{{ row.global_exam_grade.grade_range }}</span></td>
                                            </tr>
                                            <tr v-if="filteredClassExamGrades.length === 0">
                                                <td colspan="4" class="text-center py-4">No data available</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </TabPanel>

                    <!-- TAB 3: EXAM CREATE -->
                    <TabPanel header="Exam Create">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-4">
                            <!-- Left: Form -->
                            <div class="lg:col-span-1 border-r pr-4">
                                <form @submit.prevent="submitExams">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Class <span class="text-red-500">*</span></label>
                                        <Dropdown v-model="formExams.class_id" :options="classes" optionLabel="name" optionValue="id" placeholder="Select Class" class="w-full bg-gray-50" required />
                                        <div v-if="formExams.errors.class_id" class="text-red-500 text-xs mt-1">{{ formExams.errors.class_id }}</div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Exam <span class="text-red-500">*</span></label>
                                        <Dropdown v-model="formExams.global_exam_id" :options="globalExams" optionLabel="name" optionValue="id" placeholder="Select Exam" class="w-full bg-gray-50" required />
                                        <div v-if="formExams.errors.global_exam_id" class="text-red-500 text-xs mt-1">{{ formExams.errors.global_exam_id }}</div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Merit Process Type <span class="text-red-500">*</span></label>
                                        <Dropdown v-model="formExams.merit_type" :options="meritProcessTypes" optionLabel="label" optionValue="value" placeholder="Select Merit Type" class="w-full bg-gray-50" required />
                                        <div v-if="formExams.errors.merit_type" class="text-red-500 text-xs mt-1">{{ formExams.errors.merit_type }}</div>
                                    </div>
                                    
                                    <div class="flex justify-end mt-6">
                                        <Button type="submit" label="Save" icon="pi pi-save" :loading="formExams.processing" class="bg-[#0ea5e9] border-none text-white hover:bg-sky-600 px-6" />
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Right: Datatable -->
                            <div class="lg:col-span-2 pl-2">
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Show</span>
                                        <Dropdown :options="[{label:'50', value:50}]" modelValue="50" optionLabel="label" optionValue="value" class="w-20 p-inputtext-sm" />
                                        <span class="text-sm text-gray-600">Entries</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600">Search</span>
                                        <InputText v-model="searchExams" class="p-inputtext-sm" />
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 border-collapse">
                                        <thead class="text-xs text-gray-400 uppercase bg-transparent border-b">
                                            <tr>
                                                <th class="px-4 py-3">CLASS</th>
                                                <th class="px-4 py-3">EXAM NAME</th>
                                                <th class="px-4 py-3 text-center">MERIT TYPE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="row in filteredClassExams" :key="row.id" class="border-b">
                                                <td class="px-4 py-4 font-semibold text-gray-700">{{ row.academic_class.name }}</td>
                                                <td class="px-4 py-4">{{ row.global_exam.name }}</td>
                                                <td class="px-4 py-4 text-center">{{ row.merit_type }}</td>
                                            </tr>
                                            <tr v-if="filteredClassExams.length === 0">
                                                <td colspan="3" class="text-center py-4">No data available</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </TabPanel>
                </TabView>
            </template>
        </Card>
    </AdminLayout>
</template>
