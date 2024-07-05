<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { ref, onMounted } from 'vue';

    import IconX from '@/Components/vristo/icon/icon-x.vue';
    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import IconSave from '@/Components/vristo/icon/icon-save.vue';
    import IconSend from '@/Components/vristo/icon/icon-send.vue';
    import IconEye from '@/Components/vristo/icon/icon-eye.vue';
    import IconDownload from '@/Components/vristo/icon/icon-download.vue';
    import { useForm, Link } from "@inertiajs/vue3";
    import Swal2 from 'sweetalert2';
    import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
    
    const props = defineProps({
        student: {
            type: Object,
            default: () => ({}),
        },
        payments: {
            type: Object,
            default: () => ({}),
        },
        saleDocumentTypes: {
            type: Object,
            default: () => ({}),
        },
        services: {
            type: Object,
            default: () => ({}),
        },
        courses: {
            type: Object,
            default: () => ({}), 
        },
        taxes: {
            type: Object,
            default: () => ({}),
        }
    });

    
    const series = ref([]);

    const form = useForm({
        client_id: props.student.person.id,
        sale_documenttype_id: 2,
        serie: null,
        number: null,
        payments: [
            {
                type: 1,
                reference: null,
                amount: 0
            }
        ],
        additional_Information: null,
        date_end: null,
        date_issue: null,
        items:[],
        total_discount: 0,
        total_igv: 0,
        percentage_igv: 0,
        total: 0,
        total_taxed: 0
    });

    const getSeriesByDocumentType = () => {
        let did = form.sale_documenttype_id;
        axios.get(route('sale_document_series',did)).then((res) => {
            if (res.data.status) {
                series.value = res.data.series;
                form.serie = series.value[0].id;
            } else {
                Swal2.fire({
                    title: 'Información Importante',
                    text: 'No existe serie para este local o tipo de documento',
                    icon: 'info',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    denyButtonText: `Crear serie`,
                }).then((result) => {
                    if (result.isDenied) {
                        router.visit(route('establishments.index'),{
                            method: 'get'
                        });
                    }
                })
            }
        });
    }

    const addItem = (data,ttp) => {
        // 1 = servicio 2 = course
        const ddata = {
            id: data.id,
            mode: ttp,
            title: data.description,
            description: null,
            rate: 0,
            quantity: 1,
            amount: ttp == 1 ? JSON.parse(data.sale_prices).high : data.price ?? 0,
            discount: 0,
            m_igv: 0,
            total: 0,
            v_sale: 0,
            afe_igv: 10
        };

        if(ttp == 1){
            document.getElementById('service_checkbox-' + data.id).disabled = true;
        }else{
            document.getElementById('course_checkbox-' + data.id).disabled = true;
        }

        calculateTotals(ddata)
    };

    const removeItem = (data, index) => {
        console.log(index)
        removeCalculateTotals(index);
        if(data.mode == 1){
            let cbx = document.getElementById('service_checkbox-' + data.id);
            cbx.disabled = false;
            cbx.checked = false;
        }else{
            let cbx = document.getElementById('course_checkbox-' + data.id);
            cbx.disabled = false
            cbx.checked = false;
        }
        form.items.splice(index,1);
    };
    const xasset = assetUrl;

    const getUrlImage = (path) => {
        return xasset+'storage/'+path;
    }

    const addPayment = () => {
        let ar = {
            type: 1,
            reference: null,
            amount: 0
        };
        form.payments.push(ar);
    };

    const removePayment = (index) => {
        if(index>0){
            form.payments.splice(index,1);
        }
    };


    const normalizeString = (str) => {
      return str
        .normalize('NFD') // Descompone caracteres acentuados en sus componentes base
        .replace(/[\u0300-\u036f]/g, '') // Elimina los diacríticos
        .toLowerCase(); // Convierte a minúsculas
    }

    const coursesQuery = ref([]);
    const coursesInput = ref(null);
    const servicesQuery = ref([]);
    const servicesInput = ref(null);

    const searchCourses = () => {
      if (coursesInput.value) {
        const normalizedQuery = normalizeString(coursesInput.value);
        coursesQuery.value = props.courses.filter(item => 
          normalizeString(item.description).includes(normalizedQuery)
        );
      } else {
        coursesQuery.value = props.courses;
      }
    }

    const searchServices = () => {
      if (servicesInput.value) {
        const normalizedQuery = normalizeString(servicesInput.value);
        servicesQuery.value = props.services.filter(item => 
          normalizeString(item.description).includes(normalizedQuery)
        );
      } else {
        servicesQuery.value = props.courses;
      }
    }

    const taxes = ref({});
    const startTaxes = () => {
        
        let igv = parseFloat(props.taxes.igv);
        let icbper = parseFloat(props.taxes.icbper);

        let xa = {
            nfactorIGV: (igv / 100) + 1,
            rfactorIGV: (igv / 100),
            icbper: icbper
        }
        taxes.value = xa;
    }

    onMounted(() => {
        getSeriesByDocumentType();
        startTaxes();
        coursesQuery.value = props.courses;
        servicesQuery.value = props.services;
    });
    
    const calculateTotals = (data) => {
        let c = parseFloat(data.quantity) ?? 0;
        let p = parseFloat(data.amount) ?? 0;
        let d = parseFloat(data.discount) ?? 0;

        let vu = p / taxes.value.nfactorIGV; //valor unitario
        let fa = ((d * 100) / p) / 100; //factor del descuento
        let md = fa * vu * c; //monto del descuento
        let bi = (vu * c) - md; //base igv
        let mi = bi * taxes.value.rfactorIGV; //total igv por item
        let st = ((vu * c) - md) + mi;
        let vs = (vu * c) - md;
        
        // Verificar si el resultado es NaN y asignar 0 en su lugar
        if (isNaN(st)) {
            st = 0;
        }
        if (isNaN(mi)) {
            mi = 0;
        }
        if (isNaN(vs)) {
            vs = 0;
        }
        if (isNaN(md)) {
            md = 0;
        }

        data.m_igv = mi.toFixed(2);
        data.total = st.toFixed(2);
        data.v_sale = vs.toFixed(2);

        let tt = parseFloat(form.total) + st;
        let td = parseFloat(form.total_discount) + md;
        let tx = parseFloat(form.total_taxed) + vs;
        let ti = parseFloat(form.total_igv) + mi;
        // Calcular la suma de los totales de todos los items

        form.total = tt.toFixed(2);
        form.total_discount = td.toFixed(2);
        form.total_taxed = tx.toFixed(2);
        form.total_igv = ti.toFixed(2);
        form.items.push(data);
        form.payments[0].amount = form.total;
       
    }

    const removeCalculateTotals = (key) => {

        form.total = (parseFloat(form.total) - parseFloat(form.items[key].total)).toFixed(2);
        form.total_discount = (parseFloat(form.total_discount) - parseFloat(form.items[key].discount)).toFixed(2);
        form.total_taxed = (parseFloat(form.total_taxed) - parseFloat(form.items[key].v_sale)).toFixed(2);
        form.total_igv = (parseFloat(form.total_igv) - parseFloat(form.items[key].m_igv)).toFixed(2);
        form.payments[0].amount = form.total;
    }
    
    const saveDocument = () => {
        
        form.processing = true

        if(form.serie){
            if(form.client_dti != 6 && form.sale_documenttype_id == 1){
                Swal2.fire({
                    title: 'Información Importante',
                    text: "El cliente debe tener ruc para emitir una factura",
                    icon: 'error',
                });
                form.processing = false
                return;
                
            }

            axios.post(route('aca_student_invoice_store'), form ).then((res) => {
                form.client_id = props.client.id,
                form.client_name = props.client.number+"-"+props.client.full_name,
                form.client_ubigeo = props.client.ubigeo,
                form.client_dti = props.client.document_type_id,
                form.client_number = props.client.number,
                form.client_ubigeo_description = props.company.city,
                form.client_direction = props.company.fiscal_address,
                form.client_phone = props.client.telephone,
                form.client_email = props.client.email,
                form.sale_documenttype_id = 2,
                form.type_operation = props.type_operation,
                form.serie = null
                form.items = [];
                form.total_discount = 0;
                form.total_igv = 0;
                form.total = 0;
                form.total_taxed = 0;
                form.payments = [{
                    type:1,
                    reference: null,
                    amount:0
                }];
                getSeriesByDocumentType();
                form.processing =  false;
                Swal2.fire({
                    title: 'Comprobante creado con éxito',
                    text: "¿deseas enviar a sunat y/o Imprimir?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Enviar Ahora',
                    cancelButtonText: 'Seguir vendiendo',
                    showDenyButton: true,
                    denyButtonText: `Solo Imprimir`,
                    denyButtonColor: '#5E5A5A'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if(res.data.invoice_type_doc == '01'){
                            sendSunatDocumentCreated(res.data)
                        }else{
                            Swal2.fire({
                                title: 'Información Importante',
                                text: "Las boletas se envian mediante un resumen",
                                icon: 'info',
                            });
                        }
                    } else if (result.isDenied) {
                        downloadDocument(res.data.id,res.data.invoice_type_doc,'PDF')
                    }
                });
            }).catch(function (error) {
                console.log(error)
            });
        }else{
            Swal2.fire({
                title: 'Información Importante',
                text: "Elejir serie de documento",
                icon: 'error',
            });
            form.processing = false
            return;
        }
    }
