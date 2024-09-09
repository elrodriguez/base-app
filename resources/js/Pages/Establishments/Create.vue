<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import CreateForm from '@/Pages/Establishments/Partials/CreateForm.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        users: {
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
    <AppLayout title="Crear Tienda">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('establishments.index')" class="text-primary hover:underline">Tiendas</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateForm :users="users" :ubigeo="ubigeo" />
        </div>
    </AppLayout>
</template>
