<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';

const page = usePage();
const user = page.props.auth.user;
const userRoles = page.props.user_roles || [];

const isTeacher = computed(() => {
    return userRoles.includes('teacher');
});

const isStudent = computed(() => {
    return userRoles.includes('student');
});

const layout = computed(() => {
    if (isStudent.value) return StudentLayout;
    if (isTeacher.value) return TeacherLayout;
    return AdminLayout;
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
