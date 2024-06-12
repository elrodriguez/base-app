<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import { computed, onMounted, ref } from 'vue';
    import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';

    import FullCalendar from '@fullcalendar/vue3';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction';
    import momentTimezonePlugin from '@fullcalendar/moment-timezone';
    import Swal from 'sweetalert2';

    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import IconX from '@/Components/vristo/icon/icon-x.vue';
 

    const props = defineProps({
        eventsDB: {
            type: Object,
            default: () => ({}),
        },
    });

    const defaultParams = ref({
        id: null,
        title: '',
        start: '',
        end: '',
        description: '',
        type: 'primary',
    });

    const params = ref({
        id: null,
        title: '',
        start: '',
        end: '',
        description: '',
        type: 'primary',
    });
    const isAddEventModal = ref(false);
    const minStartDate = ref('');
    const minEndDate = ref('');
    const calendar = ref(null);
    const now = new Date();
    const events = ref([]);
    
    const calendarOptions = computed(() => {
        return {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, momentTimezonePlugin],
            timeZone: 'America/Lima',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },
            editable: true,
            dayMaxEvents: true,
            selectable: true,
            droppable: true,
            buttonText:{
                today:    'Hoy',
                month:    'Mes',
                week:     'Semana',
                day:      'Día',
                list:     'lista'
            },
            eventClick: (event) => {
                editEvent(event);
            },
            // select: (event) => {
            //     editDate(event);
            // },
            events: events.value,
        };
    });

    onMounted(() => {
        getEvents();
    });

    const getEvents = () => {
        // console.log(props.eventsDB)

        const formattedEvents = props.eventsDB.map(appointment => ({
          id: appointment.id,
          title: `Cita con ${appointment.patient.full_name}`,
          start: appointment.date_appointmen + 'T' + appointment.time_appointmen,
          end: appointment.date_end_appointmen + 'T' + appointment.time_end_appointmen, // Ajusta la lógica según tu necesidad
          className: (appointment.status == '1' ? 'success':(appointment.status == '2' ? 'primary' : (appointment.status == '0' ? 'danger' : 'info' ))), // Ajusta según tu necesidad
          description: appointment.description || '',
          details: appointment.details
        }));

        events.value = formattedEvents;

    };

    const getMonth = (dt, add = 0) => {
        let month = dt.getMonth() + 1 + add;
        const str = (month < 10 ? '0' + month : month).toString();
        return str;
    };

    const editEvent = (data = null) => {
        params.value = JSON.parse(JSON.stringify(defaultParams.value));
        if (data) {
            let obj = JSON.parse(JSON.stringify(data.event));
            params.value = {
                id: obj.id ? obj.id : null,
                title: obj.title ? obj.title : null,
                start: dateFormat(obj.start),
                end: dateFormat(obj.end),
                type: obj.classNames ? obj.classNames[0] : 'primary',
                description: obj.extendedProps ? obj.extendedProps.description : '',
                details: obj.extendedProps ? obj.extendedProps.details : ''
            };
            minStartDate.value = new Date();
            minEndDate.value = dateFormat(obj.start);
        } else {
            minStartDate.value = new Date();
            minEndDate.value = new Date();
        }

        isAddEventModal.value = true;
    };

    const editDate = (data) => {
        let obj = {
            event: {
                start: data.start,
                end: data.end,
            },
        };
        editEvent(obj);
    };

    const dateFormat = (dt) => {
        dt = new Date(dt);
        const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt.getMonth() + 1;
        const date = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
        const hours = dt.getHours() < 10 ? '0' + dt.getHours() : dt.getHours();
        const mins = dt.getMinutes() < 10 ? '0' + dt.getMinutes() : dt.getMinutes();
        dt = dt.getFullYear() + '-' + month + '-' + date + 'T' + hours + ':' + mins;
        return dt;
    };

    const saveEvent = () => {
        if (!params.value.title) {
            return true;
        }
        if (!params.value.start) {
            return true;
        }
        if (!params.value.end) {
            return true;
        }

        if (params.value.id) {
            //update event
            let event = events.value.find((d) => d.id == params.value.id);
            event.title = params.value.title;
            event.start = params.value.start;
            event.end = params.value.end;
            event.description = params.value.description;
            event.className = params.value.type;
        } else {
            //add event
            let maxEventId = 0;
            if (events.value) {
                maxEventId = events.value.reduce((max, character) => (character.id > max ? character.id : max), events.value[0].id);
            }

            let event = {
                id: maxEventId + 1,
                title: params.value.title,
                start: params.value.start,
                end: params.value.end,
                description: params.value.description,
                className: params.value.type,
            };
            events.value.push(event);
        }
        calendar.value.getApi(); //refresh Calendar
        showMessage('Event has been saved successfully.');
        isAddEventModal.value = false;
    };

    const startDateChange = (event) => {
        const dateStr = event.target.value;
        if (dateStr) {
            minEndDate.value = dateFormat(dateStr);
            params.value.end = '';
        }
    };

    const showMessage = (msg = '', type = 'success') => {
        const toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            customClass: { container: 'toast' },
        });
        toast.fire({
            icon: type,
            title: msg,
            padding: '10px 20px',
        });
    };
</script>

