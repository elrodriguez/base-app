<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import UpdateInformationForm from './Partials/UpdateInformationForm.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

const props = defineProps({
    identityDocumentTypes: {
        type: Object,
        default: () => ({}),
    },
    ubigeo: {
        type: Object,
        default: () => ({})
    },
    person:{
        type: Object,
        default : () => ({})
    }
});
const baseUrl = assetUrl;

const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}
</script>

<template>
    <AppLayout title="Actualizar Información">
        <Navigation :routeModule="route('aca_dashboard')" :titleModule="'AcaAcadémico'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Actualizar Información</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <!-- jumbotron fluid -->
            <div class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light">
                <h2 class="text-dark mb-5  mt-4 text-center text-5xl dark:text-white-light">Estimado usuario</h2>
                <p class="mt-3 mb-4 dark:text-white-light">Lamentamos interrumpir su actividad. Le solicitamos que verifique la veracidad de la información proporcionada. En caso de que sea correcta, le agradeceremos que proceda a realizar la acción de guardar los cambios.</p>
                <blockquote class="text-black p-5 ltr:pl-3.5 rtl:pr-3.5 bg-white shadow-md rounded-tr-md rounded-br-md border border-white-light border-l-2 !border-l-primary dark:bg-[#060818] dark:border-[#060818]">
                    <div class="flex items-start">
                        <div class="w-14 h-14 ltr:mr-5 rtl:ml-5 flex-none">
                            <img :src="getImage(person.image)" alt="" class="w-14 h-14 rounded-full object-cover m-auto" />
                        </div>
                        <p class="not-italic text-[#515365] text-sm dark:text-white-light m-0">{{ person.gender == 'M' ? 'Sr.' : 'Sra.' }} {{ person.full_name }}, esta acción se realizará solo una vez para estar seguros de que sus datos son correctos.</p>
                    </div>
                    <small class="ltr:text-right rtl:text-left w-full not-italic text-xs text-[#777] block before:w-3 before:h-[1px] before:bg-[#777] before:inline-block before:opacity-50 before:relative before:-top-1 before:ltr:mr-1 rtl:ml-1">Atentamente, <cite class="italic">La Administración</cite></small>
                </blockquote>
            </div>
        </div>
        <div class="mt-5">
            <UpdateInformationForm :person="person" :identityDocumentTypes="identityDocumentTypes" :ubigeo="ubigeo" /> 
        </div>
    </AppLayout>
</template>
