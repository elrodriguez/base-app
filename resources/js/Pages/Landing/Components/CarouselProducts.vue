<script setup>
import { Carousel } from 'flowbite-vue';
import { ref } from 'vue';
import { faCircleArrowRight, faCircleArrowLeft } from "@fortawesome/free-solid-svg-icons";

const xAssetUrl = assetUrl;

const props = defineProps({
    promotions: {
        type: Object,
        default: () => ({})
    }
});

const itemsData = props.promotions.items;
const pictures = ref([]);

for (var objeto of itemsData) {
  if(objeto.item.items.length > 0){
    var contador = 1;
    for (var subObjeto of objeto.item.items) {
        pictures.value.push({src: xAssetUrl+ 'storage/'+subObjeto.content, alt: 'Image ' + contador});
        contador++;
    }
  }
}


</script>
<template>
    <section v-if="promotions" class="bg-white dark:bg-gray-900">
        <div class="py-24 px-4 mx-auto max-w-screen-xl lg:py-24 grid lg:grid-cols-2 gap-8 lg:gap-16">
            <div class="flex flex-col justify-center">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">{{ promotions.items[0].item.content }}</h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">{{ promotions.items[1].item.content }}</p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0">
                    <!-- <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Get started
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                    <a href="#" class="inline-flex justify-center items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Learn more
                    </a>   -->
                </div>
            </div>
            <div>
                <Carousel 
                    :pictures="pictures" 
                    :slide="true" :slide-interval="3000" 
                    :noIndicators="false"
                    style="z-index: 10 !important;"
                />
            </div>
        </div>
    </section>
</template>
<style scoped>
/* For demo */
:deep(.slick-slide) {
  text-align: center;
  height: 160px;
  line-height: 160px;
  background: #364d79;
  overflow: hidden;
}

:deep(.slick-arrow.custom-slick-arrow) {
  width: 25px;
  height: 25px;
  font-size: 25px;
  color: #fff;
  background-color: rgba(31, 45, 61, 0.11);
  transition: ease all 0.3s;
  opacity: 0.3;
  z-index: 1;
}
:deep(.slick-arrow.custom-slick-arrow:before) {
  display: none;
}
:deep(.slick-arrow.custom-slick-arrow:hover) {
  color: #fff;
  opacity: 0.5;
}

:deep(.slick-slide h3) {
  color: #fff;
}
</style>