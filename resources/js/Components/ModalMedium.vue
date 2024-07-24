<script setup>
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogOverlay,
    } from "@headlessui/vue";  
    import IconX from "@/Components/vristo/icon/icon-x.vue";

    const props = defineProps({
        onClose: {
            type: Function,
            default: () => {},
        },
        show: {
            type: Boolean,
            default: false,
        },
        icon: {
            type: String,
            default: null,
        }
    });
</script>
<template>
    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @click="onClose" class="relative z-50">
            <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0"
              enter-to="opacity-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100"
              leave-to="opacity-0"
            >
              <DialogOverlay class="fixed inset-0 bg-[black]/60" />
            </TransitionChild>
            <div class="fixed inset-0 overflow-y-auto">
              <div class="flex min-h-full items-start justify-center px-4 py-8">
                <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden sm:max-w-xl w-full text-black dark:text-white-dark animate__animated animate__zoomInUp">
                  <button type="button" class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none" @click="onClose">
                    <icon-x />
                  </button>
                  <div class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                    <div class="sm:flex sm:items-start">
                      <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-800 sm:mx-0 sm:h-10 sm:w-10">
                        <img v-if="icon" :src="icon" />
                        <svg v-else class="h-6 w-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                      </div>
                      <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                          <slot name="title" />
                        </h3>
                        <div class="mt-2">
                          <slot name="message" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="p-5">
                    <slot name="content" />
                    <div class="flex justify-end items-center space-x-2 mt-8">
                        <slot name="buttons" />
                        <SecondaryButton @click="onClose" class="btn-primary">
                          Cerrar
                        </SecondaryButton>
                    </div>
                  </div>
                </DialogPanel>
              </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
  

  