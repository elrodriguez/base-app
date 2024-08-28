<script setup>
    import { useForm, Link } from "@inertiajs/vue3"
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
    import Categories from '../../components/Categories.vue';
    import PopularPost from '../../components/PopularPost.vue';
    import Archives from '../../components/Archives.vue';
    import IconEye from '@/Components/vristo/icon/icon-eye.vue';
    import IconArrowLeft from '@/Components/vristo/icon/icon-arrow-left.vue';

    import { ref } from 'vue';

    defineProps({
        category_id: {
            type: Number,
            default: null
        },
        articlesCategory: {
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
        }
    });

    const txtSearch = ref(null);

    const xasset = assetUrl;

    const getImage = (path) => {
        return xasset + 'storage/'+ path;
    }

    const formatDateCategory = (dateString) => {
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
                    
                </div>
                <div class="grid grid-cols-12 mt-8 md:gap-14">
                    <div class="col-span-12 lg:col-span-8">
                        <div class="grid grid-cols-12 md:gap-5">
                            <template v-for="(row, key) in articlesCategory">
                                <div class="col-span-12 lg:col-span-6">
                                    <div class="p-2 transition-all duration-500 bg-white rounded-md shadow-md hover:-translate-y-2 dark:bg-transparent dark:shadow-none">
                                        <img :src="row.imagen" alt="" class="img-fluid">
                                        <div class="p-5">
                                            <ul class="flex justify-between mb-3 list-inline">
                                                <li>
                                                    <p class="mb-0 text-gray-500 dark:text-gray-300">
                                                        <a href="#" class="font-semibold text-muted">{{ row.author.name }}</a> - {{ formatDateCategory(row.created_at) }}
                                                    </p>
                                                </li>
                                                <li>
                                                    <p class="flex mb-0 text-gray-500 dark:text-gray-300"><icon-eye class="mr-1" /> {{ row.views }}</p>
                                                </li>
                                            </ul>
                                            <Link :href="route('blog_article_show_studante', row.url)" class="primary-link">
                                                <h6 class="text-gray-900 transition-all duration-300 text-17 dark:text-white group-data-[theme-color=violet]:hover:text-violet-500 group-data-[theme-color=sky]:hover:text-sky-500 group-data-[theme-color=red]:hover:text-red-500 group-data-[theme-color=green]:hover:text-green-500 group-data-[theme-color=pink]:hover:text-pink-500 group-data-[theme-color=blue]:hover:text-blue-500">
                                                    {{ row.title }}
                                                </h6>
                                            </Link>
                                            <p class="mt-2 text-gray-500 dark:text-gray-300">
                                                {{ row.short_description }}
                                            </p>
                                            <div class="mt-4 font-medium group-data-[theme-color=violet]:text-violet-500 group-data-[theme-color=sky]:text-sky-500 group-data-[theme-color=red]:text-red-500 group-data-[theme-color=green]:text-green-500 group-data-[theme-color=pink]:text-pink-500 group-data-[theme-color=blue]:text-blue-500">
                                                <Link :href="route('blog_article_show_studante', row.url)" class="form-text flex items-center">Leer más <icon-arrow-left /></Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
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
                            <Categories :categories="categories" :categoryActive="category_id" />
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