<script setup>
    import { Link } from '@inertiajs/vue3';
    import { faAnglesLeft, faAnglesRight, faAngleRight } from "@fortawesome/free-solid-svg-icons";

    defineProps({
        data: {
            type: Object,
            default: () => ({}),
        },
    });
</script>
<template>
    <nav v-if="data.links.length > 0" role="navigation" aria-label="Pagination Navigation" class="flex m-4 items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            <span v-if="data.current_page <= 1" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                Previous
            </span>
            <Link v-else :href="data.prev_page_url" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                Previous
            </Link>
            <Link v-if="data.current_page < data.last_page" :href="data.next_page_url" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                Next
            </Link>
            <span v-else class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                Next
            </span>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-white">
                    Mostrando
                    <span class="font-medium">
                        {{ data.from }}
                    </span>
                    a
                    <span class="font-medium">{{ data.to }}</span>
                    de
                    <span class="font-medium">{{ data.total }}</span>
                    resultados
                </p>
            </div>
            <div>
                <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto mb-4">
                    <li v-if="data.current_page <= 1">
                        <button type="button"
                        class="
                            flex
                            justify-center
                            font-semibold
                            p-2.5
                            rounded-full
                            transition
                            bg-white-light
                            text-dark
                            dark:text-white-light dark:bg-[#191e3a]
                        ">
                            <font-awesome-icon :icon="faAnglesLeft" class="w-4 h-4 text-[#888ea8]" />
                        </button>
                    </li>
                    <li v-else >
                        <Link :href="data.first_page_url" type="button"
                            class="
                                flex
                                justify-center
                                font-semibold
                                px-2.5
                                py-2.5
                                rounded-full
                                transition
                                bg-white-light
                                text-dark
                                hover:text-white hover:bg-primary
                                dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary
                            "
                            >
                            <font-awesome-icon :icon="faAnglesLeft" class="w-4 h-4" />
                        </Link>
                    </li>
                    <template v-for="(link, key) in data.links">
                        <template v-if="key > 0 && key < data.last_page + 1">
                            <li v-if="!link.active && link.url === null" :key="key">
                                <button type="button"
                                class="
                                    flex
                                    justify-center
                                    font-semibold
                                    px-3.5
                                    py-2
                                    rounded-full
                                    transition
                                    bg-white-light
                                    text-dark
                                    hover:text-white hover:bg-primary
                                    dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary
                                "
                                >
                                    <template v-if="link.label.includes('Next')" >
                                        <font-awesome-icon :icon="faAngleRight"  class="w-2 h-5" />
                                    </template>
                                    <template v-else>
                                        {{ link.label }}
                                    </template>
                                </button>
                            </li>
                            <li v-else-if="link.active" :key="`current-${key}`">
                                <button type="button" class="flex justify-center font-semibold px-3.5 py-2 rounded-full transition bg-primary text-white dark:text-white-light dark:bg-primary">{{ link.label }}</button>
                            </li>
                            <li v-else :key="`link-${key}`">
                                <Link  :href="link.url" type="button"
                                        class="
                                            flex
                                            justify-center
                                            font-semibold
                                            px-3.5
                                            py-2
                                            rounded-full
                                            transition
                                            bg-white-light
                                            text-dark
                                            hover:text-white hover:bg-primary
                                            dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary
                                        "
                                        :aria-label="`ir a la página ${link.label}`"
                                    >
                                        <template v-if="link.label.includes('Next')" >
                                            <font-awesome-icon :icon="faAngleRight"  class="w-2 h-5" />
                                        </template>
                                        <template v-else>
                                            {{ link.label }}
                                        </template>
                                </Link>
                            </li>
                            
                        </template>
                    </template>
                    <li v-if="data.current_page < data.last_page">
                        <Link :href="data.last_page_url" type="button"
                        class="
                            flex
                            justify-center
                            font-semibold
                            p-2.5
                            rounded-full
                            transition
                            bg-white-light
                            text-dark
                            hover:text-white hover:bg-primary
                            dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary
                        ">
                            <font-awesome-icon :icon="faAnglesRight" class="w-4 h-4" />
                        </Link>
                    </li>
                    <li v-else>
                        <button type="button"
                        class="
                            flex
                            justify-center
                            font-semibold
                            p-2.5
                            rounded-full
                            transition
                            bg-white-light
                            text-dark
                            dark:text-white-light dark:bg-[#191e3a]
                        ">
                            <font-awesome-icon :icon="faAnglesRight" class="w-4 h-4 text-[#888ea8]" />
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>