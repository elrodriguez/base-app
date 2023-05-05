<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import { faTrashAlt, faPencilAlt, faPrint, faCashRegister, faFileExcel, faMoneyBill1Wave} from "@fortawesome/free-solid-svg-icons";
    import Pagination from '@/Components/Pagination.vue';
    import ModalCashEdit from './ModalCashEdit.vue';
    import ModalCashCreate from './ModalCashCreate.vue';
    import ModalExpenseCreate from './ModalExpenseCreate.vue';
    import Keypad from '@/Components/Keypad.vue';
    
    const props = defineProps({
        pettycashes: {
            type: Object,
            default: () => ({}),
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
        locals: {
            type: Object,
            default: () => ({}),
        }
    });
    
    const form = useForm({
        search: {
            date_start: props.filters.date_start,
            date_end: props.filters.date_end
        },
    });

    const dataPettycash = useForm({
        pettycash: {
            type: Object,
            default: () => ({}),
        }
    });

    const formDelete = useForm({});

    function destroy(pettycash) {
        if (confirm("¿Estás seguro de que quieres eliminar?")) {
            formDelete.delete(route('pettycash.destroy', pettycash.id));
        }
    }

    function closePettyCash(id, state){
        if(state == 0){
            alert("Esta caja ya se encuentra Cerrada");
        }else{
            if (confirm("¿Estás seguro de que quieres Cerrar la Caja?")) {
                axios.post(route('close_petty_cash', {id})).then(response => {
                    location.reload();
                }).catch(error => console.log(error));
            }
        }
    }

    function reportPettyCash(id){
        window.open(route('PettyCashReport', id), '_blank');
    }

function getLocal(id){
    let local_name;
    props.locals.forEach(local => {
    if(local.id == id){
        local_name = local.description;
    }
  });
  return local_name;
}

function openModalPettycashEdit(pettycash){
    dataPettycash.pettycash = pettycash;
}
</script>

<template>
    <AppLayout title="Cajas Chicas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Caja Chica
            </h2>
        </template>

        <div>
            <div class="max-w-10 mx-auto py-10 sm:px-6 lg:px-8">
                <div class="col-span-7 p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <form @submit.prevent="form.get(route('pettycash.index'))">
                        <div class="grid grid-cols-4 gap-3 py-2">
                            <div>
                                <input
                                    type="text"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="f1"
                                    placeholder="Fecha desde"
                                    v-mask="'##/##/####'"
                                />
                            </div>
                            <div>
                                <input
                                    type="text"
                                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="f2"
                                    placeholder="Fecha hasta"
                                    v-mask="'##/##/####'"
                                />
                            </div>
                            <div class="">
                                <button type='submit' class='inline-block px-6 py-2 bg-gray-800 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out'>
                                    Buscar
                                </button>
                            </div>
                            <div class="text-right">
                                <Keypad>
                                    <template #botones>
                                        <ModalCashCreate :locals="locals" />
                                    </template>
                                </Keypad>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-span-7 p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-3 overflow-x-auto">
                    <table class="table-auto" style="width: 100%;">
                        <thead class="border-b">
                            <tr class="bg-blue-300 hover:bg-blue-500">
                                <th scope="col" class="px-2 text-sm font-medium text-center text-gray-900 py-4 border-r">
                                #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 border-r">
                                    Acción
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-3 py-4 border-r">
                                    Usuario
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 border-r">
                                    Tienda
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 border-r">
                                    Fecha Apertura
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-4 py-4 border-r">
                                    Fecha Cerrado
                                </th>
                                <th scope="col" class="text-left text-sm font-medium text-gray-900 px-3 py-4 border-r">
                                    Ingreso por ventas
                                </th>
                                <th scope="col" class="text-left text-sm font-medium text-gray-900 px-2 py-4 border-r">
                                    Monto en Caja
                                </th>
                                <th scope="col" class="text-left text-sm font-medium text-gray-900 px-3 py-4">
                                    Gastos
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(pettycash, index) in pettycashes.data" :key="pettycash.id" :class="  index % 2 == 0 ? 'bg-gray-100 hover:bg-gray-300 border-b' : 'bg-gray-200 hover:bg-gray-300 border-b'">
                                <td class="text-center py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">
                                    {{ index + 1 }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    <div class="flex space-x-2">
                                        <div v-if="pettycash.state==1">
                                            <div>
                                                <ModalExpenseCreate :petty_cash_id="pettycash.id" />
                                             </div>
                                        </div>

                                        <div v-else>
                                            <button disabled type="button" title="Registrar Gasto" class="inline-block w-10 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-500 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                            >
                                            <font-awesome-icon :icon="faMoneyBill1Wave" />
                                            </button>
                                        </div>

                                        <div v-if="pettycash.state==1">
                                            <button @click="openModalPettycashEdit(pettycash)" type="button" title="Editar" class="inline-block w-10 py-2 bg-[#374151] text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-[#374151]/90 hover:shadow-lg dark:focus:ring-[#374151]/50 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#374151]/90 active:shadow-lg transition duration-150 ease-in-out"
                                            >
                                                <font-awesome-icon :icon="faPencilAlt" />
                                            </button>
                                        </div>
                                        <div v-else>
                                            <button disabled type="button" title="No puede Editar" class="inline-block w-10 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-500 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                            >
                                                <font-awesome-icon :icon="faPencilAlt" />
                                            </button>
                                        </div>

                                        <div v-if="pettycash.income==0">
                                            <button type="button" class="inline-block w-10 py-2 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                            @click="destroy(pettycash)"
                                            title="Eliminar"
                                            >
                                            <font-awesome-icon :icon="faTrashAlt" />
                                        </button>
                                        </div>

                                        <div v-else>
                                            <button disabled type="button" title="No puede eliminarse" class="inline-block w-10 py-2 bg-gray-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-500 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"

                                            >
                                            <font-awesome-icon :icon="faTrashAlt" />
                                        </button>
                                        </div>

                                        <div>
                                            <button  v-if="pettycash.state==1" type="button" class="inline-block w-10 py-2 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                            @click="closePettyCash(pettycash.id, pettycash.state)"
                                            title="Cerrar Caja"
                                            >
                                            <font-awesome-icon :icon="faCashRegister" />
                                        </button>

                                        <button  v-else type="button" class="inline-block w-10 py-2 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-600 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                            title="Ya Cerrada Caja"
                                            @click="closePettyCash(pettycash.id, pettycash.state)"
                                            >
                                            <font-awesome-icon :icon="faCashRegister" />
                                        </button>
                                        </div>

                                        <div>
                                            <button v-if="pettycash.state==0" type="button" class="inline-block w-10 py-2 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out"
                                            @click="reportPettyCash(pettycash.id)"
                                            title="Reporte"
                                            >
                                            <font-awesome-icon :icon="faFileExcel" />
                                        </button>

                                        <button v-else type="button" class="inline-block w-10 py-2 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-600 hover:shadow-lg focus:bg-gray-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-600 active:shadow-lg transition duration-150 ease-in-out"
                                           title="Reporte"
                                            >
                                            <font-awesome-icon :icon="faFileExcel" />
                                        </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ pettycash.name_user }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ getLocal(pettycash.local_sale_id) }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ pettycash.date_opening }}<p class="text-sm">{{ pettycash.time_opening.slice(0, -3) }} hrs</p>
                                </td>
                                <td v-if="pettycash.state==1" class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    Abierto
                                </td>
                                <td v-else class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ pettycash.date_closed}} <p>{{ pettycash.time_closed.slice(0, -3)+" hrs"  }}</p>
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ pettycash.income }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap border-r">
                                    {{ pettycash.final_balance }}
                                </td>
                                <td class="text-sm text-center text-gray-900 font-light py-4 whitespace-nowrap">
                                    {{ pettycash.expenses }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <Pagination :data="pettycashes" />
                </div>

            </div>
        </div>
        <ModalCashEdit :locals="locals" :pettycash="dataPettycash.pettycash" />
    </AppLayout>
</template>
