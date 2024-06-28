<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/ModalSmall.vue';
import TextInput from '@/Components/TextInput.vue';
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

    form.reset();
};
</script>

<template>
    <div class="panel space-y-5">
        <h5 class="font-semibold text-lg mb-4">Eliminar cuenta</h5>
        <p>Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.</p>
        <button @click="confirmUserDeletion" type="button" class="btn btn-danger btn-delete-account">Borrar mi cuenta</button>
    </div>


    <Modal 
        :show="confirmingUserDeletion" 
        :onClose="closeModal"
        :icon="'/img/64/eliminar.png'"
    >
        <template #title>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                ¿Estás seguro de que quieres eliminar tu cuenta?
            </h2>
        </template>
        <template #content>
            <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. Ingrese su contraseña para confirmar que desea eliminar permanentemente su cuenta.
            </p>

            <InputLabel for="password" value="Password" class="sr-only" />

            <TextInput
                id="password"
                ref="passwordInput"
                v-model="form.password"
                type="password"
                class="w-full"
                placeholder="Password"
                @keyup.enter="deleteUser"
            />

            <InputError :message="form.errors.password" class="mt-2" />
        </template>

        <template #buttons>
            <button type="button"
                class="btn btn-danger"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="deleteUser"
            >
                Borrar cuenta
            </button>
        </template>
        
    </Modal>

</template>
