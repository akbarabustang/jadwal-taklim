<template>
    <Head title="Kelola Jadwal" />
    <AdminLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Kelola Jadwal Taklim</h1>
                    <p class="text-gray-600 mt-1">Kelola semua jadwal kajian dan taklim</p>
                </div>
                <Link 
                    href="/admin/schedules/create" 
                    class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition-colors shadow"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Jadwal
                </Link>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-lg shadow mb-6 p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Jadwal</label>
                        <input 
                            type="text" 
                            v-model="form.search"
                            @input="debounceSearch"
                            placeholder="Cari judul, ustadz, atau masjid..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        />
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select 
                            v-model="form.status"
                            @change="applyFilters"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                            <option :value="null">Semua Status</option>
                            <option :value="1">Aktif</option>
                            <option :value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jadwal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ustadz
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lokasi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="schedule in schedules.data" :key="schedule.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ schedule.title }}</div>
                                <div class="text-sm text-gray-500">{{ schedule.category || 'Umum' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ schedule.ustad_name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ schedule.mosque_name }}</div>
                                <div class="text-sm text-gray-500">{{ schedule.mosque_city }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ schedule.formatted_date }}</div>
                                <div class="text-sm text-gray-500">{{ schedule.time_range }} WIB</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span 
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                    :class="schedule.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                                >
                                    {{ schedule.is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link 
                                    :href="`/admin/schedules/${schedule.id}/edit`" 
                                    class="text-primary-600 hover:text-primary-900 mr-3"
                                >
                                    Edit
                                </Link>
                                <button 
                                    @click="showDeleteModal(schedule)"
                                    class="text-red-600 hover:text-red-900"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Empty State -->
                <div v-if="schedules.data.length === 0" class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada jadwal ditemukan</h3>
                    <p class="text-gray-600">Tambah jadwal baru atau ubah filter pencarian</p>
                </div>

                <!-- Pagination -->
                <div v-if="schedules.links.length > 3" class="bg-gray-50 px-4 py-3 border-t border-gray-200">
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
        </div>

        <!-- Delete Confirmation Modal -->
        <ConfirmDeleteModal
            :show="deleteModal.show"
            title="Hapus Jadwal?"
            :message="deleteModal.schedule ? `Apakah Anda yakin ingin menghapus jadwal &quot;${deleteModal.schedule.title}&quot;? Tindakan ini tidak dapat dibatalkan.` : ''"
            @close="closeDeleteModal"
            @confirm="confirmDelete"
        />
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ConfirmDeleteModal from '@/Components/ConfirmDeleteModal.vue';

const props = defineProps({
    schedules: {
        type: Object,
        required: true,
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const form = ref({
    search: props.filters.search || '',
    status: props.filters.status ?? null,
});

const deleteModal = ref({
    show: false,
    schedule: null,
});

let debounceTimeout = null;

const debounceSearch = () => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        applyFilters();
    }, 300);
};

const applyFilters = () => {
    router.get('/admin/schedules', {
        search: form.value.search,
        status: form.value.status,
    }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const showDeleteModal = (schedule) => {
    deleteModal.value.schedule = schedule;
    deleteModal.value.show = true;
};

const closeDeleteModal = () => {
    deleteModal.value.show = false;
    deleteModal.value.schedule = null;
};

const confirmDelete = () => {
    if (deleteModal.value.schedule) {
        router.delete(`/admin/schedules/${deleteModal.value.schedule.id}`, {
            onFinish: () => {
                closeDeleteModal();
            },
        });
    }
};
</script>
