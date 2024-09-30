<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { onMounted, ref,   } from 'vue';
    import Keypad from '@/Components/Keypad.vue';
    import Navigation from "@/Components/vristo/layout/Navigation.vue";
    import IconArrowLeft from "@/Components/vristo/icon/icon-arrow-left.vue";
    import { Link, useForm } from '@inertiajs/vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import Swal2 from "sweetalert2";

    const props = defineProps({
        permissions: {
            type: Object,
            default: () => ({})
        },
        hasPermissions: {
            type: Object,
            default: () => ({})
        },
        modulo: {
            type: Object,
            default: () => ({})
        }
    });

    const form = useForm({
        permissions: [],
        modulo: null
    });
    const itemsFree = ref([]);
    const itemsAdded = ref([]);

    onMounted(() => {
        itemsFree.value = props.permissions;
        itemsAdded.value = props.hasPermissions;
    });

    const addItems = (item, index) => {
        itemsFree.value.splice(index,1);
        itemsAdded.value.push(item)
    }

    const removeItems = (item, index) => {
        itemsAdded.value.splice(index,1);
        itemsFree.value.push(item)
    }

    const savePermissionsModulo = () => {
        form.permissions = itemsAdded.value;
        form.modulo = props.modulo.identifier;

        form.post(route('modulos_permissions_store'), {
            errorBag: 'savePermissionsModulo',
            preserveScroll: true,
            onSuccess: () => {
                Swal2.fire({
                    title: 'Enhorabuena',
                    text: 'Se registro correctamente',
                    icon: 'success',
                    padding: '2em',
                    customClass: 'sweet-alerts',
                });
            }
        });
    }
    
</script>

<template>
    <AppLayout title="Crear Cliente">
        <Navigation :routeModule="route('security_dashboard')" :titleModule="'Configuraciones'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('modulos.index')" class="text-primary hover:underline">Modulos</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('modulos.edit',modulo.identifier)" class="text-primary hover:underline">{{ modulo.description }}</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Permisos</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="panel">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12">
                    <div>
                        <div class="font-semibold text-lg mb-5">Permisos Libres</div>
                        <div style="height: 400px;" class="flex flex-col rounded-md border border-[#e0e6ed] dark:border-[#1b2e4b]">
                            <perfect-scrollbar
                                :options="{
                                    swipeEasing: true,
                                    wheelPropagation: false,
                                }"
                                class="relative ltr:pr-3.5 rtl:pl-3.5 ltr:-mr-3.5 rtl:-ml-3.5 h-full grow"
                            >
                                <template v-if="itemsFree.length > 0">
                                    <template v-for="(item, index) in itemsFree">
                                        <div class="flex items-center justify-between space-x-4 rtl:space-x-reverse border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                            <div>{{ item.name }} </div>
                                            <button type="button" class="btn btn-sm btn-outline-primary" @click="addItems(item, index)">
                                                <icon-arrow-left />
                                            </button>
                                        </div>
                                    </template>
                                </template>
                            </perfect-scrollbar>
                        </div>
                        
                    </div>
                    <div>
                        <div class="font-semibold text-lg mb-5">Permisos Agregados</div>
                        <div style="height: 400px;" class="flex flex-col rounded-md border border-[#e0e6ed] dark:border-[#1b2e4b]">
                            <perfect-scrollbar
                                :options="{
                                    swipeEasing: true,
                                    wheelPropagation: false,
                                }"
                                class="relative ltr:pr-3.5 rtl:pl-3.5 ltr:-mr-3.5 rtl:-ml-3.5 h-full grow"
                            >
                                <template v-if="itemsAdded.length > 0">
                                    <template v-for="(item, index) in itemsAdded">
                                        <div class="flex items-center justify-between space-x-4 rtl:space-x-reverse border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                            <button type="button" class="btn btn-sm btn-outline-primary" @click="removeItems(item, index)">
                                                <icon-arrow-left class="transform" style="rotate: 180deg;"  />
                                            </button>
                                            <div>{{ item.name }} </div>
                                        </div>
                                    </template>
                                </template>
                            </perfect-scrollbar>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md dark:bg-gray-900">
                    <Keypad>
                        <template #botones>
                            <PrimaryButton @click="savePermissionsModulo" type="button":class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <svg v-show="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                </svg>
                                Guardar
                            </PrimaryButton>
                            <Link :href="route('modulos.index')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                        </template>
                    </Keypad>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
