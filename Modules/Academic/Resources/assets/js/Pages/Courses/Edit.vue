<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import EditForm from './Partials/EditForm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    course: {
        type: Object,
        default: () => ({}),
    },
    modalities: {
        type: Object,
        default: () => ({}),
    },
    categories: {
        type: Object,
        default: () => ({}),
    },
    types: {
        type: Object,
        default: () => ({}),
    },
    sectors: {
        type: Object,
        default: () => ({}),
    }
});

</script>

<template>
    <AppLayout title="Editar Curso">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <a :href="route('aca_courses_list')" class="text-primary hover:underline">Cursos</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Editar</span>
            </li>
        </ul>
        <div class="pt-5">
            <EditForm :course="course" :modalities="modalities" :categories="categories" :types="types" :sectors="sectors" /> 
        </div>
    </AppLayout>
</template>
