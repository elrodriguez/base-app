<script setup>
    import { useForm } from '@inertiajs/vue3';
    import FormSection from '@/Components/FormSection.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { library } from "@fortawesome/fontawesome-svg-core";
    import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
    import swal from 'sweetalert';
    import Keypad from '@/Components/Keypad.vue';

    const props = defineProps({
        users: {
            type: Object,
            default: () => ({}),
        }
    });

    const form = useForm({
        description:'',
        address:'',
        phone:'',
        user_id: ''
    });

    const createEstablishment = () => {
        form.post(route('establishments.store'), {
            errorBag: 'createEstablishment',
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                swal('Tienda creada con éxito');
            }
        });
    };

 </script>

<template>
    <FormSection @submitted="createEstablishment">
        <template #title>
            Datos de Tienda
        </template>

        <template #description>
            Crear nueva Tienda
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="description" value="Descripción" />
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="address" value="Dirección" />
                <TextInput
                    id="address"
                    v-model="form.address"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.address" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="phone" value="Teléfono" />
                <TextInput
                    id="phone"
                    v-model="form.phone"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.phone" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="user" value="Vendedor" />
                <select v-model="form.user_id" id="stablishment" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Sin Vendedor</option>
                    <template v-for="(user, index) in props.users" :key="index">
                        <option :value="user.id">{{ user.name }}</option>
                    </template>
                </select>
                <InputError :message="form.errors.user_id" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <Keypad>
                <template #botones>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Guardar
                </PrimaryButton>
                <a :href="route('establishments.index')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</a>
                </template>
            </Keypad>
        </template>
    </FormSection>
</template>
