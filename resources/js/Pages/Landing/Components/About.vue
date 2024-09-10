<script setup>
import { Link, usePage } from '@inertiajs/vue3';
const company = usePage().props.company;

const xtassetUrl = assetUrl;
const pathImage = xtassetUrl;
</script>
<template>
<section id="about" class="bg-white 2xl:pb-[80px] pb-[70px]">
        <div
            class="flex flex-wrap justify-between items-center mx-auto mx-auto 2xl:max-w-[1320px] xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] sm:max-w-[540px] max-[320px]:px-[12px]">
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px] px-6 max-[320px]:px-[0px]">
                <div class="transition-all relative" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="300">
                    <img :src="`${pathImage}themes/personalLanding/assets/img/shape/shape-6.png`" alt="shape-6" class="absolute w-12 top-2.5 left-2.5">
                    <img :src="`${pathImage}themes/vristo/images/about-page-amico.svg`" alt="about-img-1" class="w-full rounded-lg">
                    <img :src="`${pathImage}themes/personalLanding/assets/img/shape/shape-7.png`" alt="shape-7" class="absolute w-12 bottom-5 right-2.5">
                </div>
                <div class="transition-all" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="300">
                    <div class="banner mb-[30px]">
                        <span class="text-[14px] text-[#777]">Sobre nosotros</span>
                        <h2
                            class="mt-[5px] 2xl:text-[35px] xl:text-[33px] lg:text-[30px] md:text-[26px] sm:text-[24px] text-[22px] font-bold">
                            Impulsamos tu éxito con soluciones 
                            <span class="text-[#7963e0]">tecnológicas a medida.</span>
                        </h2>
                    </div>
                    <p class="text-[16px] text-[#777] mb-[30px]">
                        somos un equipo apasionado de profesionales dedicados a desarrollar soluciones tecnológicas innovadoras.
                    </p>
                    <div class="border p-[24px] rounded-lg">
                        <div class="box-border flex justify-between max-[400px]:block">
                            <div class="left">
                                <div class="name">
                                    <span class="text-[16px] leading-[28px] font-bold"> Nombre : </span><br>
                                    <span class="detail text-[14px] leading-[28px] text-[#777]">{{ company.business_name }} </span>
                                </div>
                            </div>
                            <div class="right">
                                <div class="ph">
                                    <span class="text-[16px] leading-[28px] font-bold">Número de teléfono : </span><br>
                                    <span class="detail text-[14px] leading-[28px] text-[#777]">+51 {{ company.phone }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bottom pt-[20px]">
                            <span class="text-[16px] leading-[28px] font-bold">DIRECCIÓN : </span>
                            <span class="detail text-[14px] leading-[28px] text-[#777]">{{ company.fiscal_address }}, Nuevo Chimbote</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>