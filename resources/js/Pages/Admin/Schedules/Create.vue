<template>
    <Head title="Tambah Jadwal" />
    <AdminLayout>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <Link href="/admin/schedules" class="text-primary-600 hover:text-primary-700 font-medium mb-2 inline-flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </Link>
                <h1 class="text-3xl font-bold text-gray-900 mt-2">Tambah Jadwal Taklim</h1>
                <p class="text-gray-600 mt-1">Buat jadwal kajian dan taklim baru</p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="bg-white rounded-lg shadow p-6">
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Kajian *</label>
                        <input 
                            type="text" 
                            v-model="form.title"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            :class="{'border-red-500': form.errors.title}"
                            placeholder="Contoh: Kajian Tafsir Al-Quran"
                        />
                        <p v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea 
                            v-model="form.description"
                            rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            placeholder="Deskripsi singkat tentang kajian..."
                        ></textarea>
                    </div>

                    <!-- Ustadz Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ustadz *</label>
                        <input 
                            type="text" 
                            v-model="form.ustad_name"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            :class="{'border-red-500': form.errors.ustad_name}"
                            placeholder="Contoh: Ustadz Abdullah Hakim"
                        />
                        <p v-if="form.errors.ustad_name" class="text-red-600 text-sm mt-1">{{ form.errors.ustad_name }}</p>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select 
                            v-model="form.category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                            <option value="">Pilih Kategori</option>
                            <option value="Tafsir">Tafsir</option>
                            <option value="Hadits">Hadits</option>
                            <option value="Fiqih">Fiqih</option>
                            <option value="Akhlaq">Akhlaq</option>
                            <option value="Sirah">Sirah</option>
                            <option value="Aqidah">Aqidah</option>
                        </select>
                    </div>

                    <!-- Mosque Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Masjid *</label>
                            <input 
                                type="text" 
                                v-model="form.mosque_name"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                :class="{'border-red-500': form.errors.mosque_name}"
                                placeholder="Masjid Al-Ikhlas"
                            />
                            <p v-if="form.errors.mosque_name" class="text-red-600 text-sm mt-1">{{ form.errors.mosque_name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                            <input 
                                type="text" 
                                v-model="form.mosque_city"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                placeholder="Jakarta"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Masjid *</label>
                        <textarea 
                            v-model="form.mosque_address"
                            rows="2"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            :class="{'border-red-500': form.errors.mosque_address}"
                            placeholder="Jl. Contoh No. 123, Jakarta Selatan"
                        ></textarea>
                        <p v-if="form.errors.mosque_address" class="text-red-600 text-sm mt-1">{{ form.errors.mosque_address }}</p>
                    </div>

                    <!-- Schedule Date & Time -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal *</label>
                            <input 
                                type="date" 
                                v-model="form.schedule_date"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                :class="{'border-red-500': form.errors.schedule_date}"
                            />
                            <p v-if="form.errors.schedule_date" class="text-red-600 text-sm mt-1">{{ form.errors.schedule_date }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai *</label>
                            <input 
                                type="time" 
                                v-model="form.start_time"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                :class="{'border-red-500': form.errors.start_time}"
                            />
                            <p v-if="form.errors.start_time" class="text-red-600 text-sm mt-1">{{ form.errors.start_time }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                            <input 
                                type="time" 
                                v-model="form.end_time"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            />
                        </div>
                    </div>

                    <!-- Frequency -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Frekuensi *</label>
                        <select 
                            v-model="form.frequency"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            :class="{'border-red-500': form.errors.frequency}"
                        >
                            <option value="once">Satu kali</option>
                            <option value="daily">Harian</option>
                            <option value="weekly">Mingguan</option>
                            <option value="monthly">Bulanan</option>
                        </select>
                        <p v-if="form.errors.frequency" class="text-red-600 text-sm mt-1">{{ form.errors.frequency }}</p>
                    </div>

                    <!-- Contact Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Narahubung</label>
                            <input 
                                type="text" 
                                v-model="form.contact_person"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                placeholder="Nama narahubung"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Kontak</label>
                            <input 
                                type="text" 
                                v-model="form.contact_number"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                placeholder="08123456789"
                            />
                        </div>
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            v-model="form.is_active"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                        />
                        <label class="ml-2 block text-sm text-gray-900">
                            Aktifkan jadwal ini
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex items-center justify-end space-x-3">
                    <Link 
                        href="/admin/schedules" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium"
                    >
                        Batal
                    </Link>
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 font-medium disabled:opacity-50"
                    >
                        {{ form.processing ? 'Menyimpan...' : 'Simpan Jadwal' }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const form = useForm({
    title: '',
    description: '',
    ustad_name: '',
    mosque_name: '',
    mosque_address: '',
    mosque_city: '',
    schedule_date: '',
    start_time: '',
    end_time: '',
    frequency: 'once',
    category: '',
    contact_person: '',
    contact_number: '',
    is_active: true,
});

const submit = () => {
    form.post('/admin/schedules');
};
</script>
