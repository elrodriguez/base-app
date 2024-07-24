<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateForm from './Partials/CreateForm.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

const props = defineProps({
    courses: {
        type: Object,
        default: () => ({}),
    },
    products: {
        type: Object,
        default: () => ({}),
    },
    tiny_api_key: {
        type: String,
        default: () => ({}),
    },
    type: {
        type: String,
        default: () => ({}),
    }
});

</script>

<template>
    <AppLayout title="Crear Producto">
        <Navigation :routeModule="route('onlineshop_dashboard')" :titleModule="'Ventas en línea'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('onlineshop_items')" class="text-primary hover:underline">Productos & servicios</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Editar</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateForm :courses="courses" :products="products" :tiny_api_key="tiny_api_key" :type="type" /> 
        </div>
    </AppLayout>
</template>