</script>

<template>
    <AppLayout title="Cobrar">
        <div>
        <div class="flex xl:flex-row flex-col">
            <div class="panel px-0 flex-1 py-6 ltr:xl:mr-6 rtl:xl:ml-6">
                <div class="flex justify-between flex-wrap px-4">
                    <div class="mb-6 lg:w-1/2 w-full">
                        <div class="flex items-center text-black dark:text-white shrink-0">
                            <img :src="getUrlImage($page.props.company.logo)" alt="" style="width: 180px;" />
                        </div>
                        <div class="space-y-1 mt-6 text-gray-500 dark:text-gray-400">
                            <div>{{ $page.props.company.fiscal_address }}</div>
                            <div>{{ $page.props.company.email }}</div>
                            <div>{{ $page.props.company.phone }}</div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full lg:max-w-fit">
                        <div class="flex items-center">
                            <label for="sale_documenttype_id" class="ltr:mr-2 rtl:ml-2 w-1/3 mb-0">Tipo </label>
                            <select @change="getSeriesByDocumentType" v-model="form.sale_documenttype_id" id="sale_documenttype_id" class="form-select text-white-dark flex-1">
                                <option v-for="(type, index) in saleDocumentTypes" :value="type.id"> {{  type.description  }}</option>
                            </select>
                            <InputError :message="form.errors.sale_documenttype_id" class="mt-2" />
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="serie" class="ltr:mr-2 rtl:ml-2 w-1/3 mb-0">Serie </label>
                            <select @change="getSeriesByDocumentType" v-model="form.serie" id="serie" class="form-select text-white-dark flex-1">
                                <option v-for="(serie, index) in series" :value="serie.id"> {{  serie.description  }}</option>
                            </select>
                            <InputError :message="form.errors.serie" class="mt-2" />
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="startDate" class="ltr:mr-2 rtl:ml-2 w-1/3 mb-0">fecha de emisión</label>
                            <input id="startDate" type="date" name="inv-date" class="form-input flex-1" v-model="form.date_issue" />
                            <InputError :message="form.errors.date_issue" class="mt-2" />
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="dueDate" class="ltr:mr-2 rtl:ml-2 w-1/3 mb-0">Fecha de vencimiento</label>
                            <input id="dueDate" type="date" name="due-date" class="form-input flex-1" v-model="form.date_end" />
                            <InputError :message="form.errors.date_end" class="mt-2" />
                        </div>
                    </div>
                </div>
                <hr class="border-[#e0e6ed] dark:border-[#1b2e4b] my-6" />
                <div class="mt-8 px-4">
                    <div class="flex justify-between lg:flex-row flex-col">
                        <div class="w-full ltr:lg:mr-6 rtl:lg:ml-6 mb-6">
                            <div class="text-lg">Cobrar a :-</div>
                            <div class="mt-4 flex items-center">
                                <label for="reciever-name" class="ltr:mr-2 rtl:ml-2 w-1/3 mb-0">Nombre</label>
                                <input
                                    id="reciever-name"
                                    type="text"
                                    name="reciever-name"
                                    class="form-input flex-1"
                                    v-model="student.person.full_name"
                                    readonly
                                />
                            </div>
                            <div class="mt-4 flex items-center">
                                <label for="reciever-email" class="ltr:mr-2 rtl:ml-2 w-1/3 mb-0">Email</label>
                                <input
                                    id="reciever-email"
                                    type="email"
                                    name="reciever-email"
                                    class="form-input flex-1"
                                    v-model="student.person.email"
                                    placeholder="Enter Email"
                                />
                            </div>
                            <div class="mt-4 flex items-center">
                                <label for="reciever-address" class="ltr:mr-2 rtl:ml-2 w-1/3 mb-0">Dirección</label>
                                <input
                                    id="reciever-address"
                                    type="text"
                                    name="reciever-address"
                                    class="form-input flex-1"
                                    v-model="student.person.address"
                                    readonly
                                />
                            </div>
                            <div class="mt-4 flex items-center">
                                <label for="reciever-number" class="ltr:mr-2 rtl:ml-2 w-1/3 mb-0">Número de teléfono</label>
                                <input
                                    id="reciever-number"
                                    type="text"
                                    name="reciever-number"
                                    class="form-input flex-1"
                                    v-model="student.person.telephone"
                                    placeholder="Enter Phone number"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-1"></th>
                                    <th>Item</th>
                                    <th class="w-1">Cantidad</th>
                                    <th class="w-1">Precio</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="form.items.length <= 0">
                                    <tr>
                                        <td colspan="5" class="!text-center font-semibold">Ningún artículo disponible</td>
                                    </tr>
                                </template>
                                <template v-for="(item, i) in form.items" :key="i">
                                    <tr class="align-top">
                                        <td>
                                            <button type="button" @click="removeItem(item, i)">
                                                <icon-x class="w-5 h-5" />
                                            </button>
                                        </td>
                                        <td>
                                            <span>{{ item.title }}</span>
                                            <!-- <textarea class="form-textarea mt-4" placeholder="Enter Description" v-model="item.description"></textarea> -->
                                        </td>
                                        <td class="text-right">{{ item.quantity }}</td>
                                        <td class="text-right">{{ item.amount }}</td>
                                        <td class="text-right">S/. {{ item.amount * item.quantity }}</td>
                                        
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end sm:flex-row flex-col mt-6 px-4">
                        <div class="sm:w-2/5">
                            <div class="flex items-center justify-between">
                                <div>Subtotal</div>
                                <div>S/. {{ form.total_taxed }}</div>
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <div>IGV</div>
                                <div>S/. {{ form.total_igv }}</div>
                            </div>
                            <!-- <div class="flex items-center justify-between mt-4">
                                <div>Descuento</div>
                                <div>S/. {{ form.total_discount }}</div>
                            </div> -->
                            <div class="flex items-center justify-between mt-4 font-semibold">
                                <div>Total</div>
                                <div>S/. {{ form.total }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 px-4">
                    <div>
                        <label for="additional_Information">Informacion Adicional</label>
                        <textarea id="additional_Information" name="additional_Information" class="form-textarea min-h-[130px]" v-model="form.additional_Information"></textarea>
                    </div>
                </div>
            </div>
            <div class="xl:w-96 w-full xl:mt-0 mt-6">
                <div class="panel mb-5">
                    <h4 class="font-bold mb-4">SERVICIOS</h4>
                    <div v-if="services.length > 20" class="flex items-center max-w-lg mx-auto my-4">   
                        <label for="services-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <font-awesome-icon :icon="faMagnifyingGlass" />
                            </div>
                            <input v-model="servicesInput" @input="searchServices" @keyup.enter="searchServices" type="text" id="services-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar..." required />
                        </div>
                    </div>
                    <perfect-scrollbar
                        :options="{
                            swipeEasing: true,
                            wheelPropagation: false,
                        }"
                        class="h-[calc(50vh-40px)] relative"
                    >
                        <div class="flex flex-col rounded-md border border-[#e0e6ed] dark:border-[#1b2e4b]">
                            <div v-for="(service, co) in servicesQuery" class="flex space-x-4 rtl:space-x-reverse border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                <input :id="`service_checkbox-${service.id}`" @change="addItem(service,1)" type="checkbox" class="form-checkbox" />
                                <label :for="`service_checkbox-${service.id}`" class="mb-0 cursor-pointer flex justify-between w-full">
                                    <span>{{ service.description }}</span>
                                    <span class="badge bg-secondary my-auto ltr:ml-3 rtl:mr-3 hover:top-0 ml-auto">S/. {{ JSON.parse(service.sale_prices).high }}</span>
                                </label>
                            </div>
                        </div>
                    </perfect-scrollbar>
                </div>
                <div class="panel mb-5">
                    <h4 class="font-bold mb-4">Cursos</h4>
                    <div v-if="courses.length > 20" class="flex items-center max-w-lg mx-auto my-4">   
                        <label for="voice-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <font-awesome-icon :icon="faMagnifyingGlass" />
                            </div>
                            <input v-model="servicesInput" @input="searchCourses" @keyup.enter="searchCourses"  type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar..." required />
                        </div>
                    </div>
                    <perfect-scrollbar
                        :options="{
                            swipeEasing: true,
                            wheelPropagation: false,
                        }"
                        class="h-[calc(50vh-40px)] relative"
                    >
                        <div class="flex flex-col rounded-md border border-[#e0e6ed] dark:border-[#1b2e4b]">
                            <div v-for="(course, ix) in coursesQuery" class="flex space-x-4 rtl:space-x-reverse border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                <input :id="`course_checkbox-${course.id}`" @change="addItem(course,2)" type="checkbox" class="form-checkbox" />
                                <label :for="`course_checkbox-${course.id}`" class="mb-0 cursor-pointer flex justify-between w-full">
                                    <span>{{ course.description }}</span>
                                    <span class="badge bg-secondary my-auto ltr:ml-3 rtl:mr-3 hover:top-0 ml-auto">S/. {{ course.price ?? 0 }}</span>
                                </label>
                            </div>
                        </div>
                    </perfect-scrollbar>
                </div>
                <div class="panel mb-5">
                    <h4 class="font-bold">Medio de Pago <span @click="addPayment" class="text-primary italic" style="cursor: pointer;">(+) agregar</span></h4>
                    <div v-for="(pay, key) in form.payments" class="border rounded p-4 mt-4">
                        <div class="grid sm:grid-cols-3 grid-cols-1 gap-4">
                            <div>
                                <label for="reference">Tipo </label>
                                <select id="type" name="type" class="form-select" v-model="pay.type">
                                    <template v-for="(payment, i) in payments" :key="i">
                                        <option :value="payment.id">{{ payment.description }}</option>
                                    </template>
                                </select>
                            </div>
                            <div>
                                <label for="reference">Referencia </label>
                                <input v-model="pay.reference" id="reference" type="number" name="reference" class="form-input" />
                            </div>
                            <div>
                                <label for="amount">Monto </label>
                                <input v-model="pay.amount" id="amount" type="number" name="amount" class="form-input" />
                            </div>
                            <div v-if="key > 0" class="col-span-1 sm:col-span-3 flex justify-end">
                                <button @click="removePayment(key)" type="button">
                                    <icon-x class="w-5 h-5" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="grid xl:grid-cols-1 lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-4">
                        <button type="button" class="btn btn-success w-full gap-2">
                            <icon-save class="ltr:mr-2 rtl:ml-2 shrink-0" />
                            Save
                        </button>

                        <button type="button" class="btn btn-info w-full gap-2">
                            <icon-send class="ltr:mr-2 rtl:ml-2 shrink-0" />
                            Send Invoice
                        </button>

                        <Link href="/apps/invoice/preview" class="btn btn-primary w-full gap-2">
                            <icon-eye class="ltr:mr-2 rtl:ml-2 shrink-0" />
                            Preview
                        </Link>

                        <button type="button" class="btn btn-secondary w-full gap-2">
                            <icon-download class="ltr:mr-2 rtl:ml-2 shrink-0" />
                            Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </AppLayout>
</template>