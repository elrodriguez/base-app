<script setup >
    import { Link } from "@inertiajs/vue3"
    defineProps({
        archives:{
            type: Object,
            default: () => ({})
        }
    });

    const nomMonth = (month) => {
        const months = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        if (month < 1 || month > 12) {
            return 'Mes inválido';
        }

        return months[month - 1];
    }
</script>
<template>
    <div>
        <h6 class="mb-2 text-gray-900 text-xl dark:text-gray-50">Archivos</h6>
        <div class="w-full h-0.5 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
            <div class="bg-primary h-0.5 rounded-full rounded-bl-full w-4/12 text-center text-white text-xs"></div>
        </div>
        <ul class="mt-3 mb-0 space-y-3 font-semibold">
            <li v-for="(archive, ke) in archives">
                <Link :href="route('blog_articles_archive',[archive.year,archive.month])">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline text-primary rtl:rotate-180 ltr:mr-2 rtl:ml-2">
                        <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span class="list-text">{{ nomMonth(archive.month) }} {{ archive.year }} ({{ archive.total_articles }})</span>
                </Link> 
            </li>
        </ul>
    </div>
</template>