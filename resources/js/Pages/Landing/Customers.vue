<script setup>
const xassetUrl = assetUrl;
const bg_image = xassetUrl + "img/Landing/bg/testi12-bg.jpg";
</script>
<template>
    <section class="bg-center bg-no-repeat bg-gray-800 bg-blend-multiply dark:bg-gray-700"
        :class="`bg-[url('${bg_image}')]`">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-20 lg:py-50">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">Nuestros Clientes</h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Sus experiencias positivas con nuestros sistemas y servicios nos han convertido en la elección preferida. Conoce las historias de éxito y recomendaciones de quienes confían en nosotros para potenciar sus operaciones. Nuestros clientes respaldan la excelencia de nuestras soluciones.</p>
            <div class="flex flex-col mb-8 space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <img class="w-20 h-20 mx-4" src="/img/Landing/customers/LogoKentha.png" alt="image description">
                <img class="w-20 h-20 mx-4" src="/img/Landing/customers/logoGrande.png" alt="image description">
                <img class="w-20 h-20 mx-4" src="/img/Landing/customers/capperu.png" alt="image description">
            </div>
        </div>
    </section>
</template>