<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateForm from './Pertials/createForm.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    permissions: {
        type: Object,
        default: () => ({}),
    }
});
</script>

<template>
    <AppLayout title="Crear Rol">
        <Navigation :routeModule="route('security_dashboard')" :titleModule="'Configuraciones'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('roles.index')" class="text-primary hover:underline">Roles</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <CreateForm :permissions="permissions"></CreateForm>
            </div>
        </div>
    </AppLayout>
</template>
