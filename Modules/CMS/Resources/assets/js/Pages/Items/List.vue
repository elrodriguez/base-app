<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import '@/Components/vristo/datatables/datatables.css'
import '@/Components/vristo/datatables/style.css'

DataTable.use(DataTablesCore);

    import { useForm } from '@inertiajs/vue3';
    import Keypad from '@/Components/Keypad.vue';
    import Pagination from '@/Components/Pagination.vue';

    import Swal2 from "sweetalert2";
    import { Link, router } from '@inertiajs/vue3';
    import { faPencil, faCheck, faTrash } from "@fortawesome/free-solid-svg-icons";

    const props = defineProps({
        types: {
            type: Object,
            default: () => ({}),
        },
    });


    const destroyItem = (id) => {
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
                return axios.delete(route('cms_items_destroy', id)).then((res) => {
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
                router.visit(route('cms_items_list'), { replace: true, method: 'get' });
            }
        });
    }

    const columns = [
        {
            data: null,
            render: '#action',
            title: 'Action'
        },
        { data: 'description', title: 'Descripción' },
        { data: 'content', title: 'Contenido' },
    ];

</script>

<template>
    <AppLayout title="Items">
        <Navigation :routeModule="route('cms_dashboard')" :titleModule="'CMS'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Items</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl">Items</h2>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link v-can="'cms_items'" :href="route('cms_items_create')" type="button" class="btn btn-primary">
                                <icon-plus class="ltr:mr-2 rtl:ml-2" />
                                Nuevo
                            </Link>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel pb-1.5 mt-6">
                <DataTable :ajax="route('cms_items_data')" :columns="columns">
                    <template #action="props">
                        <div class="flex gap-1 items-center justify-center">
                            <Link v-tippy:bottom :href="route('cms_items_edit',props.rowData.id)" type="button" class="btn btn-sm btn-outline-primary">
                                <font-awesome-icon  :icon="faPencil" class="m-0" />
                            </Link>
                            <tippy target="bottom" placement="bottom">Editar</tippy>
                            <button v-tippy:bottom type="button" class="btn btn-sm btn-outline-danger" @click="destroyItem(props.rowData.id)">
                                <font-awesome-icon :icon="faTrash" />
                            </button>
                            <tippy target="bottom" placement="bottom">Eliminar</tippy>
                        </div>
                    </template>
                </DataTable>
            </div>
            
        </div>
        
    </AppLayout>
</template>
