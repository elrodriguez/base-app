<script setup>
    import { useForm, Link, router } from "@inertiajs/vue3"
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { faTrashAlt, faPencilAlt } from "@fortawesome/free-solid-svg-icons";
    import Keypad from '@/Components/Keypad.vue';
    import Swal2 from "sweetalert2";
    import Navigation from '@/Components/vristo/layout/Navigation.vue';

    import { 
      ConfigProvider, Image,
      Tooltip
    } from 'ant-design-vue';
    import esES from 'ant-design-vue/es/locale/es_ES';
    
    const props = defineProps({
        categories: {
            type: Object,
            default: () => ({})
        },
        filters: {
            type: Object,
            default: () => ({})
        }
    });

    const form = useForm({
        search: props.filters.search,
    });

    const formDelete = useForm({})

    const destroyCategory = (id) => {
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
            padding: '2em',
            customClass: 'sweet-alerts',
            preConfirm: () => {
                return axios.delete(route('sale_category_product_destroy', id)).then((res) => {
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
                    padding: '2em',
                    customClass: 'sweet-alerts',
                });
                router.visit(route('sale_category_product_list'), { 
                  replace: false,
                  preserveState: true,
                  preserveScroll: true,
                  method: 'get' 
                });
            }
        });
    }
    const aurl = assetUrl;
</script>

<template>
    <AppLayout title="Categorías">
        <ConfigProvider :locale="esES">
            <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>Categorías</span>
                </li>
            </Navigation>
            <div class="mt-5">
                
                
                <!-- ====== Table Section Start -->
                <div class="flex flex-col gap-10">
                    <!-- ====== Table One Start -->
                    <div class="panel p-0">
                        <div class="w-full p-4" >
                            <div class="grid grid-cols-3">
                                <div class="col-span-3 sm:col-span-1">
                                    <form id="form-search-items" @submit.prevent="form.get(route('onlineshop_items'))">
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
                                            <Link v-can="'sale_categorias_nuevo'" :href="route('sale_category_product_create')" class="flex items-center justify-center inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                Nuevo
                                            </Link>
                                        </template>
                                    </Keypad>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table >
                                <thead >
                                    <tr>
                                        <th class="text-center">
                                            Acciones
                                        </th>
                                        <th class="text-center">
                                            Imagen Principal
                                        </th>
                                        <th>
                                            Descripción
                                        </th>
                                        <th class="text-center">
                                            Estado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(item, index) in categories.data" :key="item.id">
                                        <tr >
                                            <td>
                                                <div class="flex gap-4 items-center justify-center">
                                                    <Link v-can="'sale_categorias_editar'" :href="route('sale_category_product_edit',item.id)" class="btn btn-sm btn-outline-primary">
                                                        <font-awesome-icon :icon="faPencilAlt" />
                                                    </Link>
                                                                    
                                                    <button v-can="'sale_categorias_eliminar'" @click="destroyCategory(item.id)" type="button" class="btn btn-sm btn-outline-danger">
                                                        <font-awesome-icon :icon="faTrashAlt" />
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <Image v-if="item.image" :src="aurl+'storage/'+item.image" :alt="item.name" style="width: 70px;" />
                                            </td>
                                            <td >
                                                <span v-if="item.category && item.category.category">{{ item.category.category.description  }} / </span><span v-if="item.category">{{ item.category.description  }} / </span><span>{{ item.description }}</span>
                                                
                                            </td>
                                            <td class="text-center">
                                                <span v-if="item.status" class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Activo</span>
                                                <span v-else class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Inactivo</span>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :data="categories" />
                    </div>
                </div>
            </div>
        </ConfigProvider>
    </AppLayout>
</template>