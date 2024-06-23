<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { useForm, Link } from '@inertiajs/vue3';
    import IconPencilPaper from '@/Components/vristo/icon/icon-pencil-paper.vue';
    import IconInfoCircle from '@/Components/vristo/icon/icon-info-circle.vue';
    import IconMail from '@/Components/vristo/icon/icon-mail.vue';
    import IconCalendar from '@/Components/vristo/icon/icon-calendar.vue';
    import iconMapPin from '@/Components/vristo/icon/icon-map-pin.vue';
    import iconPhone from '@/Components/vristo/icon/icon-phone.vue';
    import { faFile, faHeartPulse, faFolderTree, faSyringe, faVirus } from "@fortawesome/free-solid-svg-icons";

    const props = defineProps({
        patient: {
            type: Object,
            default: () => ({}),
        }
    });

    const baseUrl = assetUrl;

    const getImage = (path) => {
        return baseUrl + 'storage/'+ path;
    }

</script>
<template>
    <AppLayout title="Pacientes">
        <div>
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="javascript:;" class="text-primary hover:underline">Salud</a>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <Link :href="route('heal_patients_list')" class="text-primary hover:underline">Pacientes</Link>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>{{ patient.person.full_name }}</span>
                </li>
            </ul>
            <div class="pt-5">
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-5">
                    <div>
                        <div class="bg-[#FFFFFF] flex flex-col rounded-md border border-[#e0e6ed] dark:border-[#1b2e4b]">
                            <div class="flex bg-primary text-white border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5" >
                                <div class="ltr:mr-3 rtl:ml-3">
                                    <img v-if="patient.person.image" :src="getImage(patient.person.image)" alt="" class="rounded-full w-12 h-12 object-cover bg-[#ffffff]" />
                                    <img v-else :src="'https://ui-avatars.com/api/?name='+patient.person.full_name+'&size=504&rounded=true'" :alt="patient.person.full_name" class="rounded-full w-12 h-12 object-cover bg-[#ffffff]" />
                                </div>
                                <div class="flex-1 font-semibold">
                                    <h6 class="mb-1 text-base">{{ patient.person.full_name }}</h6>
                                    <p class="text-xs">{{ patient.person.email }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between border-b border-[#e0e6ed] px-4 py-2.5">
                                <button class="btn btn-primary btn-sm">
                                    Crear cita
                                </button>
                                <button class="btn btn-warning btn-sm">
                                    Cobrar
                                </button>
                            </div>
                            <div class="flex border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                <div class="ltr:mr-2 rtl:ml-2.5 mt-0.5 text-primary">
                                    <font-awesome-icon :icon="faFile" class="w-5 h-5" /> 
                                </div>
                                <div class="flex-1 font-semibold">
                                    <h6 class="text-base">Historias Clínicas</h6>
                                </div>
                            </div>
                            <div class="flex border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                <div class="ltr:mr-2 rtl:ml-2.5 mt-0.5 text-primary">
                                    <font-awesome-icon :icon="faHeartPulse" class="w-5 h-5" /> 
                                </div>
                                <div class="flex-1 font-semibold">
                                    <h6 class="text-base">Diagnósticos</h6>
                                </div>
                            </div>
                            <div class="flex border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                <div class="ltr:mr-2 rtl:ml-2.5 mt-0.5 text-primary">
                                    <font-awesome-icon :icon="faFolderTree" class="w-5 h-5" /> 
                                </div>
                                <div class="flex-1 font-semibold">
                                    <h6 class="text-base">Documentos</h6>
                                </div>
                            </div>
                            <div class="flex border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                <div class="ltr:mr-2 rtl:ml-2.5 mt-0.5 text-primary">
                                    <font-awesome-icon :icon="faSyringe" class="w-5 h-5" /> 
                                </div>
                                <div class="flex-1 font-semibold">
                                    <h6 class="text-base">Medicamentos</h6>
                                </div>
                            </div>
                            <div class="flex border-b border-[#e0e6ed] dark:border-[#1b2e4b] px-4 py-2.5 hover:bg-[#eee] dark:hover:bg-[#eee]/10">
                                <div class="ltr:mr-2 rtl:ml-2.5 mt-0.5 text-primary">
                                    <font-awesome-icon :icon="faVirus" class="w-5 h-5" /> 
                                </div>
                                <div class="flex-1 font-semibold">
                                    <h6 class="text-base">Alerjias</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:col-span-2 xl:col-span-3">
                        <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 gap-5 mb-5">
                            <div class="panel lg:col-span-2 xl:col-span-1">
                                <div class="flex items-center justify-between mb-5">
                                    <h5 class="font-semibold text-lg dark:text-white-light">Perfil</h5>
                                    <Link :href="route('heal_patients_edit',patient.person.id)" class="ltr:ml-auto rtl:mr-auto btn btn-primary p-2 rounded-full">
                                        <icon-pencil-paper />
                                    </Link>
                                </div>
                                <div class="mb-5">
                                    <div class="flex flex-col justify-center items-center">
                                        <img v-if="patient.person.image" :src="getImage(patient.person.image)" alt="" class="w-24 h-24 rounded-full object-cover mb-5" />
                                        <img v-else :src="'https://ui-avatars.com/api/?name='+patient.person.full_name+'&size=504&rounded=true'" :alt="patient.person.full_name" class="w-24 h-24 rounded-full object-cover mb-5" />
                                        <p class="font-semibold text-primary text-xl">{{ patient.person.full_name }}</p>
                                    </div>
                                    <ul class="mt-5 flex flex-col max-w-[160px] m-auto space-y-4 font-semibold text-white-dark">
                                        <li class="flex items-center gap-2">
                                            <icon-info-circle class="shrink-0" />
                                            {{ patient.person.number }}
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <icon-calendar class="shrink-0" />
                                            {{ patient.person.birthdate }}
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <icon-map-pin class="shrink-0" />
                                            {{ patient.person.address }}
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="flex items-center gap-2">
                                                <icon-mail class="w-5 h-5 shrink-0" />
                                                <span class="text-primary truncate">{{ patient.person.email }}</span>
                                            </a>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <icon-phone />
                                            <span class="whitespace-nowrap" dir="ltr">
                                                {{ patient.person.telephone }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>