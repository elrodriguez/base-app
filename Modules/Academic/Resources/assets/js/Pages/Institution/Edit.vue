<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import EditForm from './Partials/EditForm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    institution: {
        type: Object,
        default: () => ({}),
    }
});

</script>

<template>
    <AppLayout title="Editar Institución">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_institutions_list')" class="text-primary hover:underline">Institución</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Editar</span>
            </li>
        </ul>
        <div class="pt-5">
            <EditForm :institution="institution" /> 
        </div>
    </AppLayout>
</template>
