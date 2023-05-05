<script setup>
import { Head } from '@inertiajs/vue3';
import StockTotal from '../Pages/Kardex/Partials/StockTotal.vue';
import Banner from '@/Components/Banner.vue';
import Navigation from '@/Components/Navigation.vue';

defineProps({
    title: String,
});

</script>

<template>
    <Head :title="title" />

    <Banner />

    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <Navigation></Navigation>
            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-3">
                        <div class="col-span-3 sm:col-span-1">
                            <slot name="header" />
                        </div>
                        <div class="col-span-3 sm:col-span-2 text-right">
                            <StockTotal />
                        </div>
                    </div>
                    
                    
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
