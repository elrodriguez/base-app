<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    // import SearchProducts from './Partials/SearchProducts.vue';
    // import SearchClients from './Partials/SearchClients.vue';
    // import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
    // import { useForm } from '@inertiajs/vue3';
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
        }
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
            
            <div class="p-2 border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">

                <div class="border-t-8 border-gray-700 h-2"></div>
                <div class="container mx-auto py-6 px-4" >
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-bold mb-6 pb-2 tracking-wider uppercase">Invoice</h2>
                        <div>
                            <div class="relative mr-4 inline-block">
                                <div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" @click="printInvoice()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                        <rect x="7" y="13" width="10" height="8" rx="2" />
                                    </svg>				  
                                </div>
                                <div class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
                                    Print this invoice!
                                </div>
                            </div>
				
                            <div class="relative inline-block">
                                <div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip2 = true" @mouseleave="showTooltip2 = false" @click="window.location.reload()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5" />
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 5v-5h-5" />
                                    </svg>	  
                                </div>
                                <div class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
                                    Reload Page
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex mb-8 justify-between">
                        <div class="w-2/4">
                            <div class="mb-2 sm:mb-1 sm:flex items-center">
                                <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide inline-flex items-center">Invoice No.</label>
                                <span class="mr-4 inline-block hidden sm:block">:</span>
                                <div class="flex-1">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 inline-block" id="inline-full-name" type="text" placeholder="eg. #INV-100001">
                                </div>
                            </div>


                            <div class="mb-2 sm:mb-1 sm:flex items-center">
                                <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice Date</label>
                                <span class="mr-4 inline-block hidden sm:block">:</span>
                                <div class="flex-1">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 js-datepicker" type="text" id="datepicker1" placeholder="eg. 17 Feb, 2020" x-model="invoiceDate" x-on:change="invoiceDate = document.getElementById('datepicker1').value" autocomplete="off" readonly>
                                </div>
                            </div>

                            <div class="mb-2 sm:mb-1 sm:flex items-center">
                                <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Due date</label>
                                <span class="mr-4 inline-block hidden sm:block">:</span>
                                <div class="flex-1">
                                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 js-datepicker-2" id="datepicker2" type="text" placeholder="eg. 17 Mar, 2020" x-model="invoiceDueDate" x-on:change="invoiceDueDate = document.getElementById('datepicker2').value" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="w-32 h-32 mb-1 border rounded-lg overflow-hidden relative bg-gray-100">
                                <img id="image" class="object-cover w-full h-32" src="https://placehold.co/300x300/e2e8f0/e2e8f0" />
                                
                                <div class="absolute top-0 left-0 right-0 bottom-0 w-full block cursor-pointer flex items-center justify-center" >
                                    <button type="button"
                                        style="background-color: rgba(255, 255, 255, 0.65)"
                                        class="hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded-lg shadow-sm"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                            <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                            <circle cx="12" cy="13" r="3" />
                                        </svg>							  
                                    </button>
                                </div>
                            </div>
                            <input name="photo" id="fileInput" accept="image/*" class="hidden" type="file" />
                        </div>
                    </div>

                    <div class="flex justify-between mb-8 mt-4">
                        <div class="w-full px-2 sm:w-1/3 mb-2 sm:mb-0">
                            <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Bill/Ship To:</label>
                            <input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Billing company name">
                            <input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Billing company address">
                            <input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Additional info">
                        </div>
                        <div class="w-full sm:w-1/3">
                            <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">From:</label>
                            <input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Your company name">

                            <input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Your company address">

                            <input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Additional info">
                        </div>
                    </div>

                    <div class="flex -mx-1 border-b py-2 items-start">
                        <div class="flex-1 px-1">
                            <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Description</p>
                        </div>

                        <div class="px-1 w-20 text-right">
                            <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Units</p>
                        </div>

                        <div class="px-1 w-32 text-right">
                            <p class="leading-none">
                                <span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Unit Price</span>
                                <span class="font-medium text-xs text-gray-500">(Incl. GST)</span>
                            </p>
                        </div>

                        <div class="px-1 w-32 text-right">
                            <p class="leading-none">
                                <span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Amount</span>
                                <span class="font-medium text-xs text-gray-500">(Incl. GST)</span>
                            </p>
                        </div>

                        <div class="px-1 w-20 text-center">
                        </div>
                    </div>
                    <template >
                        <div class="flex -mx-1 py-2 border-b">
                            <div class="flex-1 px-1">
                                <p class="text-gray-800" x-text="invoice.name"></p>
                            </div>

                            <div class="px-1 w-20 text-right">
                                <p class="text-gray-800" x-text="invoice.qty"></p>
                            </div>

                            <div class="px-1 w-32 text-right">
                                <p class="text-gray-800" x-text="numberFormat(invoice.rate)"></p>
                            </div>

                            <div class="px-1 w-32 text-right">
                                <p class="text-gray-800" x-text="numberFormat(invoice.total)"></p>
                            </div>

                            <div class="px-1 w-20 text-right">
                                <a href="#" class="text-red-500 hover:text-red-600 text-sm font-semibold" @click.prevent="">Delete</a>
                            </div>
                        </div>
                    </template>

                    <button class="mt-6 bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded shadow-sm" x-on:click="openModal = !openModal">
                        Add Invoice Items
                    </button>

                    <div class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4">
                        <div class="flex justify-between mb-3">
                            <div class="text-gray-800 text-right flex-1">Total incl. GST</div>
                            <div class="text-right w-40">
                                <div class="text-gray-800 font-medium" x-html="netTotal"></div>
                            </div>
                        </div>
                        <div class="flex justify-between mb-4">
                            <div class="text-sm text-gray-600 text-right flex-1">GST(18%) incl. in Total</div>
                            <div class="text-right w-40">
                                <div class="text-sm text-gray-600" x-html="totalGST"></div>
                            </div>
                        </div>
                
                        <div class="py-2 border-t border-b">
                            <div class="flex justify-between">
                                <div class="text-xl text-gray-600 text-right flex-1">Amount due</div>
                                <div class="text-right w-40">
                                    <div class="text-xl text-gray-800 font-bold" x-html="netTotal"></div>
                                </div>
                            </div>
                        </div>
                    </div>
	

	            </div>	



            </div>	

        </div>
    </AppLayout>
