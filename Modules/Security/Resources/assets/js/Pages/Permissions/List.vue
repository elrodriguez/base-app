<script setup>
import { useForm, Link } from "@inertiajs/vue3"
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { faTrashAlt, faPencilAlt } from "@fortawesome/free-solid-svg-icons";
import Keypad from '@/Components/Keypad.vue';
import swal from "sweetalert";
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import '@/Components/vristo/datatables/datatables.css'
import '@/Components/vristo/datatables/style.css'
import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
import { faPencil, faCheck, faTrash } from "@fortawesome/free-solid-svg-icons";
import es_PE from '@/Components/vristo/datatables/datatables-es.js'

DataTable.use(DataTablesCore);

    const props = defineProps({
        permissions: {
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

    const destroyPermission = (id) => {
        swal({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                formDelete.delete(route("permissions.destroy", id),{
                    onSuccess: () => {
                        swal('Permiso eliminado con éxito');
                    }
                });
            }
        });
    }

    const columns = [
        {
            data: null,
            render: '#action',
            title: 'Acciones'
        },
        { data: 'name', title: 'Nombre' }
    ];

    const options = { language: es_PE }
</script>

<template>
    <AppLayout title="Permisos">
        <Navigation >
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Configuraciones</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Permisos</span>
            </li>
        </Navigation>
        <div class="mt-5">

            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl">Permisos</h2>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link v-can="'cms_items'" :href="route('permissions.create')" type="button" class="btn btn-primary">
                                <icon-plus class="ltr:mr-2 rtl:ml-2" />
                                Nuevo
                            </Link>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel pb-1.5 mt-6">
                <DataTable :options="options" :ajax="route('security_permissions_data')" :columns="columns">
                    <template #action="props">
                        <div class="flex gap-1 items-center justify-center">
                            <Link v-tippy:bottom :href="route('permissions.edit',props.rowData.id)" type="button" class="btn btn-sm btn-outline-primary">
                                <font-awesome-icon  :icon="faPencil" class="m-0" />
                            </Link>
                            <tippy target="bottom" placement="bottom">Editar</tippy>
                            <button v-tippy:bottom type="button" class="btn btn-sm btn-outline-danger" @click="destroyPermission(props.rowData.id)">
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