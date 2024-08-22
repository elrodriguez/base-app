
<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import * as XLSX from 'xlsx/dist/xlsx.full.min';
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';  //No lo borres si se usa aunque pareciera que no.
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

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

const totalPrice = ref(0);
const totalQuantity = ref(0);
const totalDiscount = ref(0);
const totalFinal = ref(0);

onMounted(() => {
    calculateTotals();
});

function calculateTotals() {
    totalPrice.value    = 0;
    totalQuantity.value = 0;
    totalDiscount.value = 0;
    totalFinal.value    = 0;
    form.sales.forEach(sale => {
        console.log(sale.sale_product);
        totalPrice.value      = totalPrice.value + parseFloat(JSON.parse(sale.sale_product).unit_price);
        totalQuantity.value   = totalQuantity.value + parseFloat(JSON.parse(sale.sale_product).quantity);
        totalDiscount.value   = totalDiscount.value + parseFloat(JSON.parse(sale.sale_product).discount);
        totalFinal.value      = totalFinal.value + (parseFloat(JSON.parse(sale.sale_product).unit_price)*parseFloat(JSON.parse(sale.sale_product).quantity))-parseFloat(JSON.parse(sale.sale_product).discount);
    });
    
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
        form.payments = response.data.payments;
        calculateTotals();
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

const formatDateUS = (dateString) => {

    const date = new Date(dateString);

    const formattedDate = date.toLocaleString('en-US', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false // Desactiva el formato de 12 horas
    });

    return formattedDate;
}

const urlBaseI = assetUrl;
</script>

<template>
    <AppLayout title="Reportes de Ventas">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('reports')" class="text-primary hover:underline">Reportes</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Reporte de ventas entre fechas(por locales)</span>
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
                                <InputLabel for="stablishment" value="Establecimiento" />
                                <select v-model="form.local_id" v-on:change="getReport()"
                                    id="stablishment"
                                    class="form-select text-white-dark">
                                    <option value="0">Todos los Locales</option>
                                    <template v-for="(local, index) in props.locals" :key="index">
                                        <option :value="local.id">{{ local.description }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <input type="date" v-model="form.start" v-on:change="getReport()"
                                    class="form-input"
                                    id="f1" />
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <input type="date" v-model="form.end" v-on:change="getReport()"
                                    class="form-input"
                                    id="f2" />
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
                        <table id="table_export" class="table-striped" >
                            <thead>
                                <tr  v-if="form.start==form.end">
                                    <th colspan="10" style="text-align: center">Ventas del día: {{ form.start }} </th>
                                </tr>
                                <tr v-else>
                                    <th colspan="10" style="text-align: center">Matos Store - Ventas del: {{ form.start }} al {{ form.end }}</th>
                                </tr>
                                <tr>
                                    <th colspan="10" style="text-align: center">De: {{ form.local_name }}</th>
                                </tr>
                                <tr>
                                    <th scope="col" >
                                        Fecha
                                    </th>
                                    <th >
                                        Tienda
                                    </th>
                                    <th >
                                        Producto
                                    </th>
                                    <th >
                                        Metodos de Pago
                                    </th>
                                    <th>
                                        Precio Vendido
                                    </th>
                                    <th >
                                        Cantidad
                                    </th>
                                    <th >
                                        Descuento
                                    </th>
                                    
                                    <th >
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(sale, index) in form.sales" :key="sale.id">
                                    <td class="w-20">
                                        {{ formatDateUS(sale.created_at) }}
                                    </td>
                                    <td >
                                        {{ sale.local_description }}
                                    </td>
                                    <td>
                                        <div class="flex"> 
                                            <img v-if="sale.image=='img/imagen-no-disponible.jpg'"
                                                :src="urlBaseI+sale.image"
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                :alt="sale.interne"
                                            />

                                            <img v-else
                                                :src="urlBaseI+'storage/'+sale.image"
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                :alt="sale.interne"
                                            />
                                            <p class="whitespace-nowrap">
                                                {{ sale.product_description }}
                                                <span class="text-primary block text-xs">CÓDIGO: {{ sale.interne }}</span>
                                                <span class="text-primary block text-xs">PT: {{ JSON.parse(sale.sale_product).size }}</span>
                                            </p>
                                        </div>
                                        
                                    </td>
                                    <td >
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
                                    <td >
                                        {{ JSON.parse(sale.sale_product).unit_price }}
                                    </td>
                                    <td >
                                        {{ JSON.parse(sale.sale_product).quantity }}
                                    </td>
                                    <td >
                                        {{ JSON.parse(sale.sale_product).discount }}
                                    </td>
                                    
                                    <td >
                                        {{ sale.product_total }}
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr class="bg-blue-400 hover:bg-blue-600">
                                    <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: right" colspan="4">Totales</th>
                                    <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: right">S/ {{ totalPrice.toFixed(2) }}</th>
                                    <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: right">{{ totalQuantity }}</th>
                                    <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: right"> S/ {{ totalDiscount.toFixed(2) }} </th>
                                    <th scope="col" class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="text-align: right">S/ {{ totalFinal.toFixed(2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
