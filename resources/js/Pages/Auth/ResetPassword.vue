<script setup>
    import AuthLayout from '@/Layouts/Vristo/AuthLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, useForm, Link, usePage } from '@inertiajs/vue3';
    import IconMail from '@/Components/vristo/icon/icon-mail.vue';
    import IconLockDots from '@/Components/vristo/icon/icon-lock-dots.vue';
    
    const props = defineProps({
        email: {
            type: String,
            required: true,
        },
        token: {
            type: String,
            required: true,
        },
    });

    const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('password.store'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };

    const baseUrl = assetUrl;
    const company = usePage().props.company;
</script>

<template>
    <GuestLayout>
        <Head title="Restablecer contraseña" />

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
                <div
                    class="relative flex w-full max-w-[1502px] flex-col justify-between overflow-hidden rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 lg:min-h-[758px] lg:flex-row lg:gap-10 xl:gap-0"
                >
                    <div
                        class="relative hidden w-full items-center justify-center bg-[linear-gradient(225deg,rgba(239,18,98,1)_0%,rgba(67,97,238,1)_100%)] p-5 lg:inline-flex lg:max-w-[835px] xl:-ms-28 ltr:xl:skew-x-[14deg] rtl:xl:skew-x-[-14deg]"
                    >
                        <div
                            class="absolute inset-y-0 w-8 from-primary/10 via-transparent to-transparent ltr:-right-10 ltr:bg-gradient-to-r rtl:-left-10 rtl:bg-gradient-to-l xl:w-16 ltr:xl:-right-20 rtl:xl:-left-20"
                        ></div>
                        <div class="ltr:xl:-skew-x-[14deg] rtl:xl:skew-x-[14deg]">
                            <Link :href="route('index_main')" class="w-48 block lg:w-72 ms-10">
                                <img v-if="company.logo_negative == '/img/logo176x32_negativo.png'" :src="company.logo_negative" alt="Logo" class="w-full" />
                                <img v-else :src="`${baseUrl}storage/${company.logo_negative}`" alt="Logo" class="w-full" />
                            </Link>
                            <div class="mt-24 hidden w-full max-w-[430px] lg:block">
                                <img :src="`${baseUrl}/themes/vristo/images/auth/reset-password.svg`" alt="Cover Image" class="w-full" />
                            </div>
                        </div>
                    </div>
                    <div class="relative flex w-full flex-col items-center justify-center gap-6 px-4 pb-16 pt-6 sm:px-6 lg:max-w-[667px]">
                        <div class="flex w-full max-w-[440px] items-center gap-2 lg:absolute lg:end-6 lg:top-6 lg:max-w-full">
                            <Link :href="route('index_main')" class="w-8 block lg:hidden">
                                <img :src="`${baseUrl}/img/isotipo.png`" alt="Logo" class="mx-auto w-10" />
                            </Link>
                            <div class="dropdown ms-auto w-max">
                                <!-- <Popper :placement="'bottom-start'" offsetDistance="8">
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
                                                            :src="`/assets/images/flags/${item.code.toUpperCase()}.svg`"
                                                            alt=""
                                                        />
                                                        <span class="ltr:ml-3 rtl:mr-3">{{ item.name }}</span>
                                                    </button>
                                                </li>
                                            </template>
                                        </ul>
                                    </template>
                                </Popper> -->
                            </div>
                        </div>
                        <div class="w-full max-w-[440px] lg:mt-16">
                            <div class="mb-7">
                                <h1 class="mb-3 text-2xl font-bold !leading-snug dark:text-white">Restablecer contraseña</h1>
                                <p>Crear nueva contraseña</p>
                            </div>
                            <form class="space-y-5" @submit.prevent="submit">
                                <div>
                                    <label for="Email">Email</label>
                                    <div class="relative text-white-dark">
                                        <TextInput
                                            id="email"
                                            type="email"
                                            class="form-input pl-10 placeholder:text-white-dark"
                                            v-model="form.email"
                                            required
                                            autofocus
                                            placeholder="Introducir correo electrónico"
                                        />
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2">
                                            <icon-mail :fill="true" />
                                        </span>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                                <div>
                                    <label for="password">Nueva contraseña</label>
                                    <div class="relative text-white-dark">
                                        <TextInput
                                            id="password"
                                            type="password"
                                            class="ps-10 placeholder:text-white-dark"
                                            v-model="form.password"
                                            required
                                            placeholder="Introducir contraseña"
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
                                            placeholder="Vuelva Introducir contraseña"
                                        />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <icon-lock-dots :fill="true" />
                                        </span>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>
                                <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Restablecer
                                </button>
                            </form>
                        </div>
                        <p class="absolute bottom-6 w-full text-center dark:text-white">© {{ new Date().getFullYear() }}.VRISTO All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
