<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Jumbotron from './Components/Jumbotron.vue';
import Footer from './Components/Footer.vue';
import About from './Components/About.vue';
import ServicesTI from './Components/ServicesTI.vue';
import GalleryProducts from './Components/GalleryProducts.vue';
import Contact from './Components/Contact.vue';
import CarouselProducts from './Components/CarouselProducts.vue';
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
    pageActive: String,
    products:{
        type: Object,
        default: () => ({})
    },
    categories: {
        type: Object,
        default: () => ({})
    },
    promotions: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <Head title="Tienda" />
    <Header 
        :authUser="$page.props.user" 
        :authCompany="$page.props.company" 
        :pageActive="pageActive"
    />
    <CarouselProducts :promotions="promotions" />
    <GalleryProducts
        :categories="categories"
        :products="products"
    />
    <Footer :laravelVersion="laravelVersion" :phpVersion="phpVersion" />
</template>