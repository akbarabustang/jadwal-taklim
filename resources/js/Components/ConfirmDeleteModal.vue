<template>
    <Transition name="modal-fade">
        <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto" @click.self="close">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
            
            <!-- Modal -->
            <div class="flex min-h-full items-center justify-center p-4">
                <Transition name="modal-scale">
                    <div 
                        v-if="show"
                        class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform"
                        @click.stop
                    >
                        <!-- Icon -->
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                            <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                {{ title }}
                            </h3>
                            <p class="text-gray-600 mb-6">
                                {{ message }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3">
                            <button
                                @click="close"
                                type="button"
                                class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                            >
                                Batal
                            </button>
                            <button
                                @click="confirm"
                                type="button"
                                :disabled="processing"
                                class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span v-if="!processing">Hapus</span>
                                <span v-else class="flex items-center justify-center">
                                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="ml-2">Menghapus...</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </Transition>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
        default: 'Konfirmasi Hapus',
    },
    message: {
        type: String,
        default: 'Apakah Anda yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.',
    },
});

const emit = defineEmits(['close', 'confirm']);

const processing = ref(false);

// Reset processing state when modal is closed
watch(() => props.show, (newValue) => {
    if (!newValue) {
        processing.value = false;
    }
});

const close = () => {
    if (!processing.value) {
        emit('close');
    }
};

const confirm = () => {
    processing.value = true;
    emit('confirm');
};
</script>

<style scoped>
/* Modal fade transition */
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.3s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
    opacity: 0;
}

/* Modal scale transition */
.modal-scale-enter-active,
.modal-scale-leave-active {
    transition: all 0.3s ease;
}

.modal-scale-enter-from {
    opacity: 0;
    transform: scale(0.9);
}

.modal-scale-leave-to {
    opacity: 0;
    transform: scale(0.95);
}
</style>
