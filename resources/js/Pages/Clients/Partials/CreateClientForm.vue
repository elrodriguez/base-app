<script setup>
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Select, TreeSelect } from 'ant-design-vue';
import { ref, watch, onMounted } from 'vue';
import Swal2 from 'sweetalert2';

const props = defineProps({
    identityDocumentTypes: {
        type: Object,
        default: () => ({}),
    },
    ubigeo: {
        type: Object,
        default: () => ({}),
    }
});

const form = useForm({
    id: null,
    document_type_id: 1,
    number: null,
    telephone: null,
    email: null,
    image: null,
    image_preview: null,
    address: null,
    ubigeo: null,
    birthdate: null,
    names: null,
    father_lastname: null,
    mother_lastname: null,
    ubigeo_description: null,
    full_name: null
});

const searchPerson = async () => {
        // axios.post(route('search_person_apies'), form ).then((res) => {
        //     form.full_name = res.data.full_name;
        //     form.telephone = res.data.telephone;
        //     form.email = res.data.email;
        //     form.address = res.data.address;
        //     form.document_type_id = res.data.document_type_id;
        //     form.number = res.data.number;
        //     form.id = res.data.id;
        // });
    };   

const createClient = () => {
    form.post(route('clients.store'), {
        forceFormData: true,
        errorBag: 'createClient',
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

const filterOption = (input, option) => {
    const inputValueLower = input.toLowerCase();
    const optionTitleLower = option.label.toLowerCase();
    return optionTitleLower.includes(inputValueLower);
};

const createFormSearch = () => {

    let formHTML = document.createElement('form');
    formHTML.classList.add('max-w-sm', 'mx-auto');

    let selectLabel = document.createElement('label');
    selectLabel.setAttribute('for', 'identityDocument');
    selectLabel.classList.add('text-left','text-sm');
    selectLabel.textContent = 'Tipo de documento de identidad';

    let typeSelect = document.createElement('select');
    typeSelect.id = 'identityDocument';
    typeSelect.classList.add(
        'form-select',
        'text-white-dark',
    );

    let defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Seleccionar tipo de documento';
    typeSelect.appendChild(defaultOption);

    // Crear opciones dinámicamente
    for (const [key, value] of Object.entries(props.identityDocumentTypes)) {
        let option = document.createElement('option');
        option.value = value.id;
        option.textContent = value.description;
        typeSelect.appendChild(option);
    }

    let dniLabel = document.createElement('label');
    dniLabel.setAttribute('for', 'txtdni');
    dniLabel.classList.add('text-left','text-sm','mt-4');
    dniLabel.textContent = 'Número de DNI';

    let dnilInput = document.createElement('input');
    dnilInput.type = 'text';
    dnilInput.id = 'txtdni';
    dnilInput.classList.add(
        'form-input'
    );

    dnilInput.placeholder = 'Escribir número de identificación';
    dnilInput.required = true;

    formHTML.appendChild(selectLabel);
    formHTML.appendChild(typeSelect);
    formHTML.appendChild(dniLabel);
    formHTML.appendChild(dnilInput);

    return formHTML;

}

onMounted(() => {
    openSwal2Search();
});

const baseUrl = assetUrl;

const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}

const openSwal2Search = () => {
    Swal2.fire({
        title: "Verificar DNI",
        text: 'Por favor, ingrese el número de DNI para verificar si la persona ya está registrada.',
        html: createFormSearch(),
        showCancelButton: true,
        confirmButtonText: 'Buscar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        icon: "question",
        padding: '2em',
        customClass: 'sweet-alerts',
        preConfirm: async (login) => {
            let data = {
                document_type: document.getElementById("identityDocument").value,
                number: document.getElementById("txtdni").value
            }
            return axios.post(route('search_person_number'),data).then((res) => {
                if (!res.data.status) {
                    form.document_type_id = data.document_type,
                    form.number = data.number,
                    Swal2.showValidationMessage(res.data.alert)
                }
                return res
            });
        },
        allowOutsideClick: () => !Swal2.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal2.fire({
                allowOutsideClick: false,
                title: result.value.data.person.full_name,
                imageUrl: result.value.data.person.image ? getImage(result.value.data.person.image) : null,
                text: `Ya fue registrado con el DNI ` + result.value.data.person.number,
                imageHeight: 180,
                imageWidth: 180,
                customClass: {
                    image: 'rounded-full',  
                },
                padding: '2em',
            }).then((res) => {
                if (res.isConfirmed) {
                    getPersonData(result.value.data.person);
                }
            });
        }
    });
}
const getPersonData = (newValues) => {
    form.id = newValues.id,
    form.teacher_id = newValues.teacher_id,
    form.document_type_id = newValues.document_type_id,
    form.number = newValues.number,
    form.telephone = newValues.telephone,
    form.email = newValues.email,
    form.image = null,
    form.image_preview = newValues.image ? getImage(newValues.image) : null,
    form.address = newValues.address,
    form.ubigeo = newValues.ubigeo,
    form.birthdate = newValues.birthdate,
    form.names = newValues.names,
    form.father_lastname = newValues.father_lastname,
    form.mother_lastname = newValues.mother_lastname,
    form.ubigeo_description = newValues.city
    form.presentacion = newValues.presentacion,
    form.full_name = newValues.full_name
};
</script>

<template>
    <FormSection @submitted="createClient">
        <template #title>
            Cliente Detalles
        </template>

        <template #description>
            <span>Ingresar nuevo cliente, los campos con * son obligatorios. También puedes verificar si el cliente ya existe en </span>

            <a @click="openSwal2Search" href="javascript:;" class="text-primary font-semibold hover:underline group">
                la base de datos 
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ltr:ml-1 rtl:mr-1 inline-block relative transition-all duration-300 group-hover:translate-x-2 rtl:group-hover:-translate-x-2 rtl:rotate-180">
                    <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
        </template>

        <template #form>
            <div class="col-span-4 sm:col-span-2">
                <InputLabel value="Tipo de Documento *" class="mb-1" />
                <select class="form-select text-white-dark" v-model="form.document_type_id" >
                    <option value="" selected>Seleccionar</option>
                    <option v-for="(item, key) in identityDocumentTypes" :value="item.id">{{ item.description }}</option>
                </select>
                <InputError :message="form.errors.document_type_id" class="mt-2" />
             </div>
            <div class="col-span-6 sm:col-span-2">
                <InputLabel for="number" value="Número de Doc. *" />
                <TextInput
                    id="number"
                    v-model="form.number"
                    type="number"
                    autofocus
                />
                <InputError :message="form.errors.number" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-2">
                <button @click="searchPerson()" type="button" class="block w-full btn btn-primary mt-6">
                    <template v-if="form.document_type_id == 6" >
                        BUSCAR EN SUNAT
                    </template>
                    <template v-else >
                        BUSCAR EN RENIEC
                    </template>
                </button>
            </div>

            <div class="col-span-6 sm:col-span-2">
                <InputLabel for="telephone" value="Teléfono" />
                <TextInput
                    id="telephone"
                    v-model="form.telephone"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.telephone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel v-if="form.document_type_id==6" for="full_name" value="Razón Social" />
                <InputLabel v-else for="full_name" value="Nombres *" />
                <TextInput
                    id="full_name"
                    v-model="form.full_name"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.full_name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-2">
                <InputLabel for="email" value="Email *" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="address" value="Dirección *" />
                <TextInput
                    id="address"
                    v-model="form.address"
                    type="text"
                />
                <InputError :message="form.errors.address" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="city" value="Ciudad *" />
                <Select
                    v-model:value="form.ubigeo"
                    style="width: 100%"
                    :options="ubigeo.map((obj) => ({value:obj.district_id,label: obj.department_name+'-'+obj.province_name+'-'+obj.district_name,distric_name: obj.district_name }))"
                    show-search
                    :filter-option="filterOption"
                ></Select>
                <InputError :message="form.errors.address" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Guardar
            </PrimaryButton>
            <a :href="route('clients.index')"  class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out ml-2">Ir al Listado</a>
        </template>
    </FormSection>
</template>
