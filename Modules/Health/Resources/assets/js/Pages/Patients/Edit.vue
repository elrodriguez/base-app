<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import EditForm from './Partials/EditForm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    identityDocumentTypes: {
        type: Object,
        default: () => ({}),
    },
    ubigeo: {
        type: Object,
        default: () => ({})
    },
    patient: {
        type: Object,
        default: () => ({})
    }
});

</script>

<template>
    <AppLayout title="Crear Producto">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Salud</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('heal_patients_list')" class="text-primary hover:underline">Pacientes</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Editar</span>
            </li>
        </ul>
        <div class="pt-5">
            <EditForm :patient="patient" :identityDocumentTypes="identityDocumentTypes" :ubigeo="ubigeo" /> 
        </div>
    </AppLayout>
</template>
