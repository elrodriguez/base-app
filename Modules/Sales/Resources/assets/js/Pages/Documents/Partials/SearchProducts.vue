<script setup>
    import ModalLargeX from '@/Components/ModalLargeX.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import { ref, nextTick } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    import NumberInput from '@/Components/NumberInput.vue';

    const props = defineProps({
        iconSearch: {
            type: Object,
            default: null
        }
    });

    const displayModal = ref(false);

    const formScaner = useForm({
        scaner: false
    });
    const form = useForm({
        search: null,
        products: [],
        product: {},
        data:{
            id:'',
            interne: '',
            stock:'',
            description:'',
            price:'',
            size:'',
            quantity: 1,
            discount: 0,
            size_quantity: 0
        }
    });

    const displayResultSearch = ref(false);
    const searchProducts = async () => {
        if(formScaner.scaner){
            axios.post(route('search_scaner_product'), form ).then((response) => {
                if(response.data.success){
                    displayModal.value = true;
                    form.products = [];
                    form.product = response.data.product;
                    form.data.id = response.data.product.id;
                    form.data.interne = response.data.product.interne;
                    form.data.stock = response.data.product.stock;
                    form.data.description = response.data.product.description;
                    form.data.price = null;
                    form.data.total = 0;
                    form.data.quantity = 1;
                    form.data.discount = 0;
                    form.search = null;
                    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: response.data.message,
                        padding: '2em',
                        customClass: 'sweet-alerts',
                    });
                }
                
            });
        }else{
            axios.post(route('search_product'), form ).then((response) => {
                if(response.data.success){
                    form.products = response.data.products;
                    displayResultSearch.value = true;
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: response.data.message,
                        padding: '2em',
                        customClass: 'sweet-alerts',
                    });
                }
                
            });
        }
    };
    const closeModalSelectProduct  = () => {
        displayModal.value = false;
    }
    const openModalSelectProduct = async (product) => {
        displayModal.value = true;
        displayResultSearch.value = false;
        form.products = [];
        form.product = product;
        form.data.id = product.id;
        form.data.interne = product.interne;
        form.data.stock = product.stock;
        form.data.description = product.description;
        form.data.price = JSON.parse(product.sale_prices).high;
        form.data.total = 0;
        form.data.quantity = 1;
        form.data.discount = 0;
        form.search = null;
    }

    const emit = defineEmits(['eventdata']);

    const addProduct = (pre) => {
        if(form.data.stock > 0 && form.data.stock >= form.data.quantity){
            if (pre){
                if(form.data.size){
                    if(form.data.quantity > 0 && form.data.quantity != ''){
                        if(form.data.size_quantity >= form.data.quantity){
                            if(form.data.price){
                                let total = parseFloat(form.data.quantity)*(parseFloat(form.data.price)-parseFloat(form.data.discount))
                                form.data.total = total;
                                let data = {
                                    id: form.data.id,
                                    interne: form.data.interne,
                                    description: form.data.description + ' Talla-'+form.data.size,
                                    is_product: form.product.is_product == 1 ? true : false,
                                    unit_type: form.product.type_unit_measure_id,
                                    quantity: form.data.quantity,
                                    unit_price: form.data.price,
                                    discount: form.data.discount,
                                    total: form.data.total,
                                    afe_igv: form.product.type_sale_affectation_id,
                                    presentations: pre,
                                    size: form.data.size,
                                    m_igv: 0,
                                    v_sale: 0,
                                    icbper: false
                                }
                                emit('eventdata',data);
                                displayModal.value = false;
                                form.data.size = null;
                                displayResultSearch.value = false;
                            }else{
                                showMessage('Seleccionar Precio', 'info')
                            }
                        }else{
                            showMessage('La cantidad a vender es mayor a las existencias del producto','info')
                        }
                    }else{
                        showMessage('La cantidad a vender debe ser mayor de 0', 'info');
                    }
                }else{
                    showMessage('Seleccionar Talla', 'info')
                }
            }else{
                if(form.data.price){
                    let total = parseFloat(form.data.quantity)*(parseFloat(form.data.price)-parseFloat(form.data.discount))
                    form.data.total = total;
                    let data = {
                        id: form.data.id,
                        interne: form.data.interne,
                        description: form.data.description,
                        is_product: form.product.is_product == 1 ? true : false,
                        unit_type: form.product.type_unit_measure_id,
                        quantity: form.data.quantity,
                        unit_price: form.data.price,
                        discount: form.data.discount,
                        total: form.data.total.toFixed(2),
                        afe_igv: form.product.type_sale_affectation_id,
                        presentations: pre,
                        m_igv: 0,
                        v_sale: 0,
                        icbper: false
                    }
                    emit('eventdata',data);
                    displayModal.value = false;
                    form.data.size = null;
                    displayResultSearch.value = false;
                }else{
                    showMessage('Seleccionar Precio', 'info')
                }
            }
        }else{
            showMessage('Stock insuficiente', 'info')
        }
    }

    const astUrl = assetUrl;

    const setFocusToElement = async () => {
        nextTick(() => {
            const element = document.getElementById('searchInput');
            if (element) {
                element.focus();
            }
        });
    };

    const selectSize = (item) => {
        form.data.size = item.size
        form.data.size_quantity = item.quantity
    }

    const showMessage = (msg = '', type = 'success') => {
        const toast = Swal.mixin({
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
    <div class="dropdown shrink-0">
        <Popper :placement="'bottom-start'" @open:popper="setFocusToElement" offsetDistance="8" class="z-50">
            <button type="button" title="Abrir Buscar" class="btn btn-sm btn-outline-primary dropdown-toggle">
                <font-awesome-icon :icon="iconSearch" />
            </button>
            <template #content="{ close }">
                <ul id="result" class="!py-0 text-dark dark:text-white-dark w-full sm:w-[650px] divide-y dark:divide-white/10">
                    <li class="items-center px-4 py-2 justify-between font-semibold">
                        <form @submit.prevent="searchProducts()" class="mx-auto w-full mb-5">
                            <div class="relative">
                                <input v-model="form.search" id="searchInput" type="text" placeholder="Buscar... " class="form-input shadow-[0_0_4px_2px_rgb(31_45_61_/_10%)] bg-white rounded-full h-11 placeholder:tracking-wider" autofocus />
                                <button type="submit" class="btn btn-primary absolute ltr:right-1 rtl:left-1 inset-y-0 m-auto rounded-full w-9 h-9 p-0 flex items-center justify-center">
                                    <font-awesome-icon :icon="iconSearch" />
                                </button>
                            </div>
                        </form>
                    </li>
                    <div style="max-height: 200px;  overflow-y: auto; scrollbar-width: thin; ">
                        <li v-for="(product, index) in form.products" class="w-full p-4">
                            <div @click="openModalSelectProduct(product),close()" style="cursor: pointer;" class="flex items-center justify-between space-x-4">
                                <div class="flex-shrink-0">
                                    <img v-if="product.image=='img/imagen-no-disponible.jpg'"
                                    :src="astUrl+product.image"
                                    class="w-8 h-8 rounded-full"
                                    :alt="product.interne"
                                    />

                                    <img v-else
                                    :src="astUrl+'storage/'+product.image"
                                    class="w-8 h-8 rounded-full"
                                    :alt="product.interne"
                                    />
                                </div>
                                <div class="text-left flex-1 min-w-0 ml-2">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ product.interne }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ product.description }}
                                    </p>
                                </div>
                                <div v-if="product.is_product" class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    Stock {{ product.stock }}
                                </div>
                            </div>
                        </li>
                    </div>
                    <li>
                        <div class="p-4 flex justify-end">
                            <button class="btn btn-primary block btn-small" @click="close" >
                                Cerrar
                            </button>
                        </div>
                    </li>
                </ul>
            </template>
        </Popper>
    </div>
    
    <ModalLargeX
        :show="displayModal" 
        :onClose="closeModalSelectProduct"
    >
        <template #title>
            <template v-if="form.product.is_product">
                Detalles del Producto
            </template>
            <template v-else>
                Detalles del Servicio
            </template>
        </template>
        <template #message>
            {{ form.product.interne }} - {{ form.product.description }}
        </template>
        <template #content>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1">
                    <div class="flex flex-wrap justify-center">
                        <img v-if="form.product.image=='img/imagen-no-disponible.jpg'"
                        :src="astUrl+form.product.image"
                        class="p-1 bg-white border rounded max-w-sm"
                        :alt="form.product.description"
                        style="width: 100%;"
                        />

                        <img v-else
                        :src="astUrl+'storage/'+form.product.image"
                        class="p-1 bg-white border rounded max-w-sm"
                        :alt="form.product.description"
                        style="width: 100%;"
                        />
                    </div>
                    <p class="my-4 text-center">Stock Actual : {{ form.data.stock  }}</p>
                </div>
                <div class="col-span-1">
                    
                    <div class="mb-4">
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Precios Disponibles
                        </label>
                        <div class="flex">
                            <div v-if="!form.product.local_prices">
                                <div class="form-check">
                                    <input v-model="form.data.price" :value="JSON.parse(form.product.sale_prices).high" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                        Precio Normal {{ JSON.parse(form.product.sale_prices).high  }}
                                    </label>
                                </div>
                                <div v-show="JSON.parse(form.product.sale_prices).medium" class="form-check">
                                    <input v-model="form.data.price" :value="JSON.parse(form.product.sale_prices).medium" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                        Precio Medio {{ JSON.parse(form.product.sale_prices).medium  }}
                                    </label>
                                </div>
                                <div v-show="JSON.parse(form.product.sale_prices).under" class="form-check">
                                    <input v-model="form.data.price" :value="JSON.parse(form.product.sale_prices).under" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault3">
                                        Precio Minimo {{ JSON.parse(form.product.sale_prices).under  }}
                                    </label>
                                </div>
                            </div>
                            <div v-else>
                                <div class="form-check">
                                    <input v-model="form.data.price" :value="JSON.parse(form.product.local_prices).high" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                        Precio Normal {{ JSON.parse(form.product.local_prices).high  }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input v-model="form.data.price" :value="JSON.parse(form.product.local_prices).medium" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                        Precio Medio {{ JSON.parse(form.product.local_prices).medium  }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input v-model="form.data.price" :value="JSON.parse(form.product.local_prices).under" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault3">
                                        Precio Minimo {{ JSON.parse(form.product.local_prices).under  }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-show="form.product.presentations" class="mb-4">
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Presentaciones Disponibles
                        </label>
                        <div class="flex">
                            <div v-if="!form.product.local_sizes">
                                <template v-for="(item, key) in JSON.parse(form.product.sizes)">
                                    <div class="form-check">
                                        <input :disabled="item.quantity == 0 ? '' : disabled" @change="selectSize(item)" :value="item.size" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="sizes" :id="'size'+ key">
                                        <label :class="item.quantity == 0 ? 'text-gray-500': 'text-gray-800'" class="form-check-label inline-block" :for="'size'+ key ">
                                            Talla: {{ item.size }} / Cantidad: {{ item.quantity }}
                                        </label>
                                    </div>
                                </template>
                            </div>
                            <div v-else>
                                <template v-for="(item, key) in JSON.parse(form.product.local_sizes)">
                                    <div class="form-check">
                                        <input :disabled="item.quantity == 0 ? '' : disabled" @change="selectSize(item)" :value="item.size" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="sizes" :id="'size'+ key">
                                        <label :class="item.quantity == 0 ? 'text-gray-500': 'text-gray-800'" class="form-check-label inline-block" :for="'size'+ key ">
                                            Talla: {{ item.size }} / Cantidad: {{ item.quantity }}
                                        </label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="mb-4">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Cantidad a vender
                        </label>
                        <input v-model="form.data.quantity" type="number" id="quantity" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div v-can="'sale_aplicar_descuento'" class="mb-4">
                        <label for="discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Descuento
                        </label>
                        <NumberInput
                            v-model="form.data.discount"
                            id="discount"
                        ></NumberInput>
                    </div>
                </div>
            </div>
        </template>
        <template #buttons>
            <DangerButton
                class="mr-3"
                @click="addProduct(form.product.presentations)"
            >
                Agregar
            </DangerButton>
        </template>
    </ModalLargeX>
</template>