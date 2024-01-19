<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import Keypad from '@/Components/Keypad.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { Badge } from 'flowbite-vue'
    import Swal2 from "sweetalert2";
    import { Link, router } from '@inertiajs/vue3';
    import { faPencilAlt, faCheck, faTrashAlt } from "@fortawesome/free-solid-svg-icons";

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

    const destroyTestimony = (id) => {
        Swal2.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminar!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return axios.delete(route('cms_testimonies_destroy', id)).then((res) => {
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
                    text: 'Se Eliminó correctamente',
                    icon: 'success',
                });
                router.visit(route('cms_testimonies_list'), { replace: true, method: 'get' });
            }
        });
    }

</script>

<template>
    <AppLayout title="Lista de Ventas">
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">CMS</span>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Testimonios</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- ====== Table One Start -->
                <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="w-full p-4 border-b border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700">
                        <form id="form-search-items" @submit.prevent="form.get(route('res_sales_list'))">
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
                                    <input v-model="form.date_start" type="date" pattern="\d{4}-\d{2}-\d{2}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="col-span-6 sm:col-span-1">
                                    <input v-model="form.date_end" type="date" pattern="\d{4}-\d{2}-\d{2}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                        </form>

                        <div class="mt-4">
                            <Keypad>
                                <template #botones>
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
                                            <Link v-can="'cms_testimonios_editar'" :href="route('res_sales_edit',sale.id)" class="mr-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <font-awesome-icon :icon="faPencilAlt" />
                                            </Link>
                                            <button v-can="'cms_testimonios_eliminar'" @click="destroyTestimony(sale.id)" type="button" class="mr-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                <font-awesome-icon :icon="faTrashAlt" />
                                            </button>
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
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <td colspan="3" class="p-2 text-center">
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
        
    </AppLayout>
</template>
