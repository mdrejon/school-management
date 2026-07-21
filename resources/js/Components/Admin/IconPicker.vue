<script setup>
import { ref, shallowRef, computed, onMounted } from 'vue';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';
import ImageDropzone from '@/Components/Admin/ImageDropzone.vue';
import lucideIconNames from '@/data/lucide-icon-names.json';

// @lucide/vue exports ~2000 icon components in one object — importing it
// eagerly at module scope bloats this page's JS bundle by ~500kB. Loaded
// lazily on mount instead, so it lands in its own async chunk.
const lucideIcons = shallowRef({});
onMounted(async () => {
    lucideIcons.value = (await import('@lucide/vue')).icons;
});

const props = defineProps({
    // { source: 'lucide'|'upload', value: string|File|null }
    modelValue: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(['update:modelValue']);

const showDialog = ref(false);
const activeTab = ref('library');
const search = ref('');

// Icon names come from the same set the server renders via
// mallardduck/blade-lucide-icons (resources/js/data/lucide-icon-names.json,
// generated from that package's SVG files) — @lucide/vue's components are
// keyed PascalCase, so this converts kebab -> Pascal for component lookup.
const kebabToPascal = (name) => name.split('-').map((part) => part.charAt(0).toUpperCase() + part.slice(1)).join('');
const iconComponentFor = (kebabName) => lucideIcons.value[kebabToPascal(kebabName)];

const filteredNames = computed(() => {
    const q = search.value.trim().toLowerCase();
    const list = q ? lucideIconNames.filter((name) => name.includes(q)) : lucideIconNames;
    return list.slice(0, 150);
});

const currentLucideComponent = computed(() => {
    if (props.modelValue.source !== 'lucide' || !props.modelValue.value) return null;
    return iconComponentFor(props.modelValue.value);
});

const uploadPreview = computed(() => {
    if (props.modelValue.source !== 'upload') return null;
    const value = props.modelValue.value;
    if (!value) return null;
    return value instanceof File ? URL.createObjectURL(value) : `/storage/${value}`;
});

const openPicker = () => {
    activeTab.value = props.modelValue.source === 'upload' ? 'upload' : 'library';
    search.value = '';
    showDialog.value = true;
};

const selectLucide = (name) => {
    emit('update:modelValue', { source: 'lucide', value: name });
    showDialog.value = false;
};

const selectUpload = (file) => {
    emit('update:modelValue', { source: 'upload', value: file });
    showDialog.value = false;
};
</script>

<template>
    <div>
        <button
            type="button"
            class="flex items-center justify-center size-14 rounded-lg border border-slate-200 bg-slate-50 hover:border-indigo-300 transition-colors overflow-hidden"
            title="Change icon"
            @click="openPicker"
        >
            <component :is="currentLucideComponent" v-if="currentLucideComponent" :size="28" class="text-slate-600" />
            <img v-else-if="uploadPreview" :src="uploadPreview" class="h-full w-full object-contain" alt="" />
            <i v-else class="pi pi-image text-slate-300 text-xl" />
        </button>

        <Dialog v-model:visible="showDialog" modal header="Choose icon" class="w-full max-w-2xl">
            <Tabs v-model:value="activeTab">
                <TabList>
                    <Tab value="library">Icon library</Tab>
                    <Tab value="upload">Upload custom</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel value="library">
                        <InputText v-model="search" placeholder="Search icons (e.g. book, users, award)..." class="w-full mb-3" />
                        <div class="grid grid-cols-6 sm:grid-cols-8 gap-2 max-h-80 overflow-y-auto pr-1">
                            <button
                                v-for="name in filteredNames"
                                :key="name"
                                type="button"
                                :title="name"
                                class="flex items-center justify-center aspect-square rounded-lg border border-slate-200 hover:border-indigo-400 hover:bg-indigo-50 transition-colors"
                                @click="selectLucide(name)"
                            >
                                <component :is="iconComponentFor(name)" :size="20" class="text-slate-600" />
                            </button>
                        </div>
                        <p v-if="!filteredNames.length" class="text-sm text-slate-400 text-center py-6">No icons match "{{ search }}".</p>
                    </TabPanel>
                    <TabPanel value="upload">
                        <ImageDropzone
                            hint="Drag & drop an SVG or image icon, or click to browse"
                            width-class="w-full" height-class="h-40"
                            @select="selectUpload"
                        />
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </Dialog>
    </div>
</template>
