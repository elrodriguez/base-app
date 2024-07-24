<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import EditProductForm from './Partials/EditProductForm.vue';
    import { Link } from '@inertiajs/vue3';
    defineProps({
        product: {
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
    <AppLayout title="Editar Producto">
        
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('products.index')" class="text-primary hover:underline">Productos</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Editar</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <EditProductForm 
                :product="product"
                :categories="categories" 
                :brands="brands"
            />
        </div>
    </AppLayout>
</template>
