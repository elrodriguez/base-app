<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { faGears } from "@fortawesome/free-solid-svg-icons";
import Pagination from '@/Components/Pagination.vue';
import ModalCashCreate from './ModalCashCreate.vue';
import Keypad from '@/Components/Keypad.vue';
import swal from 'sweetalert2';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import ModalLarge from '@/Components/ModalLarge.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { 
    Textarea, Input, Dropdown, Menu, MenuItem, Button, Select
} from 'ant-design-vue';
import Swal2 from 'sweetalert2';
import Navigation from '@/Components/vristo/layout/Navigation.vue';

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

        swal.fire({
            icon: 'warning',
            title: '¿Esta seguro de cerrar caja?',
            text: 'Este proceso es irreversible.',
            showCancelButton: true,
            confirmButtonText: 'SI',
            cancelButtonText: `NO`,
            padding: '2em',
            customClass: 'sweet-alerts',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.post(route('close_petty_cash', {id})).then(response => {
                    router.visit(route('pettycash.index'), {
                        method: 'get',
                        data: form,
                        replace: false,
                        preserveState: true,
                        preserveScroll: true,
                        onSuccess: page => {
                            showMessage('La caja fue cerrada exitosamente')
                        }
                    })
                }).catch(error => console.log(error));
            } 
        });
        
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

const formExpense = useForm({
    petty_cash_id: null,
    description:'',
    amount: '',
    document:''

});

const displayModalExpense  = ref(false);
const openModalExpenseCreate = (id) => {
    formExpense.petty_cash_id = id;
    displayModalExpense.value = true;
};
const closeModalExpense = () => {
    formExpense.reset();
    displayModalExpense.value = false;
};

    
const createExpense = () => {
    formExpense.post(route('store_expense'), {
        forceFormData: true,
        errorBag: 'createExpense',
        preserveScroll: true,
        onSuccess: () => {
            Swal2.fire({
                title: 'Enhorabuena',
                text: 'Se Registro correctamente',
                icon: 'success',
            });
            closeModalExpense()
        },
    });
};

const formEdit = useForm({
    id: null,
    local_id: null,
    starting_amount: '',
    seller_name: ''
});

const displayModalEdit = ref(false);

const openModalEdit = (cash) => {
    formEdit.id = cash.id
    formEdit.local_id = cash.local_sale_id
    formEdit.starting_amount = cash.beginning_balance
    formEdit.seller_name = cash.seller_name ?? cash.name_user
    displayModalEdit.value = true;
};

const closeModalEdit = () => {
    form.reset();
    displayModalEdit.value = false;
};

const editCash = () => {
    formEdit.put(route('pettycash.update',formEdit.id), {
        errorBag: 'editCash',
        preserveScroll: true,
        onSuccess: () => {
            Swal2.fire({
                title: 'Enhorabuena',
                text: 'Se Actualizado correctamente',
                icon: 'success',
            });
            closeModalEdit()
        },
    });
};

const showMessage = (msg = '', type = 'success') => {
    const toast = Swal2.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        customClass: { container: 'toast' },
    });
    toast.fire({
        icon: type,
        title: msg,
        padding: '10px 20px',
    });
};
</script>

