<script setup>
    import { useForm, Link } from '@inertiajs/vue3';
    import FormSection from '@/Components/FormSection.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { library } from "@fortawesome/fontawesome-svg-core";
    import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
    import Keypad from '@/Components/Keypad.vue';
    import swal from 'sweetalert2';

    const props = defineProps({
        modulo: {
            type: Object,
            default: () => ({}),
        }
    });

    const form = useForm({
        description: props.modulo.description,
        identifier: props.modulo.identifier,
        icon: props.modulo.icon,
        status: props.modulo.status == 1 ? true : false 
    });

    const updateModulo = () => {
        form.put(route('modulos.update', props.modulo.identifier), {
            errorBag: 'updateModulo',
            preserveScroll: true,
            onSuccess: () => {
                swal.fire({
                    title: 'Enhorabuena',
                    text: 'Se registro correctamente',
                    icon: 'success',
                    padding: '2em',
                    customClass: 'sweet-alerts',
                });
            }
        });
    };

    library.add(faTrashAlt);

</script>

<template>
    <FormSection @submitted="updateModulo">
        <template #title>
            Datos del Modulo
        </template>

        <template #description>
            Los campos * son Obligatorios
        </template>

        <template #form>
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="description" value="Nombre" />
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
                    <InputLabel for="identifier" value="Código" />
                    <TextInput
                        id="identifier"
                        v-model="form.identifier"
                        type="text"
                        class="block w-full mt-1"
                    />
                    <InputError :message="form.errors.identifier" class="mt-2" />
                </div>
                <div v-show="false" class="col-span-6 sm:col-span-3">
                    <InputLabel for="icon" value="Icono" />
                    <TextInput
                        id="icon"
                        v-model="form.icon"
                        type="text"
                        class="block w-full mt-1"
                    />
                    <InputError :message="form.errors.icon" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label class="inline-flex">
                        <input v-model="form.status" type="checkbox" class="form-checkbox" />
                        <span>Activo</span>
                    </label>
                </div>
        </template>

        <template #actions>
            <Keypad>
                <template #botones>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Actualizar
                    </PrimaryButton>
                    <Link :href="route('modulos.index')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                </template>
            </Keypad>
        </template>
    </FormSection>

</template>
