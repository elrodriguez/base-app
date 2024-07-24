<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import DeleteUserForm from './Partials/DeleteUserForm.vue';
    import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
    import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
    import UpdatePersonInformationForm from './Partials/UpdatePersonInformationForm.vue';
    import { Link } from '@inertiajs/vue3';
    import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
    import { useAppStore } from '@/stores/index';

    import IconHome from '@/Components/vristo/icon/icon-home.vue';
    import IconDollarSignCircle from '@/Components/vristo/icon/icon-dollar-sign-circle.vue';
    import IconUser from '@/Components/vristo/icon/icon-user.vue';
    import IconPhone from '@/Components/vristo/icon/icon-phone.vue';
    import IconLinkedin from '@/Components/vristo/icon/icon-linkedin.vue';
    import IconTwitter from '@/Components/vristo/icon/icon-twitter.vue';
    import IconFacebook from '@/Components/vristo/icon/icon-facebook.vue';
    import IconGithub from '@/Components/vristo/icon/icon-github.vue';

    const store = useAppStore();

    defineProps({
        mustVerifyEmail: {
            type: Boolean,
        },
        status: {
            type: String,
        },
        person: {
            type: Object,
            default: () => ({}),
        },
        document_types: {
            type: Object,
            default: () => ({}),
        },
        ubigeo: {
            type: Object,
            default: () => ({}),
        }
    });
</script>

