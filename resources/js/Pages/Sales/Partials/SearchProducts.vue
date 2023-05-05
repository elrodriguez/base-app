<script setup>
    import DialogModal from '@/Components/DialogModal.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import swal from 'sweetalert';
    import NumberInput from '../../../Components/NumberInput.vue';

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
    const searchProducts = async () => {
        if(formScaner.scaner){
            axios.post(route('search_scaner_product'), form ).then((product) => {
                if(Object.entries(product).length > 0){
                    displayModal.value = true;
                    form.products = [];
                    form.product = product.data;
                    form.data.id = product.data.id;
                    form.data.interne = product.data.interne;
                    form.data.stock = product.data.stock;
                    form.data.description = product.data.description;
                    form.data.price = null;
                    form.data.total = 0;
                    form.data.quantity = 1;
                    form.data.discount = 0;
                    form.search = null;
                }else{
                    swal('No se encontró producto');
                }
                
            });
        }else{
            axios.post(route('search_product'), form ).then((res) => {
                if(res.data.success){
                    form.products = res.data.products;
                }else{
                    swal('No se encontró producto');
                }
                
            });
        }
    };
    const closeModalSelectProduct  = () => {
        displayModal.value = false;
    }
    const openModalSelectProduct = async (product) => {
        displayModal.value = true;
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

    const addProduct = () => {
        if(form.data.size){
            if(form.data.price){
                let total = parseFloat(form.data.quantity)*(parseFloat(form.data.price)-parseFloat(form.data.discount))
                form.data.total = total;
                let data = {
                    id: form.data.id,
                    interne: form.data.interne,
                    description: form.data.description,
                    price: form.data.price,
                    total: form.data.total,
                    quantity: form.data.quantity,
                    size: form.data.size,
                    discount: form.data.discount,
                }
                emit('eventdata',data);
                displayModal.value = false;
                form.data.size = null;
            }else{
                swal('Seleccionar Precio')
            }
        }else{
            swal('Seleccionar Talla')
        }
    }
</script>


<template>
    <div style="position: relative;">
        <form @submit.prevent="searchProducts()"> 
            <div class="flex">

                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 dark:border-gray-700 dark:text-white rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" >
                    <div class="mb-[0.125rem] block min-h-[1.5rem] pl-[1.5rem]">
                        <input
                            class="relative float-left mt-[0.15rem] mr-[6px] -ml-[1.5rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-[rgba(0,0,0,0.25)] bg-white outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:ml-[0.25rem] checked:after:-mt-px checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-t-0 checked:after:border-l-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:bg-white focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:ml-[0.25rem] checked:focus:after:-mt-px checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-t-0 checked:focus:after:border-l-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent"
                            type="checkbox"
                            v-model="formScaner.scaner"
                            id="scaner" />
                        <label
                            class="inline-block pl-[0.15rem] hover:cursor-pointer"
                            for="scaner">
                            Scaner
                        </label>
                    </div>
                </div>
                
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input v-model="form.search" autocomplete="off" type="search" id="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-r-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar Producto" required>
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </div>
            </div>
        </form>
        <div  id="result" style="position: absolute;width: 100%;z-index: 999999;">
            <div class="mt-1" style="max-height: 300px;overflow-y: auto;">
                <table class="min-w-full" >
                    <tbody>
                        <tr @click="openModalSelectProduct(product)" v-for="(product, index) in form.products" class="border-b bg-gray-100 boder-gray-900" style="cursor: pointer;">
                            <td class="text-sm font-medium px-6 py-4 whitespace-nowrap">
                                {{ product.interne }} - {{ product.description }}
                            </td>
                        </tr>
                    </tbody> 
                </table>
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
                                <div class="form-check">
                                    <input v-model="form.data.price" :value="JSON.parse(form.product.sale_prices).medium" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                        Precio Medio {{ JSON.parse(form.product.sale_prices).medium  }}
                                    </label>
                                </div>
                                <div class="form-check">
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
                    <div class="mb-4">
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tallas Disponibles
                        </label>
                        <div class="flex">
                            <div v-if="!form.product.local_sizes">
                                <template v-for="(item, key) in JSON.parse(form.product.sizes)">
                                    <div class="form-check">
                                        <input :disabled="item.quantity == 0 ? '' : disabled" v-model="form.data.size" :value="item.size" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="sizes" :id="'size'+ key">
                                        <label :class="item.quantity == 0 ? 'text-gray-500': 'text-gray-800'" class="form-check-label inline-block" :for="'size'+ key ">
                                            Talla: {{ item.size }} / Cantidad: {{ item.quantity }}
                                        </label>
                                    </div>
                                </template>
                            </div>
                            <div v-else>
                                <template v-for="(item, key) in JSON.parse(form.product.local_sizes)">
                                    <div class="form-check">
                                        <input :disabled="item.quantity == 0 ? '' : disabled" v-model="form.data.size" :value="item.size" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" name="sizes" :id="'size'+ key">
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
                            Cantidad a vender
                        </label>
                        <input v-model="form.data.quantity" type="number" id="quantity" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
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
        <template #footer>
            <DangerButton
                class="mr-3"
                @click="addProduct()"
            >
                Agregar
            </DangerButton>
            <SecondaryButton @click="closeModalSelectProduct">
                Cancel
            </SecondaryButton>
        </template>
    </DialogModal>
</template>