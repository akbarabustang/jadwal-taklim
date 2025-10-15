<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <Link href="/" class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900">Jadwal Taklim</span>
                        </Link>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <Link 
                            href="/" 
                            class="px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors"
                            :class="{ 'bg-primary-50 text-primary-600': $page.component === 'Home' }"
                        >
                            Beranda
                        </Link>
                        <Link 
                            href="/jadwal" 
                            class="px-4 py-2 rounded-lg text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors"
                            :class="{ 'bg-primary-50 text-primary-600': $page.component === 'Schedule/Index' }"
                        >
                            Jadwal Lengkap
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            <Transition 
                name="page" 
                mode="out-in"
                @before-enter="scrollToTop"
            >
                <div :key="$page.url">
                    <slot />
                </div>
            </Transition>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Tentang Jadwal Taklim</h3>
                        <p class="text-gray-400">
                            Platform untuk menemukan jadwal kajian dan taklim di masjid-masjid sekitar Anda.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Menu</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><Link href="/" class="hover:text-primary-400">Beranda</Link></li>
                            <li><Link href="/jadwal" class="hover:text-primary-400">Jadwal Lengkap</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <p class="text-gray-400">
                            Untuk menambahkan jadwal taklim masjid Anda, silakan hubungi kami.
                        </p>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; {{ new Date().getFullYear() }} Jadwal Taklim. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>
