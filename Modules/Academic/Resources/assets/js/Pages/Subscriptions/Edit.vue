<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import EditForm from './Partials/EditForm.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

defineProps({
    subscription: {
        type: Object,
        default: () => ({})
    },
    periods: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <AppLayout title="Editar">
        <Navigation :routeModule="route('aca_dashboard')" :titleModule="'Académico'">
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_subscriptions_list')" class="text-primary hover:underline">Tipo de suscripcion</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Editar</span>
            </li>
        </Navigation>
        <div class="pt-5">
            <EditForm :subscription="subscription" :periods="periods" />
        </div>
    </AppLayout>  
</template>
