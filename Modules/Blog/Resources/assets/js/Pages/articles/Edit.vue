<script setup>
import AppLayout from '../../layouts/master.vue';
import editForm from './Pertials/editForm.vue';

const props = defineProps({
    article: {
        type: Object,
        default: () => ({}),
    }
});
</script>

<template>
    <AppLayout title="Blog Nueva Articulo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Articulo
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <editForm :article="article"></editForm>
            </div>
        </div>
    </AppLayout>
</template>
