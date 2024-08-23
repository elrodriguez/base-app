<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import CreateForm from './Partials/CreateForm.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';


</script>

<template>
    <AppLayout title="Crear Curso">
        <Navigation :routeModule="route('aca_dashboard')" :titleModule="'Académico'">
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_subscriptions_list')" class="text-primary hover:underline">Tipo de suscripcion</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="pt-5">
            <CreateForm />
        </div>
    </AppLayout>  
</template>
