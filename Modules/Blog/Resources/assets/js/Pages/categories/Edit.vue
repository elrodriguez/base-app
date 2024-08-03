<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import editForm from './Pertials/editForm.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    category: {
        type: Object,
        default: () => ({}),
    }
});
</script>

<template>
    <AppLayout title="Editar Categoria">
        <Navigation :routeModule="route('blog_dashboard')" :titleModule="'Blog'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('blog-category.index')" class="text-primary hover:underline">Categorías</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Editar</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <editForm :category="category"></editForm>
        </div>
    </AppLayout>
</template>
