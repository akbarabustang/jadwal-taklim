<script setup>
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-red-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <h3 class="text-sm font-medium text-red-800 mb-1">Peringatan: Tindakan Permanen</h3>
                    <p class="text-sm text-red-700">
                        Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. 
                        Pastikan untuk mengunduh data penting sebelum melanjutkan.
                    </p>
                </div>
            </div>
        </div>

        <button
            @click="confirmUserDeletion"
            class="px-6 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all"
        >
            Hapus Akun
        </button>

        <!-- Custom Modal -->
        <Transition name="modal-fade">
            <div v-if="confirmingUserDeletion" class="fixed inset-0 z-50 overflow-y-auto" @click.self="closeModal">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
                
                <!-- Modal -->
                <div class="flex min-h-full items-center justify-center p-4">
                    <Transition name="modal-scale">
                        <div 
                            v-if="confirmingUserDeletion"
                            class="relative bg-white rounded-xl shadow-2xl max-w-md w-full p-6 transform"
                            @click.stop
                        >
                            <!-- Icon -->
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>

                            <!-- Content -->
                            <div class="text-center mb-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    Konfirmasi Hapus Akun
                                </h3>
                                <p class="text-gray-600">
                                    Apakah Anda yakin ingin menghapus akun Anda? Semua data akan dihapus secara permanen. Masukkan password Anda untuk mengkonfirmasi.
                                </p>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-6">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password
                                </label>
                                <input
                                    id="password"
                                    ref="passwordInput"
                                    v-model="form.password"
                                    type="password"
                                    placeholder="Masukkan password Anda"
                                    @keyup.enter="deleteUser"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors"
                                    :class="{ 'border-red-500': form.errors.password }"
                                />
                                <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}</p>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3">
                                <button
                                    @click="closeModal"
                                    type="button"
                                    class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                                >
                                    Batal
                                </button>
                                <button
                                    @click="deleteUser"
                                    :disabled="form.processing"
                                    type="button"
                                    class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span v-if="!form.processing">Hapus Akun</span>
                                    <span v-else class="flex items-center justify-center">
                                        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>
        </Transition>
    </section>
</template>

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
