<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateProviderForm from './Partials/CreateProviderForm.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

</script>

<template>
    <AppLayout title="Create Team">
        <Navigation :routeModule="route('purchases_dashboard')" :titleModule="'Compras'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('providers.index')">Proveedores</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <CreateProviderForm />
        </div>
    </AppLayout>
</template>
