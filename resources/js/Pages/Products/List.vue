<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import { faTrashAlt, faPencilAlt, faPrint, faWarehouse, faDollarSign, faTruck } from "@fortawesome/free-solid-svg-icons";
    import Pagination from '@/Components/Pagination.vue';
    import DialogModal from '@/Components/DialogModal.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { ref } from 'vue';
    import swal from 'sweetalert';
    import Keypad from '@/Components/Keypad.vue';
    import ModalLarge from '@/Components/ModalLarge.vue';
    import VueMagnifier from '@websitebeaver/vue-magnifier'
    import '@websitebeaver/vue-magnifier/styles.css'

    const props = defineProps({
        products: {
            type: Object,
            default: () => ({}),
        },
        establishments: {
            type: Object,
            default: () => ({}),
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
    })
    const form = useForm({
        search: props.filters.search,
    });

    const formDetails = useForm({
        usine: '',
        interne: '',
        description: '',
        image: '',
        purchase_prices: '',
        sale_prices:{
            high:'',
            medium: '',
            under:''
        },
        sizes: [{
            size:'',
            quantity: ''
        }],
        stock_min:'',
        stock:'',
        quantity_total:''

    });

    const formDelete = useForm({});
    const openModalDetilsProduct = ref(false);
    const openModalEntrada = ref(false);
    const openModalTraslado = ref(false);
    const displayModalPrices = ref(false);

    const showDetailProduct = (product) => {
        formDetails.interne = product.interne;
        formDetails.description = product.description;
        formDetails.purchase_prices = product.purchase_prices;
        formDetails.sale_prices = JSON.parse(product.sale_prices);
        formDetails.sizes = JSON.parse(product.sizes);
        formDetails.stock_min = product.stock_min;
        formDetails.stock = product.stock;
        formDetails.quantity_total=0;
        formDetails.sizes.forEach(size => {
            formDetails.quantity_total+= parseFloat(size.quantity); //*1 para parsear a numero
        });


        openModalDetilsProduct.value = true;
    }

    function destroy(id) {
        if (confirm("¿Estás seguro de que quieres eliminar?")) {
            formDelete.delete(route('products.destroy', id));
        }

    }
    const closeModalDetailsProduct = () => {
      openModalDetilsProduct.value = false;
    }

    const closeModalEntradaSalida = () => {
      openModalEntrada.value = false;
    }

    const closeModalTrasladoMercaderia = () => {
      openModalTraslado.value = false;
    }

    const openModalEntradaSalida = (d) => {

      formInput.type = d;
      openModalEntrada.value = true;
    }




    const formInput = useForm({
        type: 1,
        motion: 'purchase',
        product_id: '',
        local_id: 1,
        local_id_destino:1,
        local_id_origen:1,
        quantity: 1,
        description: '',
        sizes: [{
            size:'',
            quantity: ''
        }],
    });

    const dataProducts= useForm({
      products: [],
      search:''
    });

    const dataProductByLocal= useForm({
      product: []
    });

    const searchProducts = async () => {
        axios.post(route('search_product_all'), dataProducts ).then((res) => {
          dataProducts.products = res.data.products;
          document.getElementById('resultSearch').style.display = 'block';
        });
    };


    const saveProductInput = () => {
      formInput.post(route('input_products'), {
          errorBag: 'saveProductInput',
          preserveScroll: true,
          onSuccess: () => {
            formInput.reset()
            dataProducts.search = null;
            swal('Se registro correctamente.');
          },
      });
    }

    const selectProducts = (product) => {
      formInput.product_id = product.id;
      dataProducts.search = product.interne+ ' - '+ product.description;
      document.getElementById('resultSearch').style.display = 'none';
    }

    const addSize = () => {
        let ar = {
            size:'',
            quantity: ''
        };
        formInput.sizes.push(ar);
    };

    const removeSize = (index) => {
        if(index>0){
          formInput.sizes.splice(index,1);
        }
    };



    const dataPrices= useForm({
        product: {},
        product_name: '',
        product_id:'',
        locals:[]
    });

    const openModalPrices = (product) => {
      dataPrices.product = product;
      dataPrices.product_id = product.id;
      dataPrices.product_name = product.interne+ ' - ' +product.description;

      axios.get(route('product_prices',product.id)).then((objeto) => {
        if (Object.keys(objeto.data).length === 0) {
          for (let propiedad in props.establishments) {
            dataPrices.locals[propiedad] = {
              local_id: props.establishments[propiedad]['id'],
              local_name: props.establishments[propiedad]['description'],
              local_price1: JSON.parse(product.sale_prices)['high'],
              local_price2: JSON.parse(product.sale_prices)['medium'],
              local_price3: JSON.parse(product.sale_prices)['under']
            }
          }
        } else {
          for (let propiedad in objeto.data) {
            dataPrices.locals[propiedad] = {
              local_id: objeto.data[propiedad]['local_id'],
              local_name: objeto.data[propiedad]['description'],
              local_price1: objeto.data[propiedad]['high'],
              local_price2: objeto.data[propiedad]['medium'],
              local_price3: objeto.data[propiedad]['under']
            }
          }
        }
      });


      displayModalPrices.value = true;
    }

    const closeModalPrices = () => {
      displayModalPrices.value = false;
    }

    const saveProductPrices = () => {
      dataPrices.post(route('product_prices_establishments'), {
          errorBag: 'saveProductPrices',
          preserveScroll: true,
          onSuccess: () => {
            swal('Precios registrados correctamente');
          },
      });
    }




    const formReLocate = useForm({
        product_id: '',
        product_full_name: '',
        local_id_origin: 1,
        local_id_destiny: '',
        description:'',
        sizes: []
    });

    const openModalTrasladoMercaderia = (product) => {
        formReLocate.product_id = product.id;
        formReLocate.product_full_name = product.interne+' - '+product.description
        getProductByLocal();
        openModalTraslado.value = true;
    }

    function getProductByLocal(){
        formReLocate.sizes = [];
        axios.post(route('get_product_by_local'), formReLocate ).then((res) => {
            let dataSizes = res.data;
            for (let i = 0; i < dataSizes.length; i++) {
              formReLocate.sizes[i] = dataSizes[i];
            }
        });
    }

    function saveRelocate(){
      formReLocate.post(route('relocate_product_sizes'), {
          errorBag: 'saveRelocate',
          preserveScroll: true,
          onSuccess: () => {
            swal('Traslado registrados correctamente');
            formReLocate.sizes = [];
            formReLocate.description="";
            formReLocate.local_id_destiny="";
            openModalTraslado.value = false;
          },
      });
    }

</script>
<template>
    <AppLayout title="Productos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
                Productos
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="col-span-6 p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                  <div class="grid grid-cols-2 gap-4 pb-4">
                       <div class="col-span-2 sm:col-span-1">
                          <form @submit.prevent="form.get(route('products.index'))">
                              <label for="table-search" class="sr-only">Search</label>
                              <div class="relative">
                                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                      <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                  </div>
                                  <input v-model="form.search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar productos">
                              </div>
                          </form>
                       </div>
                        <div class="col-span-2 sm:col-span-1 text-right">
                          <Keypad>
                            <template #botones>
                                <button v-can="'productos_salida'" @click="openModalEntradaSalida(0)" type="button" class="mr-1 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Salidas</button>
                                <button v-can="'productos_entrada'" @click="openModalEntradaSalida(1)" type="button" class="mr-1 inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">Entradas</button>
                                <button type="button"                                                                class="mr-1 inline-block px-6 py-2.5 bg-green-700 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-800 hover:shadow-lg focus:ring-green-300  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 transition duration-150 ease-in-out" >Importar</button>
                                <a v-can="'productos_nuevo'" :href="route('products.create')" class="flex items-center justify-center inline-block px-6 py-2.5 bg-blue-900 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                  Nuevo
                                </a>
                            </template>
                          </Keypad>
                        </div>
                    </div>
                    <div class="mb-4 relative shadow-md sm:rounded-lg">
                      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                              <tr>
                                  <th class="px-6 py-3">
                                  #
                                  </th>
                                  <th class="text-center px-6 py-3">
                                      Acción
                                  </th>
                                  <th class="text-center px-6 py-3">
                                      Imagen
                                  </th>
                                  <th class="px-6 py-3">
                                      Código
                                  </th>
                                  <th class="px-6 py-3">
                                      Descripción
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(product, index) in products.data" :key="product.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                  <td class="px-6 py-2">
                                      {{ index + 1 }}
                                  </td>
                                  <td class="w-80 px-6 py-4">
                                      <div class="flex space-x-2 justify-center">
                                          <div>
                                              <a v-permission="'productos_editar'" title="Editar" :href="route('products.edit',product.id)" class="mr-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                  <font-awesome-icon :icon="faPencilAlt" />
                                              </a>
                                              <button title="Mover Mercadería/Calzados" type="button" class="mr-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                              @click="openModalTrasladoMercaderia(product)"
                                              >
                                                <font-awesome-icon :icon="faTruck" />
                                              </button>
                                              <button type="button" class="mr-1 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                                  <font-awesome-icon :icon="faPrint" />
                                              </button>
                                              <button
                                                @click="openModalPrices(product)"
                                                title="precios por tienda"
                                                type="button"
                                                class="mr-1 text-white bg-gray-400 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-gray-400 dark:hover:bg-gray-400 dark:focus:ring-gray-400">
                                                  <font-awesome-icon :icon="faDollarSign" />
                                              </button>
                                              <button title="ver Stock" type="button" class="mr-1 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"
                                                @click="showDetailProduct(product)"
                                              >
                                                <font-awesome-icon :icon="faWarehouse" />
                                              </button>
                                              <button type="button" class="mr-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                                @click="destroy(product.id)"
                                                >
                                                <font-awesome-icon :icon="faTrashAlt" />
                                            </button>

                                          </div>
                                      </div>
                                  </td>
                                  <td class="w-32 p-4">

                                    <VueMagnifier
                                      :src="product.image" width="500"
                                      :zoomImgSrc="product.image"
                                      :mgWidth="210"
                                      :mgHeight="210"
                                      />

                                  </td>
                                  <td class="px-6 py-4">
                                      {{ product.interne }}
                                  </td>
                                  <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                      {{ product.description }}
                                  </td>
                              </tr>

                          </tbody>
                      </table>
                    </div>
                    <Pagination :data="products" />
                </div>

            </div>
        </div>

        <DialogModal :show="openModalDetilsProduct" @close="closeModalDetailsProduct">
            <template #title>
              {{ formDetails.interne }} - {{ formDetails.description }}
            </template>

            <template #content>
              <table class="border" style="width: 100%;">
                    <thead class="bg-white border-b">
                      <tr class="text-xs text-white bg-blue-700 border-b dark:text-white">
                        <th class="text-lg font-medium  px-6 py-4 text-left italic hover:not-italic">
                          Tallas
                        </th>
                        <th class="text-lg font-medium  px-6 py-4 text-left italic hover:not-italic">
                          Cantidad
                        </th>
                        <th class="text-lg font-medium  px-6 py-4 text-left italic hover:not-italic">
                          Precio V. Normal
                        </th>
                        <th class="text-lg font-medium  px-6 py-4 text-left italic hover:not-italic">
                          Precio V. Medio
                        </th>
                        <th class="text-lg font-medium  px-6 py-4 text-left italic hover:not-italic">
                          Precio V. Minimo
                        </th>
                        <th class="text-lg font-medium  px-6 py-4 text-left italic hover:not-italic">
                          Precio de Compra
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr v-for="(size, index) in formDetails.sizes" :key="formDetails.id"  class="border-b">
                        <td class="text-right px-6 py-4 text-sm font-medium text-white bg-blue-500">
                          {{ size.size }}</td>
                        <td class="text-right text-sm text-white font-light px-6 py-4 bg-blue-700">
                          {{ size.quantity }}
                        </td>
                        <td class="text-right text-sm text-white font-light px-6 py-4 bg-blue-500">
                          S/. {{ formDetails.sale_prices.high }}
                        </td>
                        <td class="text-right text-sm text-white font-light px-6 py-4 bg-blue-700">
                          S/. {{ formDetails.sale_prices.medium }}
                        </td>
                        <td class="text-right text-sm text-white font-light px-6 py-4 bg-blue-500">
                          S/. {{ formDetails.sale_prices.under }}
                        </td>
                        <td class="text-right text-sm text-white font-light px-6 py-4 bg-blue-700">
                          S/. {{ formDetails.purchase_prices }}
                        </td>
                      </tr>


                      <tr class=" border-b">
                        <td class="text-right px-6 py-4 text-sm font-medium bg-blue-500 text-white">
                            Totales
                        </td>
                        <td class="text-right text-sm text-white font-light bg-blue-700 px-6 py-4 ">
                          {{ formDetails.quantity_total }}
                        </td>
                        <td class="text-right text-sm text-white font-light bg-blue-500 px-6 py-4">
                          S/. {{ formDetails.quantity_total*formDetails.sale_prices.high }}
                        </td>
                        <td class="text-right text-sm text-white font-light bg-blue-700 px-6 py-4">
                          S/. {{ formDetails.quantity_total*formDetails.sale_prices.medium }}
                        </td>
                        <td class="text-right text-sm text-white font-light bg-blue-500 px-6 py-4">
                          S/. {{ formDetails.quantity_total*formDetails.sale_prices.under }}
                        </td>
                        <td class="text-right text-sm text-white font-light bg-blue-700 px-6 py-4">
                          S/. {{ formDetails.quantity_total*formDetails.purchase_prices }}
                        </td>
                      </tr>

                      <tr class="border-b">
                        <td colspan="2" class="text-right px-6 py-4 text-sm bg-green-800 font-medium text-white">
                          Ganancias Esperadas
                        </td>
                        <td class="text-right text-sm text-white font-light bg-green-600 px-6 py-4">
                          S/. {{ formDetails.quantity_total*formDetails.sale_prices.high-(formDetails.quantity_total*formDetails.purchase_prices) }}
                        </td>
                        <td class="text-right text-sm text-white font-light bg-green-800 px-6 py-4">
                          S/. {{ formDetails.quantity_total*formDetails.sale_prices.medium-(formDetails.quantity_total*formDetails.purchase_prices) }}
                        </td>
                        <td class="text-right text-sm text-white font-light bg-green-600 px-6 py-4">
                          S/. {{ formDetails.quantity_total*formDetails.sale_prices.under-(formDetails.quantity_total*formDetails.purchase_prices) }}
                        </td>
                        <td class="text-sm text-white font-light bg-green-800 px-6 py-4">
                          <!-- no usar esta clase whitespace-nowrap -->
                        </td>
                      </tr>
                    </tbody>
                  </table>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModalDetailsProduct">
                    Cancel
                </SecondaryButton>
            </template>
        </DialogModal>

        <DialogModal
          :show="openModalEntrada"
          @close="closeModalEntradaSalida"

          >
            <template #title>
              {{ formInput.type == 1 ? 'Entrada' : 'Salida' }} de producto
            </template>

            <template #content>
                <div class="mt-4 mb-1">
                  <div style="position: relative;">
                    <div class="bg-white dark:bg-gray-900">
                      <label for="table-search" class="sr-only">Search</label>
                      <div class="relative mt-1">
                          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                              <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                          </div>
                          <input @keyup.enter="searchProducts" v-model="dataProducts.search" autocomplete="off" type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar producto">
                      </div>
                      <InputError :message="formInput.errors.product_id" class="mt-2" />
                    </div>
                    <div class="mt-1" id="resultSearch" style="position: absolute;width: 100%;z-index: 1000000;display: none;">
                        <div style="height: 300px;overflow-y: auto;">
                            <table class="min-w-full" >
                                <tbody>
                                    <tr v-for="(product, index) in dataProducts.products" class="border-b bg-gray-100 boder-gray-900" style="cursor: pointer;">
                                        <td @click="selectProducts(product)" class="text-sm font-medium px-6 py-4 whitespace-nowrap">
                                            {{ product.interne }} - {{ product.description }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                  <div class="col-span-2 sm:col-span-1">
                    <InputLabel for="stablishment" value="Establecimiento" />
                    <select v-model="formInput.local_id" id="stablishment" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <template v-for="(establishment, index) in props.establishments" :key="index">
                          <option :value="establishment.id">{{ establishment.description }}</option>
                      </template>
                    </select>
                    <InputError :message="formInput.errors.local_id" class="mt-2" />
                  </div>
                  <div class="col-span-2 sm:col-span-1">
                    <InputLabel for="description" value="Descripción" />
                    <TextInput
                        id="description"
                        v-model="formInput.description"
                        type="text"
                        class="block w-full mt-1"
                        autofocus
                    />
                    <InputError :message="formInput.errors.description" class="mt-2" />
                  </div>
                  <div class="col-span-6 sm:col-span-6">
                      <label>
                          Tallas
                          <button @click="addSize" type="button" class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out">Agregar</button>
                      </label>
                      <div v-for="(item, index) in formInput.sizes" v-bind:key="index">
                          <table style="width: 100%;">
                              <tr>
                                  <td style="padding: 4px;">
                                      <div class="col-span-3 sm:col-span-2">
                                          <InputLabel value="Talla" />
                                          <TextInput
                                              v-model="item.size"
                                              type="text"
                                              class="block w-full mt-1"
                                              autofocus
                                          />
                                          <InputError :message="formInput.errors[`sizes.${index}.size`]" class="mt-2" />
                                      </div>
                                  </td>
                                  <td style="padding: 4px;">
                                      <div class="col-span-3 sm:col-span-2">
                                          <InputLabel value="Cantidad" />
                                          <TextInput
                                              v-model="item.quantity"
                                              type="number"
                                              class="block w-full mt-1"
                                              autofocus
                                          />
                                          <InputError :message="formInput.errors[`sizes.${index}.quantity`]" class="mt-2" />
                                      </div>
                                  </td>
                                  <td style="padding: 4px;" valign="bottom">
                                      <button @click="removeSize(index)" type="button" class="inline-block rounded-full bg-blue-600 text-white leading-normal uppercase shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-9 h-9">
                                          <font-awesome-icon :icon="faTrashAlt" />
                                      </button>
                                  </td>
                              </tr>
                          </table>
                      </div>
                  </div>
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModalEntradaSalida">
                    Cancel
                </SecondaryButton>

                <DangerButton
                    class="ml-3"
                    :class="{ 'opacity-25': formInput.processing }"
                    :disabled="formInput.processing"
                    @click="saveProductInput"
                >
                    Guardar
                </DangerButton>
            </template>
        </DialogModal>




        <DialogModal
          :show="openModalTraslado"
          @close="closeModalTrasladoMercaderia"

          >
            <template #title>
              Traslado de {{ formReLocate.product_full_name }}
            </template>

            <template #content>
                <div class="mt-4 mb-1">
<!-- Trabajando -->
                </div>
                <div class="grid grid-cols-2 gap-4">

                  <div class="col-span-2 sm:col-span-1">

                                                                                                             <!-- ----------Origen -------->
                    <InputLabel for="stablishment" value="Establecimiento Origen" />
                    <select v-model="formReLocate.local_id_origin"  v-on:change="getProductByLocal()" id="stablishment" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <template v-for="(establishment, index) in props.establishments" :key="index">
                          <option :value="establishment.id">{{ establishment.description }}</option>
                      </template>
                    </select>
                    <InputError :message="formReLocate.errors.local_id_origin" class="mt-2" />
                  </div>
                                                                                                                        <!-- Destino-->
                  <div class="col-span-2 sm:col-span-1">
                    <InputLabel for="stablishment" value="Establecimiento Destino" />
                    <select v-model="formReLocate.local_id_destiny" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <template v-for="(establishment, index) in props.establishments" :key="index">
                          <option :value="establishment.id">{{ establishment.description }}</option>
                      </template>
                    </select>
                    <InputError :message="formReLocate.errors.local_id_destiny" class="mt-2" />
                  </div>

                  <div class="col-span-2 sm:col-span-1">
                    <InputLabel for="description" value="Descripción o Motivo" />
                    <TextInput
                        id="description"
                        v-model="formReLocate.description"
                        type="text"
                        class="block w-full mt-1"
                        autofocus
                    />
                    <InputError :message="formReLocate.errors.description" class="mt-2" />
                  </div>
                  <div class="col-span-6 sm:col-span-6">
                      <label>
                          Tallas Disponibles en el local de origen
                      </label>
                      <div v-for="(item, index) in formReLocate.sizes" v-bind:key="index">
                          <table style="width: 100%;">
                              <tr>
                                  <td style="padding: 4px;">
                                      <div class="col-span-3 sm:col-span-2">
                                          <InputLabel value="Talla" />
                                          <TextInput
                                              readonly
                                              v-model="item.size"
                                              type="text"
                                              class="bg-gray-200 block w-full mt-1"
                                              autofocus
                                          />

                                      </div>
                                  </td>
                                  <td style="padding: 4px;">
                                      <div class="col-span-3 sm:col-span-2">
                                          <InputLabel value="Cantidad" />
                                          <TextInput

                                            readonly
                                              v-model="item.quantity"
                                              type="number"
                                              class="bg-gray-200 block w-full mt-1"
                                              autofocus
                                          />

                                      </div>
                                  </td>
                                  <td style="padding: 4px;" valign="bottom">
                                    <div class="col-span-3 sm:col-span-2">
                                          <InputLabel value="Cantidad a trasladar" />
                                          <TextInput
                                          v-model="item.quantity_relocate"
                                              type="text"
                                              class="block w-full mt-1"
                                              autofocus/>
                                              <InputError :message="formReLocate[`sizes.${index}.quantity_relocate`]" class="mt-2" />
                                      </div>
                                  </td>
                              </tr>
                          </table>
                      </div>
                  </div>
                </div>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModalTrasladoMercaderia()">
                    Cancel
                </SecondaryButton>

                <DangerButton
                    class="ml-3"
                    :class="{ 'opacity-25': formInput.processing }"
                    :disabled="formInput.processing"
                    @click="saveRelocate()"
                >
                    Guardar
                </DangerButton>
            </template>
        </DialogModal>




        <ModalLarge
          :show="displayModalPrices"
          :onClose="closeModalPrices"
        >
          <template #title>
              {{ dataPrices.product_name }}
          </template>
          <template #message>
              Precios Por Tienda
          </template>
          <template #content>
            <div class="flex flex-col">
              <div class="overflow-y-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                  <div class="overflow-hidden">
                    <table class="min-w-full text-sm font-light">
                      <thead class="border font-medium dark:border-neutral-500">
                        <tr>
                          <th scope="col" class="px-6 py-2">Tienda</th>
                          <th scope="col" class="px-6 py-2">P. Normal</th>
                          <th scope="col" class="px-6 py-2">P. Medio</th>
                          <th scope="col" class="px-6 py-2">P. Minimo</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(local, fe) in dataPrices.locals" :key="fe"
                          class="border dark:border-neutral-500"
                          >
                          <td class=" px-6 py-2">{{  local.local_name  }}</td>
                          <td class=" px-6 py-2">
                            <input
                              v-model="local.local_price1"
                              type="text" class="text-right block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              <InputError :message="dataPrices.errors[`sizes.${index}.local_price1`]" class="mt-2" />
                          </td>
                          <td class=" px-6 py-2">
                            <input
                            v-model="local.local_price2"
                            type="text" class="text-right block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <InputError :message="dataPrices.errors[`sizes.${index}.local_price2`]" class="mt-2" />
                          </td>
                          <td class=" px-6 py-2">
                            <input
                            v-model="local.local_price3"
                            type="text" class="text-right block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <InputError :message="dataPrices.errors[`sizes.${index}.local_price3`]" class="mt-2" />
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template #buttons>
            <DangerButton
                class="mr-3"
                @click="saveProductPrices()"
            >
                Guardar
            </DangerButton>
          </template>
        </ModalLarge>
    </AppLayout>
</template>
