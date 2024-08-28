<script setup>
    import { Link } from "@inertiajs/vue3";

    defineProps({
        articles:{
            type: Object,
            default: () => ({})
        }
    });
    const formatDateArticle = (dateString) => {
        const dateObj = new Date(dateString);
        const options = { month: 'short', day: 'numeric', year: 'numeric', locale: 'es-ES' };
        return dateObj.toLocaleDateString('es-ES', options);
    }
</script>
<template>
    <div>
        <h6 class="mb-2 text-gray-900 text-xl dark:text-gray-50">Publicación popular</h6>
        <div class="w-full h-0.5 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
            <div class="bg-primary h-0.5 rounded-full rounded-bl-full w-8/12 text-center text-white text-xs"></div>
        </div>
        <ul class="my-4 space-y-4">
            <li v-for="(arti, ix) in articles" class="flex">
                <div class="ltr:mr-4 rtl:ml-4">
                    <img :src="arti.imagen" alt="" class="w-16 h-16 rounded" />
                </div>
                <div class="flex-1">
                    <Link :href="route('blog_article_show_studante',arti.url)" class="font-semibold text-lg mb-2 text-gray-900 dark:text-white">{{ arti.title }}</Link>
                    <span class="block text-sm text-gray-500 dark:text-gray-300">{{ formatDateArticle(arti.created_at) }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>