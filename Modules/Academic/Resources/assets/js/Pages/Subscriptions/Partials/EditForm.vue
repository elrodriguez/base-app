<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Keypad from '@/Components/Keypad.vue';
import Swal2 from 'sweetalert2';
import { ref, watch } from 'vue';
import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
import IconX from '@/Components/vristo/icon/icon-x.vue';
import IconMinus from '@/Components/vristo/icon/icon-minus.vue';
import { NumberSpinner } from 'vue3-number-spinner';

const props = defineProps({
    subscription: {
        type: Object,
        default: () => ({})
    },
    periods: {
        type: Object,
        default: () => ({})
    }
});

const form = useForm({
    title: props.subscription.title,
    description: props.subscription.description,
    details: JSON.parse(props.subscription.details),
    prices: JSON.parse(props.subscription.prices),
    status: props.subscription.status == 1 ? true : false,
    period: props.subscription.period,
    order_number: props.subscription.order_number ?? 1
});

const updateSubscription = () => {
    form.put(route('aca_subscriptions_update',props.subscription.id), {
        errorBag: 'updateSubscription',
        preserveScroll: true,
        onSuccess: () => {
            Swal2.fire({
                title: 'Enhorabuena',
                text: 'Actualizado correctamente',
                icon: 'success',
                padding: '2em',
                customClass: 'sweet-alerts',
            });
        },
    });
}

const addDetails = () => {
    form.details.push({
        label: null
    })
}

const removeDetail = (indexToRemove) => {
    if(form.details.length > 1){
        form.details.splice(indexToRemove, 1);
    }
}

const addPrice = () => {
    form.prices.push({
        currency: 'PEN',
        amount: null,
        detail: null
    });
}

const removePrice = (indexToRemove) => {
    if(form.prices.length > 1){
        form.prices.splice(indexToRemove, 1);
    }
}

</script>

<template>
    <FormSection @submitted="updateSubscription" class="">
        <template #title>
            Suscripción Detalles
        </template>
        <template #description>
            Editar Suscripción, Los campos con * son obligatorios
        </template>
        <template #form>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="title" value="Título *" />
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    
                />
                <InputError :message="form.errors.title" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="period" value="Periodo *" />
                <select v-model="form.period" class="form-select text-white-dark">
                    <template v-for="period in periods">
                        <option :value="period">{{ period }}</option>
                    </template>
                </select>
                <InputError :message="form.errors.period" class="mt-2" />
            </div>
            <div class="col-span-2">
                <InputLabel for="title" value="Número de orden *" />
                <div class="flex">
                    <button
                        type="button"
                        class="bg-primary text-white flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border border-r-0 border-primary"
                        @click="form.order_number--"
                    >
                        <icon-minus />
                    </button>
                    <number-spinner v-model="form.order_number" :min="0" :max="100" :step="1" :keyStep="1" class="form-input rounded-none text-center" />
                    <button
                        type="button"
                        class="bg-primary text-white flex justify-center items-center ltr:rounded-r-md rtl:rounded-l-md px-3 font-semibold border border-l-0 border-primary"
                        @click="form.order_number++"
                    >
                        <icon-plus />
                    </button>
                </div>
            </div>
            <div class="col-span-4">
                <InputLabel for="description" value="Descripción *" />
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>
            
            <div class="col-span-6">
                <label class="inline-flex">
                    <input v-model="form.status" type="checkbox" class="form-checkbox rounded-full" />
                    <span>Activo</span>
                </label>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <div class="p-4 border border-[#888ea8] dark:border-[#1b2e4b] rounded" >
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Detalles</h5>
                        <button @click="addDetails" class="btn btn-primary btn-sm" type="button">
                            <icon-plus class="w-4 h-4" />
                        </button>
                    </div>
                    <div class="space-y-4">
                        <template v-for="(detail, ixdex) in form.details" >
                            <div class="flex">
                                <input v-model="detail.label" :id="`txtLabel-${ixdex}`" type="text" placeholder="Escribe aquí" class="form-input ltr:rounded-r-none rtl:rounded-l-none py-1.5" />
                                <button @click="removeDetail(ixdex)" type="button" class="btn btn-danger btn-sm ltr:rounded-l-none rtl:rounded-r-none">
                                    <icon-x class="w-4 h-4" />
                                </button>
                            </div>
                            <InputError :message="form.errors[`details.${ixdex}.label`]" class="mt-2" />
                        </template>
                    </div>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <div class="p-4 border border-[#888ea8] dark:border-[#1b2e4b] rounded">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Precios</h5>
                        <!-- <button @click="addPrice" class="btn btn-primary btn-sm" type="button">
                            <icon-plus class="w-4 h-4" />
                        </button> -->
                    </div>
                    <div class="space-y-4">
                        <template v-for="(price, isdex) in form.prices" >
                            <div class="flex">
                                <!-- <select v-model="price.currency" :id="`txtCurrency-${isdex}`" class="form-select form-select-sm text-white-dark ltr:border-r-0 focus:!border-r ltr:rounded-r-none rtl:rounded-l-none flex-1 py-1.5" >
                                    <option value="">Seleccionar</option>
                                    <option value="PEN">Soles</option>
                                    <option value="USD">Dolares</option>
                                </select> -->
                                <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">
                                    {{ price.currency == 'PEN' ? 'S/' : '$' }}
                                </div>
                                <input v-model="price.amount" :id="`txtAmount-${isdex}`" type="text" placeholder="Monto" class="form-input ltr:border-r-0 rtl:border-l-0 focus:!border-r focus:!border-l rounded-none flex-1 py-1.5" />
                                <input v-model="price.detail" :id="`txtDetail-${isdex}`" type="text" placeholder="Detalle" class="form-input  rtl:border-l-0 focus:!border-r focus:!border-l flex-1 py-1.5 ltr:rounded-l-none rtl:rounded-r-none"  />
                                <!-- <button @click="removePrice(isdex)" type="button" class="btn btn-danger btn-sm ltr:rounded-l-none rtl:rounded-r-none">
                                    <icon-x class="w-4 h-4" />
                                </button> -->
                            </div>
                            <InputError :message="form.errors[`prices.${isdex}.amount`]" class="mt-2" />
                            <InputError :message="form.errors[`prices.${isdex}.detail`]" class="mt-2" />
                            
                        </template>
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            
            <Keypad>
                <template #botones>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <svg v-show="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                        </svg>
                        Guardar
                    </PrimaryButton>
                    <Link :href="route('aca_subscriptions_list')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                </template>
            </Keypad>
        </template>
    </FormSection>
</template>