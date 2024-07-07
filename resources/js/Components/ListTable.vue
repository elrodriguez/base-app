<script setup>

import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-responsive';

import './vristo/datatables/style.css'

DataTable.use(DataTablesCore);
 
const props = defineProps({
    columns: {
        type: Object,
        default: () => ({}),
    },
});

const options = {
    responsive: true,
    select: true,
};
</script>
 
<template>
    <div class="panel pb-1.5 mt-6">
        <DataTable :columns="columns" :options="options" :ajax="route('cms_items_data')" class="display">
            <template #action="props">
                <Button
                    :text="`Editar`"
                    
                ></Button>
            </template>
        </DataTable>
    </div>
</template>

