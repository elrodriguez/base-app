

<!-- script -->
<script setup>
    import { ref } from 'vue';
    import { Swiper, SwiperSlide } from 'swiper/vue';
    import { Navigation, Pagination, Autoplay } from 'swiper/modules';

    import 'swiper/css';
    import 'swiper/css/navigation';
    import 'swiper/css/pagination';

    import { Link } from "@inertiajs/vue3"

    defineProps({
        articles: {
            type: Object,
            default: () => ({})
        }
    });

    const xasset = assetUrl;

    const getImage = (path) => {
        return xasset +'storage/'+ path;
    }

</script>
<template>
    <div v-if="articles.length > 0">
        <h5 class="pb-3 text-xl text-gray-900 border-b border-gray-100/50 dark:text-gray-50 dark:border-zinc-700">Artículos relacionados</h5>

        <!-- autopaly -->
        <swiper
            :modules="[Navigation,Pagination, Autoplay]"
            :navigation="{ nextEl: '.swiper-button-next-ex2', prevEl: '.swiper-button-prev-ex2' }"
            :autoplay="{ delay: 2000 }"
            :pagination="{ clickable: true }"
            class="max-w-3xl mx-auto mb-5"
            id="slider2"
        >
            <template v-for="(item, i) in articles" :key="i">
                <swiper-slide>
                    <img :src="item.imagen" class="w-full max-h-80 object-cover" alt="" />
                    <div class="absolute z-[999] text-white top-1/4 ltr:left-12 rtl:right-12">
                        <div class="sm:text-3xl text-base font-bold">{{ item.title }}</div>
                        <div class="sm:mt-5 mt-1 w-4/5 text-base sm:block hidden font-medium">
                            {{ item.short_description }}
                        </div>
                        <Link style="width: 120px" href="route('blog_article_show_studante',item.url)" type="button" class="mt-4 btn btn-primary">Leer mas</Link>
                    </div>
                </swiper-slide>
            </template>
            <a
                href="javascript:;"
                class="
                swiper-button-prev-ex2
                grid
                place-content-center
                ltr:left-2
                rtl:right-2
                p-1
                transition
                text-primary
                hover:text-white
                border border-primary
                hover:border-primary hover:bg-primary
                rounded-full
                absolute
                z-[999]
                top-1/2
                -translate-y-1/2
                "
            >
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-rotate-90 rotate-90">
                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
            <a
                href="javascript:;"
                class="
                swiper-button-next-ex2
                grid
                place-content-center
                ltr:right-2
                rtl:left-2
                p-1
                transition
                text-primary
                hover:text-white
                border border-primary
                hover:border-primary hover:bg-primary
                rounded-full
                absolute
                z-[999]
                top-1/2
                -translate-y-1/2
                "
            >
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:rotate-90 -rotate-90">
                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
        </swiper>
    </div>
</template>