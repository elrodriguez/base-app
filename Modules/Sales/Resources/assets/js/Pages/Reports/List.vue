<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

const reportsData = [
 
    {
        title: 'Ventas',
        items: [
            { url: route('sales_report_dates'), label: 'Reporte de ventas entre fechas(por locales)'},
            { url: route('report_payment_method_totals'), label: 'Reporte Totales de método de pago(por locales)'},
            { url: route('report_product_sellers_dates'), label: 'Reporte de Productos por Vendedores y Fechas'},
            { url: route('report_sales_expenses'), label: 'Reporte de ventas y gastos'}
        ]
    },
    {
        title: 'Inventario',
        items: [
            { url: route('inventory_report_products'), label: 'Reporte de todos los productos(todos los locales)', target:'_blank'}
        ]
    },
    // {
    //     title: 'Contabilidad',
    //     items: [
    //         { url: route('record_sales_income_period'), label: 'Registro de ventas e ingresos por periodo'},
    //         { url: route('sales_report_dates'), label: 'Exportar registro  de ventas por periodo y formato'}
    //     ]
    // }
  
];

</script>

<template>
    <AppLayout title="Reportes">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Reportes</span>
            </li>
        </Navigation>
        <div class="mt-5">
                <div class="grid sm:grid-cols-3 justify-items-center gap-6" >
                    <template v-for="(row, key) in reportsData">
                        <div class="panel w-full">
                            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                                {{ row.title }}
                            </h2>
                            <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                                <template v-for="(item, co) in row.items">
                                    <li class="hover:underline md:me-6">
                                        <Link :href="item.url" class="flex items-center" :target="item.target">
                                            <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                            </svg>
                                            {{ item.label }}
                                        </Link>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </template>
                </div>
            </div>

    </AppLayout>
</template>
