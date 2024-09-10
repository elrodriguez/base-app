<script setup>
import ModalSmall from '@/Components/ModalSmall.vue';
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const company = usePage().props.company;

const xassetUrl = assetUrl;

const scrollToContact = () => {
    const element = document.getElementById('contact');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>
<template>
    <section id="home" class="section-hero bg-[#f6f8ff] relative">
        <img class="shape1 absolute w-12 left-72 bottom-36 parallax sm:block hidden" :src="`${xassetUrl}themes/personalLanding/assets/img/shape/shape-1.png`" alt="shape-1">
        <img class="shape2 absolute w-12 top-72 right-32 parallax top sm:block hidden" :src="`${xassetUrl}themes/personalLanding/assets/img/shape/shape-2.png`" alt="shape-2">
        <img class="shape3 absolute w-12 top-48	left-96 parallax left top sm:block hidden" :src="`${xassetUrl}themes/personalLanding/assets/img/shape/shape-3.png`"
            alt="shape-3">
        <img class="shape4 absolute w-6 bottom-72 left-24 parallax left sm:block hidden" :src="`${xassetUrl}themes/personalLanding/assets/img/shape/shape-4.png`"
            alt="shape-4">
        <img class="shape5 absolute w-12 bottom-48 right-12 parallax bottom sm:block hidden" :src="`${xassetUrl}themes/personalLanding/assets/img/shape/shape-5.png`"
            alt="shape-5">
        <div
            class="flex flex-wrap justify-between items-center mx-auto mx-auto 2xl:max-w-[1320px] xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] sm:max-w-[540px] py-[80px] px-4">
            <div class="w-full 2xl:h-[90vh] lg:h-[80vh] h-[70vh] max-[320px]:h-[50vh] flex items-center px-2 2xl:max-w-lg xl:max-w-lg lg:max-w-lg lg:w-1/2 lg:mx-0 md:max-w-lg md:w-1/2 md:mx-0 2xl:w-1/2 xl:w-1/2 sm:items-center">
                <div class="text-center 2xl:text-left xl:text-left lg:text-left md:text-left h-72">
                    <span class="text-[#7963e0] text-[18px] font-bold">Hola, bienvenido a</span>
                    <h1
                        class="text-dark-800 2xl:text-[60px] xl:text-[55px] lg:text-[50px] md:text-[45px] text-[40px] font-bold">
                        {{ company.name }}
                    </h1>
                    <h2 class="py-2 text-dark-800 text-[20px] font-bold">Nos especializamos</h2>
                    <p class="pt-2 text-gray-500 text-base">
                        En el desarrollo a medida de software. Además, brindamos servicios de alquiler de sistema facturador, permitiendo a las empresas acceder a tecnología sin la necesidad de inversiones iniciales elevadas. Nuestro compromiso es ayudar a nuestros clientes a optimizar sus procesos.
                    </p>
                    <button @click="scrollToContact" type="button"
                        class="text-white mt-4 bg-[#7963e0] hover:bg-opacity-80 no-underline font-medium rounded-full text-sm px-8 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                        Escribenos
                    </button>
                </div>
            </div>
            <div class="w-1/2 hidden px-2 2xl:block xl:block lg:block md:block z-10">
                <img :src="`${xassetUrl}themes/vristo/images/app-development-rafiki.svg`" alt="girl" class="max-h-full">
            </div>
        </div>
        <div class="relative">
            <img :src="`${xassetUrl}themes/personalLanding/assets/img/shape/hero-shape.png`" alt="hero-shape"
                class="absolute bottom-0 left-0 right-0 w-full z-10 bg-center bg-cover"
                >
        </div>
    </section>

</template>