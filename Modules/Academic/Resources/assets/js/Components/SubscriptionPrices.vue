<script setup>
  import { useForm, usePage } from '@inertiajs/vue3';
  const baseUrl = assetUrl;
  const company = usePage().props.company;

  const formStart = useForm({
    subscription: null
  });

  const startSubscription = (id) => {
    formStart.subscription = id;
    formStart.post(route('aca_subscriptions_free_user'), {
      preserveScroll: true,
      onSuccess: () => formStart.reset(),
    });
  }
</script>
<template>
  <!-- Hero -->
    <div :class="`relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/squared-bg-element.svg')] dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/squared-bg-element.svg')] before:bg-no-repeat before:bg-top before:size-full before:-z-[1] before:transform before:-translate-x-1/2`">
      <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-40">
        <!-- Announcement Banner -->
        <div class="flex justify-center">
          <a class="inline-flex items-center gap-x-2 bg-white border border-gray-200 text-xs text-gray-600 p-2 px-3 rounded-full transition hover:border-gray-300 focus:outline-none focus:border-gray-300 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:border-neutral-600 dark:focus:border-neutral-600" href="#">
            Explora nuestra pagina web
            <a :href="route('index_main')" class="flex items-center gap-x-1">
              <span class="border-s border-gray-200 text-blue-600 ps-2 dark:text-blue-500 dark:border-neutral-700">Está bien</span>
              <svg class="shrink-0 size-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
          </a>
        </div>
        <!-- End Announcement Banner -->

        <!-- Title -->
        <div class="mt-5 max-w-xl text-center mx-auto">
          <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200">
            Gracias por crear su cuenta de usuario
          </h1>
        </div>
        <!-- End Title -->

        <div class="mt-5 max-w-3xl text-center mx-auto">
          <p class="text-lg text-gray-600 dark:text-neutral-400">
            En <strong>{{ company.name }}</strong>, tendrás la oportunidad de aprender de los mejores profesionales. Compartirán contigo el conocimiento adquirido a través de su experiencia.
          </p>
        </div>

        <!-- Buttons -->
        <div class="mt-8 gap-3 flex justify-center">
          <button @click="startSubscription" type="button" class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-blue-600 to-violet-600 hover:from-violet-600 hover:to-blue-600 focus:outline-none focus:from-violet-600 focus:to-blue-600 border border-transparent text-white text-sm font-medium rounded-full py-3 px-4" href="#">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
              <path d="M88 0C74.7 0 64 10.7 64 24c0 38.9 23.4 59.4 39.1 73.1l1.1 1C120.5 112.3 128 119.9 128 136c0 13.3 10.7 24 24 24s24-10.7 24-24c0-38.9-23.4-59.4-39.1-73.1l-1.1-1C119.5 47.7 112 40.1 112 24c0-13.3-10.7-24-24-24zM32 192c-17.7 0-32 14.3-32 32L0 416c0 53 43 96 96 96l192 0c53 0 96-43 96-96l16 0c61.9 0 112-50.1 112-112s-50.1-112-112-112l-48 0L32 192zm352 64l16 0c26.5 0 48 21.5 48 48s-21.5 48-48 48l-16 0 0-96zM224 24c0-13.3-10.7-24-24-24s-24 10.7-24 24c0 38.9 23.4 59.4 39.1 73.1l1.1 1C232.5 112.3 240 119.9 240 136c0 13.3 10.7 24 24 24s24-10.7 24-24c0-38.9-23.4-59.4-39.1-73.1l-1.1-1C231.5 47.7 224 40.1 224 24z"/>
            </svg>
            Empezar gratis
          </button>
        </div>
        <!-- End Buttons -->
      </div>
    </div>
    <!-- End Hero -->
    <!-- Pricing -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <!-- Title -->
      <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Precios</h2>
        <p class="mt-1 text-gray-600 dark:text-neutral-400">
          Para acceder a nuestros cursos, puedes adquirir una suscripción. Nuestras ofertas se adaptan continuamente a tus necesidades.
        </p>
      </div>
      <!-- End Title -->
      <!-- Grid -->
      <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:items-center">
        <!-- Card -->
        <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-neutral-800">
          <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Gratis</h4>
          <span class="mt-7 font-bold text-5xl text-gray-800 dark:text-neutral-200">Gratis</span>
          <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Gratis para siempre</p>

          <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                1 user
              </span>
            </li>

            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                Plan features
              </span>
            </li>

            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                Product support
              </span>
            </li>
          </ul>

          <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
            Inscribirse
          </a>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col border-2 border-blue-600 text-center shadow-xl rounded-xl p-8 dark:border-blue-700">
          <p class="mb-3">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-blue-100 text-blue-800 dark:bg-blue-600 dark:text-white">Lo más popular</span>
          </p>
          <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Mensual</h4>
          <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-neutral-200">
            <span class="font-bold text-2xl -me-2">$</span>
            39
          </span>
          <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">All the basics for starting a new business</p>

          <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                2 users
              </span>
            </li>

            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                Plan features
              </span>
            </li>

            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                Product support
              </span>
            </li>
          </ul>

          <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
            Inscribirse
          </a>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-neutral-800">
          <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">Al año</h4>
          <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-neutral-200">
            <span class="font-bold text-2xl -me-2">$</span>
            89
          </span>
          <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Everything you need for a growing business</p>

          <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                5 users
              </span>
            </li>

            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                Plan features
              </span>
            </li>

            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                Product support
              </span>
            </li>
          </ul>

          <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
            Inscribirse
          </a>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8 dark:border-neutral-800">
          <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">VIP</h4>
          <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-neutral-200">
            <span class="font-bold text-2xl -me-2">$</span>
            149
          </span>
          <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Advanced features for scaling your business</p>

          <ul class="mt-7 space-y-2.5 text-sm">
            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                10 users
              </span>
            </li>

            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                Plan features
              </span>
            </li>

            <li class="flex gap-x-2">
              <svg class="shrink-0 mt-0.5 size-4 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
              <span class="text-gray-800 dark:text-neutral-400">
                Product support
              </span>
            </li>
          </ul>

          <a class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
            Inscribirse
          </a>
        </div>
        <!-- End Card -->
      </div>
      <!-- End Grid -->
    </div>
</template>