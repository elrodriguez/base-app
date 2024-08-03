<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import IconArrowleft from '@/Components/vristo/icon/icon-arrow-left.vue';
</script>
<template>
    <AppLayout title="Tipo de suscripcion">
        <Navigation :routeModule="route('aca_dashboard')" :titleModule="'Académico'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Tipo de suscripcion</span>
            </li>
        </Navigation>
        <div class="pt-5 space-y-8">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Basic</h5>

                </div>
                <div class="mb-5">
                    <div class="max-w-[320px] md:max-w-[990px] mx-auto">
                        <div class="md:flex justify-between space-y-4 md:space-y-0 md:space-x-4 rtl:space-x-reverse">
                            <div class="p-3 lg:p-5 border border-black dark:border-[#1b2e4b] text-center rounded group hover:border-primary">
                                <h3 class="text-xl lg:text-2xl">Beginner Savers</h3>
                                <div class="border-t border-black dark:border-white-dark w-1/5 mx-auto my-6 group-hover:border-primary"></div>
                                <p class="text-[15px]">For people who are starting out in the water saving business</p>
                                <div class="my-7 p-2.5 text-center text-lg group-hover:text-primary">
                                    <strong class="text-[#3b3f5c] dark:text-white-dark text-3xl lg:text-5xl group-hover:text-primary">$19</strong> / monthly
                                </div>
                                <ul class="space-y-2.5 mb-5 font-semibold group-hover:text-primary">
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Free water saving e-book
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Free access to forums
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Beginners tips
                                    </li>
                                </ul>
                                <a
                                    href="#"
                                    target="_self"
                                    class="btn text-black shadow-none group-hover:text-primary group-hover:border-primary group-hover:bg-primary/10 dark:text-white-dark dark:border-white-dark/50"
                                    >Buy Now</a
                                >
                            </div>
                            <div class="p-3 lg:p-5 border border-black dark:border-[#1b2e4b] text-center rounded group hover:border-primary">
                                <h3 class="text-xl lg:text-2xl">Advanced Savers</h3>
                                <div class="border-t border-black dark:border-white-dark w-1/5 mx-auto my-6 group-hover:border-primary"></div>
                                <p class="text-[15px]">For experienced water savers who'd like to push their limits</p>
                                <div class="my-7 p-2.5 text-center text-lg group-hover:text-primary">
                                    <strong class="text-[#3b3f5c] dark:text-white-dark text-3xl lg:text-5xl group-hover:text-primary">$29</strong> / monthly
                                </div>
                                <ul class="space-y-2.5 mb-5 font-semibold group-hover:text-primary">
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Free water saving e-book
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Free access to forums
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Advanced saving tips
                                    </li>
                                </ul>
                                <a
                                    href="#"
                                    target="_self"
                                    class="btn text-black shadow-none group-hover:text-primary group-hover:border-primary group-hover:bg-primary/10 dark:text-white-dark dark:border-white-dark/50"
                                    >Buy Now</a
                                >
                            </div>
                            <div class="p-3 lg:p-5 border border-black dark:border-[#1b2e4b] text-center rounded group hover:border-primary">
                                <h3 class="text-xl lg:text-2xl">Pro Savers</h3>
                                <div class="border-t border-black dark:border-white-dark w-1/5 mx-auto my-6 group-hover:border-primary"></div>
                                <p class="text-[15px]">For all the professionals who'd like to educate others, too</p>
                                <div class="my-7 p-2.5 text-center text-lg group-hover:text-primary">
                                    <strong class="text-[#3b3f5c] dark:text-white-dark text-3xl lg:text-5xl group-hover:text-primary">$79</strong> / monthly
                                </div>
                                <ul class="space-y-2.5 mb-5 font-semibold group-hover:text-primary">
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Access to all books
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Unlimited board topics
                                    </li>
                                    <li class="flex justify-center items-center">
                                        <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                        Beginners tips
                                    </li>
                                </ul>
                                <a
                                    href="#"
                                    target="_self"
                                    class="btn text-black shadow-none group-hover:text-primary group-hover:border-primary group-hover:bg-primary/10 dark:text-white-dark dark:border-white-dark/50"
                                    >Buy Now</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>