</template>
<style scoped>

@media print {
    .no-printme  {
        display: none;
    }
    .printme  {
        display: block;
    }
    body {
        line-height: 1.2;
    }
}

@page {
    size: A4 portrait;
    counter-increment: page;
}

/* Datepicker */
.date-input {
    background-color: #fff;
    border-radius: 10px;
    padding: 0.5rem 1rem;
    z-index: 2000;
    margin: 3px 0 0 0;
    border-top: 1px solid #eee;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
}
.date-input.is-hidden {
    display: none;
}
.date-input .pika-title {
    padding: 0.5rem;
    width: 100%;
    text-align: center;
}
.date-input .pika-prev,
.date-input .pika-next {
    margin-top: 0;
    /* margin-top: 0.5rem; */
    padding: 0.2rem 0;
    cursor: pointer;
    color: #4299e1;
    text-transform: uppercase;
    font-size: 0.85rem;
}
.date-input .pika-prev:hover,
.date-input .pika-next:hover {
    text-decoration: underline;
}
.date-input .pika-prev {
    float: left;
}
.date-input .pika-next {
    float: right;
}
.date-input .pika-label {
    display: inline-block;
    font-size: 0;
}
.date-input .pika-select-month,
.date-input .pika-select-year {
    display: inline-block;
    border: 1px solid #ddd;
    color: #444;
    background-color: #fff;
    border-radius: 10px;
    font-size: 0.9rem;
    padding-left: 0.5em;
    padding-right: 0.5em;
    padding-top: 0.25em;
    padding-bottom: 0.25em;
    appearance: none;
}
.date-input .pika-select-month:focus,
.date-input .pika-select-year:focus {
    border-color: #cbd5e0;
    outline: none;
}
.date-input .pika-select-month {
    margin-right: 0.25em;
}
.date-input table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0.2rem;
}
.date-input table th {
    width: 2em;
    height: 2em;
    font-weight: normal;
    color: #718096;
    text-align: center;
}
.date-input table th abbr {
    text-decoration: none;
}
.date-input table td {
    padding: 2px;
}
.date-input table td button {
    /* border: 1px solid #e2e8f0; */
    width: 1.8em;
    height: 1.8em;
    text-align: center;
    color: #555;
    border-radius: 10px;
}
.date-input table td button:hover {
    background-color: #bee3f8;
}
.date-input table td.is-today button {
    background-color: #ebf8ff;
}
.date-input table td.is-selected button {
    background-color: #3182ce;
}
.date-input table td.is-selected button {
    color: white;
}
.date-input table td.is-selected button:hover {
    color: white;
}
</style>