
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import * as XLSX from 'xlsx/dist/xlsx.full.min';
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';  //No lo borres si se usa aunque pareciera que no.

const props = defineProps({
    locals: {
        type: Object,
        default: () => ({}),
    },
    sales: {
        type: Object,
        default: () => ({}),
    },
    start: {
        type: Object,
        default: () => ({}),
    },
    end: {
        type: Object,
        default: () => ({}),
    },
    payments:{
        type: Object,
        default: () => ({}),
    }
});

const form = useForm({
    start:props.start,
    end:props.end,
    local_id:0,
    sales:props.sales,
    local_name:"TODOS LOS LOCALES",
    payments: props.payments
});

function getLocal(id){
    let arreglo = props.locals;
    let local = arreglo.find(arreglo => arreglo.id == id);
    return local.description;
}

function getTotalQuantities(){
    let quantities=0;
    let arreglo = form.sales;
    arreglo.forEach(sale=> {
        quantities+=JSON.parse(sale.product).quantity;
    });
    return quantities;
}
function getTotalPrices(){
    let prices=0;
    form.sales.forEach(sale=> {
        prices+=JSON.parse(sale.product).quantity*JSON.parse(sale.product).price;
    });
    return prices;
}

function getReport(){
    let url = route('sales_report_dates', {
        start: form.start,
        end: form.end,
        local_id: form.local_id,
        consulta:true
    });
    axios.get(url).then(response => {
        form.sales=null;
        form.sales = response.data.sales;
        form.payments = response.data.payments
        getTotalPrices();
        getTotalQuantities();
    }).catch(err => {
        console.log("ERROR ENCONTRADO", err);
    });

    props.locals.forEach(local => {
        if(form.local_id == local.id){
            form.local_name = local.description;
        }
        if(form.local_id == 0)form.local_name= "TODOS LOS LOCALES";
    });
}


function downloadExcel(){
    const workbook = XLSX.utils.book_new();

    // Obtén la tabla HTML que deseas convertir
    const table = document.getElementById('table_export');

    // Convierte la tabla HTML en una hoja de cálculo
    const worksheet = XLSX.utils.table_to_sheet(table);
    worksheet['!cols'] = [
        {width:12}, // Columna "A" Fecha
        { width: 25 }, // Columna "B" Tienda
        {width:9}, // Columna "C" Cod. Prod.
        { width: 30 }, // Columna "D" Producto
        {width: 35}, //metodos de pago
        {width:12}, // Columna "F" Precio Vendido
        {width:9}, // Columna "G" Cantidad
        {width:9}, // Columna "H" Talla
        {width:9}, // Columna "I" Total
    ];

    XLSX.utils.book_append_sheet(workbook, worksheet, form.start+'-'+form.end);
    XLSX.writeFile(workbook, 'RpteVentas'+form.start+'-'+form.end+'.xlsx');
}


function downloadPdf(){
    const table = document.getElementById('table_export');

    const pdf = new jsPDF({
        orientation: 'landscape',
        unit: 'pt',
        format: 'a4'
    });
    let titulo = "Reporte de Ventas de: "+form.local_name;
    pdf.text(titulo, 200, 20); //X e Y
    titulo="Día: "+form.start;
    pdf.text(titulo, 200, 40);
    titulo="al: "+form.end;
    pdf.text(titulo, 400, 40);
        // Genera la tabla PDF utilizando jsPDF
    pdf.autoTable({
        html: table,
        startY: 70  // altura desde top para inicar dibujar la tabla
    });


    // Guarda el archivo PDF
    pdf.save('RpteVentas_'+form.local_name+'_'+form.start+'-'+form.end+'.pdf');
}

</script>

<template>
    <AppLayout title="Reportes de Ventas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reportes
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="col-span-6 p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                    <div class="grid grid-cols-6 gap-3 py-2">
                        <div class="col-span-6 sm:col-span-2">
                            <InputLabel for="stablishment" value="Establecimiento" />
                            <select v-model="form.local_id" v-on:change="getReport()"
                                id="stablishment"
                                class="w-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="0">Todos los Locales</option>
                                <template v-for="(local, index) in props.locals" :key="index">
                                    <option :value="local.id">{{ local.description }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <input type="date" v-model="form.start" v-on:change="getReport()"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="f1" />
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <input type="date" v-model="form.end" v-on:change="getReport()"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="f2" />
                        </div>
                        <div v-if="false" class="col-span-6 sm:col-span-1">
                            <button v-on:click="downloadExcel()"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                     >Exportar en Excel
                            </button>
                        </div>

                        <div class="col-span-6 sm:col-span-1">
                            <button v-on:click="downloadPdf()"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                >Exportar en PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
                <div id="ContenidoTabla" class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="table_export" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead>
                            <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" v-if="form.start==form.end">
                                <th colspan="9" scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800" style="text-align: center">Ventas del día: {{ form.start }} </th>
                            </tr>
                            <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" v-else>
                                <th colspan="9" scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800" style="text-align: center">Matos Store - Ventas del: {{ form.start }} al {{ form.end }}</th>
                            </tr>
                            <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th colspan="9" scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800" style="text-align: center">De: {{ form.local_name }}</th>
                            </tr>
                            <tr class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                <th scope="col" class="px-6 py-3">
                                    Fecha
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tienda
                                </th>
                                <th scope="col"  class="px-6 py-3">
                                    Cod. Prod.
                                </th>
                                <th scope="col"  class="px-6 py-3">
                                    Producto
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                    Metodos de Pago
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Precio Vendido
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cantidad
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Talla
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(sale, index) in form.sales" :key="sale.id" :class="  index % 2 == 0 ? 'bg-gray-100 hover:bg-gray-300 border-b' : 'bg-gray-200 hover:bg-gray-300 border-b'">
                                <td class="px-6 py-4">
                                    {{ sale.created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ getLocal(sale.local_id) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ sale.interne }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <img :src="'/storage/'+sale.image" width="40"> {{ sale.product_description }}
                                </td>
                                <td scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                    <div v-for="pay in JSON.parse(sale.payments)"> 
                                        <ul class="">
                                            <li>
                                                <span v-for="mto in form.payments">
                                                    <strong v-if="pay.type == mto.id">
                                                        Metodo: {{ mto.description }}
                                                    </strong>
                                                </span>
                                            </li>
                                            <li>Referencia: {{ pay.reference }}</li>
                                            <li>Importe: {{ pay.amount }}</li>
                                        </ul>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{ JSON.parse(sale.product).price }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{ JSON.parse(sale.product).quantity }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{ JSON.parse(sale.product).size }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{ JSON.parse(sale.product).quantity * JSON.parse(sale.product).price }}
                                </td>
                            </tr>

                        </tbody>

                        <tfoot>
                            <tr class="bg-blue-400 hover:bg-blue-600">
                                <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: right" colspan="6">Totales</th>
                                <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: right">{{ getTotalQuantities()}}</th>
                                <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: right"></th>
                                <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: center">S/ {{ getTotalPrices()}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        

    </AppLayout>
</template>
