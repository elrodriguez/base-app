<script setup>
import ModalSmall from '@/Components/ModalSmall.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { ConfigProvider, notification } from 'ant-design-vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    jumbotron: {
        type: Object,
        default: () => ({})
    }

   
});

const xassetUrl = assetUrl;

const displayModalContact = ref(false);

const openModalContact = () => {
    displayModalContact.value = true;
};

const closeModalContact = () => {
    displayModalContact.value = false;
};

const formModal = useForm({
    full_name: null,
    email: null,
    phone: null,
    message: null
});

const saveModalSubscriber = () => {
    formModal.post(route('subscriber_public'), {
        errorBag: 'saveSubscriber',
        preserveScroll: true,
        onSuccess: () => {
            displayModalContact.value = false;
            notification.success({
                message: `Gracias ${formModal.full_name}`,
                description: 'Su mensaje ha sido enviado correctamente. Pronto, uno de nuestros expertos se pondrá en contacto con usted.'
            })
            formModal.reset()
        },
    });
}

</script>
<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-2 gap-8 py-20 lg:py-20 lg:gap-16">
            <div class="flex flex-col justify-center">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    {{ jumbotron[0].content }}
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">
                    {{ jumbotron[1].content }}
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0">
                    <button @click="openModalContact" type="button" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Contactanos
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <img :src="xassetUrl + 'storage/' + jumbotron[2].content" class="h-auto max-w-full">
            </div>
        </div>
    </section>
    <ModalSmall
        :show="displayModalContact"
        :onClose="closeModalContact"
        :icon="'/img/64/correo.png'"
    >
        <template #title>
            Contactar con Nosotros
        </template>
        <template #message>
            Programar una cita
        </template>
        <template #content>
            <form class="space-y-2">
                <div>
                    <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo</label>
                    <input type="text" v-model="formModal.full_name" id="full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    <InputError :message="formModal.errors.full_name" class="mt-2" />
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
                    <input type="email" v-model="formModal.email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                    <InputError :message="formModal.errors.email" class="mt-2" />
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                    <input type="text" v-model="formModal.phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    <InputError :message="formModal.errors.phone" class="mt-2" />
                </div>
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensaje</label>
                    <textarea id="message" v-model="formModal.message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí tu mensaje..."></textarea>
                    <InputError :message="formModal.errors.message" class="mt-2" />
                </div>
            </form>
        </template>
        <template #buttons>
            <button 
                @click="saveModalSubscriber"
                type="button" 
                :class="{ 'opacity-25': formModal.processing }" :disabled="formModal.processing"
                class="mr-2 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg v-show="formModal.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                </svg>
                Enviar
            </button>
        </template>
    </ModalSmall> 

</template>