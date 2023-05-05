
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import * as XLSX from 'xlsx/dist/xlsx.full.min';
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';   //No lo borres si se usa aunque pareciera que no.

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
    petty_cash: {
        type: Object,
        default: () => ({}),
    },
    expenses: {
        type: Object,
        default: () => ({}),
    }
});

const form = useForm({
    start:props.start,
    end:props.end,
    local_id:props.petty_cash.local_sale_id,
    sales:props.sales,
    expenses:props.expenses,
    local_name:"TODOS LOS LOCALES"
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
function getTotalExpenses(){
    let expenses=0.0;
    form.expenses.forEach(expense=> {
        expenses+=parseFloat(expense.amount);
    });
    return expenses;
}
getReport();
function getReport(){

    getTotalPrices();
    getTotalQuantities();


  props.locals.forEach(local => {
    if(form.local_id == local.id){
        form.local_name = local.description;
    }
    if(form.local_id == 0)form.local_name= "TODOS LOS LOCALES";
  });
}

// const botonImprimir = document.getElementById('boton-imprimir');
// botonImprimir.addEventListener('click', () => {
//   window.print();
// });

function downloadExcel(){
    const workbook = XLSX.utils.book_new();

// Obtén la tabla HTML que deseas convertir
const table = document.getElementById('table_export');

// Convierte la tabla HTML en una hoja de cálculo
const worksheet = XLSX.utils.table_to_sheet(table);
worksheet['!cols'] = [
  {width:4}, // Columna "A" #
  {width:12}, // Columna "B" Fecha
  { width: 30 }, // Columna "C" Tienda
  {width:9}, // Columna "D" Cod. Prod.
  { width: 35 }, // Columna "E" Producto
  {width:12}, // Columna "F" Precio Vendido
  {width:9}, // Columna "G" Cantidad
  {width:9}, // Columna "H" Talla
  {width:9}, // Columna "I" Total
];

XLSX.utils.book_append_sheet(workbook, worksheet, form.start+'-'+form.end);
XLSX.writeFile(workbook, 'RpteCaja_'+form.local_name+"-"+form.start+'.xlsx');
}


function downloadPdf(){
    const table = document.getElementById('table_export');

    const pdf = new jsPDF({
  orientation: 'landscape',
  unit: 'pt',
  format: 'a4'
});
let titulo = "Reporte de Caja de: "+form.local_name;
pdf.text(titulo, 200, 20); //X e Y
titulo="Día: "+props.petty_cash.date_opening;
pdf.text(titulo, 200, 40);
    // Genera la tabla PDF utilizando jsPDF
    pdf.autoTable({
      html: table,
      startY: 70  // altura(Y) desde top para iniciar dibujar la tabla
    });

    // Guarda el archivo PDF
    pdf.save('RpteCaja_'+form.local_name+"-"+props.petty_cash.date_opening+".pdf");
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

                    <div class="col-span-4 sm:col-span-1">
                            <InputLabel for="stablishment" value="Establecimiento" />
                            <select v-model="form.local_id" v-on:change="getReport()"
                                id="stablishment"
                                disabled
                                class="w-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="0">Todos los Locales</option>
                                <template v-for="(local, index) in props.locals" :key="index">
                                    <option :value="local.id">{{ local.description }}</option>
                                </template>
                            </select>
                        </div>

                        <div class="grid grid-cols-4 gap-3 py-2" id="form-dates">

                            <div v-if="false">
                                <button v-on:click="downloadExcel()"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                     >Exportar en Excel</button>
                            </div>

                            <div>
                            <button v-on:click="downloadPdf()"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                     >Exportar en PDF</button>
                            </div>



                            <div class="text-right">
                                <ModalCashCreate :locals="locals" />
                            </div>
                        </div>
                </div>

            </div>
        </div><hr>
        <div id="ContenidoTabla">
            <table id="table_export" class="table border mb-4 table-fixed" style="width: 100%;">
                        <thead class="border-b">

                            <tr><th colspan="9" class="text-center fs-1" style="text-align: center">Matos Store - Ventas Caja desde: {{ props.petty_cash.date_opening+" hora: "+props.petty_cash.time_opening.slice(0, -3) }} cerrado  el: {{ props.petty_cash.date_closed+" hora: "+props.petty_cash.time_closed.slice(0, -3) }}</th></tr>
                            <tr><th colspan="9" class="text-center fs-1" style="text-align: center">De: {{ form.local_name }}</th></tr>
                            <tr><th colspan="3"></th><th>Monto final en Caja: </th><th>{{ props.petty_cash.final_balance }}</th><th colspan="4"></th></tr>

                            <tr class="bg-blue-400 border-b hover:bg-blue-600">
                                <th scope="col" class="w-2.5 text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                #
                                </th>
                                <th scope="col" class="w-4 text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                    Fecha
                                </th>
                                <th scope="col" class="w-4 text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                    Tienda
                                </th>
                                <th scope="col" class="w-4 text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                    Cod. Prod.
                                </th>
                                <th scope="col" class="w-4 text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                    Producto
                                </th>
                                <th scope="col" class="w-4 text-left text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                    Precio Vendido
                                </th>
                                <th scope="col" class="w-4 text-left text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                    Cantidad
                                </th>
                                <th scope="col" class="w-4 text-left text-sm font-medium text-gray-900 px-6 py-4 border-r">
                                    Talla
                                </th>
                                <th scope="col" class="w-4 text-left text-sm font-medium text-gray-900 px-6 py-4">
                                    Total
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(sale, index) in form.sales" :key="sale.id" :class="  index % 2 == 0 ? 'bg-gray-100 hover:bg-gray-300 border-b' : 'bg-gray-200 hover:bg-gray-300 border-b'">
                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">
                                    {{ index + 1 }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ sale.created_at }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ getLocal(sale.local_id) }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ sale.interne }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                   <img :src="'/storage/'+sale.image" width="40"> {{ sale.product_description }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                   {{ JSON.parse(sale.product).price }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ JSON.parse(sale.product).quantity }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ JSON.parse(sale.product).size }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ JSON.parse(sale.product).quantity * JSON.parse(sale.product).price }}
                                </td>
                            </tr>

                        </tbody>

                        <tfoot>
                            <tr class="bg-blue-400 border-b">
                                        <th class="fs-4" style="text-align: center">#</th>
                                        <th></th>
                                        <th class="fs-4" style="text-align: center" colspan="2">Totales</th>
                                        <th class="fs-4" style="text-align: left"></th>
                                        <th class="fs-4" style="text-align: center"></th>
                                        <th class="fs-4" style="text-align: center">{{ getTotalQuantities()}}</th>
                                        <th class="fs-4" style="text-align: center"></th>
                                        <th class="fs-4" style="text-align: center">S/ {{ getTotalPrices()}}</th>
                            </tr>
                            <template v-if="expenses.length > 0">
                            <tr class="bg-gray-900 border-b">
                                <th class="fs-4 text-white font-light" style="text-align: center" colspan="9">GASTOS</th>
                            </tr>
                            <tr class="bg-gray-900 border-b">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="fs-4 text-white font-light border-r" style="text-align: center">#</th>
                                <th colspan="2" class="fs-4 text-white font-light border-r" style="text-align: center">Motivo o Descripción</th>
                                <th class="fs-4 text-white font-light border-r" style="text-align: center">Monto</th>
                                <th colspan="2" class="fs-4 text-white font-light" style="text-align: center">N° Documento</th>
                            </tr>
                            <tr  v-for="(expense, index) in form.expenses" :key="expense.id" :class="  index % 2 == 0 ? 'bg-gray-100 hover:bg-gray-300 border-b' : 'bg-gray-200 hover:bg-gray-300 border-b'">  
                                <td></td>
                                <td></td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r"></td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r" style="text-align: center">{{ index + 1 }}</td>
                                <td colspan="2" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ expense.description }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ expense.amount }}
                                </td>      
                                <td colspan="2" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ expense.document }}
                                </td>                          
                            </tr>
                            <tr class="bg-gray-900 border-b">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="fs-4 text-white font-light border-r" style="text-align: center">Total en Gastos:</th>
                                <th class="fs-4 text-white font-light border-r" style="text-align: center">{{ getTotalExpenses() }}</th>
                                <th colspan="2"></th>
                            </tr>
                        </template>
                        </tfoot>

                    </table>
                    <Pagination :data="sales" />

                </div>

    </AppLayout>
</template>
