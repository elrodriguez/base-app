<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import { onMounted, ref } from 'vue';

const props = defineProps({
    locals: {
        type: Object,
        default: () => ({})
    }
});

const form = useForm({
    local_id: 0
});

const productsData = ref([]);

const getDataProducts = () => {
    axios({
        method: 'post',
        url: route('inventory_report_products_data'),
        data: form
    }).then((response) => {
        productsData.value = response.data.products
    });
}

const urlBaseI = assetUrl;

onMounted(() => {
    getDataProducts();
});
</script>

<template>
    <AppLayout title="Reportes">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('reports')" class="text-primary hover:underline">Reportes</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Reporte de todos los productos(todos los locales)</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- ====== Table One Start -->
                <div class="panel p-0">
                    <div class="w-full p-4">
                        <div class="grid grid-cols-6 gap-3 py-2">
                            <div class="col-span-6 sm:col-span-2">
                                <select v-model="form.local_id" id="stablishment" class="form-select text-white-dark">
                                    <option value="0">Todos los Locales</option>
                                    <template v-for="(local, index) in locals" :key="index">
                                        <option :value="local.id">{{ local.description }}</option>
                                    </template>
                                </select>
                            </div>
                            <div v-if="false" class="col-span-6 sm:col-span-1">
                                <button v-on:click="downloadExcel()"
                                        class="btn btn-warning "
                                        >Exportar en Excel
                                </button>
                            </div>

                            <div class="col-span-6 sm:col-span-1">
                                <button v-on:click="downloadPdf()"
                                class="btn btn-dark"
                                    >Exportar en PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="ContenidoTabla" class="table-responsive">
                        <table id="tableProductExport" class="table-striped" >
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Presentaciones</th>
                                    <th class="text-center">Cantidad Vendida</th>
                                    <th class="text-center">Stock Actual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(product, index) in productsData">
                                    <tr>
                                        <td class="max-w-[300px]">
                                            <div class="flex"> 
                                                <img
                                                    :src="product.image"
                                                    class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                    :alt="product.interne"
                                                />
                                                <p class="word-break-break-all">
                                                    {{ product.description }}
                                                    <span class="text-primary block text-xs">CÓDIGO: {{ product.interne }}</span>
                                                    <span class="text-primary block text-xs"></span>
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="grid grid-cols-2 gap-4">
                                                <span v-for="xsize in JSON.parse(product.sizes)" class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-purple-400 border border-purple-400">
                                                    PT: {{ xsize.size }}, CANT: {{ xsize.quantity }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            {{ product.total_sold ? parseInt(product.total_sold) : 0 }}
                                            <div class="w-full h-4 bg-[#ebedf2] dark:bg-dark/40 rounded-full">
                                                <div :style="`width: ${(product.total_sold / product.stock) * 100}%`" 
                                                    class="h-4 rounded-full text-center text-white text-xs"
                                                    :class="((product.total_sold / product.stock) * 100).toFixed(2) < 60 ? 'bg-primary' : 'bg-danger'"
                                                >
                                                {{ ((product.total_sold / product.stock) * 100).toFixed(2) }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            {{ product.stock }}
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>