<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { useForm, Link, router } from '@inertiajs/vue3';
    import { faTrashAlt, faPencilAlt, faTicketAlt, faTimes } from "@fortawesome/free-solid-svg-icons";
    import Pagination from '@/Components/Pagination.vue';
    import { ref } from 'vue';
    import DialogModal from '@/Components/ModalLarge.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import swal from 'sweetalert';
    import Swal2 from 'sweetalert2';
    import Keypad from '@/Components/Keypad.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';

    const props = defineProps({
        locals: {
            type: Object,
            default: () => ({}),
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
        document_types: {
            type: Object,
            default: () => ({}),
        }
    });

    const form = useForm({
        search: props.filters.search,
    });

    const destroyEstablishment = (id) => {
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
                return axios.delete(route('establishment_destroies', id)).then((res) => {
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
                router.visit(route('establishments.index'), { replace: true, method: 'get' });
            }
        });
    }

    const showModalSeries = ref(false);

    const formSeries = useForm({
        local_name: '',
        document_type_id: '',
        description: '',
        number: '',
        local_id: '',
        series: []
    });

    const openModalSeries = async (local) => {
        axios.post(route('localseriesbyid',local)).then((res) => {
            formSeries.series = res.data;
        });

        formSeries.local_id = local.id;
        formSeries.local_name = local.description;
        showModalSeries.value = true;
    }

    const closeModalSeries = () => {
        showModalSeries.value = false;
    }

    const saveSeriesLocal = () => {
        formSeries.post(route('series.store'), {
            errorBag: 'saveSeriesLocal',
            preserveScroll: true,
            onSuccess: () => {
                formSeries.document_type_id = null;
                formSeries.description = null;
                formSeries.number = null;
                showModalSeries.value = false;
                swal('Serie creada con éxito');
            }
        });
    }

    const formDeleteSerie = useForm({});

    const destroySerie = (id) => {
        swal({
            title: "¿Estas seguro?",
            text: "¿Estás seguro de que quieres eliminar?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                formDeleteSerie.delete(route('series.destroy', id),{
                    onSuccess: () => {
                        showModalSeries.value = false;
                        swal('Serie eliminada con éxito');
                    }
                });
            }
        });
    }
</script>
<template>
    <AppLayout title="Tiendas">
        <Navigation :routeModule="route('sales_dashboard')" :titleModule="'Ventas'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Administracion</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Centros de distribución</span>
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
                                <form id="form-search-items" @submit.prevent="form.get(route('establishments.index'))">
                                    <label for="table-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <input v-model="form.search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por Descripción">
                                    </div>
                                </form>
                            </div>
                            <div class="col-span-3 sm:col-span-2">
                                <Keypad>
                                    <template #botones>
                                        <Link v-can="'sale_tienda_nuevo'" :href="route('establishments.create')" class="flex items-center justify-center inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            Nuevo
                                        </Link>
                                    </template>
                                </Keypad>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        Acciones
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th >
                                        Dirección
                                    </th>
                                    <th >
                                        Teléfono
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(local, index) in locals.data" :key="index">
                                    <td class="text-center">
                                        <div class="flex gap-4 items-center justify-center">
                                            <Link v-can="'sale_tienda_editar'" data-bs-toggle="tooltip" title="Editar" :href="route('establishments.edit', local.id)" class="btn btn-sm btn-outline-primary">
                                                <font-awesome-icon :icon="faPencilAlt" />
                                            </Link>
                                            <button v-can="'sale_tienda_series'" @click="openModalSeries(local)" data-bs-toggle="tooltip" title="Series" type="button" class="btn btn-sm btn-outline-success">
                                                <font-awesome-icon :icon="faTicketAlt" />
                                            </button>
                                            <button v-can="'sale_tienda_eliminar'" data-bs-toggle="tooltip" title="Eliminar" type="button" class="btn btn-sm btn-outline-danger"
                                                @click="destroyEstablishment(local.id)"
                                                >
                                                <font-awesome-icon :icon="faTrashAlt" />
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        {{ local.description }}
                                    </td>
                                    <td>
                                        {{ local.address }}
                                    </td>
                                    <td>
                                        {{ local.phone }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :data="locals" />
                </div>
            </div>
        </div>

        <DialogModal :show="showModalSeries" :onClose="closeModalSeries">
            <template #title>
                Series {{ formSeries.local_name }}
            </template>

            <template #content>
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-4 sm:col-span-2">
                        <InputLabel value="Tipo de Documento" />
                        <select v-model="formSeries.document_type_id" id="stablishment" class="form-select text-white-dark">
                            <option value="">Seleccionar</option>
                            <template v-for="(document_type, index) in props.document_types" :key="index">
                                <option :value="document_type.id">{{ document_type.description }}</option>
                            </template>
                        </select>
                        <InputError :message="formSeries.errors.document_type_id" class="mt-2" />
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <InputLabel value="Serie" />
                        <TextInput
                            ref="serie"
                            v-model="formSeries.description"
                            type="text"
                            class="block w-full mt-1"
                        />
                        <InputError :message="formSeries.errors.description" class="mt-2" />
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <InputLabel value="Número" />
                        <TextInput
                            ref="number"
                            v-model="formSeries.number"
                            type="text"
                            class="block w-full mt-1"
                        />
                        <InputError :message="formSeries.errors.number" class="mt-2" />
                    </div>
                </div>
                <div class="mt-5 table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">Accion</th>
                                <th>Tipo</th>
                                <th class="text-center">Serie</th>
                                <th class="text-center">Número</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(serie, index) in formSeries.series">
                                <td class="text-center">
                                    <div class="flex gap-4 items-center justify-center">
                                        <button data-bs-toggle="tooltip" title="Eliminar" type="button" class="btn btn-sm btn-outline-danger"
                                            @click="destroySerie(serie.id)"
                                            >
                                            <font-awesome-icon :icon="faTimes" />
                                        </button>
                                    </div>
                                </td>
                                <td >{{ serie.type_name }}</td>
                                <td >{{ serie.description }}</td>
                                <td class="text-center">{{ serie.number }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>

            <template #buttons>

                <DangerButton
                    class="ml-3"
                    :class="{ 'opacity-25': formSeries.processing }"
                    :disabled="formSeries.processing"
                    @click="saveSeriesLocal()"
                >
                    Guardar
                </DangerButton>
            </template>
        </DialogModal>
    </AppLayout>
</template>