<script setup>
    import { useAppStore } from '@/stores/index';
    import IconPencilPaper from '@/Components/vristo/icon/icon-pencil-paper.vue';
    import IconCoffee from '@/Components/vristo/icon/icon-coffee.vue';
    import IconCalendar from '@/Components/vristo/icon/icon-calendar.vue';
    import IconMapPin from '@/Components/vristo/icon/icon-map-pin.vue';
    import IconMail from '@/Components/vristo/icon/icon-mail.vue';
    import IconPhone from '@/Components/vristo/icon/icon-phone.vue';
    import IconTwitter from '@/Components/vristo/icon/icon-twitter.vue';
    import IconDribbble from '@/Components/vristo/icon/icon-dribbble.vue';
    import IconGithub from '@/Components/vristo/icon/icon-github.vue';
    import IconShoppingBag from '@/Components/vristo/icon/icon-shopping-bag.vue';
    import IconTag from '@/Components/vristo/icon/icon-tag.vue';
    import IconCreditCard from '@/Components/vristo/icon/icon-credit-card.vue';
    import IconClock from '@/Components/vristo/icon/icon-clock.vue';
    import IconHorizontalDots from '@/Components/vristo/icon/icon-horizontal-dots.vue';
    import { Link } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';
    import { Image, AvatarGroup, Avatar, Tooltip } from 'ant-design-vue';

    const store = useAppStore();


    const props = defineProps({
        userData: {
            type: Object,
            default: () => ({})
        },
        authPerson: {
            type: Object,
            default: () => ({})
        }
    });

    const baseUrl = assetUrl;

    const getImage = (path) => {
        return baseUrl + 'storage/'+ path;
    }

    const formatDateEs = (dateString) => {
        const months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        const date = new Date(dateString);
        const monthIndex = date.getMonth();
        const day = date.getDate();
        const year = date.getFullYear();

        return `${months[monthIndex]} ${day}, ${year}`;
    }

    const mycourses = ref([]);
    const allcourses = ref([]);
    const mcLoading = ref(false);

    const getCourses = () => {
        mcLoading.value = true;
        axios.post(route('aca_student_dashboard_courses'),{
            id: props.authPerson.id
        }).then((res) => {
            console.log(res)
            return res.data
        }).then((res)=>{
            mycourses.value = res.mycourses
            allcourses.value = res.allcourses
        }).then(()=>{
            mcLoading.value = false;
        });
    }


    onMounted(() => {
        getCourses()
    });
