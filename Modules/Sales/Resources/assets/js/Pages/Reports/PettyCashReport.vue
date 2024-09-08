
<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Keypad from '@/Components/Keypad.vue';
import * as XLSX from 'xlsx/dist/xlsx.full.min';
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';  
import Navigation from '@/Components/vristo/layout/Navigation.vue';

const props = defineProps({
    locals: {
        type: Object,
        default: () => ({}),
    },
    tickets: {
        type: Object,
        default: () => ({}),
    },
    physicals: {
        type: Object,
        default: () => ({}),
    },
    documents: {
        type: Object,
        default: () => ({}),
    },
    start: {
        type: String,
        default: null
    },
    end:{
        type: String,
        default: null
    },
    date:{
        type: String,
        default: null
    },
    petty_cash: {
        type: Object,
        default: () => ({}),
    },
    expenses: {
        type: Object,
        default: () => ({}),
    },
    total : {
        type: Number,
        default: 0,
    }
});

const form = useForm({
    local_id: props.petty_cash.local_sale_id,
});

const local_name = ref(null);

const  getLocal = (id = null) => {
    if(id){
        let arreglo = props.locals;
        let local = arreglo.find(arreglo => arreglo.id == id);
        local_name.value = local.description;
    } else{
        local_name.value = "TODOS LOS LOCALES"
    }
    
}
const getTotalQuantities = () => {
    let quantities=0;
    let arreglo = props.tickets;
    arreglo.forEach(sale => {
        quantities+=sale.quantity;
    });
    return quantities;
}


const getTotalExpenses = () => {
    let expenses=0.0;
    props.expenses.forEach(expense=> {
        expenses+=parseFloat(expense.amount);
    });
    return expenses.toFixed(2);
}

const downloadExcel = () => {
    const workbook = XLSX.utils.book_new();

    // Obtén la tabla HTML que deseas convertir
    const table = document.getElementById('table_export');

    // Convierte la tabla HTML en una hoja de cálculo
    const worksheet = XLSX.utils.table_to_sheet(table);
    worksheet['!cols'] = [
        {width:4}, // Columna "A" #
        {width:12}, // Columna "B" Fecha
        {width:30}, // Columna "C" Tienda
        {width:9}, // Columna "D" Cod. Prod.
        {width:35}, // Columna "E" Producto
        {width:12}, // Columna "F" Precio Vendido
        {width:9}, // Columna "G" Cantidad
        {width:9}, // Columna "H" Talla
        {width:9}, // Columna "I" Total
    ];

    XLSX.utils.book_append_sheet(workbook, worksheet, props.start+'-'+props.end);
    XLSX.writeFile(workbook, 'RpteCaja_'+local_name.value+"-"+props.start+'.xlsx');
}


const downloadPdf = () => {
    const table = document.getElementById('table_export');

    const pdf = new jsPDF({
        orientation: 'landscape',
        unit: 'pt',
        format: 'a4'
    });

    let titulo = "Reporte de Caja de: "+ local_name.value;
    pdf.text(titulo, 200, 20); //X e Y

    titulo="Día: "+ props.petty_cash.state == 0 ? props.petty_cash.date_opening : 'Caja abierta';
    
    pdf.text(titulo, 200, 40);
        // Genera la tabla PDF utilizando jsPDF
        pdf.autoTable({
        html: table,
        startY: 70  // altura(Y) desde top para iniciar dibujar la tabla
    });

    // Guarda el archivo PDF
    pdf.save('RpteCaja_'+ local_name.value + "-" + props.petty_cash.state == 0 ? props.petty_cash.date_opening : 'xx-xx-xxxx' +".pdf");
}

onMounted(()=>{
    getLocal();
    getTotalQuantities();
});
</script>

