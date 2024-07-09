<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
import CreateItemForm from './Partials/CreateItemForm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    types: {
        type: Object,
        default: () => ({}),
    }
});

</script>

<template>
    <AppLayout title="Crear Producto">
        <Navigation :routeModule="route('cms_dashboard')" :titleModule="'CMS'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('cms_items_list')">Items</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateItemForm :types="types" /> 
        </div>
    </AppLayout>
</template>
