<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import EditForm from './Partials/EditForm.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

const props = defineProps({
    parameter: {
        type: Object,
        default: () => ({}),
    }
});
</script>

<template>
    <AppLayout title="Editar Parametro">
        <Navigation >
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Configuraciones</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('parameters')" class="text-primary hover:underline">Parametros</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Editar</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <EditForm :parameter="parameter" /> 
        </div>
    </AppLayout>
</template>
