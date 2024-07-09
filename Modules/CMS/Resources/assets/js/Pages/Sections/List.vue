<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import Keypad from '@/Components/Keypad.vue';
    import Pagination from '@/Components/Pagination.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import Swal2 from "sweetalert2";
    import { Link, router } from '@inertiajs/vue3';
    import { faPencilAlt, faObjectGroup, faTrashAlt, faPlus } from "@fortawesome/free-solid-svg-icons";

    const props = defineProps({
        sections: {
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

    const destroySection = (id) => {
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
                return axios.delete(route('cms_section_destroy', id)).then((res) => {
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
                router.visit(route('cms_section_list'), { replace: true, method: 'get' });
            }
        });
    }
    
</script>

<template>
    <AppLayout title="Resumen">
        <Navigation :routeModule="route('cms_dashboard')" :titleModule="'CMS'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Secciones</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl">Secciones</h2>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link v-can="'cms_items'" :href="route('cms_section_create')" type="button" class="btn btn-primary">
                                <icon-plus class="ltr:mr-2 rtl:ml-2" />
                                Nuevo
                            </Link>
                        </div>

                    </div>
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Buscar"
                            class="form-input py-2 ltr:pr-11 rtl:pl-11 peer"
                            v-model="form.search" 
                            @keyup="form.get(route('cms_section_list'))"
                        />
                        <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                            <icon-search class="mx-auto" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 panel p-0 border-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr >
                                <th class="text-center">
                                    Acciones
                                </th>
                                <th>
                                    Descripción/Nombre
                                </th>
                                <th>
                                    Component_id
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(item, index) in sections.data" :key="item.id">
                                <tr>
                                    <td>
                                        <div class="flex gap-4 items-center justify-center">
                                            <Link v-can="'cms_seccion_editar'" :href="route('cms_section_edit',item.id)" class="btn btn-sm btn-outline-primary">
                                                <font-awesome-icon :icon="faPencilAlt" />
                                            </Link>
                                            <Link v-can="'cms_seccion_items'" :href="route('cms_section_items',item.id)" class="btn btn-sm btn-outline-success" title="Agregar Items a esta sección">
                                                <font-awesome-icon :icon="faPlus" />
                                            </Link>
                                            <Link v-can="'cms_seccion_grupos'" :href="route('cms_section_group_items',item.id)" class="btn btn-sm btn-outline-warning" title="Crear Grupo de Items">
                                                <font-awesome-icon :icon="faObjectGroup" />
                                            </Link>
                                            <button v-can="'cms_seccion_eliminar'" @click="destroySection(item.id)" type="button" class="btn btn-sm btn-outline-danger">
                                                <font-awesome-icon :icon="faTrashAlt" />
                                            </button> 
                                        </div>                                           
                                    </td>
                                    <td class="whitespace-nowrap">
                                        {{ item.description }}
                                    </td>
                                    <td class="whitespace-nowrap">
                                        {{ item.component_id }}
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <Pagination :data="sections" />
            </div>
        </div>
       
    </AppLayout>
</template>
