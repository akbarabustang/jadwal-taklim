<template>
    <Head title="Jadwal Lengkap" />
    <AppLayout>
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <h1 class="text-4xl font-bold mb-2">Jadwal Lengkap Taklim</h1>
                <p class="text-primary-100">Temukan jadwal kajian yang sesuai dengan kebutuhan Anda</p>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Kajian</label>
                        <input 
                            type="text" 
                            v-model="form.search"
                            @input="debounceSearch"
                            placeholder="Cari judul, ustadz, atau masjid..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        />
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select 
                            v-model="form.category"
                            @change="applyFilters"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                            <option value="">Semua Kategori</option>
                            <option v-for="category in categories" :key="category" :value="category">
                                {{ category }}
                            </option>
                        </select>
                    </div>

                    <!-- City Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                        <select 
                            v-model="form.city"
                            @change="applyFilters"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                            <option value="">Semua Kota</option>
                            <option v-for="city in cities" :key="city" :value="city">
                                {{ city }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Active Filters -->
                <div v-if="hasActiveFilters" class="mt-4 flex items-center gap-2 flex-wrap">
                    <span class="text-sm text-gray-600">Filter aktif:</span>
                    <button 
                        v-if="form.category"
                        @click="clearFilter('category')"
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-primary-100 text-primary-800 hover:bg-primary-200"
                    >
                        {{ form.category }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <button 
                        v-if="form.city"
                        @click="clearFilter('city')"
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-secondary-100 text-secondary-800 hover:bg-secondary-200"
                    >
                        {{ form.city }}
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <button 
                        v-if="form.search"
                        @click="clearFilter('search')"
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200"
                    >
                        "{{ form.search }}"
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <button 
                        @click="clearAllFilters"
                        class="text-sm text-primary-600 hover:text-primary-700 font-medium"
                    >
                        Hapus semua filter
                    </button>
                </div>
            </div>

            <!-- Schedule Table -->
            <div v-if="schedules.data.length > 0" class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Desktop Table -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kajian
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ustadz
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jadwal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Lokasi
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="schedule in schedules.data" :key="schedule.id" class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ schedule.title }}</div>
                                    <div v-if="schedule.description" class="text-sm text-gray-500 line-clamp-2 mt-1">
                                        {{ schedule.description }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <Link 
                                        :href="`/ustadz/${getUstadzSlug(schedule.ustad_name)}`"
                                        class="text-sm text-primary-700 font-medium hover:text-primary-900 hover:underline"
                                    >
                                        {{ schedule.ustad_name }}
                                    </Link>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ schedule.day_name }}, {{ schedule.formatted_date }}</div>
                                    <div class="text-sm text-gray-500">{{ schedule.time_range }} WIB</div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-secondary-100 text-secondary-800 mt-1">
                                        {{ getFrequencyLabel(schedule.frequency) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ schedule.mosque_name }}</div>
                                    <div class="text-sm text-gray-500">{{ schedule.mosque_city }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                        {{ schedule.category || 'Umum' }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="md:hidden divide-y divide-gray-200">
                    <div v-for="schedule in schedules.data" :key="schedule.id" class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ schedule.title }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                {{ schedule.category || 'Umum' }}
                            </span>
                        </div>
                        
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <Link 
                                    :href="`/ustadz/${getUstadzSlug(schedule.ustad_name)}`"
                                    class="text-primary-700 font-medium hover:text-primary-900 hover:underline"
                                >
                                    {{ schedule.ustad_name }}
                                </Link>
                            </div>
                            
                            <div class="flex items-center text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ schedule.day_name }}, {{ schedule.formatted_date }} • {{ schedule.time_range }} WIB
                            </div>
                            
                            <div class="flex items-start text-gray-600">
                                <svg class="w-4 h-4 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <div class="font-medium text-gray-900">{{ schedule.mosque_name }}</div>
                                    <div>{{ schedule.mosque_city }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-secondary-100 text-secondary-800">
                                {{ getFrequencyLabel(schedule.frequency) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="schedules.links.length > 3" class="bg-gray-50 px-4 py-3 border-t border-gray-200 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">{{ schedules.from }}</span> sampai 
                            <span class="font-medium">{{ schedules.to }}</span> dari 
                            <span class="font-medium">{{ schedules.total }}</span> jadwal
                        </div>
                        <div class="flex gap-1">
                            <template v-for="(link, index) in schedules.links" :key="index">
                                <Link 
                                    v-if="link.url"
                                    :href="link.url"
                                    :class="[
                                        'px-3 py-1 rounded',
                                        link.active ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'
                                    ]"
                                    v-html="link.label"
                                    :preserve-state="true"
                                />
                                <span
                                    v-else
                                    :class="[
                                        'px-3 py-1 rounded bg-white text-gray-400 opacity-50 cursor-not-allowed'
                                    ]"
                                    v-html="link.label"
                                />
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada jadwal ditemukan</h3>
                <p class="text-gray-600 mb-4">Coba ubah filter pencarian Anda</p>
                <button 
                    @click="clearAllFilters"
                    class="inline-block bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors"
                >
                    Reset Filter
                </button>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    schedules: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    cities: {
        type: Array,
        required: true,
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const form = ref({
    search: props.filters.search || '',
    category: props.filters.category || '',
    city: props.filters.city || '',
});

let debounceTimeout = null;

const hasActiveFilters = computed(() => {
    return form.value.search || form.value.category || form.value.city;
});

const debounceSearch = () => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        applyFilters();
    }, 300);
};

const applyFilters = () => {
    router.get('/jadwal', {
        search: form.value.search,
        category: form.value.category,
        city: form.value.city,
    }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const clearFilter = (filterName) => {
    form.value[filterName] = '';
    applyFilters();
};

const clearAllFilters = () => {
    form.value = {
        search: '',
        category: '',
        city: '',
    };
    applyFilters();
};

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
