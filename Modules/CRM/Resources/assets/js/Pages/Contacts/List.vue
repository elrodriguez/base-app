<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import IconChatDot from '@/Components/vristo/icon/icon-chat-dots.vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';
import '@/Components/vristo/datatables/datatables.css'
import '@/Components/vristo/datatables/style.css'
import Swal2 from "sweetalert2";
import { Link, router } from '@inertiajs/vue3';
import { faComments, faPerson, faPersonDress, faTrash } from "@fortawesome/free-solid-svg-icons";

DataTable.use(DataTablesCore);

const columns = [
    { data: null, render: '#action', title: 'Acción' },
    { data: null, render: '#perinformation', title: 'Nombre' },
    { data: 'number', title: 'Número Identificación' },
    { data: 'birthdate', title: 'Fecha nacimiento' },
    { data: 'telephone', title: 'Teléfono' },
    { data: 'email', title: 'Email' },
    { data: null, render: '#pergender', title: 'Sexo' },
];

const baseUrl = assetUrl;

const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}

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
                <!-- <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link v-can="'cms_items'" :href="route('cms_items_create')" type="button" class="btn btn-primary">
                                <icon-plus class="ltr:mr-2 rtl:ml-2" />
                                Nuevo
                            </Link>
                        </div>

                    </div>
                </div> -->
            </div>
            <div class="panel pb-1.5 mt-6">
                <DataTable :ajax="route('crm_contacts_list_data')" :columns="columns">
                    <template #action="props">
                        <div class="flex gap-1 items-center justify-center">

                            <button v-tippy:bottom type="button" class="btn btn-sm btn-outline-info" @click="destroyItem(props.rowData.id)">
                                <font-awesome-icon :icon="faComments" />
                            </button>
                            <tippy target="bottom" placement="bottom">Enviar Mensaje</tippy>
                        </div>
                    </template>
                    <template #perinformation="props">
                        <div class="flex items-center w-max hover:text-primary">
                            <div class="w-max">
                                <img v-if="props.rowData.image"
                                    :src="getImage(props.rowData.image)"
                                    class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"
                                    alt="AV"
                                />
                                <img v-else :src="'https://ui-avatars.com/api/?name='+props.rowData.full_name+'&size=54&rounded=true'" class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2" :alt="props.rowData.full_name"/>
                            </div>
                            <div>{{ props.rowData.full_name }}</div>
                        </div>
                    </template>
                    <template #pergender="props">
                        <div class="text-center" >
                            <template v-if="props.rowData.gender == 'M'">
                                <font-awesome-icon v-tippy:left :icon="faPerson" class="w-6 h-6 text-success" /> 
                                <tippy target="left" placement="left">Masculino</tippy>
                            </template> 
                            <template v-else>
                                <font-awesome-icon v-tippy:left :icon="faPersonDress" class="w-6 h-6 text-primary" /> 
                                <tippy target="left" placement="left">Femenino</tippy>
                            </template> 
                        </div>
                    </template>
                </DataTable>
            </div>
            
        </div>
        
    </AppLayout>
</template>
