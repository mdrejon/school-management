<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';

const page = usePage();
const user = page.props.auth.user;

// Assuming if user is not admin, they are a teacher for this context
// Alternatively, check roles if Spatie is loaded
const isTeacher = computed(() => {
    if (user.roles && user.roles.length > 0) {
        return user.roles.some(r => r.name.toLowerCase() === 'teacher');
    }
    // Fallback: check email or something if roles aren't populated, but roles should be.
    return false;
});

const layout = computed(() => {
    // We can't use dynamic component for layout easily in script setup with Vue 3 SFC if they are not imported,
    // but we have both imported. We can just use v-if in template.
    return isTeacher.value ? TeacherLayout : AdminLayout;
});
</script>

<template>
    <component :is="layout" title="Dashboard">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
            <p class="text-sm text-gray-500">Home - Profile</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column: Profile Information -->
            <div>
                <UpdateProfileInformationForm :user="user" />
            </div>

            <!-- Right Column: Update Password -->
            <div>
                <UpdatePasswordForm />
            </div>
        </div>
    </component>
</template>
