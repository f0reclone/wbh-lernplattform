<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {CalendarDaysIcon} from "@heroicons/vue/24/solid/index.js";

defineProps({events: Array})
</script>

<template>
    <Head title="Kalender"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <CalendarDaysIcon class="mr-2 h-6 w-6 text-black"/>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Hier findest deine aktuellen Termine.</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="bg-white is-light-mode h-[78vh] rounded shadow-md"
                     style="color-scheme: light">
                    <Qalendar
                        :events="qalenderEvents"
                        :config="config"
                        @event-was-clicked="showEventModal"
                    >
                        <template #eventDialog="props">

                        </template>
                    </Qalendar>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <dialog id="event_details" class="modal" :class="{'modal-open': eventDialogVisible}" v-if="event">
        <div class="modal-box">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Titel</span>
                </div>
                <input type="text" placeholder="Name des Termins" :value="event.title" :disabled="!event.isEditable"
                       class="input input-bordered w-full"/>
                <div class="label">
                </div>
            </label>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Ort</span>
                </div>
                <input type="text" placeholder="Ort" :value="event.location" :disabled="!event.isEditable"
                       class="input input-bordered w-full"/>
                <div class="label">
                </div>
            </label>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Start</span>
                </div>
                <input :type="dateTimeInputType" placeholder="Start" :value="event.time.start"
                       :disabled="!event.isEditable"
                       class="input input-bordered w-full"/>
                <div class="label">
                </div>
            </label>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Ende</span>
                </div>
                <input :type="dateTimeInputType" placeholder="Ende" :value="event.time.end"
                       :disabled="!event.isEditable"
                       class="input input-bordered w-full"/>
                <div class="label">
                </div>
            </label>
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Beschreibung</span>
                </div>
                <textarea class="textarea textarea-bordered h-48 w-full" placeholder="Bio"
                          :value="event.description" :disabled="!event.isEditable"></textarea>
                <div class="label">
                </div>
            </label>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn" @click="hideEventModal">Close</button>
                </form>
            </div>
        </div>
    </dialog>
</template>


<script>
import {Qalendar} from "qalendar";

export default {
    components: {
        Qalendar,
    },

    methods: {
        showEventModal(props) {
            this.event = props.clickedEvent;
            this.eventDialogVisible = true;
            props.closeEventDialog;
        },
        hideEventModal() {
            this.eventDialogVisible = false;
        }
    },

    computed: {
        qalenderEvents() {
            return this.events.map((event) => {
                event.with = null;

                return event;
            })
        },
        dateTimeInputType() {
            if (this.event?.isFullDay) {
                return 'date-local';
            }

            return 'datetime-local'
        }
    },

    data() {
        return {
            eventDialogVisible: false,
            event: null,
            config: {
                showCurrentTime: true,
                eventDialog: {
                    isCustom: true
                }
            }
        }
    },
}
</script>

<style>
@import "qalendar/dist/style.css";
</style>
