<script setup>
    import ModalLargeX from '@/Components/ModalLargeX.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import { ref, nextTick, watchEffect } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import swal from 'sweetalert';
    import { Input } from 'flowbite-vue'

    const astUrl = assetUrl;
    const props = defineProps({
        iconSearch: {
            type: Object,
            default: null
        }
    });



    const searchInput = ref(null);
    watchEffect(() => {
        if (searchInput.value) {
            searchInput.value.focus()
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
                    swal(response.data.message);
                }
                
            });
        }else{
            axios.post(route('search_product'), form ).then((response) => {
                if(response.data.success){
                    form.products = response.data.products;
                    displayResultSearch.value = true;
                }else{
                    swal(response.data.message);
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
        form.data.price = product.purchase_prices;
        form.data.total = 0;
        form.data.quantity = 1;
        form.data.discount = 0;
        form.search = null;
    }

    const emit = defineEmits(['eventdata']);

    const addProduct = (pre) => {

            if (pre){
                if(form.data.size){
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
                        swal('Seleccionar Precio')
                    }
                }else{
                    swal('Seleccionar Talla')
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
                    swal('Seleccionar Precio')
                }
            }
       
    }
    const setFocusToElement = async () => {
        nextTick(() => {
            const element = document.getElementById('searchInput');
            if (element) {
                element.focus();
            }
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
                                <input v-model="form.search" id="searchInput" ref="searchInput" type="text" placeholder="Buscar... " class="form-input shadow-[0_0_4px_2px_rgb(31_45_61_/_10%)] bg-white rounded-full h-11 placeholder:tracking-wider" autofocus />
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
        @close="closeModalSelectProduct"
    >
        <template #title>
            Detalles del Producto
        </template>
        <template #content>
            <div class="grid grid-cols-3">
                <div class="col-span-1">
                    <div class="flex flex-wrap justify-center p-4">
                        <img
                        :src="'/storage/'+form.product.image"
                        class="p-1 bg-white border rounded max-w-sm"
                        :alt="form.product.description"
                        style="width: 100%;"
                        />
                    </div>
                </div>
                <div class="col-span-2">
                    <h4>{{ form.product.interne  }} - {{ form.product.description  }}</h4>
                    <p class="my-4">Stock Actual : {{ form.data.stock  }}</p>
                    <div class="mb-4">
                        <Input
                            v-model="form.data.price"
                            placeholder="0.00"
                            label="Precio de compra"
                        />
                    </div>
                    <div v-show="form.product.presentations" class="mb-4">
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tallas Disponibles
                        </label>
                        <div class="flex">
                            <div v-if="!form.product.local_sizes">
                                <template v-for="(item, key) in JSON.parse(form.product.sizes)">
                                    <div class="form-check">
                                        <input v-model="form.data.size" :value="item.size" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="sizes" :id="'size'+ key">
                                        <label :class="item.quantity == 0 ? 'text-gray-500': 'text-gray-800'" class="form-check-label inline-block" :for="'size'+ key ">
                                            Talla: {{ item.size }} / Cantidad: {{ item.quantity }}
                                        </label>
                                    </div>
                                </template>
                            </div>
                            <div v-else>
                                <template v-for="(item, key) in JSON.parse(form.product.local_sizes)">
                                    <div class="form-check">
                                        <input v-model="form.data.size" :value="item.size" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="sizes" :id="'size'+ key">
                                        <label :class="item.quantity == 0 ? 'text-gray-500': 'text-gray-800'" class="form-check-label inline-block" :for="'size'+ key ">
                                            Talla: {{ item.size }} / Cantidad: {{ item.quantity }}
                                        </label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Cantidad compra
                        </label>
                        <input v-model="form.data.quantity" type="number" id="quantity" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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