<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import CreateForm from './Pertials/createForm.vue';

const props = defineProps({
    roles: {
        type: Object,
        default: () => ({}),
    }
});
</script>

<template>
    <AppLayout title="Crear Permisos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nuevo Permiso
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <CreateForm :roles="roles"></CreateForm>
            </div>
        </div>
    </AppLayout>
</template>
