<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import Keypad from '@/Components/Keypad.vue';
    import Pagination from '@/Components/Pagination.vue';
    import ModalLarge from '@/Components/ModalLarge.vue';
    import Swal2 from "sweetalert2";
    import { Link, router } from '@inertiajs/vue3';
    import { faMagnifyingGlass, faRotate } from "@fortawesome/free-solid-svg-icons";
    import { ref } from "vue";
    import Navigation from '@/Components/vristo/layout/Navigation.vue';

    const props = defineProps({
        sales: {
            type: Object,
            default: () => ({}),
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
    });

    const form = useForm({
        search: props.filters.search,
    });
    const displayModalDetails = ref(false);
    const saleDetails = ref(null);
    const openModalDetails = (data) => {
        saleDetails.value = data;
        displayModalDetails.value = true;
    }
    const closeModalDetails = () => {
        displayModalDetails.value = false;
    }
</script>

<template>
    <AppLayout title="Resumen">
        <Navigation :routeModule="route('onlineshop_dashboard')" :titleModule="'Ventas en línea'">
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>Pedidos</span>
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
                                <form id="form-search-items" @submit.prevent="form.get(route('cms_items_list'))">
                                    <label for="table-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <input v-model="form.search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por Descripción">
                                    </div>
                                </form>
                            </div>
                            <div class="col-span-3 sm:col-span-2">
                                <Keypad>
                                    <template #botones>
                                        <Link v-can="'cms_items'" :href="route('onlineshop_items_create')" class="flex items-center justify-center inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Nuevo
                                        </Link>
                                    </template>
                                </Keypad>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="w-full table-auto">
                            <thead >
                                <tr >
                                    <th >
                                        Acciones
                                    </th>
                                    <th >
                                        Nombre Completo
                                    </th>
                                    <th >
                                        Teléfono
                                    </th>
                                    <th >
                                        Email
                                    </th>
                                    <th >
                                        Total
                                    </th>
                                    <th >
                                        Estado
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(item, index) in sales.data" :key="item.id">
                                    <tr >
                                        <td class="text-center">
                                            <button @click="openModalDetails(item)" type="button" title="ver detalles" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <font-awesome-icon :icon="faMagnifyingGlass" />
                                            </button>
                                            <button @click="destroyItem(item.id)" type="button" title="Consultar a mercado pago" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                                <font-awesome-icon :icon="faRotate" />
                                            </button>
                                        </td>
                                        <td >
                                            {{ item.clie_full_name }}
                                        </td>
                                        <td >
                                            {{ item.person.telephone }}
                                        </td>
                                        <td >
                                            {{ item.email }}
                                        </td>
                                        <td >
                                            {{ item.total }}
                                        </td>
                                        <td class="text-center">
                                           <span v-if="item.response_status == 'pendiente'"  class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">No completó el pago</span>
                                           <span v-else-if="item.response_status == 'approved'" class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Pago aprobado</span>
                                           <span v-else class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Error en la transacción</span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :data="sales" />
                </div>
            </div>
        </div>
        <ModalLarge 
            :show="displayModalDetails"
            :onClose="closeModalDetails"
            :icon="'/img/lupa-documento.png'"
        >
            <template v-if="saleDetails" #title>
                VEN-{{ saleDetails.id }}
            </template>
            <template #message>
                Detalles de la venta
            </template>
            <template #content>
                <div  v-if="saleDetails" class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Producto o servicio
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Precio
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, key) in saleDetails.details" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ row.item.name }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{ row.item.price }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </ModalLarge>
       
    </AppLayout>
</template>