<template>
    <AppLayout title="Cajas Chicas">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Caja Chica</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- ====== Table One Start -->
                <div class="panel p-0">
                    <div class="w-full p-4">
                        <div class="grid grid-cols-3">
                            <div class="col-span-3 sm:col-span-1">
                                <form @submit.prevent="form.get(route('pettycash.index'))">
                                    <div class="grid grid-cols-3">
                                        <div class="col-span-3 sm:col-span-1 mr-2">
                                            <input v-mask="'##/##/####'" placeholder="##/##/####" type="text" id="f1" aria-label="f1" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="col-span-3 sm:col-span-1">
                                            <input v-mask="'##/##/####'" placeholder="##/##/####" type="text" id="f2" aria-label="d2" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </div>
                                        <div class="col-span-3 sm:col-span-1">
                                            <button type="submit" class="p-2 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                <span class="sr-only">Search</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-span-3 sm:col-span-2">
                                <Keypad>
                                    <template #botones>
                                        <ModalCashCreate :locals="locals" />
                                    </template>
                                </Keypad>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="">
                            <thead class="">
                                <tr class="">
                                    <th class="">
                                        Acción
                                    </th>
                                    <th class="">
                                        Usuario
                                    </th>
                                    <th class="">
                                        Tienda
                                    </th>
                                    <th class="">
                                        Fecha Apertura
                                    </th>
                                    <th class="">
                                        Fecha Cerrado
                                    </th>
                                    <th class="">
                                        Ingreso por ventas
                                    </th>
                                    <th class="">
                                        Monto en Caja
                                    </th>
                                    <th class="">
                                        Gastos
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pettycash, index) in pettycashes.data" :key="pettycash.id" :class="  pettycash.state==1? '' : 'bg-gray-100 hover:bg-gray-200'">
                                    <td class="">
                                        <Dropdown :placement="'bottomLeft'" arrow>
                                            <button class="border py-1.5 px-2 dropdown-button inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm" type="button">
                                                <font-awesome-icon :icon="faGears" />
                                            </button>
                                            <template #overlay>
                                                <Menu>
                                                    <MenuItem v-if="pettycash.state==1">
                                                        <a href="#" @click="openModalEdit(pettycash)" class="text-left block px-4 py-2 text-sm text-blue-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                            Editar
                                                        </a>
                                                    </MenuItem>
                                                    <MenuItem v-if="pettycash.state==1" >
                                                        <a href="#" @click="openModalExpenseCreate(pettycash.id)" class="text-left block px-4 py-2 text-sm text-blue-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                            Gastos
                                                        </a>
                                                    </MenuItem>
                                                    <MenuItem v-if="pettycash.state==1">
                                                        <a href="#" @click="closePettyCash(pettycash.id, pettycash.state)" class="text-left block px-4 py-2 text-sm text-blue-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                            Cerrar Caja
                                                        </a>
                                                    </MenuItem>
                                                    <MenuItem type="button" >
                                                        <Link :href="route('PettyCashReport', pettycash.id)" class="text-left block px-4 py-2 text-sm text-blue-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                            Reporte Caja
                                                        </Link>
                                                    </MenuItem>
                                                    <MenuItem v-if="pettycash.income==0">
                                                        <a @click="destroy(pettycash)" href="#" class="text-left block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Eliminar</a>
                                                    </MenuItem>
                                                </Menu>
                                            </template>
                                        </Dropdown>

                                    </td>
                                    <td class="">
                                        {{ pettycash.name_user }}
                                    </td>
                                    <td class="">
                                        {{ getLocal(pettycash.local_sale_id) }}
                                    </td>
                                    <td class="">
                                        {{ pettycash.date_opening }}<p class="text-sm">{{ pettycash.time_opening.slice(0, -3) }} hrs</p>
                                    </td>
                                    <td class="">
                                        <span v-if="pettycash.state==1"  class="bg-blue-800 text-white text-xs font-medium mr-2 px-2 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                            Abierto
                                        </span>
                                        <span v-else class="bg-gray-700 text-white text-xs font-medium mr-2 px-2 py-1 rounded dark:bg-pink-900 dark:text-pink-300">
                                            {{ pettycash.date_closed}} {{ pettycash.time_closed.slice(0, -3)+" hrs"  }}
                                        </span>
                                    </td>
                                    <td class="">
                                        {{ pettycash.income }}
                                    </td>
                                    <td class="">
                                        {{ pettycash.final_balance }}
                                    </td>
                                    <td class="">
                                        {{ pettycash.expenses }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :data="pettycashes" />
                </div>
            </div>
        </div>
        <ModalLarge :show="displayModalExpense" @close="closeModalExpense">
            <template #title>
                Registrar Gasto en CAJA
            </template>
            <template #content>

                <form>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-4">
                            <InputLabel id="formExpense_description" value="Descripción o Motivo" class="mb-1" />
                            <Textarea
                                id="formExpense_description"
                                v-model:value="formExpense.description"
                                placeholder="Escriba motivo del gasto"
                                :auto-size="{ minRows: 2, maxRows: 5 }"
                                autofocus
                            />
                            <InputError  :message="formExpense.errors.description" class="mt-2" />
                        </div>
                        <div class="col-span-4 sm:col-span-2">
                            <InputLabel ref="formExpense_amount" value="Monto" />
                            <Input
                                id="formExpense_amount"
                                v-model:value="formExpense.amount"
                                placeholder="Monto del gasto"
                                type="text"
                            />
                            <InputError :message="formExpense.errors.amount" class="mt-2" />
                        </div>
                        <div class="col-span-4 sm:col-span-2">
                            <InputLabel ref="formExpense_document" value="N° Documento" />
                            <Input
                                id="formExpense_document"
                                v-model:value="formExpense.document"
                                placeholder="N° de Recibo / Empresa"
                                type="text"
                            />
                            <InputError :message="formExpense.errors.document" class="mt-2" />
                        </div>
                    </div>
                </form>
            </template>

            <template #buttons>
                <DangerButton
                    class="ml-3"
                    :class="{ 'opacity-25': formExpense.processing }"
                    :disabled="formExpense.processing"
                    @click="createExpense"
                >
                    Guardar
                </DangerButton>
            </template>
        </ModalLarge>
        <ModalLarge :show="displayModalEdit" @close="closeModalEdit">
            <template #title>
                Editar Caja Chica
            </template>
            <template #content>
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6 sm:col-span-3">
                        <InputLabel value="Local" class="mb-1" />
                        <Select
                            class="w-full"
                            v-model:value="formEdit.local_id"
                            :options="locals.map((row)=>({value: row.id, label: row.description}))"
                        />
                        <InputError :message="formEdit.errors.local_id" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <InputLabel value="Monto de Inicio" class="mb-1" />
                        <Input
                            v-model:value="formEdit.starting_amount"
                            type="text"
                        />
                        <InputError :message="formEdit.errors.starting_amount" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <InputLabel value="Nombre Vendedor" class="mb-1" />
                        <Input
                            v-model:value="formEdit.seller_name"
                            type="text"
                        />
                        <InputError :message="formEdit.errors.seller_name" class="mt-2" />
                    </div>
                </div>

            </template>

            <template #buttons>

                <DangerButton
                    class="ml-3"
                    :class="{ 'opacity-25': formEdit.processing }"
                    :disabled="formEdit.processing"
                    @click="editCash"
                >
                    Guardar
                </DangerButton>
            </template>
        </ModalLarge>
    </AppLayout>
</template>
