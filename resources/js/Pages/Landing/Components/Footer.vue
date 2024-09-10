<script setup>
    import { Link, usePage } from '@inertiajs/vue3';
    import { onMounted, ref } from 'vue';

    const user = usePage().props.auth.user;
    const company = usePage().props.company;

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });
</script>
<template>

    <footer class="bg-[#070415]">
        <div
            class="flex justify-center mx-auto mx-auto 2xl:max-w-[1320px] xl:max-w-[1140px] lg:max-w-[960px] 2xl:flex-row xl:flex-row lg:flex-row flex-col md:max-w-[720px] max-[320px]:px-[12px] sm:max-w-[540px] gap-[30px] px-6 py-8">
            <div class="lg:w-1/2 text-white text-[12px] font-normal 2xl:text-left xl:text-left text-center">
                Copyright ©
                <Link :href="route('index_main')" class="hover:text-white font-semibold">{{ company.name }}</Link>
                todos los derechos reservados. Desarrollado por Aracode.
            </div>
            <div
                class="lg:w-1/2 text-white font-normal text-[12px] flex 2xl:justify-end xl:justify-end lg:justify-end justify-between">
                <a href="javascript:void(0)" class="pr-10 hover:text-white">política de privacidad</a>
                <a href="javascript:void(0)" class="hover:text-white">Términos y condiciones</a>
            </div>
        </div>
    </footer>
</template>