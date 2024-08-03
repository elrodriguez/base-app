<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateForm from './Pertials/createForm.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import { Link } from "@inertiajs/vue3";

</script>

<template>
    <AppLayout title="Nueva Categoria">
        <Navigation :routeModule="route('blog_dashboard')" :titleModule="'Blog'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('blog-category.index')" class="text-primary hover:underline">Categorías</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateForm></CreateForm>
        </div>

    </AppLayout>
</template>
