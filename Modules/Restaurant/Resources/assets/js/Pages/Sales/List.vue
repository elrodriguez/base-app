<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import Keypad from '@/Components/Keypad.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { Badge } from 'flowbite-vue'
    import Swal2 from "sweetalert2";
    import { Link, router } from '@inertiajs/vue3';
    import { faGears } from "@fortawesome/free-solid-svg-icons";
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import esES from 'ant-design-vue/es/locale/es_ES';
    import { 
      ConfigProvider, Dropdown, Menu, MenuItem, Button, Select, Image,
      SubMenu
    } from 'ant-design-vue';

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
        date_start: props.filters.date_start,
        date_end: props.filters.date_end,
        queue_status: props.filters.queue_status ?? '00'
    });


    const destroySale = (id) => {
        Swal2.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Anular!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return axios.delete(route('res_sales_destroy', id)).then((res) => {
                    if (!res.data.success) {
                        Swal2.showValidationMessage(res.data.message)
                    }
                    return res
                });
            },
            allowOutsideClick: () => !Swal2.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal2.fire({
                    title: 'Enhorabuena',
                    text: 'La venta fue anulada',
                    icon: 'success',
                });
                router.visit(route('res_sales_list'), { replace: true, method: 'get' });
            }
        });
    }

</script>

<template>
    <AppLayout title="Lista de Ventas">
        <ConfigProvider :locale="esES">
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Restaurante</span>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Ventas</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <!-- ====== Table Section Start -->
                <div class="flex flex-col gap-10">
                    <!-- ====== Table One Start -->
                    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                        <div class="w-full p-4 border-b border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700">
                            <div id="form-search-items">
                                <div class="grid grid-cols-6 gap-4">
                                    <div class="col-span-6 sm:col-span-3">
                                        <input v-model="form.search" type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por cliente">
                                    </div>
                                    <div class="col-span-6 sm:col-span-1">
                                        <select v-model="form.queue_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="00">TODOS</option>
                                            <option value="01">Pendiente</option>
                                            <option value="02">Atendido</option>
                                            <option value="03">Por cobrar</option>
                                            <option value="04">Pagado</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-1">
                                        <input v-model="form.date_start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-1">
                                        <input v-model="form.date_end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <div class="sm:flex md:flex justify-between items-center mt-4">
                                <Link :href="route('res_sales_cuisine')" class="uppercase text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Vista cocina</Link>
                                <Keypad>
                                    <template #botones>
                                        
                                        <PrimaryButton @click="form.get(route('res_sales_list'))" class="mr-2 mb-2 sm:mb-0">BUSCAR</PrimaryButton>
                                        <Link v-can="'cms_testimonios_nuevo'" :href="route('res_sales_create')" class="flex items-center justify-center inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Nuevo
                                        </Link>
                                    </template>
                                </Keypad>
                            </div>

                        </div>
                        <div class="max-w-full overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead class="border-b border-stroke dark:border-strokedark">
                                    <tr class="bg-gray-50 text-left dark:bg-meta-4">
                                        <th  class="py-2 px-4 text-center font-medium text-black dark:text-white">
                                            Acciones
                                        </th>
                                        <th class="py-2 px-4 font-medium text-black dark:text-white">
                                            Fecha
                                        </th>
                                        <th class="py-2 px-4 font-medium text-black dark:text-white">
                                            Código
                                        </th>
                                        <th class="py-2 px-4 font-medium text-black dark:text-white">
                                            Cliente
                                        </th>
                                        <th class="py-2 px-4 font-medium text-black dark:text-white">
                                            Total
                                        </th>
                                        <th class="py-2 px-4 font-medium text-black dark:text-white">
                                            Estado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="sales.data.length > 0">
                                        <tr v-for="(sale, index) in sales.data" :key="sale.id" class="border-b border-stroke dark:border-strokedark">
                                            <td class="text-center py-2 dark:border-strokedark">
                                                <Dropdown :placement="'bottomLeft'" arrow>
                                                    <button class="border py-1.5 px-2 dropdown-button inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm" type="button" @click="toggle">
                                                        <font-awesome-icon :icon="faGears" />
                                                    </button>
                                                    <template #overlay>
                                                        <Menu >
                                                        <MenuItem>
                                                            <Link v-permission="'res_venta_editar'" :href="route('res_sales_edit',sale.id)" >
                                                                Editar
                                                            </Link>
                                                        </MenuItem>
                                                        <SubMenu :key="'sub'+index">
                                                            <template #title>
                                                                Crear documento venta
                                                            </template>
                                                            <MenuItem>
                                                                <Link :href="route('res_sales_document_boleta',sale.id)" type="Link">
                                                                    Boleta
                                                                </Link>
                                                            </MenuItem>
                                                            <MenuItem>
                                                                <Link type="Link" >
                                                                    Factura
                                                                </Link>
                                                            </MenuItem>
                                                        </SubMenu>
                                                        <MenuItem v-permission="'res_venta_eliminar'" @click="destroySale(sale.id)" class="text-red-700">
                                                            Eliminar
                                                        </MenuItem>
                                                        </Menu>
                                                    </template>
                                                </Dropdown>
                                            </td>
                                            <td class="py-2 px-2 dark:border-strokedark">
                                                {{ sale.sale_date }}
                                            </td>
                                            <td class="py-2 px-2 dark:border-strokedark">
                                                {{ sale.correlative }}
                                            </td>
                                            <td class="py-2 px-2 dark:border-strokedark">
                                                {{ sale.full_name }}
                                            </td>
                                            <td class="text-right py-2 px-2 dark:border-strokedark">
                                                {{ sale.total }}
                                            </td>
                                            <td class="text-center py-2 px-2 dark:border-strokedark">
                                                <Badge v-if="sale.queue_status == '01'" type="red">Pendiente</Badge>
                                                <Badge v-else-if="sale.queue_status == '02'" type="yellow">Atendido</Badge>
                                                <Badge v-else-if="sale.queue_status == '03'" type="indigo">Cobrar</Badge>
                                                <Badge v-else-if="sale.queue_status == '04'" type="green">Pagado</Badge>
                                                <Badge v-else-if="sale.queue_status == '99'" type="dark">Anulado</Badge>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <td colspan="6" class="p-2 text-center">
                                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                                No existen registros para mostrar.
                                            </div>
                                        </td>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :data="sales" />
                    </div>
                </div>
            </div>
        </ConfigProvider>
    </AppLayout>
</template>
