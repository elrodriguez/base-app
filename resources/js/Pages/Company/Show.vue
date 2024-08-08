<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import InformationCompany from "./Partials/InformationCompany.vue";
import Navigation from "@/Components/vristo/layout/Navigation.vue";

const props = defineProps({
    company: {
        type: Object,
        default: () => ({}),
    },
    ubigeo: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <AppLayout title="Empresa">
        <Navigation>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Configuraciones</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Empresa</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <InformationCompany
                :company="company"
                :ubigeo="ubigeo"
            ></InformationCompany>
        </div>
    </AppLayout>
</template>
