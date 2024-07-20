<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateForm from './Partials/CreateForm.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

</script>

<template>
    <AppLayout title="Crear Marca">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('sale_brands_product_list')">Marcas</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">

            <CreateForm /> 
        </div>
    </AppLayout>
</template>
