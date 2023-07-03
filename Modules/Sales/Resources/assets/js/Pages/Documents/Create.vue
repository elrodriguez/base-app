<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    // import SearchProducts from './Partials/SearchProducts.vue';
    // import SearchClients from './Partials/SearchClients.vue';
    // import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
    import { useForm } from '@inertiajs/vue3';
    // import ModalPrintSale from './Partials/ModalPrintSale.vue';
    // import InputError from '@/Components/InputError.vue';
    // import Keypad from '@/Components/Keypad.vue';
    // import Swal2 from 'sweetalert2';
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        payments: {
            type: Object,
            default: () => ({}),
        },
        client: {
            type: Object,
            default: () => ({}),
        },
        documentTypes: {
            type: Object,
            default: () => ({}),
        },
        company:{
            type: Object,
            default: () => ({}),
        },
        saleDocumentTypes:{
            type: Object,
            default: () => ({}),
        }  
    });

    const openSearchClient = () => {
        alert('ssss')
    }

    const formDocument = useForm({
        client_id: props.client.id,
        client_name: props.client.full_name,
        client_ubigeo: props.client.ubigeo,
        client_ubigeo_description: 'Ancash-Chimbote',
        client_direction: props.client.address,
        sale_documenttype_id: 2
    });
</script>
<template>
    <AppLayout title="Punto de Ventas">
        <div class="max-w-screen-2xl  mx-auto p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <nav class="flex px-4 py-3 border border-stroke text-gray-700 mb-4 bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <Link :href="route('dashboard')" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Inicio
                        </Link>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <!-- <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Productos</a> -->
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Facturación Electrónica</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Crear Documentos</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex-shrink max-w-full px-4 w-full mb-6">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700 mb-3">
                        <div class="flex flex-col">
                            <div class="text-3xl font-bold mb-1">
                                <img style="width: 172px;height: 32px;" class="inline-block h-auto ltr:mr-2 rtl:ml-2" src="/storage/uploads/company/logo176x32.png">
                            </div>
                            <p class="text-sm">Ancash, Chimbote<br>{{ company.fiscal_address }}</p>
                        </div>
                        <div class="text-4xl uppercase font-bold">
                            <select v-model="formDocument.sale_documenttype_id" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="(type, index) in saleDocumentTypes" :value="type.id"> {{  type.description  }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between py-3">
                        <div class="flex-1 pr-4 ">
                            <div class="flex justify-between mb-1">
                                <div class="flex-1 font-semibold">Cliente:</div>
                                <div class="flex-1 ltr:text-right rtl:text-left">
                                    <input :value="formDocument.client_name" class="invoice-imput" type="text" />
                                </div>
                            </div>
                            <div class="flex justify-between mb-1">
                                <div class="flex-1 font-semibold">Ciudad:</div>
                                <div class="flex-1 ltr:text-right rtl:text-left">
                                    <input :value="formDocument.client_ubigeo_description" class="invoice-imput bg-gray-100" disabled type="text" />
                                </div>
                            </div>
                            <div class="flex justify-between mb-1">
                                <div class="flex-1 font-semibold">Dirección:</div>
                                <div class="flex-1 ltr:text-right rtl:text-left">
                                    <input :value="formDocument.client_direction" class="invoice-imput bg-gray-100" disabled type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between mb-1">
                                <div class="flex-1 font-semibold">Serie:</div>
                                <div class="flex-1 ltr:text-right rtl:text-left">
                                    <select class="invoice-select">
                                        <option>
                                            
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-between mb-1">
                                <div class="flex-1 font-semibold">Fecha de la factura:</div>
                                <div class="flex-1 ltr:text-right rtl:text-left">
                                    <input class="invoice-imput" type="date" />
                                </div>
                            </div>
                            <div class="flex justify-between mb-1">
                                <div class="flex-1 font-semibold">Fecha de vencimiento:</div>
                                <div class="flex-1 ltr:text-right rtl:text-left">
                                    <input class="invoice-imput bg-gray-100" disabled type="date" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-4">
                        <table class="table-bordered w-full ltr:text-left rtl:text-right text-gray-600">
                            <thead class="border-b border-stroke dark:border-gray-700">
                                <tr class="bg-gray-100 dark:bg-gray-900 dark:bg-opacity-20">
                                    <th>Products</th>
                                    <th class="text-center px-2 py-2">Qty</th>
                                    <th class="text-center px-2 py-2">Unit price</th>
                                    <th class="text-center px-2 py-2">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-2 py-2">
                                        <div class="flex flex-wrap flex-row items-center">
                                            <div class="self-center"><img class="h-8 w-8" src=""></div>
                                            <div class="leading-5 dark:text-gray-300 flex-1 ltr:ml-2 rtl:mr-2 mb-1">  
                                            Nike Unisex-Child Free Rn (Big Kid)
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center px-2 py-2">1</td>
                                    <td class="text-right px-2 py-2">80$</td>
                                    <td class="text-right px-2 py-2">80$</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-right"><b>Sub-Total</b></td>
                                    <td class="text-right">$290</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-right"><b>Discount</b></td>
                                    <td class="text-right">15%</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-right"><b>Tax</b></td>
                                    <td class="text-right">5%</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-right"><b>Total</b></td>
                                    <td class="text-right font-bold">$258,8</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>
.invoice-select{
    margin: 0px !important;
    padding: 1px !important;
    height: 26px !important;
    width: 100% !important;
    font-size: 14px;
}
.invoice-imput{
    margin: 0px !important;
    padding: 1px !important;
    height: 26px !important;
    width: 100% !important;
    font-size: 14px;
}
</style>