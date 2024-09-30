<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import EditProviderForm from './Partials/EditProviderForm.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    
    defineProps({
        provider: {
            type: Object,
            default: () => ({}),
        }
    });
</script>

<template>
    <AppLayout title="Edit Provider">
        <Navigation :routeModule="route('purchases_dashboard')" :titleModule="'Compras'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('providers.index')">Proveedores</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Editar</span>
            </li>
        </Navigation>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <EditProviderForm
                :provider="provider"
            />
        </div>
    </AppLayout>
</template>