<template>
    <AppLayout title="Perfil">
        <div>
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <Link :href="route('dashboard')" class="text-primary hover:underline">Dashboard</Link>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>Perfil</span>
                </li>
            </ul>
            <div class="pt-5">
                <TabGroup>
                    <TabList class="flex font-semibold border-b border-[#ebedf2] dark:border-[#191e3a] mb-5 whitespace-nowrap overflow-y-auto">
                        <Tab as="template" v-slot="{ selected }">
                            <a
                                href="javascript:;"
                                class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary !outline-none"
                                :class="{ '!border-primary text-primary': selected }"
                            >
                                <icon-home />
                                Información general
                            </a>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <a
                                href="javascript:;"
                                class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary !outline-none"
                                :class="{ '!border-primary text-primary': selected }"
                            >
                                <icon-user class="w-5 h-5" />
                                Datos personales
                            </a>
                        </Tab>
                        <!-- <Tab as="template" v-slot="{ selected }">
                            <a
                                href="javascript:;"
                                class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary !outline-none"
                                :class="{ '!border-primary text-primary': selected }"
                            >
                                <icon-user class="w-5 h-5" />
                                Preferences
                            </a>
                        </Tab>
                        <Tab as="template" v-slot="{ selected }">
                            <a
                                href="javascript:;"
                                class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary !outline-none"
                                :class="{ '!border-primary text-primary': selected }"
                            >
                                <icon-dollar-sign-circle />
                                Payment Details
                            </a>
                        </Tab> -->
                        <!-- <Tab as="template" v-slot="{ selected }">
                            <a
                                href="javascript:;"
                                class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary !outline-none"
                                :class="{ '!border-primary text-primary': selected }"
                            >
                                <icon-phone />
                                Limpiar y dar de baja mi cuenta
                            </a>
                        </Tab> -->
                    </TabList>
                    <TabPanels>
                        <TabPanel>
                            <div>
                                <UpdateProfileInformationForm
                                    :must-verify-email="mustVerifyEmail"
                                    :status="status"
                                />
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <UpdatePasswordForm />
                                    <DeleteUserForm />
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel>
                            <div>
                                <UpdatePersonInformationForm :person="person" :document_types="document_types" :ubigeo="ubigeo" />
                            </div>
                        </TabPanel>
                        <TabPanel>
                            <div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
                                    <div class="panel">
                                        <div class="mb-5">
                                            <h5 class="font-semibold text-lg mb-4">Billing Address</h5>
                                            <p>
                                                Changes to your <span class="text-primary">Billing</span> information will take effect starting with scheduled
                                                payment and will be refelected on your next invoice.
                                            </p>
                                        </div>
                                        <div class="mb-5">
                                            <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                                <div class="flex items-start justify-between py-3">
                                                    <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                        Address #1
                                                        <span class="block text-white-dark dark:text-white-light font-normal text-xs mt-1"
                                                            >2249 Caynor Circle, New Brunswick, New Jersey</span
                                                        >
                                                    </h6>
                                                    <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                        <button class="btn btn-dark">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                                <div class="flex items-start justify-between py-3">
                                                    <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                        Address #2
                                                        <span class="block text-white-dark dark:text-white-light font-normal text-xs mt-1"
                                                            >4262 Leverton Cove Road, Springfield, Massachusetts</span
                                                        >
                                                    </h6>
                                                    <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                        <button class="btn btn-dark">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex items-start justify-between py-3">
                                                    <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                        Address #3
                                                        <span class="block text-white-dark dark:text-white-light font-normal text-xs mt-1"
                                                            >2692 Berkshire Circle, Knoxville, Tennessee</span
                                                        >
                                                    </h6>
                                                    <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                        <button class="btn btn-dark">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">Add Address</button>
                                    </div>
                                    <div class="panel">
                                        <div class="mb-5">
                                            <h5 class="font-semibold text-lg mb-4">Payment History</h5>
                                            <p>
                                                Changes to your <span class="text-primary">Payment Method</span> information will take effect starting with
                                                scheduled payment and will be refelected on your next invoice.
                                            </p>
                                        </div>
                                        <div class="mb-5">
                                            <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                                <div class="flex items-start justify-between py-3">
                                                    <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                        <img src="/assets/images/card-americanexpress.svg" alt="" />
                                                    </div>
                                                    <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                        Mastercard
                                                        <span class="block text-white-dark dark:text-white-light font-normal text-xs mt-1"
                                                            >XXXX XXXX XXXX 9704</span
                                                        >
                                                    </h6>
                                                    <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                        <button class="btn btn-dark">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                                <div class="flex items-start justify-between py-3">
                                                    <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                        <img src="/assets/images/card-mastercard.svg" alt="" />
                                                    </div>
                                                    <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                        American Express<span class="block text-white-dark dark:text-white-light font-normal text-xs mt-1"
                                                            >XXXX XXXX XXXX 310</span
                                                        >
                                                    </h6>
                                                    <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                        <button class="btn btn-dark">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex items-start justify-between py-3">
                                                    <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                        <img src="/assets/images/card-visa.svg" alt="" />
                                                    </div>
                                                    <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                        Visa<span class="block text-white-dark dark:text-white-light font-normal text-xs mt-1"
                                                            >XXXX XXXX XXXX 5264</span
                                                        >
                                                    </h6>
                                                    <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                        <button class="btn btn-dark">Edit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">Add Payment Method</button>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                    <div class="panel">
                                        <div class="mb-5">
                                            <h5 class="font-semibold text-lg mb-4">Add Billing Address</h5>
                                            <p>Changes your New <span class="text-primary">Billing</span> Information.</p>
                                        </div>
                                        <div class="mb-5">
                                            <form>
                                                <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="billingName">Name</label>
                                                        <input id="billingName" type="text" placeholder="Enter Name" class="form-input" />
                                                    </div>
                                                    <div>
                                                        <label for="billingEmail">Email</label>
                                                        <input id="billingEmail" type="email" placeholder="Enter Email" class="form-input" />
                                                    </div>
                                                </div>
                                                <div class="mb-5">
                                                    <label for="billingAddress">Address</label>
                                                    <input id="billingAddress" type="text" placeholder="Enter Address" class="form-input" />
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-5">
                                                    <div class="md:col-span-2">
                                                        <label for="billingCity">City</label>
                                                        <input id="billingCity" type="text" placeholder="Enter City" class="form-input" />
                                                    </div>
                                                    <div>
                                                        <label for="billingState">State</label>
                                                        <select id="billingState" class="form-select text-white-dark">
                                                            <option>Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="billingZip">Zip</label>
                                                        <input id="billingZip" type="text" placeholder="Enter Zip" class="form-input" />
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary">Add</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="mb-5">
                                            <h5 class="font-semibold text-lg mb-4">Add Payment Method</h5>
                                            <p>Changes your New <span class="text-primary">Payment Method</span> Information.</p>
                                        </div>
                                        <div class="mb-5">
                                            <form>
                                                <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="payBrand">Card Brand</label>
                                                        <select id="payBrand" class="form-select text-white-dark">
                                                            <option selected>Mastercard</option>
                                                            <option>American Express</option>
                                                            <option>Visa</option>
                                                            <option>Discover</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="payNumber">Card Number</label>
                                                        <input id="payNumber" type="text" placeholder="Card Number" class="form-input" />
                                                    </div>
                                                </div>
                                                <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="payHolder">Holder Name</label>
                                                        <input id="payHolder" type="text" placeholder="Holder Name" class="form-input" />
                                                    </div>
                                                    <div>
                                                        <label for="payCvv">CVV/CVV2</label>
                                                        <input id="payCvv" type="text" placeholder="CVV" class="form-input" />
                                                    </div>
                                                </div>
                                                <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="payExp">Card Expiry</label>
                                                        <input id="payExp" type="text" placeholder="Card Expiry" class="form-input" />
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary">Add</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel>
                            <div class="switch">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Choose Theme</h5>
                                        <div class="flex justify-around">
                                            <label class="inline-flex cursor-pointer">
                                                <input class="form-radio ltr:mr-4 rtl:ml-4 cursor-pointer" type="radio" name="flexRadioDefault" checked />
                                                <span>
                                                    <img class="ms-3" width="100" height="68" alt="settings-dark" src="/assets/images/settings-light.svg" />
                                                </span>
                                            </label>

                                            <label class="inline-flex cursor-pointer">
                                                <input class="form-radio ltr:mr-4 rtl:ml-4 cursor-pointer" type="radio" name="flexRadioDefault" />
                                                <span>
                                                    <img class="ms-3" width="100" height="68" alt="settings-light" src="/assets/images/settings-dark.svg" />
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Activity data</h5>
                                        <p>Download your Summary, Task and Payment History Data</p>
                                        <button type="button" class="btn btn-primary">Download Data</button>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Public Profile</h5>
                                        <p>Your <span class="text-primary">Profile</span> will be visible to anyone on the network.</p>
                                        <label class="w-12 h-6 relative">
                                            <input
                                                type="checkbox"
                                                class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                                id="custom_switch_checkbox1"
                                            />
                                            <span
                                                for="custom_switch_checkbox1"
                                                class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"
                                            ></span>
                                        </label>
                                    </div>
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Show my email</h5>
                                        <p>Your <span class="text-primary">Email</span> will be visible to anyone on the network.</p>
                                        <label class="w-12 h-6 relative">
                                            <input
                                                type="checkbox"
                                                class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                                id="custom_switch_checkbox2"
                                            />
                                            <span
                                                for="custom_switch_checkbox2"
                                                class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"
                                            ></span>
                                        </label>
                                    </div>
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Enable keyboard shortcuts</h5>
                                        <p>When enabled, press <span class="text-primary">ctrl</span> for help</p>
                                        <label class="w-12 h-6 relative">
                                            <input
                                                type="checkbox"
                                                class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                                id="custom_switch_checkbox3"
                                            />
                                            <span
                                                for="custom_switch_checkbox3"
                                                class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"
                                            ></span>
                                        </label>
                                    </div>
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Hide left navigation</h5>
                                        <p>Sidebar will be <span class="text-primary">hidden</span> by default</p>
                                        <label class="w-12 h-6 relative">
                                            <input
                                                type="checkbox"
                                                class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                                id="custom_switch_checkbox4"
                                            />
                                            <span
                                                for="custom_switch_checkbox4"
                                                class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"
                                            ></span>
                                        </label>
                                    </div>
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Advertisements</h5>
                                        <p>Display <span class="text-primary">Ads</span> on your dashboard</p>
                                        <label class="w-12 h-6 relative">
                                            <input
                                                type="checkbox"
                                                class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                                id="custom_switch_checkbox5"
                                            />
                                            <span
                                                for="custom_switch_checkbox5"
                                                class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"
                                            ></span>
                                        </label>
                                    </div>
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Social Profile</h5>
                                        <p>Enable your <span class="text-primary">social</span> profiles on this network</p>
                                        <label class="w-12 h-6 relative">
                                            <input
                                                type="checkbox"
                                                class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                                id="custom_switch_checkbox6"
                                            />
                                            <span
                                                for="custom_switch_checkbox6"
                                                class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"
                                            ></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </TabPanel>
                        <TabPanel>
                            <div class="switch">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Purge Cache</h5>
                                        <p>Remove the active resource from the cache without waiting for the predetermined cache expiry time.</p>
                                        <button class="btn btn-secondary">Clear</button>
                                    </div>
                                    <div class="panel space-y-5">
                                        <h5 class="font-semibold text-lg mb-4">Deactivate Account</h5>
                                        <p>You will not be able to receive messages, notifications for up to 24 hours.</p>
                                        <label class="w-12 h-6 relative">
                                            <input
                                                type="checkbox"
                                                class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                                id="custom_switch_checkbox7"
                                            />
                                            <span
                                                for="custom_switch_checkbox7"
                                                class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"
                                            ></span>
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                        </TabPanel>
                    </TabPanels>
                </TabGroup>
   
            </div>
        </div>
    </AppLayout>
</template>
