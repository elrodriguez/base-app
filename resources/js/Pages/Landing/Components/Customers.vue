<script setup>
const xassetUrl = assetUrl;

</script>
<template>
    <section id="portfolio" class="section-Portfolio 2xl:py-[80px] py-[70px]">
        <div class="banner text-center mb-[30px]" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="300">
            <span class="text-[14px] text-[#777]">PORTFOLIO</span>
            <h2
                class="text-center mt-[5px] 2xl:text-[35px] xl:text-[33px] lg:text-[30px] md:text-[26px] sm:text-[24px] text-[22px] font-bold">
                My <span class="text-[#7963e0]"> PORTFOLIO</span></h2>
        </div>
        <div
            class="flex flex-wrap justify-between items-center mx-auto mx-auto 2xl:max-w-[1320px] xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] sm:max-w-[540px] max-[320px]:px-[12px] px-6">
            <div class="m-b-minus-24px w-full">
                <div class="portfolio-content" id="MixItUpDA2FB7" data-aos="fade-up" data-aos-duration="2000"
                    data-aos-delay="600">
                    <div class="portfolio-tabs mb-[30px]">
                        <ul
                            class="2xl:flex xl:flex md:flex sm:block place-content-center text-center">
                            <li class="text-[14px] text-[#17181c] 2xl:mx-[10px] sm:mx-[0px] px-[10px] leading-[11px] font-semibold hover:text-[#7963e0] cursor-pointer inline-block active"
                                data-filter="all">
                                ALL</li>
                            <li class="text-[14px] text-[#17181c] 2xl:mx-[10px] sm:mx-[0px] px-[10px] leading-[11px] font-semibold hover:text-[#7963e0] cursor-pointer inline-block"
                                data-filter=".design">DESIGN</li>
                            <li class="text-[14px] text-[#17181c] 2xl:mx-[10px] sm:mx-[0px] px-[10px] leading-[11px] font-semibold hover:text-[#7963e0] cursor-pointer inline-block"
                                data-filter=".development">DEVELOPMENT</li>
                            <li class="text-[14px] text-[#17181c] 2xl:mx-[10px] sm:mx-[0px] px-[10px] leading-[11px] font-semibold hover:text-[#7963e0] cursor-pointer inline-block"
                                data-filter=".graphics">GRAPHICS</li>
                            <li class="text-[14px] text-[#17181c] 2xl:mx-[10px] sm:mx-[0px] px-[10px] leading-[11px] font-semibold hover:text-[#7963e0] cursor-pointer inline-block"
                                data-filter=".templates">Templates</li>
                        </ul>
                    </div>
                    <div class="portfolio-content-items">
                        <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-[30px]">
                            <div class="mix graphics templates">
                                <div class="portfolio-img truncate rounded-2xl relative">
                                    <img :src="`${xassetUrl}img/Landing/customers/LogoKentha.png`" style="width: 400px;"
                                        class="w-full transform hover:bg-blue-600 transition duration-500 hover:-rotate-12 hover:scale-125">
                                    <h3 class="top-contain absolute top-[15px] right-[15px]">
                                        <span
                                            class="bg-black rounded-full text-white font-normal text-[12px] px-2 py-1">3D
                                            Graphics</span>
                                        <span
                                            class="bg-black rounded-full text-white font-normal text-[12px] px-2 py-1">Templates</span>
                                    </h3>
                                    <div class="bottom-contain absolute bottom-4 left-4 right-4">
                                        <div
                                            class="overlay-info px-4 py-2 bg-black bg-opacity-60 rounded-xl grid grid-cols-2 gap-[30px] place-content-between">
                                            <a href="#" class="text-white text-sm flex items-center">

                                            </a>
                                            <a :href="`${xassetUrl}img/Landing/customers/LogoKentha.png`" data-fancybox="gallery"
                                                class="text-white text-sm grid justify-items-end">
                                                <p class="hidden">.</p>
                                                <span
                                                    class="bg-[#7963e0] h-8 w-8 flex justify-center items-center rounded-md">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mix design">
                                <div class="portfolio-img truncate rounded-2xl relative">
                                    <img :src="`${xassetUrl}img/Landing/customers/logoGrande.png`" alt="design"
                                        class="w-full transform hover:bg-blue-600 transition duration-500 hover:-rotate-12 hover:scale-125">
                                    <h3 class="top-contain absolute top-[15px] right-[15px]">
                                        <span
                                            class="bg-black rounded-full font-normal text-white text-[12px] px-2 py-1">Web
                                            Design</span>
                                    </h3>
                                    <div class="bottom-contain absolute bottom-4 left-4 right-4">
                                        <div
                                            class="overlay-info px-4 py-2 bg-black bg-opacity-60 rounded-xl grid grid-cols-2 gap-[30px] place-content-between">
                                            <a href="#" class="text-white text-sm flex items-center">Boros -
                                                Artificial Intelligence</a>
                                            <a href="assets/img/portfolio/img-2.jpg" data-fancybox="gallery"
                                                class="text-white text-sm grid justify-items-end">
                                                <p class="hidden">.</p>
                                                <span
                                                    class="bg-[#7963e0] h-8 w-8 flex justify-center items-center rounded-md">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mix design">
                                <div class="portfolio-img truncate rounded-2xl relative">
                                    <img :src="`${xassetUrl}img/Landing/customers/capperu.png`" alt="design"
                                        class="w-full transform hover:bg-blue-600 transition duration-500 hover:-rotate-12 hover:scale-125">
                                    <h3 class="top-contain absolute top-[15px] right-[15px]">
                                        <span
                                            class="bg-black rounded-full font-normal text-white text-[12px] px-2 py-1">Web
                                            Design</span>
                                    </h3>
                                    <div class="bottom-contain absolute bottom-4 left-4 right-4">
                                        <div
                                            class="overlay-info px-4 py-2 bg-black bg-opacity-60 rounded-xl grid grid-cols-2 gap-[30px] place-content-between">
                                            <a href="#" class="text-white text-sm flex items-center">Mila - Virtual
                                                Reality</a>
                                            <a href="assets/img/portfolio/img-3.jpg" data-fancybox="gallery"
                                                class="text-white text-sm grid justify-items-end">
                                                <p class="hidden">.</p>
                                                <span
                                                    class="bg-[#7963e0] h-8 w-8 flex justify-center items-center rounded-md">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mix development">
                                <div class="portfolio-img truncate rounded-2xl relative">
                                    <img :src="`${xassetUrl}img/Landing/customers/LogoKentha.png`" alt="development"
                                        class="w-full transform hover:bg-blue-600 transition duration-500 hover:-rotate-12 hover:scale-125">
                                    <h3 class="top-contain absolute top-[15px] right-[15px]">
                                        <span
                                            class="bg-black rounded-full font-normal text-white text-[12px] px-2 py-1">Development</span>
                                    </h3>
                                    <div class="bottom-contain absolute bottom-4 left-4 right-4">
                                        <div
                                            class="overlay-info px-4 py-2 bg-black bg-opacity-60 rounded-xl grid grid-cols-2 gap-[30px] place-content-between">
                                            <a href="#" class="text-white text-sm flex items-center">Sen - Hotel
                                                Website</a>
                                            <a href="assets/img/portfolio/img-4.jpg" data-fancybox="gallery"
                                                class="text-white text-sm grid justify-items-end">
                                                <p class="hidden">.</p>
                                                <span
                                                    class="bg-[#7963e0] h-8 w-8 flex justify-center items-center rounded-md">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mix templates design">
                                <div class="portfolio-img truncate rounded-2xl relative">
                                    <img :src="`${xassetUrl}img/Landing/customers/LogoKentha.png`" alt="templates"
                                        class="w-full transform hover:bg-blue-600 transition duration-500 hover:-rotate-12 hover:scale-125">
                                    <h3 class="top-contain absolute top-[15px] right-[15px]">
                                        <span
                                            class="bg-black rounded-full font-normal text-white text-[12px] px-2 py-1">Templates</span>
                                        <span
                                            class="bg-black rounded-full font-normal text-white text-[12px] px-2 py-1">Web
                                            Design</span>
                                    </h3>
                                    <div class="bottom-contain absolute bottom-4 left-4 right-4">
                                        <div
                                            class="overlay-info px-4 py-2 bg-black bg-opacity-60 rounded-xl grid grid-cols-2 gap-[30px] place-content-between">
                                            <a href="#" class="text-white text-sm flex items-center">Ekka -
                                                eCommerce template</a>
                                            <a href="assets/img/portfolio/img-1.jpg" data-fancybox="gallery"
                                                class="text-white text-sm grid justify-items-end">
                                                <p class="hidden">.</p>
                                                <span
                                                    class="bg-[#7963e0] h-8 w-8 flex justify-center items-center rounded-md">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mix development graphics">
                                <div class="portfolio-img truncate rounded-2xl relative">
                                    <img :src="`${xassetUrl}img/Landing/customers/LogoKentha.png`" alt="development"
                                        class="w-full transform hover:bg-blue-600 transition duration-500 hover:-rotate-12 hover:scale-125">
                                    <h3 class="top-contain absolute top-[15px] right-[15px]">
                                        <span
                                            class="bg-black rounded-full font-normal text-white text-[12px] px-2 py-1">Development</span>
                                        <span
                                            class="bg-black rounded-full font-normal text-white text-[12px] px-2 py-1">3D
                                            Graphics</span>
                                    </h3>
                                    <div class="bottom-contain absolute bottom-4 left-4 right-4">
                                        <div
                                            class="overlay-info px-4 py-2 bg-black bg-opacity-60 rounded-xl grid grid-cols-2 gap-[30px] place-content-between">
                                            <a href="#" class="text-white text-sm flex items-center">Bukki - Teck
                                                crafts</a>
                                            <a href="assets/img/portfolio/img-2.jpg" data-fancybox="gallery"
                                                class="text-white text-sm grid justify-items-end">
                                                <p class="hidden">.</p>
                                                <span
                                                    class="bg-[#7963e0] h-8 w-8 flex justify-center items-center rounded-md">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>