</script>
<template>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <span>Dashboard</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-5">
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Alumno</h5>
                        <Link :href="route('profile.edit')" class="ltr:ml-auto rtl:mr-auto btn btn-primary p-2 rounded-full">
                            <icon-pencil-paper />
                        </Link>
                    </div>
                    <div class="mb-5">
                        <div class="flex flex-col justify-center items-center">
                            <img v-if="userData.avatar":src="getImage(userData.avatar)" alt="" class="w-24 h-24 rounded-full object-cover mb-5" />
                            <img v-else :src="`https://ui-avatars.com/api/?name=${userData.name}&size=150&rounded=true`" alt="" class="w-24 h-24 rounded-full object-cover mb-5" />
                            <p class="font-semibold text-primary text-xl">{{ authPerson.full_name }}</p>
                        </div>
                        <ul class="mt-5 flex flex-col max-w-[160px] m-auto space-y-4 font-semibold text-white-dark">
                            <li v-if="userData.information" class="flex items-center gap-2">
                                <icon-coffee class="shrink-0" />
                                {{ userData.information }}
                            </li>
                            <li v-if="authPerson.birthdate" class="flex items-center gap-2">
                                <icon-calendar class="shrink-0" />
                                {{ formatDateEs(authPerson.birthdate) }}
                            </li>
                            <li v-if="authPerson.ubigeo" class="flex items-center gap-2">
                                <icon-map-pin class="shrink-0" />
                                {{ authPerson.district.name }}
                            </li>
                            <li>
                                <a href="javascript:;" class="flex items-center gap-2">
                                    <icon-mail class="w-5 h-5 shrink-0" />
                                    <span class="text-primary truncate">
                                        {{ userData.email }}
                                    </span>
                                </a>
                            </li>
                            <li class="flex items-center gap-2">
                                <icon-phone />
                                <span class="whitespace-nowrap" dir="ltr">{{ authPerson.telephone }}</span>
                            </li>
                        </ul>
                        <!-- <ul class="mt-7 flex items-center justify-center gap-2">
                            <li>
                                <a class="btn btn-info flex items-center justify-center rounded-full w-10 h-10 p-0" href="javascript:;">
                                    <icon-twitter class="w-5 h-5" />
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-danger flex items-center justify-center rounded-full w-10 h-10 p-0" href="javascript:;">
                                    <icon-dribbble />
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-dark flex items-center justify-center rounded-full w-10 h-10 p-0" href="javascript:;">
                                    <icon-github />
                                </a>
                            </li>
                        </ul> -->
                    </div>
                </div>
                <div class="panel lg:col-span-2 xl:col-span-3">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Mis Cursos</h5>
                    </div>
                    <div class="mb-5">
                        <div class="table-responsive text-[#515365] dark:text-white-light font-semibold">
                            <table class="whitespace-nowrap table-hover">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Docentes</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="dark:text-white-dark">
                                    <template v-if="mcLoading">
                                        <tr>
                                            <td colspan="4">
                                                <div role="status" class="space-y-2.5 animate-pulse w-full">
                                                    <div class="flex items-center w-full">
                                                        <div class="h-4 bg-gray-200 rounded-full dark:bg-gray-700 w-40"></div>
                                                        <div class="h-4 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                        <div class="h-4 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                        <div class="h-4 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                    </div>
                                                    <div class="flex items-center w-full">
                                                        <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-40"></div>
                                                        <div class="h-2.5 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                        <div class="h-2.5 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                        <div class="h-2.5 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                    </div>
                                                    <div class="flex items-center w-full">
                                                        <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-40"></div>
                                                        <div class="h-2.5 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                        <div class="h-2.5 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                        <div class="h-2.5 ms-2 bg-gray-300 rounded-full dark:bg-gray-600 w-40"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr v-for="(item, index) in mycourses">
                                            <td>
                                                <div class="flex items-center">
                                                    <div class="ltr:mr-4 rtl:ml-4">
                                                        <Image :width="80" class="rounded-md" :src="getImage(item.course.image)" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <h4 class="font-semibold text-lg text-primary">{{  item.course.type_description }}</h4>
                                                        <p class="media-text mb-2">
                                                            {{ item.course.description }}
                                                        </p>
                                                        <ul class="flex space-x-4 rtl:space-x-reverse font-bold">
                                                            <li>
                                                                <span class="text-warning block text-xs">{{  item.course.sector_description }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="text-warning block text-xs">{{  item.course.modality.description }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="w-full">
                                                    <AvatarGroup
                                                        :max-count="2"
                                                        size="large"
                                                        :max-style="{
                                                            color: '#f56a00',
                                                            backgroundColor: '#fde3cf',
                                                        }"
                                                    >
                                                        <template v-for="tea in item.course.teachers">
                                                            <template v-if="tea.teacher.person.image">
                                                                <Tooltip :title="tea.teacher.person.full_name" placement="top">
                                                                    <Avatar :src="getImage(tea.teacher.person.image)" />
                                                                </Tooltip>
                                                            </template>
                                                            <template v-else>
                                                                <Tooltip :title="tea.teacher.person.full_name" placement="top">
                                                                    <Avatar :src="`https://ui-avatars.com/api/?name=${tea.teacher.person.full_name}&size=150&rounded=true`" />
                                                                </Tooltip>
                                                            </template>
                                                        </template>
                                                        
                                                    </AvatarGroup>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="flex items-center space-x-2">
                                                    <Link :href="route('aca_mycourses_lessons',item.course.id)" type="button" class="btn btn-outline-success rounded-full">Ingresar</Link>
                                                    <button v-tippy:button type="button" class="btn btn-danger w-10 h-10 p-0 rounded-full">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                            <polyline points="7 10 12 15 17 10"></polyline>
                                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                                        </svg>
                                                    </button>
                                                    <tippy target="button" :extra="{ theme: 'danger' }">Certificado</tippy>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr v-for="(itemx, keyx) in allcourses" class="bg-primary/20 border-primary/20">
                                            <td>
                                                <div class="flex items-center">
                                                    <div class="ltr:mr-4 rtl:ml-4">
                                                        <Image :width="80" class="rounded-md" :src="getImage(itemx.image)" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <h4 class="font-semibold text-lg text-primary">{{  itemx.type_description }}</h4>
                                                        <p class="media-text mb-2">
                                                            {{ itemx.description }}
                                                        </p>
                                                        <ul class="flex space-x-4 rtl:space-x-reverse font-bold">
                                                            <li>
                                                                <span class="text-warning block text-xs">{{  itemx.sector_description }}</span>
                                                            </li>
                                                            <li>
                                                                <span class="text-warning block text-xs">{{  itemx.modality.description }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="w-full">
                                                    <AvatarGroup
                                                        :max-count="2"
                                                        size="large"
                                                        :max-style="{
                                                            color: '#f56a00',
                                                            backgroundColor: '#fde3cf',
                                                        }"
                                                    >
                                                        <template v-for="tea in itemx.teachers">
                                                            <template v-if="tea.teacher.person.image">
                                                                <Tooltip :title="tea.teacher.person.full_name" placement="top">
                                                                    <Avatar :src="getImage(tea.teacher.person.image)" />
                                                                </Tooltip>
                                                            </template>
                                                            <template v-else>
                                                                <Tooltip :title="tea.teacher.person.full_name" placement="top">
                                                                    <Avatar :src="`https://ui-avatars.com/api/?name=${tea.teacher.person.full_name}&size=150&rounded=true`" />
                                                                </Tooltip>
                                                            </template>
                                                        </template>
                                                    </AvatarGroup>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="flex items-center">
                                                    <button type="button" class="btn btn-outline-primary rounded-full">Comprar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- desde aca mas panel informativos -->
        </div>
    </div>
</template>

