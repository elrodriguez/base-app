<script  setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import { useForm, router, Link  } from '@inertiajs/vue3';

import { ref, watch  } from 'vue';
import { faStar, faStarHalfStroke } from "@fortawesome/free-solid-svg-icons";
import IconStarRegular from '@/Components/vristo/icon/icon-star-regular.vue';

const props = defineProps({
    courses: {
        type: Object,
        default: () => ({}),
    }
});


const baseUrl = assetUrl;

const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}
</script>

<template>
    <AppLayout title="Mis Cursos">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Mis cursos</span>
            </li>
        </ul>
        <div class="pt-5">
            <section class="py-10 rounded-md dark:bg-gray-800">
                <h1 class="text-center text-2xl font-bold text-gray-800 dark:text-gray-50">Cursos</h1>

                <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 pt-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <template v-for="(course, index) in courses">
                        <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 dark:bg-gray-900">
                            <Link :href="route('aca_mycourses_lessons',course.id)">
                                <div class="relative flex items-end overflow-hidden rounded-xl">
                                    <img :src="getImage(course.image)" alt="Hotel Photo" />
                                    <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>

                                        <Link :href="route('aca_mycourses_lessons',course.id)" class="text-sm">Ir al curso</Link>
                                    </div>
                                </div>

                                <div class="mt-1 p-2">
                                    <p class="mt-1 text-sm text-slate-400">{{ course.modality.description }}</p>
                                    <h2 class="text-slate-700 dark:text-slate-400">{{ course.description }}</h2>
                               </div>
                            </Link>
                        </article>
                    </template>
                </div>
            </section>

        </div>
    </AppLayout>
</template>