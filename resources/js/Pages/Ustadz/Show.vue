<template>
    <Head :title="ustadzName" />
    <AppLayout>
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex items-center space-x-4 mb-6">
                    <Link href="/" class="text-primary-100 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </Link>
                    <span class="text-primary-100">Kembali</span>
                </div>
                
                <div class="flex items-center space-x-6">
                    <!-- Avatar -->
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-12 h-12 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    
                    <!-- Info -->
                    <div>
                        <h1 class="text-4xl font-bold mb-2">{{ ustadzName }}</h1>
                        <p class="text-primary-100 text-lg">Pengajar & Pembimbing Kajian Islam</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary-600">{{ stats.total_schedules }}</div>
                        <div class="text-gray-600 mt-1">Total Kajian</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary-600">{{ stats.upcoming_schedules }}</div>
                        <div class="text-gray-600 mt-1">Jadwal Mendatang</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary-600">{{ stats.categories.length }}</div>
                        <div class="text-gray-600 mt-1">Kategori</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary-600">{{ stats.cities.length }}</div>
                        <div class="text-gray-600 mt-1">Kota</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories & Cities -->
        <div class="bg-gray-50 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Categories -->
                    <div v-if="stats.categories.length > 0">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Kategori Kajian:</h3>
                        <div class="flex flex-wrap gap-2">
                            <span 
                                v-for="category in stats.categories" 
                                :key="category"
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800"
                            >
                                {{ category }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Cities -->
                    <div v-if="stats.cities.length > 0">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Lokasi:</h3>
                        <div class="flex flex-wrap gap-2">
                            <span 
                                v-for="city in stats.cities" 
                                :key="city"
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-secondary-100 text-secondary-800"
                            >
                                {{ city }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedules -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Jadwal Kajian</h2>
            
            <div v-if="schedules.length > 0" class="space-y-4">
                <div 
                    v-for="schedule in schedules" 
                    :key="schedule.id"
                    class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-gray-100"
                >
                    <div class="md:flex">
                        <!-- Date Section -->
                        <div class="bg-gradient-to-br from-primary-500 to-primary-600 text-white p-6 md:w-48 flex flex-col items-center justify-center">
                            <div class="text-4xl font-bold">{{ schedule.schedule_date.split('-')[2] }}</div>
                            <div class="text-lg mt-1">{{ getMonthName(schedule.schedule_date) }}</div>
                            <div class="text-sm opacity-90 mt-1">{{ schedule.day_name }}</div>
                            <div class="mt-3 text-sm font-medium">{{ schedule.time_range }} WIB</div>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="flex-1 p-6">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900">{{ schedule.title }}</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                    {{ schedule.category || 'Umum' }}
                                </span>
                            </div>
                            
                            <p v-if="schedule.description" class="text-gray-600 mb-4">
                                {{ schedule.description }}
                            </p>
                            
                            <div class="space-y-2">
                                <!-- Location -->
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-primary-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ schedule.mosque_name }}</div>
                                        <div class="text-sm text-gray-600">{{ schedule.mosque_address }}</div>
                                        <div class="text-sm text-gray-600">{{ schedule.mosque_city }}</div>
                                    </div>
                                </div>

                                <!-- Frequency -->
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    <span class="text-gray-700">{{ getFrequencyLabel(schedule.frequency) }}</span>
                                </div>

                                <!-- Contact -->
                                <div v-if="schedule.contact_person" class="flex items-center">
                                    <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-gray-700">{{ schedule.contact_person }}<span v-if="schedule.contact_number"> - {{ schedule.contact_number }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="text-center py-12 bg-white rounded-lg shadow">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada jadwal ditemukan</h3>
                <p class="text-gray-600">Belum ada jadwal kajian dari ustadz ini</p>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    ustadzName: {
        type: String,
        required: true,
    },
    schedules: {
        type: Array,
        required: true,
    },
    stats: {
        type: Object,
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

const getMonthName = (dateString) => {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const month = parseInt(dateString.split('-')[1]) - 1;
    return months[month];
};
</script>
