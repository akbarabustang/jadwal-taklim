<template>
    <Transition name="loading-fade">
        <div v-if="isLoading" class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-sm">
            <div class="text-center">
                <!-- Modern Spinner -->
                <div class="relative inline-flex">
                    <!-- Outer Ring -->
                    <div class="w-16 h-16 border-4 border-primary-200 rounded-full"></div>
                    <!-- Spinning Ring -->
                    <div class="absolute top-0 left-0 w-16 h-16 border-4 border-transparent border-t-primary-600 rounded-full animate-spin"></div>
                    <!-- Inner Pulse -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-8 h-8 bg-primary-500 rounded-full animate-pulse"></div>
                </div>
                
                <!-- Loading Text -->
                <div class="mt-4 text-gray-700 font-medium animate-pulse">
                    Memuat halaman...
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { router } from '@inertiajs/vue3';

const isLoading = ref(false);
let timeout = null;

const startLoading = () => {
    // Only show loading after 250ms to avoid flashing on fast loads
    timeout = setTimeout(() => {
        isLoading.value = true;
    }, 250);
};

const stopLoading = () => {
    clearTimeout(timeout);
    isLoading.value = false;
};

onMounted(() => {
    router.on('start', startLoading);
    router.on('finish', stopLoading);
});

onUnmounted(() => {
    router.off('start', startLoading);
    router.off('finish', stopLoading);
    clearTimeout(timeout);
});
</script>

<style scoped>
.loading-fade-enter-active,
.loading-fade-leave-active {
    transition: opacity 0.2s ease;
}

.loading-fade-enter-from,
.loading-fade-leave-to {
    opacity: 0;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        opacity: 0.5;
        transform: translate(-50%, -50%) scale(0.8);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

.animate-pulse {
    animation: pulse 2s ease-in-out infinite;
}
</style>
