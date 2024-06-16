<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import CreateForm from './Partials/CreateForm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    modalities: {
        type: Object,
        default: () => ({}),
    },
    categories: {
        type: Object,
        default: () => ({}),
    }
});

</script>

<template>
    <AppLayout title="Crear Curso">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <a :href="route('aca_courses_list')" class="text-primary hover:underline">Cursos</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Nuevo</span>
            </li>
        </ul>
        <div class="pt-5">
            <CreateForm :modalities="modalities" :categories="categories" /> 
        </div>
    </AppLayout>  
</template>
