<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import SearchProducts from './Partials/SearchProducts.vue';
    import SearchClients from './Partials/SearchClients.vue';
    import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
    import { useForm, Link } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import Keypad from '@/Components/Keypad.vue';
    import Swal2 from 'sweetalert2';
    import { onMounted } from 'vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import iconTrash from '@/Components/vristo/icon/icon-trash-lines.vue'

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

    const form = useForm({
        products: [],
        total: 0,
        payments: [{
            type:1,
            reference: null,
            amount:0
        }],
        client:{
            id: props.client.id,
            full_name: props.client.full_name
        },
        sale_date: null
    });

    const getFormattedDate = () => {
      const now = new Date();
      const year = now.getFullYear();
      const month = String(now.getMonth() + 1).padStart(2, '0');
      const day = String(now.getDate()).padStart(2, '0');
      //return `${year}-${month}-${day}`;
      form.sale_date = `${year}-${month}-${day}`
    }

    onMounted(() => {
        getFormattedDate();
    });
    
    const getDataTable = async (data) => {
        let xtotal = parseFloat(data.total) + parseFloat(form.total);
        form.total = xtotal.toFixed(2);
        form.products.push(data);
        form.payments[0].amount = form.total;
    }

    const removeProduct = (key) => {
        let t = parseFloat(form.products[key].total);
        form.total = parseFloat(form.total) - t;
        form.products.splice(key,1);
    }

    const addPayment = () => {
        let ar = {
            type:1,
            reference: null,
            amount:0
        };
        form.payments.push(ar);
    };
    const removePayment = (index) => {
        if(index>0){
            form.payments.splice(index,1);
        }
    };
    const saveSale = async () => {
        Swal2.fire({
          imageUrl: '/img/loading-70.gif',
          imageHeight: 120,
          imageAlt: 'Cargando',
          showConfirmButton: false,
          allowOutsideClick: false
        });
        if(form.total>0){
            axios.post(route('sales.store'), form ).then((res) => {
                form.reset();
                Swal2.fire({
                    title: 'Venta registrada',
                    text: "¿Desea imprimir el ticket?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Imprimir',
                    cancelButtonText: 'Cancelar',
                    padding: '2em',
                    customClass: 'sweet-alerts',
                }).then((result) => {
                    if (result.isConfirmed) {
                        printPdf(res.data.id);
                    }
                });
            }).catch((error) => {
                let validationErrors = error.response.data.errors;
                if (validationErrors && validationErrors.payments) {
                    const paymentsErrors = validationErrors.payments;
                    for (let i = 0; i < paymentsErrors.length; i++) {
                        form.setError('payments.'+index+'.amount', paymentsErrors[i]);
                    }
                }
                
                Swal2.close();
            });
        }else{
            swal('Agregar Productos para realizar la venta');
        }
        
    }

    const printPdf = (id) => {
        //window.location.href = "../../pdf/sales/ticket/" + id;
        let url = route('ticketpdf_sales',id)
        window.open(url, "_blank");
    }

    const getClient = async (data) => {
        form.client.id = data.id;
        form.client.full_name = data.full_name;
    }
</script>

<template>
    <AppLayout title="Punto de Ventas">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('sales.index')" class="text-primary hover:underline">Punto de Ventas</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Nuevo</span>
            </li>
        </Navigation>
        <div class="mt-5">

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-2 col-span-2 sm:col-span-1 md:col-span-1">
                    <div class="panel">
                        <SearchProducts @eventdata="getDataTable" />
                        <div class="table-responsive mt-4">
                            <table >
                                <thead class="">
                                    <tr>
                                        <th class=""></th>
                                        <th  >
                                            Código & Descripción
                                        </th>
                                        <th >
                                            Cantidad
                                        </th>
                                        <th >
                                            Precio
                                        </th>
                                        <th >
                                            Descuento
                                        </th>
                                        <th >
                                            Importe
                                        </th>
                                    </tr>
                                </thead >
                                <tbody style="max-height: 250px;overflow-y: auto;overflow-x: hidden;">
                                   <template v-if="form.products.length > 0">
                                    <tr v-for="(product, key) in form.products" >
                                        <td class="text-center">
                                            <button @click="removeProduct(key)" type="button" v-tippy:delete>
                                                <icon-trash />
                                            </button>
                                            <tippy target="delete">Eliminar</tippy>
                                        </td>
                                        <td >
                                            {{ product.interne  }} - {{ product.description  }}  {{ product.size ? '/' + product.size : ''  }}
                                        </td>
                                        <td >
                                            {{ product.quantity  }}
                                        </td>
                                        <td >
                                            {{ product.price  }}
                                        </td>
                                        <td >
                                            {{ product.discount  }}
                                        </td>
                                        <td >
                                            {{ product.total  }}
                                        </td>
                                    </tr>
                                   </template>
                                   <template v-else>
                                        <tr >
                                           <td colspan="6" >
                                                <div class="flex p-4 text-sm border border-gray-300 bg-gray-50 dark:bg-gray-800 dark:text-white dark:border-yellow-800" role="alert">
                                                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Info</span>
                                                    <div>
                                                        <span class="font-medium">Vacío!</span> Agregar productos
                                                    </div>
                                                </div>
                                           </td> 
                                        </tr>
                                   </template>
                                </tbody>
                                <tfoot>
                                    <tr >
                                        <th colspan="5" ><strong>Total a Cobrar</strong></th>
                                        <td ><strong>S/. {{ form.total }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mb-2 pr-4 col-span-2 sm:col-span-1 md:col-span-1">
                    <div class="panel">
                        <SearchClients @clientId="getClient" :clientDefault="form.client" :documentTypes="documentTypes" />
                        <InputError :message="form.errors[`client.id`]" class="mt-2" />
                        <div class="flex items-center me-4 mt-4 justify-between">
                            <label for="sale_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de venta: </label>
                            <input v-model="form.sale_date" id="sale_date" type="date" class="form-input" placeholder="Select date">
                        </div>

                        <div class="mt-4">
                            <h4 class="italic font-bold mb-4">Medio de Pago</h4>
                            <table>
                                <tbody>
                                    <tr v-for="(row, index) in form.payments" v-bind:key="index">
                                        <td>
                                            <select v-model="row.type" id="countries" class="form-select text-white-dark">
                                                <template v-for="(payment) in payments">
                                                    <option :value="payment.id">{{ payment.description }}</option>
                                                </template>
                                            </select>
                                            <InputError :message="form.errors[`payments.${index}.id`]" class="mt-2" />
                                        </td>
                                        <td>
                                            <input v-model="row.reference" type="text" id="first_name" class="form-input" placeholder="Referencia" required>
                                            <InputError :message="form.errors[`payments.${index}.reference`]" class="mt-2" />
                                        </td>
                                        <td>
                                            <input v-model="row.amount" type="text" id="first_name" class="form-input" placeholder="Monto" required>
                                            <InputError :message="form.errors[`payments.${index}.amount`]" class="mt-2" />
                                        </td>
                                        <td>
                                            <button @click="removePayment(index)" type="button" v-tippy:delete>
                                                <icon-trash />
                                            </button>
                                            <tippy target="delete">Eliminar</tippy>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button @click="addPayment()" type="button" class="inline-block px-0 py-2 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">Agregar (+)</button>
                        </div>
                        <div class="grid grid-cols-6 gap-4">
                            <div class="col-span-6 text-right">
                                <Keypad>
                                    <template #botones>
                                        <button @click="saveSale()" type="button" class=" inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Cobrar
                                        </button>
                                        <Link :href="route('sales.index')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                                    </template>
                                </Keypad>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
