<template>
    <section class="bg-red-50 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-screen-xl lg:py-16 py-20 lg:py-20 lg:gap-16">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4 md:col-span-4">
                    <div class="w-full p-4">
                        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Hable con nuestros expertos.</h5>
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Estamos aquí para escuchar y asesorarte en cada paso de tu viaje tecnológico. Nuestro equipo de expertos en desarrollo a medida está listo para entender tus desafíos, responder a tus preguntas y diseñar soluciones que impulsen el éxito de tu empresa. Hable con nuestros expertos hoy y descubre cómo podemos transformar tus ideas en soluciones innovadoras y personalizadas que potencien tu negocio.</p>
                        
                        <div class="flex items-center justify-center p-4 text-center">
                            <span class="flex w-3 h-3 me-3 bg-gray-900 rounded-full dark:bg-gray-700"></span>
                            <span class="flex w-3 h-3 me-3 bg-blue-600 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-green-500 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-red-500 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-gray-200 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-purple-500 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-indigo-500 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-yellow-300 rounded-full"></span>
                            <span class="flex w-3 h-3 me-3 bg-teal-500 rounded-full"></span>
                        </div>
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8" src="/img/Landing/email.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Email
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            contacto@aracodeperu.com
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8" src="/img/Landing/telefono.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            LLamanos
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            (+51) 977 627207
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8" src="/img/Landing/ubicacion.png" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Dirección
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            Urb. Las Casuarinas Mz. P1 - Lt.26 2da Etapa, Nuevo Chimbote - Perú.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-2 md:col-span-2">
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <form class="space-y-6" action="#">
                            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Programar una cita</h5>
                            <div>
                                <label for="names" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo</label>
                                <input type="text" name="names" id="names" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                            </div>
                            <div>
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                                <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>

                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                Estamos aquí para ayudarte 24/7
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>