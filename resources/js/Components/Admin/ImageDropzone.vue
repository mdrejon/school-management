<script setup>
import { ref } from 'vue';
import Button from 'primevue/button';

const props = defineProps({
    previewUrl: {
        type: String,
        default: null,
    },
    hint: {
        type: String,
        default: 'Drag & drop an image here, or click to browse',
    },
    widthClass: {
        type: String,
        default: 'w-full sm:w-80',
    },
    heightClass: {
        type: String,
        default: 'h-44',
    },
});

const emit = defineEmits(['select', 'remove']);

const isDragging = ref(false);
const fileInput = ref(null);

const trigger = () => fileInput.value?.click();

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file?.type?.startsWith('image/')) emit('select', file);
    event.target.value = '';
};

const onDrop = (event) => {
    isDragging.value = false;
    const file = event.dataTransfer.files[0];
    if (file?.type?.startsWith('image/')) emit('select', file);
};
</script>

<template>
    <div>
        <div
            class="group relative overflow-hidden rounded-lg border-2 border-dashed transition-colors"
            :class="[
                widthClass,
                heightClass,
                isDragging ? 'border-indigo-400 bg-indigo-50' : 'border-slate-300 bg-slate-50',
                !previewUrl && 'cursor-pointer hover:border-indigo-300',
            ]"
            @click="!previewUrl && trigger()"
            @dragover.prevent="isDragging = true"
            @dragleave.prevent="isDragging = false"
            @drop.prevent="onDrop"
        >
            <template v-if="previewUrl">
                <img :src="previewUrl" class="absolute inset-0 h-full w-full object-contain bg-slate-100" alt="" />
                <div class="absolute inset-0 flex items-center justify-center gap-2 bg-black/0 opacity-0 transition-all group-hover:bg-black/50 group-hover:opacity-100">
                    <Button icon="pi pi-refresh" label="Replace" size="small" @click.stop="trigger" />
                    <Button icon="pi pi-trash" label="Remove" size="small" severity="danger" @click.stop="emit('remove')" />
                </div>
            </template>
            <div v-else class="pointer-events-none flex h-full flex-col items-center justify-center gap-2 text-slate-400">
                <i class="pi pi-cloud-upload text-2xl" />
                <span class="px-6 text-center text-xs">{{ hint }}</span>
            </div>
        </div>
        <input ref="fileInput" type="file" accept="image/*" class="hidden" @change="onFileChange" />
    </div>
</template>
