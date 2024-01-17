<script setup>
import { useForm } from '@inertiajs/vue3';
import { ConfigProvider, notification } from 'ant-design-vue';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    full_name: null,
    email: null,
    phone: null,
    message: null
});
const saveSubscriber = () => {
    form.post(route('subscriber_public'), {
        errorBag: 'saveSubscriber',
        preserveScroll: true,
        onSuccess: () => {
            notification.success({
                message: `Gracias ${form.full_name}`,
                description: 'Su mensaje ha sido enviado correctamente. Pronto, uno de nuestros expertos se pondrá en contacto con usted.'
            })
            form.reset()
        },
    });
}
</script>
<template>
    <section class="bg-red-50 dark:bg-gray-800" id="contacto">
        <div class="px-4 mx-auto max-w-screen-xl lg:py-16 py-20 lg:py-20 lg:gap-16">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4 md:col-span-4">
                    <div class="w-full p-4">
                        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Hable con nuestros expertos.</h5>
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Estamos aquí para escuchar y asesorarte en cada paso de tu viaje tecnológico. Nuestro equipo de expertos en desarrollo a medida está listo para entender tus desafíos, responder a tus preguntas y diseñar soluciones que impulsen el éxito de tu empresa. Hable con nuestros expertos hoy y descubre cómo podemos transformar tus ideas en soluciones innovadoras y personalizadas que potencien tu negocio.</p>
                        
                        <div class="flex items-center justify-center p-4 text-center">
                            <span class="flex w-3 h-3 me-3 bg-gray-900 rounded-full dark:bg-gray-700"></span>
                            <span class="flex w-3 h-3 me-3 bg-blue-600 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-green-500 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-red-500 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-gray-200 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-purple-500 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-indigo-500 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-yellow-300 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-teal-500 rounded-full"></span>
                        </div>
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8" src="/img/Landing/email.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Email
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            contacto@aracodeperu.com
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8" src="/img/Landing/telefono.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            LLamanos
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            (+51) 977 627207
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8" src="/img/Landing/ubicacion.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Dirección
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            Urb. Las Casuarinas Mz. P1 - Lt.26 2da Etapa, Nuevo Chimbote - Perú.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-2 md:col-span-2">
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <form class="space-y-6" action="#" @submit.prevent="saveSubscriber">
                            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Programar una cita</h5>
                            <div>
                                <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo</label>
                                <input type="text" v-model="form.full_name" id="full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                <InputError :message="form.errors.full_name" class="mt-2" />
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
                                <input type="email" v-model="form.email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                                <input type="text" v-model="form.phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                <InputError :message="form.errors.phone" class="mt-2" />
                            </div>
                            <div>
                                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mensaje</label>
                                <textarea id="message" v-model="form.message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí tu mensaje..."></textarea>
                                <InputError :message="form.errors.message" class="mt-2" />
                            </div>
                            <button type="submit" 
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg v-show="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                </svg>
                                Enviar
                            </button>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                Estamos aquí para ayudarte 24/7
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>