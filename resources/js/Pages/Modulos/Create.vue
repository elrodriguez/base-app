<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import CreateForm from './Partials/CreateForm.vue';
import Navigation from "@/Components/vristo/layout/Navigation.vue";
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <AppLayout title="Crear Cliente">
        <Navigation :routeModule="route('security_dashboard')" :titleModule="'Configuraciones'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('modulos.index')" class="text-primary hover:underline">Modulos</Link>
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
