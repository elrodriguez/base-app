<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { ref, onMounted } from 'vue';
    
    import Swal2 from 'sweetalert2';
    import { faPencil, faTrash } from "@fortawesome/free-solid-svg-icons";
    import IconUserPlus from '@/Components/vristo/icon/icon-user-plus.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';
    import { useForm, Link, router } from '@inertiajs/vue3';

    const props = defineProps({
        institutions: {
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

    const destroyInstitution = (id) => {
        const swalConfirm = Swal2.mixin({
            customClass: {
                popup: "sweet-alerts",
                confirmButton: "btn btn-secondary",
                cancelButton: "btn btn-dark ltr:mr-3 rtl:ml-3",
            },
            buttonsStyling: false,
        });
        swalConfirm.fire({
            title: "¿Estas seguro?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, Eliminar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            reverseButtons: true,
            padding: "2em",
            preConfirm: () => {
                return axios.delete(route("aca_institutions_destroy",id)).then((res) => {
                    if (!res.data.success) {
                        Swal2.showValidationMessage(res.data.message);
                    }
                    return res;
                });
            },
            allowOutsideClick: () => !Swal2.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                showMessage("Se Eliminó correctamente.");
                router.visit(route("aca_institutions_list"), {
                    replace: true,
                    method: "get",
                    preserveState: true,
                    preserveScroll: true,
                });
            }
        });
    };

    const showMessage = (msg = "", type = "success") => {
        const toast = Swal2.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            customClass: { container: "toast" },
        });
        toast.fire({
            icon: type,
            title: msg,
            padding: "10px 20px",
        });
    };

    const baseUrl = assetUrl;

    const getImage = (path) => {
        return baseUrl + 'storage/'+ path;
    }

</script>

<template>
    <AppLayout title="Institución">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Institución</span>
            </li>
        </ul>
        <div class="pt-5">
            
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl">Institución</h2>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link :href="route('aca_institutions_create')" type="button" class="btn btn-primary">
                                <icon-user-plus class="ltr:mr-2 rtl:ml-2" />
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
                            @keyup.enter="form.get(route('aca_institutions_list'))"
                        />
                        <div class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">
                            <icon-search class="mx-auto" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 panel p-0 border-0 overflow-hidden">
                <div class="table-responsive">
                    <table class="table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="!text-center">
                                    Acciones
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Dirección
                                </th>
                                <th>
                                    Teléfono
                                </th>
                                <th>
                                    Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="contact in institutions.data" :key="contact.id">
                                <tr>
                                    <td>
                                        <div class="flex gap-1 items-center justify-center">
                                            <Link v-tippy:bottom :href="route('aca_institutions_edit',contact.id)" type="button" class="btn btn-sm btn-outline-primary">
                                                <font-awesome-icon  :icon="faPencil" class="m-0" />
                                            </Link>
                                            <tippy target="bottom" placement="bottom">Editar</tippy>
                                            <button v-tippy:bottom type="button" class="btn btn-sm btn-outline-danger" @click="destroyInstitution(contact.id)">
                                                <font-awesome-icon :icon="faTrash" />
                                            </button>
                                            <tippy target="bottom" placement="bottom">Eliminar</tippy>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center w-max">
                                            <div class="w-max">
                                                <img v-if="contact.image"
                                                    :src="getImage(contact.image)"
                                                    class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"
                                                    alt="avatar"
                                                />
                                                <img v-else :src="'https://ui-avatars.com/api/?name='+contact.name+'&size=54&rounded=true'" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2" :alt="contact.full_name"/>
                                            </div>
                                            <div>{{ contact.name }}</div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap">{{ contact.address }}</td>
                                    <td class="whitespace-nowrap">{{ contact.phone }}</td>
                                    <td class="whitespace-nowrap text-center">
                                        <div class="" >
                                            <template v-if="contact.status">
                                                <span class="badge bg-success">Activo</span>
                                            </template> 
                                            <template v-else>
                                                <span class="badge bg-danger">Inactivo</span>
                                            </template> 
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            
            </div>
        
        </div>
    </AppLayout>
</template>