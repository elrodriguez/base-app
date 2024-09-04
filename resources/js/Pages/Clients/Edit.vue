<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import EditClientForm from '@/Pages/Clients/Partials/EditClientForm.vue';
    import { Link } from '@inertiajs/vue3';
    import Navigation from "@/Components/vristo/layout/Navigation.vue";

    defineProps({
        client: {
            type: Object,
            default: () => ({}),
        },
        identityDocumentTypes: {
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
    <AppLayout title="Editar cliente">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('clients.index')" class="text-primary hover:underline">Clientes</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Editar</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <EditClientForm
                :client="client"
                :identityDocumentTypes="identityDocumentTypes"
                :ubigeo="ubigeo"
            />
        </div>

    </AppLayout>
</template>
