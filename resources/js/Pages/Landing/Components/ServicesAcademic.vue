<script setup>
const xassetUrl = assetUrl;
const bg_imagea = xassetUrl+"img/Landing/bg/testi12-bg.jpg";
</script>
<template>
    <section class="bg-white dark:bg-gray-900" 
    :class="`bg-[url('${bg_imagea}')]`"
    >
        <div class="px-4 mx-auto max-w-screen-xl lg:py-16 py-20 lg:py-20 lg:gap-16">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 w-full text-center">
                    <h4 class="mb-12 text-3xl font-bold text-gray-900 dark:text-white">Formación y Desarrollo</h4> 
                </div>
                <div class="col-span-6 sm:col-span-2 md:col-span-2">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#" class="text-center">
                            <img class="rounded-t-lg" src="/img/Landing/about-part-3.png" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Desarrollo de paginas web</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">¡Sumérgete en el emocionante mundo del desarrollo web con nuestro curso integral de HTML, CSS3 y JavaScript!, este curso te proporcionará las habilidades esenciales para crear páginas web modernas, atractivas y totalmente funcionales.</p>
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Ver mas
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-2 md:col-span-2">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="/img/Landing/about-part-3.png" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Laravel 10</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Descubre el fascinante mundo del desarrollo web con Laravel 10, uno de los frameworks de PHP más potentes y elegantes. Este curso te llevará desde los conceptos fundamentales hasta la construcción de aplicaciones web dinámicas y robustas.</p>
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                ver mas
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-2 md:col-span-2">
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="rounded-t-lg" src="/img/Landing/about-part-3.png" alt="" />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Excel 2023</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Descubre el poder y la versatilidad de Microsoft Excel con nuestro curso diseñado para aquellos que desean adquirir habilidades desde lo más básico hasta un nivel intermedio. Aprende a utilizar Excel de manera eficiente para organizar datos.</p>
                            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Ver mas
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>