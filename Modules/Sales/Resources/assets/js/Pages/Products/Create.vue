<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateProductForm from './Partials/CreateProductForm.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

const props = defineProps({
    establishments: {
        type: Object,
        default: () => ({}),
    },
    categories: {
        type: Object,
        default: () => ({}),
    },
    brands: {
        type: Object,
        default: () => ({}),
    }
});
</script>

<template>
    <AppLayout title="Crear Producto">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('products.index')" class="text-primary hover:underline">Productos</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateProductForm 
                :categories="categories" 
                :establishments="establishments"
                :brands="brands"
            />
        </div>
    </AppLayout>
</template>
