<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import EditForm from '@/Pages/Establishments/Partials/EditForm.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        users: {
            type: Object,
            default: () => ({}),
        },
        local:{
            type: Object,
            default: () => ({}),
        },
        seller:{
            type: Object,
            default: () => ({}),
        },
        ubigeo: {
            type: Object,
            default: () => ({}),
        }
    });

</script>

<template>
    <AppLayout title="Editar Tienda">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('establishments.index')"  class="text-primary hover:underline" >Tiendas</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Editar</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <EditForm :users="users" :local="local" :seller="seller" :ubigeo="ubigeo" />
            </div>
        </div>
    </AppLayout>
</template>
