<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { Spanish } from 'flatpickr/dist/l10n/es.js';
import InputError from '@/Components/InputError.vue';
import Multiselect from '@suadelabs/vue3-multiselect';
import '@suadelabs/vue3-multiselect/dist/vue3-multiselect.css';
import IconLinkedin from '@/Components/vristo/icon/icon-linkedin.vue';
import IconTwitter from '@/Components/vristo/icon/icon-twitter.vue';
import IconFacebook from '@/Components/vristo/icon/icon-facebook.vue';
import IconInstagram from '@/Components/vristo/icon/icon-instagram.vue';
import Swal2 from 'sweetalert2';

const props = defineProps({
    person: {
        type: Object,
        default: () => ({})
    },
    document_types: {
        type: Object,
        default: () => ({})
    },
    ubigeo: {
        type: Object,
        default: () => ({})
    }
});


const form = useForm({
    id: props.person ? props.person.id : null,
    document_type_id: props.person ? props.person.document_type_id : 99,
    short_name: props.person ? props.person.short_name : null,
    full_name: props.person ? props.person.full_name : null,
    description: props.person ? props.person.description : null,
    number: props.person ? props.person.number : null,
    telephone: props.person ? props.person.telephone : null,
    email: props.person ? props.person.email : null,
    image: props.person ? props.person.image : null,
    address: props.person ? props.person.address : null,
    ubigeo: props.person ? {"district_id" : props.person.ubigeo, "name_city" : props.person.ubigeo_description} : null,
    birthdate: props.person ? props.person.birthdate : null,
    names: props.person ? props.person.names : null,
    father_lastname: props.person ? props.person.father_lastname : null,
    mother_lastname: props.person ? props.person.mother_lastname : null,
    ocupacion: props.person ? props.person.ocupacion : null,
    presentacion: props.person ? props.person.presentacion : null,
    gender: props.person ? props.person.gender : 'M',
    status: props.person ? props.person.status : null,
    social_networks: props.person ? props.person.social_networks : null
});

  const basic = ref({
    dateFormat: 'Y-m-d',
    locale: Spanish,
  });

  const socialData = ref({
    facebook: props.person ? JSON.parse(props.person.social_networks).facebook : null,
    instagram: props.person ? JSON.parse(props.person.social_networks).instagram : null,
    linkedin: props.person ? JSON.parse(props.person.social_networks).linkedin : null,
    twitter: props.person ? JSON.parse(props.person.social_networks).twitter : null,
  });

  const savePerson = () => {
    form.social_networks = socialData.value;
    form.post(route('person_information_update'), {
        errorBag: 'savePerson',
        preserveScroll: true,
        onSuccess: () => {
            showMessage('Actualizado con éxito.');
        },
    });
  }

  const showMessage = (msg = '', type = 'success') => {
        const toast = Swal2.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            customClass: { container: 'toast' },
        });
        toast.fire({
            icon: type,
            title: msg,
            padding: '10px 20px',
        });
    };
</script>
<template>
    <form @submit.prevent="savePerson">
        <div class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 mb-5 bg-white dark:bg-[#0e1726]">
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
                <div class="col-span-3 sm:col-span-2 md:col-span-2">
                    <label for="ubigeo">Ciudad</label>
                    <multiselect
                        id="ubigeo"
                        v-model="form.ubigeo"
                        :options="ubigeo"
                        class="custom-multiselect"
                        :searchable="true"
                        placeholder="Buscar ciudad"
                        selected-label="seleccionado"
                        select-label="Elegir"
                        deselect-label="Quitar"
                        label="name_city"
                        track-by="district_id"
                        ></multiselect>
                    <InputError class="mt-2" :message="form.errors.ubigeo" />
                </div>
                <div>
                    <label for="gender">Sexo</label>
                    <select id="gender" v-model="form.gender" class="form-select text-white-dark" required>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.gender" />
                </div>
                <div>
                    <label for="description">Descripción Personal</label>
                    <textarea v-model="form.description" id="description" rows="3" class="form-textarea"></textarea>
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>
                <div>
                    <label for="ocupacion">Ocupación Profesional</label>
                    <textarea v-model="form.ocupacion" id="ocupacion" rows="3" class="form-textarea"></textarea>
                    <InputError class="mt-2" :message="form.errors.ocupacion" />
                </div>
                <div>
                    <label for="presentacion">Presentación Profesional</label>
                    <textarea v-model="form.presentacion" id="presentacion" rows="3" class="form-textarea"></textarea>
                    <InputError class="mt-2" :message="form.errors.presentacion" />
                </div>
            </div>
            <div class="sm:col-span-2 mt-3 w-full flex justify-end">
                <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="mr-4" style="height: 10px;">
                    {{ form.progress.percentage }}%
                </progress>
                <button type="submit" :disabled="form.processing" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        <div class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 bg-white dark:bg-[#0e1726]">
            <h6 class="text-lg font-bold mb-5">Redes Sociales</h6>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="flex">
                    <div class="bg-[#eee] flex justify-center items-center rounded px-3 font-semibold dark:bg-[#1b2e4b] ltr:mr-2 rtl:ml-2">
                        <icon-linkedin class="w-5 h-5" />
                    </div>
                    <input v-model="socialData.linkedin" type="text" class="form-input" />
                </div>
                <div class="flex">
                    <div class="bg-[#eee] flex justify-center items-center rounded px-3 font-semibold dark:bg-[#1b2e4b] ltr:mr-2 rtl:ml-2">
                        <icon-twitter class="w-5 h-5" />
                    </div>
                    <input v-model="socialData.twitter" type="text" class="form-input" />
                </div>
                <div class="flex">
                    <div class="bg-[#eee] flex justify-center items-center rounded px-3 font-semibold dark:bg-[#1b2e4b] ltr:mr-2 rtl:ml-2">
                        <icon-facebook class="w-5 h-5" />
                    </div>
                    <input v-model="socialData.facebook" type="text" class="form-input" />
                </div>
                <div class="flex">
                    <div class="bg-[#eee] flex justify-center items-center rounded px-3 font-semibold dark:bg-[#1b2e4b] ltr:mr-2 rtl:ml-2">
                        <icon-instagram />
                    </div>
                    <input v-model="socialData.instagram"type="text" class="form-input" />
                </div>
            </div>
        </div>
    </form>
</template>