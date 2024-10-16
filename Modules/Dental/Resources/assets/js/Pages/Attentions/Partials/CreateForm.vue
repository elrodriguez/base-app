<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import iconSearch from '@/Components/vristo/icon/icon-search.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, reactive } from 'vue';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { Spanish } from "flatpickr/dist/l10n/es.js"
import Multiselect from '@suadelabs/vue3-multiselect';
import '@suadelabs/vue3-multiselect/dist/vue3-multiselect.css';
import InputError from "@/Components/InputError.vue";
import Swal from 'sweetalert2';
import { Dropdown, Menu } from 'ant-design-vue';
import Keypad from '@/Components/Keypad.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    doctors: {
        type: Object,
        default: () => ({})
    }
});

const form = useForm({
    date_time_attention: null,
    current_illness: null,
    reason_consultation: null,
    sick_time: null,
    appetite: null,
    thirst: null,
    dream: null,
    mood: null,
    urine: null,
    depositions: null,
    weight_loss: null,
    pex_tem: null,
    pex_pa: null,
    pex_fc: null,
    pex_fr: null,
    pex_peso: null,
    pex_talla: null,
    pex_imc: null,
    treatment: null,
    pex_aux_examination: {
        description: null,
        reference: null
    },
    doctor_id: null,
    patient_id: null,
    appointment_id: null,
    next_appointment_id: null,
    signed_accepted: null,
    observations: null,
    history_id: null
});

// Función para obtener la fecha y hora actual formateada
const getCurrentDateTime = () => {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    
    // Formato Y-m-d H:i
    return `${year}-${month}-${day} ${hours}:${minutes}`;
};

const dateTime = ref({
    enableTime: true,
    dateFormat: 'Y-m-d H:i',
    position: 'auto left',
    locale: Spanish, // Cambiado a 'es' para español
});

let intervalId;

onMounted(() => {
    // Inicializar el valor de date_attention con la fecha y hora actual
    form.date_time_attention = getCurrentDateTime();

    // Actualizar la fecha y hora cada minuto
    intervalId = setInterval(() => {
        form.date_time_attention = getCurrentDateTime(); // Actualiza la hora en tiempo real
    }, 60000); // Actualizar cada 60,000 ms (1 minuto)
});

onUnmounted(() => {
    clearInterval(intervalId); // Limpiar el intervalo al desmontar el componente
});

const seeker = reactive({
    search: null,
    loading: false,
    several: false,
    patients: [],
    patient: null
});

const searchPatients = () => {
    seeker.loading = true;
    axios({
        method: 'post',
        url: route('heal_patients_search'),
        data: {search: seeker.search}
    }).then((response) => {
        let contador = 0;
        if(response.data.success){
            seeker.patients = response.data.patients;
            contador = response.data.patients.length;
        }else{
            contador = 0;
        }

        return contador;
    }).then((result) => {
        if(result == 0){
            Swal.fire({
                icon: 'error',
                title: 'Lo sentimos',
                text: 'No se encontraron datos para la busqueda',
                padding: '2em',
                customClass: 'sweet-alerts',
            });
        } else {
            seeker.several = true
        } 
    }).finally(() => {
        seeker.loading = false;
    });
}

const selectPatient = (patient) => {
    form.patient_id = patient.id;
    seeker.patient = patient;
    seeker.search = patient.person.full_name;
    seeker.several = false;
}

const baseUrl = assetUrl;

const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}

function calcularEdad(fechaNacimiento) {
    const hoy = new Date();
    const nacimiento = new Date(fechaNacimiento);
    
    let edad = hoy.getFullYear() - nacimiento.getFullYear();
    const mes = hoy.getMonth() - nacimiento.getMonth();
    
    // Restar un año si el mes actual es antes del mes de nacimiento
    // o si es el mismo mes pero el día actual es antes del día de nacimiento
    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
        edad--;
    }

    return edad;
}

