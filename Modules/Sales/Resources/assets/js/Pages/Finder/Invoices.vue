<script setup>
    import AuthLayout from '@/Layouts/Vristo/AuthLayout.vue';
    import { ref, onMounted } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import flatPickr from 'vue-flatpickr-component';
    import { Spanish } from "flatpickr/dist/l10n/es.js"
    import 'flatpickr/dist/flatpickr.css';

    import IconFilePdf from '@/Components/vristo/icon/icon-file-pdf.vue';
    import IconFileXml from '@/Components/vristo/icon/icon-file-xml.vue';

    const baseUrl = assetUrl;

    const props = defineProps({
        saleDocumentTypes: {
            type: Object,
            default: () => ({})
        },
        csrfToken: {
            type: String,
            default: null
        }
    });

    const searchForm = useForm({
        type: '03',
        date: null,
        serie: null,
        number: null,
        client: null,
        amount: null
    })
    const tableData = ref([]);

    const basic = ref({
        dateFormat: 'Y-m-d',
        position: 'auto right' ,
        locale: Spanish
    });

    const searchDocument = () => {
        searchForm.processing = true;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.post(route('client_search_electronic_invoice'), searchForm,{
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        }).then((res) => {
            return res.data.document
        }).then((result) => {
            searchForm.processing = false;
            tableData.value = result;
            console.log(tableData.value)
        });
    }
    
    const downloadDocument = (id,type,file) => {
        let url = route('saledocuments_download',[id, type,file])
        window.open(url, "_blank");      
    }
</script>
<template>
    <AuthLayout title="Buscar">
        <div>
            <div class="absolute inset-0">
                <img :src="`${baseUrl}/themes/vristo/images/auth/bg-gradient.png`" alt="image" class="h-full w-full object-cover" />
            </div>
            <div
                class="relative flex min-h-screen items-center justify-center bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16"
                :style="`background-image:url('${baseUrl}/themes/vristo/images/auth/map.png');`"
            >
                <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object1.png`" alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object2.png`" alt="image" class="absolute left-24 top-0 h-40 md:left-[30%]" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object3.png`" alt="image" class="absolute right-0 top-0 h-[300px]" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/polygon-object.svg`" alt="image" class="absolute bottom-0 end-[28%]" />
                <div class="relative w-full max-w-[870px] rounded-md bg-[linear-gradient(45deg,#fff9f9_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,_#fff9f9_100%)] p-2 dark:bg-[linear-gradient(52.22deg,#0E1726_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#0E1726_100%)]">
                    <div class="relative flex flex-col justify-center rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 px-6 lg:min-h-[758px] py-20">
                        <div class="absolute top-6 end-6">
                        
                        </div>
                        <div class="mx-auto w-full max-w-[640px]">
                            <div class="mb-10">
                                <h1 class="text-3xl font-extrabold uppercase !leading-snug text-primary md:text-4xl">Buscar comprobante electrónico </h1>
                                <p class="text-base font-bold leading-normal text-white-dark">
                                    Los campos con * son obligatorios
                                </p>
                            </div>
                            <form class="grid grid-cols-4 gap-4" @submit.prevent="searchDocument">
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="cbxTypeDocument">Tipo Documento *</label>
                                    <select id="cbxTypeDocument" v-model="searchForm.type" class="form-select text-white-dark" required>
                                        <option v-for="(ttype, key) in saleDocumentTypes" :value="ttype.sunat_id">{{ ttype.description }}</option>
                                    </select>
                                </div>
                                <div class="col-span-4 sm:col-span-1">
                                    <label for="txtserie">Serie *</label>
                                    <input id="txtserie" v-model="searchForm.serie" type="text" class="form-input" />
                                </div>
                                <div class="col-span-4 sm:col-span-1">
                                    <label for="txtnumber">Número *</label>
                                    <input id="txtnumber" v-model="searchForm.number" type="text" class="form-input" />
                                </div>
                                <div class="col-span-4 sm:col-span-2">
                                    <label for="txtidclient">Número Cliente (RUC/DNI/CE) *</label>
                                    <input id="txtidclient" v-model="searchForm.client" type="text" class="form-input" />
                                </div>
                                <div class="col-span-4 sm:col-span-1">
                                    <label for="txtamont">Monto total *</label>
                                    <input id="txtamont" v-model="searchForm.amount" type="text" class="form-input" />
                                </div>
                                <div class="col-span-4 sm:col-span-1">
                                    <label for="txtdate">Fecha de emisión *</label>
                                    <flat-pickr id="txtdate" v-model="searchForm.date" class="form-input" :config="basic"></flat-pickr>
                                </div>
                                <div class="col-span-4 flex justify-end">
                                    <button :class="{ 'opacity-25': searchForm.processing }" :disabled="searchForm.processing" type="submit" class="btn btn-gradient !mt-6 border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                        <svg v-show="searchForm.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                        </svg>
                                        BUSCAR
                                    </button>
                                </div>
                            </form>
                            <div v-if="tableData.length > 0" class="mt-10 relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
                                    <thead >
                                        <tr>
                                            <th class="text-xs text-white uppercase bg-blue-600 dark:text-white">Cliente</th>
                                            <th class="text-xs text-white uppercase bg-blue-600 dark:text-white">Número</th>
                                            <th class="text-xs text-white uppercase bg-blue-600 dark:text-white">Total</th>
                                            <th class="text-xs text-white uppercase bg-blue-600 dark:text-white !text-center">Descargas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <template v-for="(data, index) in tableData" :key="index">
                                        <tr class="bg-blue-500 border-b border-blue-400">
                                            <td>
                                                <div class="flex">
                                                    <p class="whitespace-nowrap">{{ data.client_rzn_social }} 
                                                        <span class="block">{{ data.client_number }}</span>
                                                    </p>
                                                </div>
                                            </td>
                                            <td>{{ data.invoice_serie }} - {{ data.number }}</td>
                                            <td>{{ data.invoice_mto_imp_sale }}</td>
                                            <td class="text-center">
                                                <ul class="flex items-center justify-center gap-2">
                                                    <li>
                                                        <a @click="downloadDocument(data.id,data.invoice_type_doc,'PDF')" href="javascript:;" v-tippy:edit>
                                                            <icon-file-pdf width="35" height="35"  />
                                                        </a>
                                                        <tippy target="edit">Descargar PDF</tippy>
                                                    </li>
                                                    <!-- <li>
                                                        <a href="javascript:;" v-tippy:edit>
                                                            <icon-file-xml />
                                                        </a>
                                                        <tippy target="edit">Descargar XML</tippy>
                                                    </li> -->
                                                </ul>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>