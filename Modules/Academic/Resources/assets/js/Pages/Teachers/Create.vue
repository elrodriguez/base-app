<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import CreateForm from './Partials/CreateForm.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Swal2 from 'sweetalert2';

const props = defineProps({
    identityDocumentTypes: {
        type: Object,
        default: () => ({}),
    },
    ubigeo: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <AppLayout title="Crear Docente">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_teachers_list')" class="text-primary hover:underline">Docentes</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Nuevo</span>
            </li>
        </ul>
        <div class="pt-5">
            <CreateForm 
                :identityDocumentTypes="identityDocumentTypes" 
                :ubigeo="ubigeo"
             /> 
        </div>
    </AppLayout>
</template>
