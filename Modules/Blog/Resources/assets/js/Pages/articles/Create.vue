<script setup>
import AppLayout from '../../layouts/master.vue';
import CreateForm from './Pertials/createForm.vue';


</script>

<template>
    <AppLayout title="Blog Nueva Articulo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nueva Articulo
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <CreateForm></CreateForm>
            </div>
        </div>
    </AppLayout>
</template>
