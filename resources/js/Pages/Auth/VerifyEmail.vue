<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/Vristo/AuthLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});
const baseUrl = assetUrl;

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');

const company = usePage().props.company;
</script>

<template>
    <GuestLayout title="Email Verification">

        <div>
            <div class="absolute inset-0">
                <img :src="`${baseUrl}/themes/vristo/images/auth/bg-gradient.png`" alt="image" class="h-full w-full object-cover" />
            </div>
            <div
                class="relative flex min-h-screen items-center justify-center bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16"
                :style="`background-image:url('${baseUrl}/themes/vristo/images/auth/map.png');`"
            >
                <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object1.png`"  alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object2.png`" alt="image" class="absolute left-24 top-0 h-40 md:left-[30%]" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object3.png`" alt="image" class="absolute right-0 top-0 h-[300px]" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/polygon-object.svg`" alt="image" class="absolute bottom-0 end-[28%]" />
                <div
                    class="relative flex w-full max-w-[1502px] flex-col justify-between overflow-hidden rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 lg:min-h-[758px] lg:flex-row lg:gap-10 xl:gap-0"
                >
                    <div
                        class="relative hidden w-full items-center justify-center bg-[linear-gradient(225deg,rgba(239,18,98,1)_0%,rgba(67,97,238,1)_100%)] p-5 lg:inline-flex lg:max-w-[835px] xl:-ms-28 ltr:xl:skew-x-[14deg] rtl:xl:skew-x-[-14deg]"
                    >
                        <div
                            class="absolute inset-y-0 w-8 from-primary/10 via-transparent to-transparent ltr:-right-10 ltr:bg-gradient-to-r rtl:-left-10 rtl:bg-gradient-to-l xl:w-16 ltr:xl:-right-20 rtl:xl:-left-20"
                        ></div>
                        <div class="ltr:xl:-skew-x-[14deg] rtl:xl:skew-x-[14deg]">
                            <Link :href="route('index_main')" class="w-48 block lg:w-72 ms-10">
                                <img v-if="company.logo_negative == '/img/logo176x32_negativo.png'" :src="company.logo_negative" alt="Logo" class="w-full" />
                                <img v-else :src="`${baseUrl}storage/${company.logo_negative}`" alt="Logo" class="w-full" />
                            </Link>
                            <div class="mt-24 hidden w-full max-w-[430px] lg:block">
                                <img :src="`${baseUrl}/themes/vristo/images/email-campaign-amico.svg`" alt="Cover Image" class="w-full" />
                            </div>
                        </div>
                    </div>
                    <div class="relative flex w-full flex-col items-center justify-center gap-6 px-4 pb-16 pt-6 sm:px-6 lg:max-w-[667px]">
                        <div class="flex w-full max-w-[440px] items-center gap-2 lg:absolute lg:end-6 lg:top-6 lg:max-w-full">
                            <Link :href="route('index_main')" class="w-8 block lg:hidden">
                                <img :src="`${baseUrl}/img/isotipo.png`" alt="Logo" class="mx-auto w-10" />
                            </Link>
                            <div class="dropdown ms-auto w-max">
                                
                            </div>
                        </div>
                        <div class="w-full max-w-[440px] lg:mt-16">
                            <div class="mb-7">
                                <h1 class="mb-3 text-2xl font-bold !leading-snug dark:text-white">Verificación de correo electrónico</h1>
                                <p>¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no recibiste el correo electrónico, con gusto te enviaremos otro.</p>
                                <p>Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.</p>
                            </div>
                            <form @submit.prevent="submit">
                                <div class="mt-4 flex items-center justify-between">
                                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Reenviar correo electrónico de verificación
                                    </PrimaryButton>

                                    <Link
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                        >
                                        Finalizar
                                    </Link>
                                </div>
                            </form>
                        </div>
                        <p class="absolute bottom-6 w-full text-center dark:text-white">© {{ new Date().getFullYear() }}.ARACODE All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
