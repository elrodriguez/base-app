<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateForm from './Partials/CreateForm.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

const props = defineProps({
    categories: {
        type: Object,
        default: () => ({}),
    }
});
</script>

<template>
    <AppLayout title="Crear Categoría">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('sale_category_product_list')" class="text-primary hover:underline">Categorías</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateForm :categories="categories" /> 
        </div>
    </AppLayout>
</template>