<template>
    <AppLayout title="Calendario">
        <div>
            <div class="panel">
                <div class="mb-5">
                    <div class="mb-4 flex items-center sm:flex-row flex-col sm:justify-between justify-center">
                        <div class="sm:mb-0 mb-4">
                            <div class="text-lg font-semibold ltr:sm:text-left rtl:sm:text-right text-center">Calendario</div>
                            <div class="flex items-center mt-2 flex-wrap sm:justify-start justify-center">
                                <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                    <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-primary"></div>
                                    <div>Atendido</div>
                                </div>
                                <!-- <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                    <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-info"></div>
                                    <div>Travel</div>
                                </div> -->
                                <div class="flex items-center ltr:mr-4 rtl:ml-4">
                                    <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-success"></div>
                                    <div>Pendiente</div>
                                </div>
                                <div class="flex items-center">
                                    <div class="h-2.5 w-2.5 rounded-sm ltr:mr-2 rtl:ml-2 bg-danger"></div>
                                    <div>Cancelado</div>
                                </div>
                            </div>
                        </div>
                        <!-- <button type="button" class="btn btn-primary" @click="editEvent()">
                            <icon-plus class="ltr:mr-2 rtl:ml-2" />
                            Crear evento
                        </button> -->
                    </div>
                    <div class="calendar-wrapper">
                        <FullCalendar ref="calendar" :options="calendarOptions">
                            <template v-slot:eventContent="arg">
                                <div class="fc-event-main-frame flex items-center px-1 py-0.5 text-white">
                                    <div class="fc-event-time font-semibold px-0.5">
                                        {{ arg.timeText }}
                                    </div>
                                    <div class="fc-event-title-container">
                                        <div class="fc-event-title fc-sticky !font-medium px-0.5">
                                            {{ arg.event.title }}
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </FullCalendar>
                    </div>
                </div>
            </div>
            <!-- add event modal -->
            <TransitionRoot appear :show="isAddEventModal" as="template">
                <Dialog as="div" @close="isAddEventModal = false" class="relative z-[51]">
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
                        <div class="flex min-h-full items-center justify-center px-4 py-8">
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100"
                                leave-to="opacity-0 scale-95"
                            >
                                <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                    <button
                                        type="button"
                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                        @click="isAddEventModal = false"
                                    >
                                        <icon-x />
                                    </button>
                                    <div class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                        {{ params.id ? 'Ver Cita' : 'Nuevo Cita' }}
                                    </div>
                                    <div class="p-5">
                                        <form @submit.prevent="saveEvent">
                                            <div class="mb-5">
                                                <label for="title">Titulo :</label>
                                                <input
                                                    id="title"
                                                    type="text"
                                                    name="title"
                                                    class="form-input bg-gray-100"
                                                    placeholder="Enter Event Title"
                                                    v-model="params.title"
                                                    required
                                                    disabled
                                                />
                                                <div class="text-danger mt-2" id="titleErr"></div>
                                            </div>

                                            <div class="mb-5">
                                                <label for="dateStart">desde :</label>
                                                <input
                                                    id="dateStart"
                                                    type="datetime-local"
                                                    name="start"
                                                    class="form-input"
                                                    placeholder="Event Start Date"
                                                    v-model="params.start"
                                                    :min="minStartDate"
                                                    @change="startDateChange($event)"
                                                    required
                                                />
                                                <div class="text-danger mt-2" id="startDateErr"></div>
                                            </div>
                                            <div class="mb-5">
                                                <label for="dateEnd">Hasta :</label>
                                                <input
                                                    id="dateEnd"
                                                    type="datetime-local"
                                                    name="end"
                                                    class="form-input"
                                                    placeholder="Event End Date"
                                                    v-model="params.end"
                                                    :min="minEndDate"
                                                    required
                                                />
                                                <div class="text-danger mt-2" id="endDateErr"></div>
                                            </div>
                                            <div class="mb-5">
                                                <label for="description">Asunto :</label>
                                                <textarea
                                                    id="description"
                                                    name="description"
                                                    class="form-textarea min-h-[130px]"
                                                    placeholder=""
                                                    v-model="params.description"
                                                ></textarea>
                                            </div>
                                            <div class="mb-5">
                                                <label for="description">Descripcion :</label>
                                                <textarea
                                                    id="description"
                                                    name="description"
                                                    class="form-textarea min-h-[130px]"
                                                    placeholder=""
                                                    v-model="params.details"
                                                ></textarea>
                                            </div>
                                            <div class="mb-5">
                                                <label>Badge:</label>
                                                <div class="mt-3">
                                                    <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                                        <input type="radio" class="form-radio" name="badge" value="primary" v-model="params.type" />
                                                        <span class="ltr:pl-2 rtl:pr-2">Atendido</span>
                                                    </label>
                                                    <!-- <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                                        <input type="radio" class="form-radio text-info" name="badge" value="info" v-model="params.type" />
                                                        <span class="ltr:pl-2 rtl:pr-2">Travel</span>
                                                    </label> -->
                                                    <label class="inline-flex cursor-pointer ltr:mr-3 rtl:ml-3">
                                                        <input type="radio" class="form-radio text-success" name="badge" value="success" v-model="params.type" />
                                                        <span class="ltr:pl-2 rtl:pr-2">Pendiente</span>
                                                    </label>
                                                    <label class="inline-flex cursor-pointer">
                                                        <input type="radio" class="form-radio text-danger" name="badge" value="danger" v-model="params.type" />
                                                        <span class="ltr:pl-2 rtl:pr-2">Cancelado</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- <div class="flex justify-end items-center mt-8">
                                                <button type="button" class="btn btn-outline-danger" @click="isAddEventModal = false">Cerrar</button>
                                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                    {{ params.id ? 'Actualizar' : 'Guardar' }}
                                                </button>
                                            </div> -->
                                        </form>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
        </div>


    </AppLayout>
</template>
