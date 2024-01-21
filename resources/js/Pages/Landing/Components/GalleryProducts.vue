<script setup>


const xAssetUrl = assetUrl;

const props = defineProps({
    products:{
        type: Object,
        default: () => ({})
    },
    categories: {
        type: Object,
        default: () => ({})
    }
});

</script>

<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">

            <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
                <button type="button" class="uppercase text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">All categories</button>
                <template v-if="categories.length > 0">
                    <template v-for="(category, index) in categories">
                        <button type="button" class="uppercase text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:text-white dark:focus:ring-gray-800">{{ category.category_description }}</button>
                    </template>
                </template>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <template v-if="products.length > 0">
                    <div v-for="(product, key) in products">
                        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="p-8 rounded-t-lg" :src="product.image" alt="product image" />
                            </a>
                            <div class="px-5 pb-5">
                                <a href="#">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ product.name }}</h5>
                                </a>
                                <div class="flex items-center justify-between">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white">S/ {{ product.price }}</span>
                                    <a :href="route('whatsapp_send', product.id)" target="_blank" type="button" class="px-2.5 py-2.5 text-center inline-flex items-center me-2 mb-2">
                                        <img src="/img/Landing/whatsapp.png" style="width: 40px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>                
            </div>
        </div>
    </section>
</template>