</script>
<template>
    <div class="space-y-6">
        <div class="panel">
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-6 sm:col-span-1">
                    <div class="ltr:sm:mr-4 rtl:sm:ml-4 w-full mb-5">
                        <template v-if="seeker.patient">
                            <img v-if="seeker.patient.person.image" 
                                :src="getImage(seeker.patient.person.image)"
                                alt="" 
                                class="w-20 h-20 md:w-32 md:h-32 rounded-full object-cover mx-auto">
                            
                            <img v-else :src="'https://ui-avatars.com/api/?name='+seeker.patient.person.full_name+'&size=500&rounded=true'"
                                :alt="seeker.patient.person.full_name" 
                                class="w-20 h-20 md:w-32 md:h-32 rounded-full object-cover mx-auto">
                        </template>
                        <template v-else>
                            <img src="/img/svg/questions-pana.svg" alt="" class="w-20 h-20 md:w-32 md:h-32 rounded-full object-cover mx-auto">
                        </template>
                    </div>
                    <div class="space-y-3" v-if="seeker.patient">
                        <dl class="flex flex-col sm:flex-row gap-1">
                            <dt class="min-w-20">
                                <span class="block text-sm text-gray-500 dark:text-neutral-500">DNI:</span>
                            </dt>
                            <dd>
                                <strong>{{ seeker.patient.person.number }}</strong>
                            </dd>
                        </dl>
                        <dl class="flex flex-col sm:flex-row gap-1">
                            <dt class="min-w-20">
                                <span class="block text-sm text-gray-500 dark:text-neutral-500">EDAD:</span>
                            </dt>
                            <dd>
                                <strong>{{ calcularEdad(seeker.patient.person.birthdate) }}</strong>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6 sm:col-span-3">
                            <InputLabel value="PACIENTE" />
                            <div class="relative w-full max-w-md">
                                <div class="relative">
                                    <input
                                        type="text"
                                        placeholder="Buscar paciente..."
                                        class="form-input"
                                        v-model="seeker.search"
                                        @keyup.enter="searchPatients"
                                    />
                                    <button @click="searchPatients" type="button" class="btn btn-primary absolute ltr:right-1 rtl:left-1 inset-y-0 m-auto rounded-md w-7 h-7 p-0 flex items-center justify-center">
                                        <icon-search />
                                    </button>
                                </div>
                                <div v-if="seeker.several" class="absolute w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-60 overflow-auto z-10">
                                    <ul>
                                        <!-- Ejemplos de resultados -->
                                        <template v-for="patient, index in seeker.patients">
                                            <li v-on:click="selectPatient(patient)" class="cursor-pointer">
                                                <div class="flex px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10"
                                                    :class="{
                                                        'border-b border-[#e0e6ed] dark:border-[#1b2e4b]': index > 0
                                                    }"
                                                >
                                                    <div class="ltr:mr-3 rtl:ml-3">
                                                        <img v-if="patient.person.image" :src="getImage(patient.person.image)" alt="" class="rounded-full w-12 h-12 object-cover" />
                                                        <img v-else :src="'https://ui-avatars.com/api/?name='+patient.person.full_name+'&size=500&rounded=true'" alt="" class="rounded-full w-12 h-12 object-cover" />
                                                    </div>
                                                    <div class="flex-1 font-semibold">
                                                        <h6 class="mb-1 text-base">{{ patient.person.full_name }}</h6>
                                                        <p class="text-xs">{{ patient.person.number }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <InputLabel value="ENFERMEDAD ACTUAL" />
                            <TextInput v-model="form.current_illness" />
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <InputLabel value="FECHA" />
                            <flat-pickr v-model="form.date_time_attention" class="form-input" :config="dateTime"></flat-pickr>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <InputLabel value="PESO" />
                            <TextInput v-model="form.pex_peso" />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <InputLabel value="TALLA" />
                            <TextInput v-model="form.pex_talla" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <InputLabel value="MOTIVO DE CONSULTA" />
                            <TextInput v-model="form.reason_consultation" />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <InputLabel value="APETITO" />
                            <TextInput v-model="form.appetite" />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <InputLabel value="SED" />
                            <TextInput v-model="form.thirst" />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <InputLabel value="SUEÑO" />
                            <TextInput v-model="form.dream" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <InputLabel value="TIEMPO DE ENFERMEDAD" />
                            <TextInput v-model="form.sick_time" />
                        </div>
                        
                        <div class="col-span-3 sm:col-span-1">
                            <InputLabel value="ESTADO DE ANIMO" />
                            <TextInput v-model="form.mood" />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <InputLabel value="ORINA" />
                            <TextInput v-model="form.urine" />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <InputLabel value="DEPOSICIONES" />
                            <TextInput v-model="form.depositions" />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <InputLabel value="PERDIDA DE PESO" />
                            <TextInput v-model="form.weight_loss" />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <InputLabel value="T°" />
                            <TextInput v-model="form.pex_tem" />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <InputLabel value="PA" />
                            <TextInput v-model="form.pex_pa" />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <InputLabel value="FC" />
                            <TextInput v-model="form.pex_fc" />
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <InputLabel value="FR" />
                            <TextInput v-model="form.pex_fr" />
                        </div>
                        
                        <div class="col-span-2 sm:col-span-1">
                            <InputLabel value="IMC" />
                            <TextInput v-model="form.pex_imc" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-1">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <InputLabel value="TRATAMIENTO" />
                            <textarea v-model="form.treatment" class="form-textarea" rows="3"></textarea>
                        </div>
                        <div class="col-span-2">
                            <InputLabel value="Observación" />
                            <textarea v-model="form.observations" class="form-textarea" rows="3"></textarea>
                        </div>
                        <div class="col-span-2">
                            <InputLabel value="Exámenes auxiliares" />
                            <textarea v-model="form.pex_aux_examination.description" class="form-textarea" rows="3"></textarea>
                        </div>
                        <div class="col-span-2">
                            <InputLabel value="Referencia (Lugar y motivo): " />
                            <textarea v-model="form.pex_aux_examination.reference" class="form-textarea" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <InputLabel value="DOCTOR ATENDIO" />
                            <multiselect
                                id="doctor_id" 
                                :model-value="form.doctor_id"
                                v-model="form.doctor_id"
                                :options="doctors"
                                class="custom-multiselect"
                                :searchable="true"
                                placeholder="Buscar doctor"
                                selected-label="seleccionado"
                                select-label="Elegir"
                                deselect-label="Quitar"
                                label="name"
                                track-by="code"
                            ></multiselect>
                            <InputError :message="form.errors.doctor_id" class="mt-1" />
                        </div>
                        <div class="col-span-2">
                            <InputLabel value="Firmado aceptado" />
                            <label class="inline-flex">
                                <input v-model="form.signed_accepted" type="checkbox" class="form-checkbox outline-primary" />
                                <span>si</span>
                            </label>
                        </div>
                        <div class="col-span-2">
                            <div class="rounded-md border border-gray-200 dark:border-gray-700 px-4 py-2">
                                <h3 class="m-0 dark:text-white-dark">PROGRAMAR PROXIMA CITA (opcional)</h3>
                                <div class="mt-5 mb-5">
                                    <label for="doctor_id" >Doctor</label>
                                    <multiselect
                                        id="doctor_id" :model-value="form.doctor_id"
                                        v-model="form.doctor_id"
                                        :options="doctors"
                                        class="custom-multiselect"
                                        :searchable="true"
                                        placeholder="Buscar doctor"
                                        selected-label="seleccionado"
                                        select-label="Elegir"
                                        deselect-label="Quitar"
                                        label="name"
                                        track-by="code"
                                        @update:modelValue="getBusyHours"
                                    ></multiselect>
                                    <InputError :message="form.errors.doctor_id" class="mt-1" />
                                </div>
                                <div class="mb-5">
                                    <label for="dateStart">Día :</label>
                                    <flat-pickr
                                        v-model="form.date_appointmen"
                                        :config="configFlatPickr"
                                        class="form-input"
                                        placeholder="Selecciona fecha"
                                    />
                                    <div class="text-danger mt-2" id="startDateErr"></div>
                                </div>
                                <div class="mb-5">
                                    <label for="dateEnd">Hora :</label>
                                    <Dropdown placement="bottom" align-to-end :trigger="['click']" v-model:visible="timeVisible">
                                        <input v-model="form.time_appointmen" class="form-input w-full" @click.prevent /> 
                                        <template #overlay>
                                            <Menu>
                                                <perfect-scrollbar
                                                    :options="{
                                                        swipeEasing: true,
                                                        wheelPropagation: false,
                                                    }"
                                                    class="relative"
                                                    style="max-height: 288px;"
                                                >
                                                    <div class="max-w-[85rem] px-4 py-2 mx-auto">
                                                        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-2">
                                                            <template v-for="(row, index) in arrayTimes" :key="index">
                                                                <template v-if="row.active">
                                                                    <button @click="startTimeChange(row.time)" type="button" class="btn btn-outline-primary">
                                                                        {{ row.time }}
                                                                    </button>
                                                                </template>
                                                                <template v-else>
                                                                    <button disabled type="button" class="btn btn-danger">
                                                                        {{ row.time }}
                                                                    </button>
                                                                </template>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </perfect-scrollbar>
                                                
                                            </Menu>
                                        </template>
                                    </Dropdown>
                                    
                                    <div class="text-danger mt-2" id="endDateErr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full flex justify-between items-center">
            <span class="text-primary text-[16px]">Los campos con * son obligatorios</span>
            <Keypad>
                <template #botones>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <svg v-show="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                        </svg>
                        Guardar
                    </PrimaryButton>
                    <Link :href="route('odontology_attention_list')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                </template>
            </Keypad>
        </div>
    </div>
</template>