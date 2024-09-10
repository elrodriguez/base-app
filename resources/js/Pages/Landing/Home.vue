<script setup>
import '@Public/themes/personalLanding/assets/css/style.css';
import Header from './Components/Header.vue';
import Jumbotron from './Components/Jumbotron.vue';
import ServicesTI from './Components/ServicesTI.vue';
import About from './Components/About.vue';
import Customers from './Components/Customers.vue';
import Footer from './Components/Footer.vue';
import { Head, Link } from '@inertiajs/vue3';

const xassetUrl = assetUrl;

</script>
<template>
    <Head title="Landing" />
    <Header />

    <!-- hero section -->
    <Jumbotron />

    <!-- service -->
    
    <ServicesTI />
    <!-- about -->
    
    <About />
    <!-- Experience and Education -->
    <!-- <section id="experience" class="section-experience bg-[#f6f8ff] relative">
        <div class="relative pt-[60px]">
            <img src="assets/img/shape/bg-shape.png" alt="bg-shape"
                class="absolute top-0 left-0 right-0 w-full bg-center bg-cover">
        </div>
        <div class="2xl:pb-[80px] pb-[70px] 2xl:pt-[80px] md:pt-[70px] pt-[20px]">
            <div class="banner text-center mb-[30px]" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="300">
                <span class="text-[14px] text-[#777]">QUALIFICATION</span>
                <h2
                    class="text-center mt-[5px] 2xl:text-[35px] xl:text-[33px] lg:text-[30px] md:text-[26px] sm:text-[24px] text-[22px] font-bold">
                    My <span class="text-[#7963e0]"> ACHIEVEMENTS</span></h2>
            </div>
            <div
                class="flex flex-wrap justify-between items-center mx-auto mx-auto 2xl:max-w-[1320px] xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] sm:max-w-[540px] max-[320px]:px-[12px] px-6 relative">
                <img src="assets/img/shape/shape-8.png" alt="shape-8" class="absolute w-12 -top-10 right-10">
                <div class="absolute -top-10 left-10 h-12 w-12 bg-[#f1c7a1] rounded-full"></div>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px]">
                    <div class="transition-all justify-start items-start">
                        <h2 class="text-[20px] font-bold leading-[24px]">Education</h2>
                        <div class="border-l-2 border-gray-300 pl-6">
                            <div class="p-[30px] bg-white rounded-3xl mt-8 relative" data-aos="fade-up"
                                data-aos-duration="2000" data-aos-delay="400">
                                <div class="absolute top-0 bottom-0 -left-6 w-4">
                                    <span
                                        class="w-4 h-4 border-2 border-[#7963e0] rounded-full block bg-[#f6f8ff] absolute top-28 -left-2.5"></span>
                                    <span
                                        class="w-5 border border-[#7963e0] block bg-[#f6f8ff] absolute top-28 my-1.5 left-1.5"></span>
                                </div>
                                <span class="text-[#777] text-[12px] font-medium">June 15, 2013 - 2016</span>
                                <h4 class="text-[16px] leading-[22px] font-semibold mt-[15px] mb-[6px] text-[#7963e0]">
                                    Master in Computer Engineering <span class="ml-[15px] text-[#999] text-[14px]">-
                                        First
                                        Class</span></h4>
                                <p class="text-[13px] text-[#777] mb-0 leading-[28px]">Lorem, ipsum dolor sit amet
                                    consectetur adipisicing elit. Mollitia
                                    sequi doloremque ullam placeat quos provident ex fuga. Ratione ab explicabo
                                    doloribus error odio veritatis tenetur.</p>
                            </div>
                            <div class="p-[30px] bg-white rounded-3xl mt-8 relative" data-aos="fade-up"
                                data-aos-duration="2000" data-aos-delay="600">
                                <div class="absolute top-0 bottom-0 -left-6 w-4">
                                    <span
                                        class="w-4 h-4 border-2 border-[#7963e0] rounded-full block bg-[#f6f8ff] absolute top-28 -left-2.5"></span>
                                    <span
                                        class="w-5 border border-[#7963e0] block bg-[#f6f8ff] absolute top-28 my-1.5 left-1.5"></span>
                                </div>
                                <span class="text-[#777] text-[12px] font-medium">June 12, 2010 - 2013</span>
                                <h4 class="text-[16px] leading-[22px] font-semibold mt-[15px] mb-[6px] text-[#7963e0]">
                                    Bachelor
                                    in Computer Engineering <span class="ml-[15px] text-[#999] text-[14px]">- First
                                        Class</span></h4>
                                <p class="text-[13px] text-[#777] mb-0 leading-[28px]">Lorem, ipsum dolor sit amet
                                    consectetur adipisicing elit.
                                    Mollitia sequi doloremque ullam placeat quos provident ex fuga. Ratione ab explicabo
                                    doloribus error odio veritatis tenetur.</p>
                            </div>
                            <div class="p-[30px] bg-white rounded-3xl mt-8 relative" data-aos="fade-up"
                                data-aos-duration="2000" data-aos-delay="800">
                                <div class="absolute top-0 bottom-0 -left-6 w-4">
                                    <span
                                        class="w-4 h-4 border-2 border-[#7963e0] rounded-full block bg-[#f6f8ff] absolute top-28 -left-2.5"></span>
                                    <span
                                        class="w-5 border border-[#7963e0] block bg-[#f6f8ff] absolute top-28 my-1.5 left-1.5"></span>
                                </div>
                                <span class="text-[#777] text-[12px] font-medium">June 1, 2009 - 2010</span>
                                <h4 class="text-[16px] leading-[22px] font-semibold mt-[15px] mb-[6px] text-[#7963e0]">
                                    Higher Secondary <span class="ml-[15px] text-[#999] text-[14px]">- (A+)</span></h4>
                                <p class="text-[13px] text-[#777] mb-0 leading-[28px]">Lorem, ipsum dolor sit amet
                                    consectetur adipisicing elit.
                                    Mollitia sequi doloremque ullam placeat quos provident ex fuga. Ratione ab explicabo
                                    doloribus error odio veritatis tenetur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="transition-all 2xl:mt-0 lg:mt-0 xl:mt-0 mt-[15px] justify-start items-start" data-aos="fade-up" data-aos-duration="2000"
                        data-aos-delay="300">
                        <h2 class="text-[20px] font-bold leading-[24px]">Experience</h2>
                        <div class="border-l-2 border-gray-300 pl-6">
                            <div class="p-[30px] bg-white rounded-3xl mt-8 relative" data-aos="fade-up"
                                data-aos-duration="2000" data-aos-delay="400">
                                <div class="absolute top-0 bottom-0 -left-6 w-4">
                                    <span
                                        class="w-4 h-4 border-2 border-[#7963e0] rounded-full block bg-[#f6f8ff] absolute top-28 -left-2.5"></span>
                                    <span
                                        class="w-5 border border-[#7963e0] block bg-[#f6f8ff] absolute top-28 my-1.5 left-1.5"></span>
                                </div>
                                <span class="text-[#777] text-[12px] font-medium">March 12, 2020</span>
                                <h4 class="text-[16px] leading-[22px] font-semibold mt-[15px] mb-[6px] text-[#7963e0]">
                                    Envato
                                    <span class="ml-[15px] text-[#999] text-[14px]">- Team Leader</span>
                                </h4>
                                <p class="text-[13px] text-[#777] mb-0 leading-[28px]">Lorem, ipsum dolor sit amet
                                    consectetur adipisicing elit.
                                    Mollitia
                                    sequi doloremque ullam placeat quos provident ex fuga. Ratione ab explicabo
                                    doloribus
                                    error
                                    odio veritatis tenetur.</p>
                            </div>
                            <div class="p-[30px] bg-white rounded-3xl mt-8 relative" data-aos="fade-up"
                                data-aos-duration="2000" data-aos-delay="600">
                                <div class="absolute top-0 bottom-0 -left-6 w-4">
                                    <span
                                        class="w-4 h-4 border-2 border-[#7963e0] rounded-full block bg-[#f6f8ff] absolute top-28 -left-2.5"></span>
                                    <span
                                        class="w-5 border border-[#7963e0] block bg-[#f6f8ff] absolute top-28 my-1.5 left-1.5"></span>
                                </div>
                                <span class="text-[#777] text-[12px] font-medium">January 23, 2018 - 2020</span>
                                <h4 class="text-[16px] leading-[22px] font-semibold mt-[15px] mb-[6px] text-[#7963e0]">
                                    Facebook Company <span class="ml-[15px] text-[#999] text-[14px]">- Sr.
                                        Developer</span></h4>
                                <p class="text-[13px] text-[#777] mb-0 leading-[28px]">Lorem, ipsum dolor sit amet
                                    consectetur adipisicing elit.
                                    Mollitia sequi doloremque ullam placeat quos provident ex fuga. Ratione ab explicabo
                                    doloribus error odio veritatis tenetur.</p>
                            </div>
                            <div class="p-[30px] bg-white rounded-3xl mt-8 relative" data-aos="fade-up"
                                data-aos-duration="2000" data-aos-delay="800">
                                <div class="absolute top-0 bottom-0 -left-6 w-4">
                                    <span
                                        class="w-4 h-4 border-2 border-[#7963e0] rounded-full block bg-[#f6f8ff] absolute top-28 -left-2.5"></span>
                                    <span
                                        class="w-5 border border-[#7963e0] block bg-[#f6f8ff] absolute top-28 my-1.5 left-1.5"></span>
                                </div>
                                <span class="text-gray-500 text-sm">July 23, 2016 - 2018 </span>
                                <h4 class="text-[16px] leading-[22px] font-semibold mt-[15px] mb-[6px] text-[#7963e0]">
                                    Twitter Company <span class="ml-[15px] text-[#999] text-[14px]">- Jr.
                                        Developer</span></h4>
                                <p class="text-[13px] text-[#777] mb-0 leading-[28px]">Lorem, ipsum dolor sit amet
                                    consectetur adipisicing elit.
                                    Mollitia sequi doloremque ullam placeat quos provident ex fuga. Ratione ab explicabo
                                    doloribus error odio veritatis tenetur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Portfolio -->
    <!--  -->
    <!-- <Customers /> -->
    <!-- News -->
    <!-- <section id="news" class="section-news bg-[#f6f8ff]">
        <div class="relative pt-[60px]">
            <img :src="`${pathImage}themes/personalLanding/assets/img/shape/bg-shape.png`" alt="bg-shape"
                class="absolute top-0 left-0 right-0 w-full bg-center bg-cover">
        </div>
        <div class="2xl:pb-[80px] pb-[70px] 2xl:pt-[80px] lg:pt-[80px] pt-[20px]">
            <div class="banner text-center mb-[30px]" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="300">
                <span class="text-[14px] text-[#777]">BLOGS</span>
                <h2
                    class="text-center mt-[5px] 2xl:text-[35px] xl:text-[33px] lg:text-[30px] md:text-[26px] sm:text-[24px] text-[22px] font-bold">
                    Latest <span class="text-[#7963e0]"> NEWS</span></h2>
            </div>
            <div class="flex flex-wrap justify-between items-center mx-auto mx-auto 2xl:max-w-[1320px] xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] sm:max-w-[540px] max-[320px]:px-[12px] relative px-6"
                data-aos="fade-up" data-aos-duration="2000" data-aos-delay="300">
                <div class="relative"></div>
                <div class="2xl:absolute 2xl:max-[1140px] xl:absolute xl:max-w-[720px] lg:absolute lg:max-w-[620px] max-w-[100%] relative">
                    <div class="transition-all justify-start items-start">
                        <div class="news-slider">
                            <div class="carousel-wrap">
                                <div class="owl-carousel news-carousel owl-loaded owl-drag">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage">
                                            <div class="owl-item">
                                                <div class="card bg-white border rounded-2xl p-6">
                                                    <img src="assets/img/news/img-2.jpg" alt="news-3">
                                                    <div class="news-card-details mt-[16px]">
                                                        <p class="text-[13px] leading-[30px] mb-[5px] text-[#7963e0]">By
                                                            Admin <span class="text-gray-400">- 04 Comments</span></p>
                                                        <h5
                                                            class="pb-[15px] text-[17px] font-bold border-b border-[#dbdada]">
                                                            Lorem ipsum dolor sit amet.</h5>
                                                        <div class="pt-[15px] text-sm text-[#7963e0]">Read More <a
                                                                class="hover:text-[#7963e0]">
                                                                <i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="card bg-white border rounded-2xl p-6">
                                                    <img src="assets/img/news/img-3.jpg" alt="news-3">
                                                    <div class="news-card-details mt-[16px]">
                                                        <p class="text-[13px] leading-[30px] mb-[5px] text-[#7963e0]">By
                                                            Admin <span class="text-gray-400">- 04 Comments</span></p>
                                                        <h5
                                                            class="pb-[15px] text-[17px] font-bold border-b border-[#dbdada]">
                                                            Lorem ipsum dolor sit amet.</h5>
                                                        <div class="pt-[15px] text-sm text-[#7963e0]">Read More <a
                                                                class="hover:text-[#7963e0]">
                                                                <i class="fa-solid fa-arrow-right"></i>
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
                    </div>
                </div>
                <div class="transition-all flex-row 2xl:block xl:block lg:block hidden">
                    <img src="assets/img/news/img-1.jpg" alt="news" class="w-auto rounded-[15px]">
                </div>
            </div>
        </div>
    </section> -->

    <!-- contact -->
    <section id="contact" class="section-contact 2xl:py-[80px] py-[70px]">
        <div class="banner text-center mb-[30px]" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="300">
            <span class="text-[14px] text-[#777]">FORMULARIO</span>
            <h2
                class="text-center mt-[5px] 2xl:text-[35px] xl:text-[33px] lg:text-[30px] md:text-[26px] sm:text-[24px] text-[22px] font-bold">
                Ponte en contacto con 
                <span class="text-[#7963e0]">NOSOTROS</span>
            </h2>
        </div>
        <form>
            <div
                class="flex flex-wrap justify-between items-center mx-auto mx-auto 2xl:max-w-[1320px] xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] sm:max-w-[540px] max-[320px]:px-[12px] px-6">
                <div class="m-b-minus-24px w-full">
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px]" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="300">
                        <div class="border rounded-lg">
                            <div class="border-b">
                                <input type="text"
                                    class="appearance-none w-full py-6 px-3 text-gray-700 leading-tight focus:outline-none rounded-t-lg"
                                    id="fname" placeholder="Nombre completo">
                            </div>
                            <div class="border-b">
                                <input type="email"
                                    class="appearance-none w-full py-6 px-3 text-gray-700 leading-tight focus:outline-none"
                                    id="umail" placeholder="Correo electrónico">
                            </div>
                            <div class="border-b">
                                <input type="text"
                                    class="appearance-none w-full py-6 px-3 text-gray-700 leading-tight focus:outline-none"
                                    id="phone" placeholder="Teléfono">
                            </div>
                            <div>
                                <input type="text"
                                    class="appearance-none w-full py-6 px-3 text-gray-700 leading-tight focus:outline-none rounded-b-lg"
                                    id="subject" placeholder="Asunto">
                            </div>
                        </div>
                        <div class="mb-0">
                            <div class="mb-4">
                                <textarea class="w-full border rounded-xl pl-4 pt-2 focus:outline-none"
                                    id="exampleFormControlTextarea1" rows="8" placeholder="Mensaje"></textarea>
                            </div>
                            <button type="button"
                                class="text-white bg-[#7963e0] hover:bg-opacity-80 no-underline font-medium rounded-full text-sm px-8 py-2.5 mr-2">
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- footer -->
    
    <Footer />
    <!-- scroll Top -->
    <div id="scrollup"
        class="fixed bg-[#7963e0] text-white rounded-full flex justify-center text-center items-center p-2 right-6 cursor-pointer bottom-6 h-10 w-10 z-20">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </div>
</template>
