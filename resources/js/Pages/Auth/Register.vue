<script setup>
import GuestLayout from '@/Layouts/Vristo/AuthLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import { computed, reactive } from 'vue';
    import { useI18n } from 'vue-i18n';
    import appSetting from '@/app-setting';
    import { useAppStore } from '@/stores/index';
    import IconCaretDown from '@/Components/vristo/icon/icon-caret-down.vue';
    import IconUser from '@/Components/vristo/icon/icon-user.vue';
    import IconMail from '@/Components/vristo/icon/icon-mail.vue';
    import IconLockDots from '@/Components/vristo/icon/icon-lock-dots.vue';
    import IconInstagram from '@/Components/vristo/icon/icon-instagram.vue';
    import IconFacebookCircle from '@/Components/vristo/icon/icon-facebook-circle.vue';
    import IconTwitter from '@/Components/vristo/icon/icon-twitter.vue';
    import IconGoogle from '@/Components/vristo/icon/icon-google.vue';



    const store = useAppStore();
    // multi language
    const i18n = reactive(useI18n());
    const changeLanguage = (item) => {
        i18n.locale = item.code;
        appSetting.toggleLanguage(item);
    };
    const baseUrl = assetUrl;

    const currentFlag = computed(() => {
        return baseUrl  + `/themes/vristo/images/flags/${i18n.locale.toUpperCase()}.svg`;
    });

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div>
            <div class="absolute inset-0">
                <img :src="`${baseUrl}/themes/vristo/images/auth/bg-gradient.png`" alt="image" class="h-full w-full object-cover" />
            </div>
            <div
                class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16"
            >
            <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object1.png`" alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object2.png`" alt="image" class="absolute left-24 top-0 h-40 md:left-[30%]" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/coming-soon-object3.png`" alt="image" class="absolute right-0 top-0 h-[300px]" />
                <img :src="`${baseUrl}/themes/vristo/images/auth/polygon-object.svg`" alt="image" class="absolute bottom-0 end-[28%]" />
                <div class="relative flex w-full max-w-[1502px] flex-col justify-between overflow-hidden rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 lg:min-h-[758px] lg:flex-row lg:gap-10 xl:gap-0">
                    <div class="relative hidden w-full items-center justify-center bg-[linear-gradient(225deg,rgba(239,18,98,1)_0%,rgba(67,97,238,1)_100%)] p-5 lg:inline-flex lg:max-w-[835px] xl:-ms-28 ltr:xl:skew-x-[14deg] rtl:xl:skew-x-[-14deg]">
                        <div class="absolute inset-y-0 w-8 from-primary/10 via-transparent to-transparent ltr:-right-10 ltr:bg-gradient-to-r rtl:-left-10 rtl:bg-gradient-to-l xl:w-16 ltr:xl:-right-20 rtl:xl:-left-20"></div>
                        <div class="ltr:xl:-skew-x-[14deg] rtl:xl:skew-x-[14deg]">
                            <Link to="/" class="w-48 block lg:w-72 ms-10">
                                <img :src="`${baseUrl}/img/logo176x32_negativo.png`" alt="Logo" class="w-full" />
                            </Link>
                            <div class="mt-24 hidden w-full max-w-[430px] lg:block">
                                <img :src="`${baseUrl}/themes/vristo/images/auth/register.svg`" alt="Cover Image" class="w-full" />
                            </div>
                        </div>
                    </div>
                    <div class="relative flex w-full flex-col items-center justify-center gap-6 px-4 pb-16 pt-6 sm:px-6 lg:max-w-[667px]">
                        <div class="flex w-full max-w-[440px] items-center gap-2 lg:absolute lg:end-6 lg:top-6 lg:max-w-full">
                            <Link to="/" class="w-8 block lg:hidden">
                                <img :src="`${baseUrl}/img/isotipo.png`" alt="Logo" class="mx-auto w-10" />
                            </Link>
                            <!-- <div class="dropdown ms-auto w-max">
                                <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'" offsetDistance="8">
                                    <button
                                        type="button"
                                        class="flex items-center gap-2.5 rounded-lg border border-white-dark/30 bg-white px-2 py-1.5 text-white-dark hover:border-primary hover:text-primary dark:bg-black"
                                    >
                                        <div>
                                            <img :src="currentFlag" alt="image" class="h-5 w-5 rounded-full object-cover" />
                                        </div>
                                        <div class="text-base font-bold uppercase">{{ store.locale }}</div>
                                        <span class="shrink-0">
                                            <icon-caret-down />
                                        </span>
                                    </button>
                                    <template #content="{ close }">
                                        <ul class="!px-2 text-dark dark:text-white-dark grid grid-cols-2 gap-2 font-semibold dark:text-white-light/90 w-[280px]">
                                            <template v-for="item in store.languageList" :key="item.code">
                                                <li>
                                                    <button
                                                        type="button"
                                                        class="w-full hover:text-primary"
                                                        :class="{ 'bg-primary/10 text-primary': i18n.locale === item.code }"
                                                        @click="changeLanguage(item), close()"
                                                    >
                                                        <img
                                                            class="w-5 h-5 object-cover rounded-full"
                                                            :src="`${baseUrl}/themes/vristo/images/flags/${item.code.toUpperCase()}.svg`"
                                                            alt=""
                                                        />
                                                        <span class="ltr:ml-3 rtl:mr-3">{{ item.name }}</span>
                                                    </button>
                                                </li>
                                            </template>
                                        </ul>
                                    </template>
                                </Popper>
                            </div> -->
                        </div>
                        <div class="w-full max-w-[440px] lg:mt-16">
                            <div class="mb-10">
                                <h1 class="text-3xl font-extrabold uppercase !leading-snug text-primary md:text-4xl">Registrate</h1>
                                <p class="text-base font-bold leading-normal text-white-dark">Ingresa tu email y contraseña para registrarte</p>
                            </div>
                            <form class="space-y-5 dark:text-white" @submit.prevent="submit">
                                <div>
                                    <label for="name">Nombre</label>
                                    <div class="relative text-white-dark">
                                        
                                        <TextInput
                                            id="name"
                                            type="text"
                                            class="ps-10 placeholder:text-white-dark"
                                            v-model="form.name"
                                            required
                                            autofocus
                                            autocomplete="name"
                                        />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <icon-user :fill="true" />
                                        </span>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>
                                <div>
                                    <label for="email">Email</label>
                                    <div class="relative text-white-dark">
                                        <TextInput
                                            id="email"
                                            type="email"
                                            class="ps-10 placeholder:text-white-dark"
                                            v-model="form.email"
                                            required
                                            autocomplete="username"
                                        />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <icon-mail :fill="true" />
                                        </span>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                                <div>
                                    <label for="password">Contraseña</label>
                                    <div class="relative text-white-dark">
                                        <TextInput
                                            id="password"
                                            type="password"
                                            class="ps-10 placeholder:text-white-dark"
                                            v-model="form.password"
                                            required
                                            autocomplete="new-password"
                                        />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <icon-lock-dots :fill="true" />
                                        </span>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>
                                <div>
                                    <label for="password_confirmation">Confirmar contraseña</label>
                                    <div class="relative text-white-dark">
                                        <TextInput
                                            id="password_confirmation"
                                            type="password"
                                            class="ps-10 placeholder:text-white-dark"
                                            v-model="form.password_confirmation"
                                            required
                                            autocomplete="new-password"
                                        />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <icon-lock-dots :fill="true" />
                                        </span>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>
                                <div>
                                    <label class="flex cursor-pointer items-center">
                                        <input type="checkbox" class="form-checkbox bg-white dark:bg-black" />
                                        <span class="text-white-dark">Subscribe to weekly newsletter</span>
                                    </label>
                                </div>
                                <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Guardar
                                </button>
                            </form>

                            <div class="relative my-7 text-center md:mb-9">
                                <span class="absolute inset-x-0 top-1/2 h-px w-full -translate-y-1/2 bg-white-light dark:bg-white-dark"></span>
                                <span class="relative bg-white px-2 font-bold uppercase text-white-dark dark:bg-dark dark:text-white-light">or</span>
                            </div>
                            <div class="mb-10 md:mb-[60px]">
                                <ul class="flex justify-center gap-3.5 text-white">
                                    <li>
                                        <a href="javascript:"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-full p-0 transition hover:scale-110"
                                            style="background: linear-gradient(135deg, rgba(239, 18, 98, 1) 0%, rgba(67, 97, 238, 1) 100%)"
                                        >
                                            <icon-instagram />
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="javascript:"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-full p-0 transition hover:scale-110"
                                            style="background: linear-gradient(135deg, rgba(239, 18, 98, 1) 0%, rgba(67, 97, 238, 1) 100%)"
                                        >
                                            <icon-facebook-circle />
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="javascript:"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-full p-0 transition hover:scale-110"
                                            style="background: linear-gradient(135deg, rgba(239, 18, 98, 1) 0%, rgba(67, 97, 238, 1) 100%)"
                                        >
                                            <icon-twitter :fill="true" />
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="javascript:"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-full p-0 transition hover:scale-110"
                                            style="background: linear-gradient(135deg, rgba(239, 18, 98, 1) 0%, rgba(67, 97, 238, 1) 100%)"
                                        >
                                            <icon-google />
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-center dark:text-white">
                                ¿ Ya tienes una cuenta ?
                                <Link :href="route('login')" class="uppercase text-primary underline transition hover:text-black dark:hover:text-white">
                                    INICIAR SESIÓN
                                </Link>
                            </div>
                        </div>
                        <p class="absolute bottom-6 w-full text-center dark:text-white">© {{ new Date().getFullYear() }}.ARACODE All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
