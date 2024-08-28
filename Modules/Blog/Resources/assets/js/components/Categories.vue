<script setup >
    import { Link } from "@inertiajs/vue3"
    defineProps({
        categories: {
            type: Object,
            default: () => ({})
        },
        categoryActive:{
            type: Number,
            default: null
        }
    });
</script>
<template>
    <div>
        <h6 class="mb-2 text-gray-900 text-xl dark:text-gray-50">Categorías</h6>
        <div class="w-full h-0.5 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
            <div class="bg-primary h-0.5 rounded-full rounded-bl-full w-5/12 text-center text-white text-xs"></div>
        </div>
        <div class="my-4">
            <div v-for="(category, index) in categories" class="mb-3">
                <Link :href="route('blog_category_articles_all',category.id)" class="inline-flex">
                    <input :value="category.id" type="checkbox" :id="`category-chx-${index}`" class="form-checkbox rounded-full" :checked="categoryActive == category.id" />
                    <span>{{ category.description }}</span>
                </Link>
            </div>
        </div>
    </div>
</template>