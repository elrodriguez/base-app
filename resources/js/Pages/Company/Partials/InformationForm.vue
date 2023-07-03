<script setup>
    import { useForm } from '@inertiajs/vue3';
    import FormSection from '@/Components/FormSection.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import swal from 'sweetalert';
    import Keypad from '@/Components/Keypad.vue';

    const props = defineProps({
        company: {
            type: Object,
            default: () => ({}),
        }
    });

    const form = useForm({
        ruc: props.company.ruc,
        name: props.company.name,
        business_name: props.company.business_name,
        tradename: props.company.tradename,
        fiscal_address: props.company.fiscal_address,
        phone: props.company.phone,
        representative: props.company.representative,
        email: props.company.email,
        logo: null,
        logo_old: props.company.logo,
        logo_document_old: props.company.logo_document,
        logo_document: null,
        key_sunat: props.company.key_sunat,
        user_sunat: props.company.user_sunat,
        certificate_sunat: props.company.certificate_sunat,
        mode: props.company.mode 
    });

    const createOrUpdateCompany = () => {
        form.post(route('company_update_create'), {
            errorBag: 'createOrUpdateCompany',
            preserveScroll: true,
            onSuccess: () => {
                swal('Datos registrados con éxito');
            }
        });
    };

 </script>

<template>
    <FormSection @submitted="createOrUpdateCompany">
        <template #title>
            Información de la empresa 
        </template>

        <template #description>
            Detalles
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="ruc" value="Ruc*" />
                <TextInput
                    id="ruc"
                    v-model="form.ruc"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                />
                <InputError :message="form.errors.ruc" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="name" value="Nombre*" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="block w-full mt-1"
                    
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="business_name" value="Nombre del Negocio*" />
                <TextInput
                    id="business_name"
                    v-model="form.business_name"
                    type="text"
                    class="block w-full mt-1"
                    
                />
                <InputError :message="form.errors.business_name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="tradename" value="Nombre comercial*" />
                <TextInput
                    id="tradename"
                    v-model="form.tradename"
                    type="text"
                    class="block w-full mt-1"
                    
                />
                <InputError :message="form.errors.tradename" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="fiscal_address" value="Dirección fiscal*" />
                <TextInput
                    id="fiscal_address"
                    v-model="form.fiscal_address"
                    type="text"
                    class="block w-full mt-1"
                    
                />
                <InputError :message="form.errors.fiscal_address" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="email" value="Email*" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="block w-full mt-1"
                    
                />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="representative" value="Representante" />
                <TextInput
                    id="representative"
                    v-model="form.representative"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.representative" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="phone" value="Teléfono*" />
                <TextInput
                    id="phone"
                    v-model="form.phone"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.phone" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <figure v-if="form.logo_old" class="max-w-lg">
                    <img class="h-auto max-w-full rounded-lg" :src="'/storage/'+form.logo_old" alt="image description">
                    <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Logo Actual</figcaption>
                </figure>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Logo - recomienda 200x200*</label>
                <input type="file" @input="form.logo = $event.target.files[0]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="logo_small_size" >
                <InputError :message="form.errors.logo" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <figure v-if="form.logo_document_old" class="max-w-lg">
                    <img class="h-auto max-w-full rounded-lg" :src="'/storage/'+form.logo_document_old" alt="image description">
                    <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Logo Actual</figcaption>
                </figure>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Logo - se recomienda 317x48</label>
                <input type="file" @input="form.logo_document = $event.target.files[0]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="document_small_size" >
            </div>

            <div class="col-span-6 sm:col-span-2">
                <InputLabel for="user_sunat" value="Usuario Sunat" />
                <TextInput
                    id="user_sunat"
                    v-model="form.user_sunat"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.user_sunat" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-2">
                <InputLabel for="key_sunat" value="Clave Sunat" />
                <TextInput
                    id="key_sunat"
                    v-model="form.key_sunat"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.key_sunat" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Certificado Sunat</label>
                <input  @input="form.certificate_sunat = $event.target.files[0]" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file">
            </div>
            <div class="col-span-6">
                <div class="flex flex-wrap">
                    <div class="flex items-center mr-4">
                        <input v-model="mode" :value="'prod'" id="red-radio" type="radio" value="" name="colored-radio" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="red-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Producción</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input v-model="mode" :value="'demo'" checked  id="purple-radio" type="radio" value="" name="colored-radio" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="purple-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Demo</label>
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <Keypad>
                <template #botones>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Guardar
                    </PrimaryButton>
                </template>
            </Keypad>
        </template>
    </FormSection>
</template>
