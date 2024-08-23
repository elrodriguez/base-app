<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import IconArrowleft from '@/Components/vristo/icon/icon-arrow-left.vue';
    import { Link } from '@inertiajs/vue3';

    defineProps({
        subscriptions: {
            type: Object,
            default: () => ({})
        }
    });

</script>
<template>
    <AppLayout title="Tipo de suscripcion">
        <Navigation :routeModule="route('aca_dashboard')" :titleModule="'Académico'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Tipo de suscripcion</span>
            </li>
        </Navigation>
        <div class="pt-5 space-y-8">
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Tipo de suscripciones</h5>
                    <Link :href="route('aca_subscriptions_create')" class="btn btn-primary">Nuevo</Link>
                </div>
                <div class="mb-5">
                    <div class="max-w-[320px] md:max-w-[990px] mx-auto">
                        <div class="grid sm:grid-cols-3 gap-4">
                            <template v-for="(subscription, index) in subscriptions">
                                <div class="p-3 lg:p-5 border border-black dark:border-[#1b2e4b] text-center rounded group hover:border-primary">
                                    <h3 class="text-xl lg:text-2xl">{{ subscription.title }}</h3>
                                    <div class="border-t border-black dark:border-white-dark w-1/5 mx-auto my-6 group-hover:border-primary"></div>
                                    <p class="text-[15px]">{{ subscription.description }}</p>
                                    <div v-for="price in JSON.parse(subscription.prices)" class="my-7 p-2.5 text-center text-lg group-hover:text-primary">
                                        <strong class="text-[#3b3f5c] dark:text-white-dark text-3xl lg:text-5xl group-hover:text-primary">{{ price.currency == 'PEN' ? 'S/' : '$' }}{{ price.amount }}</strong> / {{ price.detail }}
                                    </div>
                                    <ul class="space-y-2.5 mb-5 font-semibold group-hover:text-primary">
                                        <li v-for="detail in JSON.parse(subscription.details)" class="flex justify-center items-center">
                                            <icon-arrow-left class="w-3.5 h-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180 shrink-0" />
                                            {{ detail.label }}
                                        </li>
                                    </ul>
                                    <a
                                        href="#"
                                        target="_self"
                                        class="btn text-black shadow-none group-hover:text-primary group-hover:border-primary group-hover:bg-primary/10 dark:text-white-dark dark:border-white-dark/50"
                                        >Editar</a
                                    >
                                </div>
                            </template>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>