<template>
    <AppLayout title="Ventas en caja">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('pettycash.index')" class="text-primary hover:underline">Caja Chica</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Reporte</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <!-- Breadcrumb End -->
            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- ====== Table One Start -->
                <div class="panel p-0">
                    <div class="w-full p-4">
                        <div class="grid grid-cols-3">
                            <div class="col-span-3 sm:col-span-1">
                                <form @submit.prevent="form.get(route('pettycash.index'))">
                                    <select v-model="form.local_id" v-on:change="getReport()"
                                        id="stablishment"
                                        disabled
                                        class="form-select text-white-dark">
                                        <option value="0">Todos los Locales</option>
                                        <template v-for="(local, index) in props.locals" :key="index">
                                            <option :value="local.id">{{ local.description }}</option>
                                        </template>
                                    </select>
                                </form>
                            </div>
                            <div class="col-span-3 sm:col-span-2">
                                <Keypad>
                                    <template #botones>
                                        
                                        <button v-if="false" v-on:click="downloadExcel()"
                                            class="px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            >Exportar en Excel
                                        </button>

                                        <button v-on:click="downloadPdf()"
                                            class="px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            >Exportar en PDF
                                        </button>
                                        <a :href="route('pettycash.index')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</a>
                                    </template>
                                </Keypad>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table_export">
                            <thead class="text-xs uppercase">
                                <tr class="bg-primary/20 border-primary/20">
                                    <th colspan="2" class=""><strong>LOCAL:</strong> </th>
                                    <th colspan="4" class="">{{ local_name }}</th>
                                </tr>
                                <tr class="bg-primary/20 border-primary/20">
                                    <th colspan="2" class="">
                                        <strong>Desde: </strong> 
                                    </th>
                                    <th colspan="4" class="text-left font-medium">
                                        <span v-if="petty_cash.state == 0">
                                            {{ petty_cash.date_opening +" "+ petty_cash.time_opening.slice(0, -3) }}
                                        </span>
                                    </th>
                                </tr>
                                <tr class="bg-primary/20 border-primary/20">
                                    <th colspan="2" class="text-left font-medium">
                                        <strong>HASTA: </strong> 
                                    </th>
                                    <th colspan="4" class="text-left font-medium">
                                        <span v-if="petty_cash.state == 0">
                                            {{ petty_cash.date_closed +" "+ petty_cash.time_closed }}
                                        </span>
                                    </th>
                                </tr>
                                <tr class="bg-primary/20 border-primary/20">
                                    <th colspan="2"  class="text-left font-medium"><strong>Monto final en Caja:</strong></th>
                                    <th colspan="4"  class="text-left font-medium ">{{ petty_cash.final_balance }}</th>
                                </tr>
                                <tr class="bg-primary/20 border-primary/20">
                                    <td class="text-center text-sm" colspan="6"><b>Ventas</b></td>
                                </tr>
                                <tr>
                                    <th scope="col">
                                        Fecha
                                    </th>
                                    <th>
                                        Tienda
                                    </th>
                                    <th>
                                        Producto / Servicio
                                    </th>
                                    <th>
                                        Precio Vendido
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ticket, index) in tickets" :key="ticket.id">
                                    <th class="font-medium whitespace-nowrap">
                                        {{ ticket.sale_date }}
                                    </th>
                                    <td>
                                        {{ getLocal(ticket.local_id) }}
                                    </td>
                                    <td>
                                        {{ ticket.interne + " - " + ticket.product_description }}
                                    </td>
                                    <td class="text-right">
                                        {{ ticket.price }}
                                    </td>
                                    <td class="text-right">
                                        {{ ticket.quantity }}
                                    </td>
                                    <td class="text-right">
                                        {{ (ticket.quantity * ticket.price).toFixed(2) }}
                                    </td>
                                </tr>
                                <template v-for="(physical, key) in physicals">
                                    <tr v-for="(pro, k) in JSON.parse(physical.products)"  :key="pro.id">
                                        <th class="font-medium whitespace-nowrap">
                                            {{ physical.sale_date }}
                                        </th>
                                        <td>
                                            {{ physical.description }}
                                        </td>
                                        <td>
                                            {{ pro.interne + " - " + pro.description }}
                                        </td>
                                        <td class="text-right" style="text-align: right;">
                                            {{ pro.unit_price }}
                                        </td>
                                        <td class="text-right" style="text-align: right;">
                                            {{ pro.quantity }}
                                        </td>
                                        <td class="text-right" style="text-align: right;">
                                            {{ pro.total }}
                                        </td>
                                    </tr>
                                </template>
                                <tr v-for="(document, index) in documents" :key="document.id">
                                    <th class="font-medium whitespace-nowrap">
                                        {{ document.sale_date }}
                                    </th>
                                    <td>
                                        {{ getLocal(document.local_id) }}
                                    </td>
                                    <td>
                                        {{ document.interne + " - " + document.product_description }}
                                    </td>
                                    <td class="text-right">
                                        {{ document.price }}
                                    </td>
                                    <td class="text-right">
                                        {{ document.quantity }}
                                    </td>
                                    <td class="text-right">
                                        {{ (document.quantity * document.price).toFixed(2) }}
                                    </td>
                                </tr>
                                <tr class="">
                                    <td colspan="5" class="text-right font-medium whitespace-nowrap" style="text-align: right;">
                                        <strong>Totales En Ventas</strong>
                                    </td>
                                    <td class="text-right" style="text-align: right;">
                                        <strong>S/ {{ total }}</strong>
                                    </td>
                                </tr>
                                <template v-if="expenses.length > 0">
                                    <tr class="bg-danger/20 border-danger/20 uppercase">
                                        <td class="text-center text-sm" colspan="6"><b>GASTOS</b></td>
                                    </tr>
                                    <tr class="bg-danger/20 border-danger/20 uppercase">
                                        
                                        <td scope="col" ><b>N° Documento</b></td>
                                        <td scope="col" colspan="4"><b>Motivo o Descripción</b></td>
                                        <td scope="col" ><b>Monto</b></td>
                                    </tr>
                                    <tr v-for="(expense, index) in expenses" :key="expense.id" class="bg-danger/20 border-danger/20">  
                                        <td class="text-left">
                                            {{ expense.document }}
                                        </td>
                                        <td colspan="4" class="text-left">
                                            {{ expense.description }}
                                        </td>      
                                        <td class="text-right" style="text-align: right;">
                                            {{ expense.amount }}
                                        </td>                          
                                    </tr>
                                    <tr class="bg-danger/20 border-danger/20">
                                        <td colspan="5" class="text-right" style="text-align: right;">Total en Gastos:</td>
                                        <td class="text-right" style="text-align: right;">S/ {{ getTotalExpenses() }}</td>
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
