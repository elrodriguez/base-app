<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import InformationForm from './Partials/InformationForm.vue';
import { Link } from '@inertiajs/vue3';
import { faCheck, faTrashAlt } from "@fortawesome/free-solid-svg-icons";

const props = defineProps({
    brochure:{
        type: Object,
        default: () => ({}),
    },
    course: {
        type: Object,
        default: () => ({}),
    },
    tiny_api_key: {
        type: String,
        default: () => ({}),
    },
    teachers: {
        type: Object,
        default: () => ({}),
    },
    course_teachers: {
        type: Object,
        default: () => ({}),
    }
});

</script>

<template>
    <AppLayout title="Información">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_courses_list')" class="text-primary hover:underline">Cursos</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_courses_edit',course.id)" class="text-primary hover:underline">{{ course.description }}</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Información</span>
            </li>
        </ul>
        <div class="pt-5">
            <InformationForm 
                :course_teachers="course_teachers" 
                :teachers="teachers" 
                :course="course" 
                :tiny_api_key="tiny_api_key" 
                :brochure="brochure" 
                :faCheck="faCheck"
                :faTrashAlt="faTrashAlt" 
            /> 
        </div>
    </AppLayout>
</template>
