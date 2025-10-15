<template>
    <Head title="Admin Dashboard" />
    <AdminLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-600 mt-1">Selamat datang di Admin Panel Jadwal Taklim</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Schedules -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Total Jadwal</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ stats.total_schedules }}</p>
                        </div>
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Schedules -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Jadwal Aktif</p>
                            <p class="text-3xl font-bold text-primary-600 mt-2">{{ stats.active_schedules }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Schedules -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Jadwal Mendatang</p>
                            <p class="text-3xl font-bold text-secondary-600 mt-2">{{ stats.upcoming_schedules }}</p>
                        </div>
                        <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-medium">Kategori</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ stats.categories_count }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Schedules -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Jadwal Terbaru</h2>
                    </div>
                    <div class="p-6">
                        <div v-if="recentSchedules.length > 0" class="space-y-4">
                            <div v-for="schedule in recentSchedules" :key="schedule.id" class="flex items-start justify-between pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900">{{ schedule.title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ schedule.ustad_name }}</p>
                                    <div class="flex items-center mt-2 text-xs text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        {{ schedule.mosque_name }}
                                    </div>
                                    <div class="flex items-center mt-1 text-xs text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ schedule.schedule_date }}
                                    </div>
                                </div>
                                <span 
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                    :class="schedule.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                                >
                                    {{ schedule.is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>
                        <div v-else class="text-center py-8 text-gray-500">
                            Belum ada jadwal
                        </div>
                    </div>
                </div>

                <!-- Category Stats -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Statistik Kategori</h2>
                    </div>
                    <div class="p-6">
                        <div v-if="categoryStats.length > 0" class="space-y-4">
                            <div v-for="stat in categoryStats" :key="stat.category" class="flex items-center justify-between">
                                <div class="flex items-center flex-1">
                                    <div class="w-2 h-2 bg-primary-600 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-900">{{ stat.category || 'Tanpa Kategori' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm font-semibold text-gray-900 mr-3">{{ stat.count }}</span>
                                    <div class="w-32 bg-gray-200 rounded-full h-2">
                                        <div 
                                            class="bg-primary-600 h-2 rounded-full" 
                                            :style="{ width: (stat.count / stats.total_schedules * 100) + '%' }"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="text-center py-8 text-gray-500">
                            Belum ada data kategori
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-gradient-to-r from-primary-600 to-primary-700 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-white">Mulai Kelola Jadwal</h3>
                        <p class="text-primary-100 mt-1">Tambah jadwal taklim baru atau kelola yang sudah ada</p>
                    </div>
                    <div class="flex space-x-3">
                        <Link 
                            href="/admin/schedules/create" 
                            class="inline-flex items-center px-4 py-2 bg-white text-primary-700 font-semibold rounded-lg hover:bg-gray-100 transition-colors"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah Jadwal
                        </Link>
                        <Link 
                            href="/admin/schedules" 
                            class="inline-flex items-center px-4 py-2 bg-primary-800 text-white font-semibold rounded-lg hover:bg-primary-900 transition-colors"
                        >
                            Lihat Semua
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    stats: {
        type: Object,
        required: true,
    },
    recentSchedules: {
        type: Array,
        required: true,
    },
    categoryStats: {
        type: Array,
        required: true,
    },
});
</script>
