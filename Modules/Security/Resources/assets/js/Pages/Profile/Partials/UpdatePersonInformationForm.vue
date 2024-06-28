<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { Spanish } from 'flatpickr/dist/l10n/es.js';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    person: {
        type: Object,
        default: () => ({})
    },
    document_types: {
        type: Object,
        default: () => ({})
    }
});


const form = useForm({
    document_type_id: props.person ? props.person.document_type_id : 99,
    short_name: props.person ? props.person.short_name : null,
    full_name: props.person ? props.person.full_name : null,
    description: props.person ? props.person.description : null,
    number: props.person ? props.person.number : null,
    telephone: props.person ? props.person.telephone : null,
    email: props.person ? props.person.email : null,
    image: props.person ? props.person.image : null,
    address: props.person ? props.person.address : null,
    ubigeo: props.person ? props.person.ubigeo : null,
    birthdate: props.person ? props.person.birthdate : null,
    names: props.person ? props.person.names : null,
    father_lastname: props.person ? props.person.father_lastname : null,
    mother_lastname: props.person ? props.person.mother_lastname : null,
    ocupacion: props.person ? props.person.ocupacion : null,
    presentacion: props.person ? props.person.presentacion : null,
    gender: props.person ? props.person.gender : null,
    status: props.person ? props.person.status : null,
    social_networks: props.person ? props.person.social_networks : null
});

  const basic = ref({
    dateFormat: 'Y-m-d',
    locale: Spanish,
  });

</script>
<template>
    <form class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 mb-5 bg-white dark:bg-[#0e1726]">
        <h6 class="text-lg font-bold mt-1">Información Personal</h6>
        <p class="mb-5 text-sm text-gray-600 dark:text-gray-400">
            Actualice la información del perfil y la dirección de correo electrónico de su cuenta.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label for="names">Nombres</label>
                <input id="names" type="text" v-model="form.names" class="form-input" required />
                <InputError class="mt-2" :message="form.errors.names" />
            </div>
            <div>
                <label for="father_lastname">Apellido paterno</label>
                <input id="father_lastname" type="text" v-model="form.father_lastname" class="form-input" required />
                <InputError class="mt-2" :message="form.errors.father_lastname" />
            </div>
            <div>
                <label for="mother_lastname">Apellido materno</label>
                <input id="mother_lastname" type="text" v-model="form.mother_lastname" class="form-input" required />
                <InputError class="mt-2" :message="form.errors.mother_lastname" />
            </div>
            <div>
                <label for="mother_lastname">Tipo de Identificación</label>
                <select v-model="form.document_type_id" class="form-select text-white-dark" required>
                    <option value="99">Seleccionar</option>
                    <option v-for="(document_type, index) in document_types" :value="document_type.id">{{ document_type.description }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.document_type_id" />
            </div>
            <div>
                <label for="mother_lastname">Número de Identificación</label>
                <input id="mother_lastname" type="text" v-model="form.number" class="form-input" required />
                <InputError class="mt-2" :message="form.errors.number" />
            </div>
            <div>
                <label for="birthdate">Fecha de nacimiento</label>
                <flat-pickr v-model="form.birthdate" class="form-input" :config="basic"></flat-pickr>
                <InputError class="mt-2" :message="form.errors.birthdate" />
            </div>
            <div>
                <label for="telephone">Teléfono</label>
                <input v-model="form.telephone" class="form-input" />
                <InputError class="mt-2" :message="form.errors.telephone" />
            </div>
            <div>
                <label for="email">Correo electrónico</label>
                <input v-model="form.email" class="form-input" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div>
                <label for="address">Dirección</label>
                <input v-model="form.address" class="form-input" />
                <InputError class="mt-2" :message="form.errors.address" />
            </div>
            <div>
                <label for="ubigeo">Ciudad</label>
                <input v-model="form.ubigeo" class="form-input" />
                <InputError class="mt-2" :message="form.errors.ubigeo" />
            </div>
        </div>
    </form>
</template>