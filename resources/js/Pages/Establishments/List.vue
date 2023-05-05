<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import { faTrashAlt, faPencilAlt, faTicketAlt, faTimes } from "@fortawesome/free-solid-svg-icons";
    import Pagination from '@/Components/Pagination.vue';
    import { ref } from 'vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import swal from 'sweetalert';
    import Keypad from '@/Components/Keypad.vue';

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

    const formDelete = useForm({});

    function destroy(id) {
        if (confirm("¿Estás seguro de que quieres eliminar?")) {
            formDelete.delete(route('users.destroy', id));
        }
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
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tiendas
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="col-span-6 p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="grid grid-cols-2 gap-4 justify-items-stretch">
                        <div class="col-span-1 sm:col-span-1">
                            <form @submit.prevent="form.get(route('establishments.index'))">
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <input v-model="form.search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar venta por fecha">
                                </div>
                            </form>
                        </div>
                        <div class="col-span-2 sm:col-span-1 justify-self-end">
                            <Keypad>
                                <template #botones>
                                    <a :href="route('establishments.create')" class="inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Nuevo</a>
                                </template>
                            </Keypad>
                            
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-2 mt-2">
                        <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                            <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
                                <tr>
                                    <th scope="col" class="px-6 py-2">
                                        Acciones
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        Fecha
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        Dirección
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        Teléfono
                                    </th>
                                    <th scope="col" class="px-6 py-2">
                                        Vendedor
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(local, index) in locals.data" :key="index" class="bg-blue-600 border-b border-blue-400 hover:bg-blue-500">
                                    <td class="text-center px-6 py-4">
                                        <a data-bs-toggle="tooltip" title="Editar" :href="route('establishments.edit', local.id)" class="mr-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <font-awesome-icon :icon="faPencilAlt" />
                                        </a>
                                        <button @click="openModalSeries(local)" data-bs-toggle="tooltip" title="Series" type="button" class="mr-1 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                            <font-awesome-icon :icon="faTicketAlt" />
                                        </button>
                                        <button data-bs-toggle="tooltip" title="Eliminar" type="button" class="mr-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                            @click="destroy(local.id)"
                                            >
                                            <font-awesome-icon :icon="faTrashAlt" />
                                        </button>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ local.created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ local.description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ local.address }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ local.phone }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ local.user_name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <Pagination :data="locals" />
                </div>
            </div>
        </div>
        <DialogModal :show="showModalSeries" @close="closeModalSeries">
            <template #title>
                Series {{ formSeries.local_name }}
            </template>

            <template #content>
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-4 sm:col-span-2">
                        <InputLabel value="Tipo de Documento" />
                        <select v-model="formSeries.document_type_id" id="stablishment" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                <div>
                    <table class="mt-2 w-full border-separate border-spacing-2 border border-slate-400 ...">
                        <thead>
                            <tr class="bg-green-700 text-white">
                                <th class="border border-slate-300 p-2">Accion</th>
                                <th class="border border-slate-300 p-2">Tipo</th>
                                <th class="border border-slate-300 p-2">Serie</th>
                                <th class="border border-slate-300 p-2">Número</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(serie, index) in formSeries.series">
                                <td class="text-center">
                                    <button data-bs-toggle="tooltip" title="Eliminar" type="button" class="mr-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                        @click="destroySerie(serie.id)"
                                        >
                                        <font-awesome-icon :icon="faTimes" />
                                    </button>
                                </td>
                                <td class="text-left border border-slate-300 p-2">{{ serie.type_name }}</td>
                                <td class="text-center border border-slate-300 p-2">{{ serie.description }}</td>
                                <td class="text-right border border-slate-300 p-2">{{ serie.number }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModalSeries">
                    Cancel
                </SecondaryButton>

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