<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateForm from './Pertials/createForm.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    categories: {
        type: Object,
        default: () => ({})
    },
    tiny_api_key: {
        type: String,
        default: null,
    }
});
</script>

<template>
    <AppLayout title="Blog Nueva Articulo">
        <Navigation :routeModule="route('blog_dashboard')" :titleModule="'Blog'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('blog-article.index')" class="text-primary hover:underline">Artículos</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateForm :tiny_api_key="tiny_api_key" :categories="categories"></CreateForm>
        </div>
    </AppLayout>
</template>
