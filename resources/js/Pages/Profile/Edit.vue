<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, usePage } from '@inertiajs/vue3';

const page = usePage();

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profil" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Profil Pengguna</h1>
                <p class="text-gray-600 mt-1">Kelola informasi profil dan keamanan akun Anda</p>
            </div>

            <div class="space-y-6">
                <!-- Profile Information Card -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Profil</h2>
                        <p class="text-sm text-gray-600 mt-1">Perbarui informasi profil dan alamat email Anda</p>
                    </div>
                    <div class="p-6">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                        />
                    </div>
                </div>

                <!-- Update Password Card -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Perbarui Password</h2>
                        <p class="text-sm text-gray-600 mt-1">Pastikan menggunakan password yang kuat dan aman</p>
                    </div>
                    <div class="p-6">
                        <UpdatePasswordForm />
                    </div>
                </div>

                <!-- Delete Account Card -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Hapus Akun</h2>
                        <p class="text-sm text-gray-600 mt-1">Hapus akun Anda secara permanen</p>
                    </div>
                    <div class="p-6">
                        <DeleteUserForm />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
