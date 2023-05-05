<script setup>
    import { useForm } from '@inertiajs/vue3';
    import ModalLarge from '@/Components/ModalLarge.vue';
    import { ref, watch } from 'vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';

    const props = defineProps({
        clientDefault: {
            type: Object,
            default: () => ({})
        },
        documentTypes: {
            type: Object,
            default: () => ({})
        }
    })

    const form = useForm({
        search: props.clientDefault.full_name,
        client: {
            id: props.clientDefault.id,
            full_name: props.clientDefault.full_name
        },
        clients: [],
        id: '',
        document_type: '',
        number: '',
        telephone: '',
        full_name: '',
        email: '',
        address: ''
    });
    
    const searchClient = () => {
        axios.post(route('search_person_fullname_number'), form).then((res) => {
            if (res.data.status) {
                form.clients = res.data.persons;
            } else {
                swal(res.data.alert);
            }

        });
    }

    const displayModalClient = ref(false);

    const openModalClient = () => {
        displayModalClient.value = true;
    }

    const closeModalClient = () => {
        displayModalClient.value = false;
    }

    const modalNewSearchClient = () => {
        axios.post(route('search_person_number'), form).then((res) => {
            if (res.data.status) {
                form.id = res.data.person.id;
                form.telephone = res.data.person.telephone;
                form.full_name = res.data.person.full_name;
                form.email = res.data.person.email;
                form.address = res.data.person.address;
            } else {
                form.errors.document_type = res.data.document_type;
                form.errors.number = res.data.number;
                swal(res.data.alert);
            }

        });
    }

    const emit = defineEmits(['clientId']);

    const saveNewSearchClient = () => {
        axios.post(route('save_person_update_create'), form).then((res) => {
            form.id = res.data.id;
            form.telephone = res.data.telephone;
            form.full_name = res.data.full_name;
            form.email = res.data.email;
            form.address = res.data.address;
            form.search = res.data.full_name;
            displayModalClient.value = false;
            emit('clientId', { id: form.id, full_name: form.full_name });
        });
    }

    const selectClient = (client) => {
        form.clients = [];
        form.search = client.full_name;
        emit('clientId', { id: client.id, full_name: client.full_name });
    }

    watch(() => props.clientDefault, (newValue) => {
        form.search = newValue.full_name
    });
</script>

<template>
    <div style="display: none;">
        <div>
            <form @submit.prevent="searchClient()">
                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input v-model="form.search" autocomplete="off" type="search" id="search"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar Cliente" required>
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </div>
            </form>
            <div id="result" style="position: absolute;width: 100%;z-index: 999999;">
                <div class="mt-1" style="max-height: 300px;overflow-y: auto;">
                    <table class="min-w-full">
                        <tbody>
                            <tr @click="selectClient(client)" v-for="(client, index) in form.clients"
                                class="border-b bg-gray-100 boder-gray-900" style="cursor: pointer;">
                                <td class="text-sm font-medium px-6 py-4 whitespace-nowrap">
                                    {{ client.number }} - {{ client.full_name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button @click="openModalClient()" type="button"
                class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded transition duration-150 ease-in-out">Nuevo
                (+)</button>
        </div>
        <div>
            <ModalLarge :show="displayModalClient" :onClose="closeModalClient">
                <template #title>
                    Cliente
                </template>
                <template #message>
                    Registrar nuevo o editar buscando por su numero de documento
                </template>
                <template #content>
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6 sm:col-span-2">
                            <InputLabel value="Tipo de Documento" class="mb-1" />
                            <select class="form-select appearance-none
                                    block
                                    w-full
                                    text-base
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding bg-no-repeat
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                v-model="form.document_type">
                                <option value="" selected>Seleccionar</option>
                                <template v-for="(documentType, index) in documentTypes">
                                    <option :value="documentType.id">{{ documentType.description }}</option>
                                </template>
                            </select>
                            <InputError :message="form.errors.document_type" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <InputLabel for="number" value="Número de Doc." />
                            <TextInput id="number" v-model="form.number" type="number" class="block w-full mt-1"
                                autofocus />
                            <InputError :message="form.errors.number" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <button @click="modalNewSearchClient()" type="button"
                                class="block w-full bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-6">Buscar
                                por Nro</button>
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <InputLabel for="telephone" value="Teléfono" />
                            <TextInput id="telephone" v-model="form.telephone" type="text" class="block w-full mt-1"
                                autofocus />
                            <InputError :message="form.errors.telephone" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel v-if="form.document_type == 6" for="full_name" value="Razón Social" />
                            <InputLabel v-else for="full_name" value="Nombres" />
                            <TextInput id="full_name" v-model="form.full_name" type="text" class="block w-full mt-1"
                                autofocus />
                            <InputError :message="form.errors.full_name" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" v-model="form.email" type="email" class="block w-full mt-1" autofocus />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <InputLabel for="address" value="Dirección" />
                            <TextInput id="address" v-model="form.address" type="text" class="block w-full mt-1"
                                autofocus />
                            <InputError :message="form.errors.address" class="mt-2" />
                        </div>

                    </div>
                </template>
                <template #buttons>
                    <PrimaryButton @click="saveNewSearchClient()" class="mr-2">
                        Guardar
                    </PrimaryButton>
                </template>
            </ModalLarge>
        </div>
    </div>
</template>
