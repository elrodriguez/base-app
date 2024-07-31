<script setup>
    import DialogModal from '@/Components/ModalLargeX.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import swal from 'sweetalert';
    import NumberInput from '@/Components/NumberInput.vue';

    const astUrl = assetUrl;
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
        form.data.price = JSON.parse(product.sale_prices).high;
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
                    form.data.total = total.toFixed(2);
                    let data = {
                        id: form.data.id,
                        interne: form.data.interne,
                        description: form.data.description,
                        price: form.data.price,
                        total: form.data.total,
                        quantity: form.data.quantity,
                        size: form.data.size,
                        discount: form.data.discount,
                        presentations: pre
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
                form.data.total = total.toFixed(2);
                let data = {
                    id: form.data.id,
                    interne: form.data.interne,
                    description: form.data.description,
                    price: form.data.price,
                    total: form.data.total,
                    quantity: form.data.quantity,
                    size: form.data.size,
                    discount: form.data.discount,
                    presentations: pre
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
</script>


<template>
    <div style="position: relative;">
        <form @submit.prevent="searchProducts()">
            <div class="flex">
                <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">Scaner</div>
                <div class="bg-[#eee] flex justify-center items-center rounded-none px-3 font-semibold ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">
                    <input v-model="formScaner.scaner" value="" id="scaner" type="checkbox" class="form-checkbox border-[#e0e6ed] dark:border-white-dark ltr:mr-0 rtl:ml-0" />
                </div>
                <input v-model="form.search" autocomplete="off" type="text" class="form-input ltr:rounded-l-none rtl:rounded-r-none ltr:rounded-r-none rtl:rounded-l-none" placeholder="Buscar por código o descripción..." required />
                <button type="submit" class="btn btn-secondary ltr:rounded-l-none rtl:rounded-r-none">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
        </form>
        <div v-show="displayResultSearch" id="result" style="position: absolute; width: 100%;z-index: 999;">
            <div class="mt-1 border border-white dark:border-gray-600" style="max-height: 100%;overflow-y: auto;">
                <ul class="w-full divide-y">
                    <li v-for="(product, index) in form.products" class="p-2 border-b border-white bg-gray-100 sm:pb-4 dark:bg-gray-800 dark:border-gray-600 " >
                        <div @click="openModalSelectProduct(product)" style="cursor: pointer;" class="flex items-center space-x-4">
                            <div class="flex-shrink-0" >
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
                            <div class="flex-1 min-w-0 ml-2">
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
                    <li class="flex justify-end bg-gray-100 dark:bg-gray-900 border-none" >
                        <button @click="displayResultSearch = false" class="right-2 flex items-center justify-center w-8 h-8 text-red-500 hover:text-red-700 dark:text-red-100 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                fill-rule="evenodd"
                                d="M5.293 4.293a1 1 0 011.414 0L10 8.586l3.293-3.293a1 1 0 111.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <DialogModal 
        :show="displayModal" 
        @close="closeModalSelectProduct"
    >
        <template #title>
            Detalles del Producto
        </template>
        <template #message>
            {{ form.product.interne  }} - {{ form.product.description  }}
        </template>
        <template #content>
            <div class="grid grid-cols-6">
                <div class="col-span-6 sm:col-span-2 md:col-span-2">
                    <div class="flex flex-wrap justify-center p-4">
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
                    <p v-if="form.product.is_product" class="my-4 text-center">Stock Actual : {{ form.data.stock  }}</p>
                </div>
                <div class="col-span-6 sm:col-span-2 md:col-span-2">
                    <div class="mb-4">
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Precios Disponibles
                        </label>
                        <div class="flex">
                            <div v-if="!form.product.local_prices">
                                <div v-if="JSON.parse(form.product.sale_prices).high">
                                    <label class="inline-flex" for="flexRadioDefault1">
                                        <input v-model="form.data.price" :value="JSON.parse(form.product.sale_prices).high"  type="radio" class="form-radio rounded-full peer" name="flexRadioDefault" id="flexRadioDefault1" />
                                        <span class="peer-checked:text-primary"> Precio Normal {{ JSON.parse(form.product.sale_prices).high  }}</span>
                                    </label>
                                </div>
                                <div v-if="JSON.parse(form.product.sale_prices).medium">
                                    <label class="inline-flex" for="flexRadioDefault2">
                                        <input v-model="form.data.price" :value="JSON.parse(form.product.sale_prices).medium" class="form-radio rounded-full peer" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                        <span class="peer-checked:text-primary">Precio Medio {{ JSON.parse(form.product.sale_prices).medium  }}</span>
                                    </label>
                                </div>
                                <div v-if="JSON.parse(form.product.sale_prices).under" >
                                    <label class="inline-flex" for="flexRadioDefault3">
                                        <input v-model="form.data.price" :value="JSON.parse(form.product.sale_prices).under" class="form-radio rounded-full peer" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                        <span class="peer-checked:text-primary">Precio Minimo {{ JSON.parse(form.product.sale_prices).under  }}</span>
                                    </label>
                                </div>
                            </div>
                            <div v-else>
                                <div >
                                    <label class="inline-flex" for="flexRadioDefault1">
                                        <input v-model="form.data.price" :value="JSON.parse(form.product.local_prices).high" class="form-radio rounded-full peer" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <span class="peer-checked:text-primary">Precio Normal {{ JSON.parse(form.product.local_prices).high  }}</span>
                                    </label>
                                </div>
                                <div >
                                    <label class="inline-flex" for="flexRadioDefault2">
                                        <input v-model="form.data.price" :value="JSON.parse(form.product.local_prices).medium" class="form-radio rounded-full peer" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    
                                        <span class="peer-checked:text-primary">Precio Medio {{ JSON.parse(form.product.local_prices).medium  }}</span>
                                    </label>
                                </div>
                                <div >
                                    <label class="inline-flex" for="flexRadioDefault3">
                                        <input v-model="form.data.price" :value="JSON.parse(form.product.local_prices).under" class="form-radio rounded-full peer" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    
                                        <span class="peer-checked:text-primary">Precio Minimo {{ JSON.parse(form.product.local_prices).under  }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-show="form.product.presentations" class="mb-4">
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tallas Disponibles
                        </label>
                        <div class="flex">
                            <div v-if="!form.product.local_sizes">
                                <template v-for="(item, key) in JSON.parse(form.product.sizes)">
                                    <div >
                                        <label :class="item.quantity == 0 ? 'text-gray-500': ''" class="inline-flex" :for="'size'+ key ">
                                        <input :disabled="item.quantity == 0 ? '' : disabled" v-model="form.data.size" :value="item.size" class="form-radio text-success peer" type="radio" name="sizes" :id="'size'+ key">
                                        
                                            <span class="peer-checked:text-success">Talla: {{ item.size }} / Cantidad: {{ item.quantity }}</span>
                                        </label>
                                    </div>
                                </template>
                            </div>
                            <div v-else>
                                <template v-for="(item, key) in JSON.parse(form.product.local_sizes)">
                                    <div >
                                        <label :class="item.quantity == 0 ? 'text-gray-500': ''" class="inline-flex" :for="'size'+ key ">
                                            <input :disabled="item.quantity == 0 ? '' : disabled" v-model="form.data.size" :value="item.size" class="form-radio text-success peer" type="radio" name="sizes" :id="'size'+ key">
                                        
                                            <span class="peer-checked:text-success">Talla: {{ item.size }} / Cantidad: {{ item.quantity }}</span>
                                        </label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-2 md:col-span-2">
                    <div class="mb-4">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Cantidad a vender
                        </label>
                        <input v-model="form.data.quantity" type="number" id="quantity" class="form-input">
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
            <DangerButton @click="addProduct(form.product.presentations)" >
                Agregar
            </DangerButton>
        </template>
    </DialogModal>
</template>