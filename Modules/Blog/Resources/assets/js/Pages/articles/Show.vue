<script setup>
    import { useForm, Link } from "@inertiajs/vue3"
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
    import Categories from '../../components/Categories.vue';
    import PopularPost from '../../components/PopularPost.vue';
    import Archives from '../../components/Archives.vue';
    import Comments from '../../components/Comments.vue';
    import Carousel from '../../components/Carousel.vue';

    import { ref } from 'vue';

    defineProps({
        article: {
            type: Object,
            default: () => ({})
        },
        categories: {
            type: Object,
            default: () => ({})
        },
        articles: {
            type: Object,
            default: () => ({})
        },
        archives: {
            type: Object,
            default: () => ({})
        },
        comments: {
            type: Object,
            default: () => ({})
        }
    });

    const txtSearch = ref(null);

    const xasset = assetUrl;

    const getImage = (path) => {
        return xasset + 'storage/'+ path;
    }

    const formatDate = (dateString) => {
        const dateObj = new Date(dateString);
        const options = { month: 'short', day: 'numeric', year: 'numeric', locale: 'es-ES' };
        return dateObj.toLocaleDateString('es-ES', options);
    }
</script>

<template>
    <AppLayout title="Articulo">
        <section class="panel py-10">
            <div class="container mx-auto">
                <div class="grid grid-cols-12 md:gap-8">
                    <div class="col-span-12 md:col-span-6 md:col-start-4">
                        <div class="text-center">
                            <p class="mb-0 font-semibold text-red-600">{{ article.category.description }}</p>
                            <h3 class="text-gray-900 text-[26px] dark:text-white">{{ article.title }}</h3>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 mt-8 md:gap-14">
                    <div class="col-span-12 lg:col-span-8">
                        <div class="swiper blogdetailSlider">
                            <img :src="article.imagen" alt="" class="rounded-lg" style="width: 100%;" />
                        </div>
                        <ul class="flex flex-wrap items-center mt-3 mb-0 text-gray-500">
                            <li>
                                <div class="flex items-center">
                                    <div class="shrink-0">
                                        <img v-if="article.author.avatar"
                                            class="w-12 h-12 rounded-full"
                                                :src="getImage(article.author.avatar)"
                                                :alt="article.author.name"
                                            />
                                        <img v-else :src="`https://ui-avatars.com/api/?name=${article.author.name}&size=150&rounded=true`" class="w-12 h-12 rounded-full" />
                                    </div>
                                    <div class="ltr:ml-3 rtl:mr-3">
                                        <a href="#" class="text-gray-900 dark:text-white">
                                            <h6 class="mb-0 dark:text-gray-300">{{ article.author.name }}</h6>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="ltr:ml-3 rtl:mr-3">
                                <div class="flex items-center">
                                    <div class="shrink-0">
                                        <i class="uil uil-calendar-alt"></i>
                                    </div>
                                    <div class="ltr:ml-2 rtl:mr-2">
                                        <p class="mb-0 dark:text-gray-300"> {{ formatDate(article.created_at) }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="ltr:ml-3 rtl:mr-3">
                                <div class="flex items-center">
                                    <div class="shrink-0">
                                        <i class="uil uil-comments-alt"></i>
                                    </div>
                                    <div class="ltr:ml-2 rtl:mr-2 flex-grow-1">
                                        <p class="mb-0 dark:text-gray-300"> 2 Comments</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <div v-html="article.content_text"></div>
                            <div class="flex items-center my-4">
                                <div class="shrink-0">
                                    <b class="text-gray-900 dark:text-gray-50">Tags:</b>
                                </div>
                                <div class="ltr:ml-2 rtl:mr-2 flex-grow-1 space-x-2">
                                    <template v-for="tag in JSON.parse(JSON.stringify(article.keywords))">
                                        <a href="javascript:void(0)" class="px-1.5 py-0.5 mt-1 text-sm font-medium text-green-500 bg-green-500/20 rounded">{{ tag }}</a>
                                    </template>
                                </div>
                            </div>
                            <!-- <ul class="flex gap-2 mb-0 md:justify-end">
                                <li>
                                    <b class="text-gray-900 dark:text-gray-50">Share post:</b>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="p-2.5 rounded bg-violet-500/20 text-violet-500">
                                        <i class="uil uil-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="p-2.5 rounded bg-green-500/20 text-green-500">
                                        <i class="uil uil-whatsapp"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="p-2.5 rounded bg-violet-500/20 text-violet-500">
                                        <i class="uil uil-linkedin-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="p-2.5 rounded bg-red-500/20 text-red-500">
                                        <i class="uil uil-envelope"></i>
                                    </a>
                                </li>
                            </ul> -->
                            
                            <Comments :comments="comments" :article="article" />                            
                        </div>
                        <div class="mt-8">
                            <Carousel />
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <form class="mx-auto w-full mb-5">
                            <div class="relative">
                                <input
                                    type="text"
                                    placeholder="Buscar..."
                                    class="form-input shadow-[0_0_4px_2px_rgb(31_45_61_/_10%)] bg-white rounded-full h-11 placeholder:tracking-wider ltr:pr-11 rtl:pl-11"
                                    v-model="txtSearch"
                                />
                                <button type="button" class="btn btn-primary absolute ltr:right-1 rtl:left-1 inset-y-0 m-auto rounded-full w-9 h-9 p-0 flex items-center justify-center">
                                    <font-awesome-icon :icon="faMagnifyingGlass" />
                                </button>
                            </div>
                        </form>
                        <div class="mt-8">
                            <Categories :categories="categories" :categoryActive="article.category_id" />
                        </div>
                        <div class="mt-8">
                            <PopularPost :articles="articles" />
                        </div>
                        <div class="mt-8">
                            <Archives :archives="archives" />
                        </div>
                        <!-- <div class="mt-8">
                            <h6 class="mb-2 text-gray-900 text-16 dark:text-gray-50">Seguir y conectar</h6>
                            <div class="w-full h-0.5 rounded-full bg-gray-100/60 dark:bg-gray-500/20">
                                <div class="group-data-[theme-color=violet]:bg-violet-500 group-data-[theme-color=sky]:bg-sky-500 group-data-[theme-color=red]:bg-red-500 group-data-[theme-color=green]:bg-green-500 group-data-[theme-color=pink]:bg-pink-500 group-data-[theme-color=blue]:bg-blue-500 w-[25%] h-0.5 ltr:rounded-l-full rtl:rounded-r-full" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <ul class="flex flex-wrap gap-3 mt-4">
                                <li class="leading-9 text-center ease-in rounded-full w-9 h-9 bg-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:text-white hover:transition-all dark:bg-gray-500/20 dark:text-white dark:hover:bg-violet-500/20 dark:hover:text-gray-50">
                                    <a href="javascript:void(0)"><i class="uil uil-facebook-f"></i></a>
                                </li>
                                <li class="leading-9 text-center ease-in rounded-full w-9 h-9 bg-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:text-white hover:transition-all dark:bg-gray-500/20 dark:text-white dark:hover:bg-violet-500/20 dark:hover:text-gray-50">
                                    <a href="javascript:void(0)"><i class="uil uil-whatsapp"></i></a>
                                </li>
                                <li class="leading-9 text-center ease-in rounded-full w-9 h-9 bg-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:text-white hover:transition-all dark:bg-gray-500/20 dark:text-white dark:hover:bg-violet-500/20 dark:hover:text-gray-50">
                                    <a href="javascript:void(0)"><i class="uil uil-twitter-alt"></i></a>
                                </li>
                                <li class="leading-9 text-center ease-in rounded-full w-9 h-9 bg-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:text-white hover:transition-all dark:bg-gray-500/20 dark:text-white dark:hover:bg-violet-500/20 dark:hover:text-gray-50">
                                    <a href="javascript:void(0)"><i class="uil uil-dribbble"></i></a>
                                </li>
                                <li class="leading-9 text-center ease-in rounded-full w-9 h-9 bg-gray-50 group-data-[theme-color=violet]:hover:bg-violet-500 group-data-[theme-color=sky]:hover:bg-sky-500 group-data-[theme-color=red]:hover:bg-red-500 group-data-[theme-color=green]:hover:bg-green-500 group-data-[theme-color=pink]:hover:bg-pink-500 group-data-[theme-color=blue]:hover:bg-blue-500 hover:text-white hover:transition-all dark:bg-gray-500/20 dark:text-white dark:hover:bg-violet-500/20 dark:hover:text-gray-50">
                                    <a href="javascript:void(0)"><i class="uil uil-envelope"></i></a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>