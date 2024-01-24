<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Jumbotron from './Components/Jumbotron.vue';
import Footer from './Components/Footer.vue';
import About from './Components/About.vue';
import SliderHome from './Components/SliderHome.vue';
import ServicesTI from './Components/ServicesTI.vue';
import ServicesAcademic from './Components/ServicesAcademic.vue';
import Contact from './Components/Contact.vue';
import Customers from './Components/Customers.vue';
import Header from './Components/Header.vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    jumbotron: {
        type: Object,
        default: () => ({})
    },
    pageActive: String
});

</script>

<template>
    <Head title="Bienvenido" />
    <Header 
        :authUser="$page.props.user" 
        :authCompany="$page.props.company"
        :pageActive="pageActive"
    />
    <Jumbotron :jumbotron="jumbotron" />
    <About />
    <SliderHome />
    <!-- <ServicesAcademic /> -->
    <ServicesTI />
    <Contact />
    <Customers />
    <Footer :laravelVersion="laravelVersion" :phpVersion="phpVersion" />
</template>