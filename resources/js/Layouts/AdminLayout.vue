<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex items-center mr-8">
                            <Link href="/admin/dashboard" class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </div>
                                <span class="text-lg font-bold text-gray-900">Admin Panel</span>
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden md:flex space-x-4">
                            <Link 
                                href="/admin/dashboard" 
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md transition-colors"
                                :class="$page.component === 'Admin/Dashboard' ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </Link>
                            <Link 
                                href="/admin/schedules" 
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md transition-colors"
                                :class="$page.component.startsWith('Admin/Schedules') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Jadwal Taklim
                            </Link>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        <!-- View Site -->
                        <a href="/" target="_blank" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Lihat Website
                        </a>

                        <!-- User Dropdown -->
                        <div class="relative">
                            <button 
                                @click="showDropdown = !showDropdown"
                                class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none"
                            >
                                <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">{{ userInitial }}</span>
                                </div>
                                <span class="hidden md:block text-sm font-medium">{{ $page.props.auth.user.name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div 
                                v-show="showDropdown"
                                @click.away="showDropdown = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200"
                            >
                                <Link 
                                    href="/profile" 
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    Profile
                                </Link>
                                <Link 
                                    href="/logout" 
                                    method="post" 
                                    as="button"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    Logout
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        <Transition
            enter-active-class="transform ease-out duration-300 transition"
            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="showSuccessMessage" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded-lg shadow-lg animate-pulse-once">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ $page.props.flash.success }}</p>
                            </div>
                        </div>
                        <button
                            @click="dismissSuccess"
                            class="ml-4 inline-flex text-green-600 hover:text-green-800 focus:outline-none"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </Transition>

        <Transition
            enter-active-class="transform ease-out duration-300 transition"
            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="showErrorMessage" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-lg shadow-lg animate-shake">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ $page.props.flash.error }}</p>
                            </div>
                        </div>
                        <button
                            @click="dismissError"
                            class="ml-4 inline-flex text-red-600 hover:text-red-800 focus:outline-none"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Page Content -->
        <main class="py-8">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const showSuccessMessage = ref(false);
const showErrorMessage = ref(false);

// Watch for flash messages
watch(() => page.props.flash, (flash) => {
    if (flash.success) {
        showSuccessMessage.value = true;
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            showSuccessMessage.value = false;
        }, 5000);
    }
    
    if (flash.error) {
        showErrorMessage.value = true;
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
        // Auto dismiss after 8 seconds (errors should stay longer)
        setTimeout(() => {
            showErrorMessage.value = false;
        }, 8000);
    }
}, { deep: true, immediate: true });

const dismissSuccess = () => {
    showSuccessMessage.value = false;
};

const dismissError = () => {
    showErrorMessage.value = false;
};

const showDropdown = ref(false);

const userInitial = computed(() => {
    return window.Laravel?.user?.name?.charAt(0).toUpperCase() || 'A';
});
</script>

<style scoped>
@keyframes pulse-once {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

@keyframes shake {
    0%, 100% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-5px);
    }
    20%, 40%, 60%, 80% {
        transform: translateX(5px);
    }
}

.animate-pulse-once {
    animation: pulse-once 0.6s ease-in-out;
}

.animate-shake {
    animation: shake 0.5s ease-in-out;
}
</style>
