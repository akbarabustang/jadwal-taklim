<template>
    <Head title="Beranda" />
    <AppLayout>
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Jadwal Taklim & Kajian Islam
                    </h1>
                    <p class="text-xl text-primary-100 mb-8">
                        Temukan jadwal kajian dan taklim di masjid-masjid sekitar Anda
                    </p>
                    <Link 
                        href="/jadwal" 
                        class="inline-block bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors shadow-lg"
                    >
                        Lihat Jadwal Lengkap
                    </Link>
                </div>
            </div>
        </div>

        <!-- Upcoming Schedules Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Jadwal Taklim Mendatang</h2>
                <p class="text-gray-600">Jangan lewatkan kajian-kajian yang akan datang</p>
            </div>

            <div v-if="upcomingSchedules.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div 
                    v-for="schedule in upcomingSchedules" 
                    :key="schedule.id"
                    class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow overflow-hidden border border-gray-100"
                >
                    <!-- Category Badge -->
                    <div class="bg-gradient-to-r from-primary-500 to-secondary-500 px-4 py-2">
                        <span class="text-white text-sm font-semibold">{{ schedule.category || 'Umum' }}</span>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ schedule.title }}</h3>
                        
                        <div class="space-y-3 mb-4">
                            <!-- Ustadz -->
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-primary-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <Link 
                                    :href="`/ustadz/${getUstadzSlug(schedule.ustad_name)}`"
                                    class="text-primary-700 font-medium hover:text-primary-900 hover:underline"
                                >
                                    {{ schedule.ustad_name }}
                                </Link>
                            </div>

                            <!-- Date & Time -->
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-secondary-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div class="text-gray-700">
                                    <div class="font-medium">{{ schedule.day_name }}, {{ schedule.formatted_date }}</div>
                                    <div class="text-sm text-gray-600">{{ schedule.time_range }} WIB</div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-primary-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div class="text-gray-700">
                                    <div class="font-medium">{{ schedule.mosque_name }}</div>
                                    <div class="text-sm text-gray-600">{{ schedule.mosque_city }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <p v-if="schedule.description" class="text-gray-600 text-sm line-clamp-2 mb-4">
                            {{ schedule.description }}
                        </p>

                        <!-- Frequency Badge -->
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-secondary-100 text-secondary-800">
                                {{ getFrequencyLabel(schedule.frequency) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-gray-600 text-lg">Belum ada jadwal taklim yang tersedia</p>
            </div>

            <!-- View All Button -->
            <div v-if="upcomingSchedules.length > 0" class="text-center mt-12">
                <Link 
                    href="/jadwal" 
                    class="inline-block bg-primary-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition-colors shadow-md"
                >
                    Lihat Semua Jadwal
                </Link>
            </div>
        </div>

        <!-- Info Section -->
        <div class="bg-secondary-50 py-16 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Beragam Kajian</h3>
                        <p class="text-gray-600">Tafsir, Hadits, Fiqih, Akhlaq, dan lebih banyak lagi</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Berbagai Lokasi</h3>
                        <p class="text-gray-600">Masjid-masjid di berbagai kota di Indonesia</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Jadwal Terkini</h3>
                        <p class="text-gray-600">Informasi jadwal yang selalu up-to-date</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    upcomingSchedules: {
        type: Array,
        required: true,
    },
});

const getFrequencyLabel = (frequency) => {
    const labels = {
        once: 'Satu kali',
        daily: 'Harian',
        weekly: 'Mingguan',
        monthly: 'Bulanan',
    };
    return labels[frequency] || frequency;
};

const getUstadzSlug = (name) => {
    return name.toLowerCase().replace(/\s+/g, '-');
};
</script>
