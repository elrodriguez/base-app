<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import EditProductForm from './Partials/EditProductForm.vue';

    defineProps({
        product: {
            type: Object,
            default: () => ({}),
        }
    });
</script>

<template>
    <AppLayout title="Editar Producto">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
                Editar Producto
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <EditProductForm 
                    :product="product"
                />
            </div>
        </div>
    </AppLayout>
</template>
