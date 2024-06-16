<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import ResumeForm from './Partials/ResumeForm.vue';
import { Link } from '@inertiajs/vue3';
import { faCheck, faTrashAlt } from "@fortawesome/free-solid-svg-icons";


const props = defineProps({
    person: {
        type: Object,
        default: () => ({}),
    },
    teacher: {
        type: Object,
        default: () => ({}),
    },
    resumes: {
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
                <Link :href="route('aca_teachers_list')" class="text-primary hover:underline">Docentes</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>{{ person.full_name }}</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Currículum</span>
            </li>
        </ul>
        <div class="pt-5">
           <ResumeForm :resumes="resumes" :teacher="teacher" :faCheck="faCheck" :faTrashAlt="faTrashAlt" /> 
        </div>
    </AppLayout>
</template>
