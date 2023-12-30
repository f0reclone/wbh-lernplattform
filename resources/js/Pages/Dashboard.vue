<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// defineProps({ events: Array })
defineProps({ credit_points_total: Number,
                    credit_points_achieved: Number,
                    modules_done: Number,
                    modules_total: Number,
                    grade_average: Number,
                    tasks: Array,
                    events: Array
})
</script>
<template>
<Head title="Übersicht" />


    <AuthenticatedLayout>
		<template #header>
			<h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h1>
		</template>

		<!-- 0 - This is the outermost Div -->
		<div class="py-6">

			<!-- 1 - This is the second outermost Div-->
			<div class="max-w-7x1 mx-auto sm:px-6 lg:px-8 space-y-6">

				<!-- 3 - This is the bottom Div for ToDo's and Calendar-->
				<div class="p-2 sm:p-4 bg-opacity-0 overflow-hidden shadow-sm sm:rounded-lg flex gap-4 content-between justify-center">
					<!-- 3l - This is the bottom left Div for the ToDo title and the ToDo items-->
					<div class="p-2 sm:p-4 bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-3/4">
						<!-- 3lt - This is the bottom left top Div for ToDo title-->
						<div class="bg-opacity-0">
                            <h1 class="flex justify-center font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                                Deine Module
                            </h1>
                            <div class="border-t border-gray-500 my-2"></div>
						</div>

						<!-- 3lb - This is the bottom left bottom Div for Modules and associated Tasks-->
						<div class="p-4 flex gap-4 content-between justify-center">

						<!-- 3lbl - This is the bottom left bottom left Div for the first ToDo item-->
                            <div v-if="tasks[0] != null" class="p-4 sm:p-8 bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                {{ tasks[0].title }}<br>
                                <div class="border-t border-gray-500 my-2"></div>
                                {{ tasks[0].description }}
                            </div>
                            <div v-else class="p-4 sm:p-8 bg-gray-200 shadow-sm sm:rounded-lg w-1/3">
                                Du hast keine offenen Tasks - Yay!
                            </div>

							<!-- 3lbl - This is the bottom left bottom center Div for the second ToDo item-->
                            <div v-if="tasks[1] != null" class="p-4 sm:p-8 bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                {{ tasks[1].title }}<br>
                                <div class="border-t border-gray-500 my-2"></div>
                                {{ tasks[1].description }}
                            </div>
                            <div v-else class="p-4 sm:p-8 bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                Kein weiterer Task zum Anzeigen - Yay!
                            </div>

							<!-- 3blr - This is the bottom left bottom right Div for the third Todo item-->
                            <div v-if="tasks[2] != null" class="p-4 sm:p-8 bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                {{ tasks[2].title }}<br>
                                <div class="border-t border-gray-500 my-2"></div>
                                {{ tasks[2].description }}
                            </div>
                            <div v-else class="p-4 sm:p-8 bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                Kein weiterer Task zum Anzeigen - Yay!
                            </div>
						</div>
					</div>

					<!-- 3r - This is the bottom left Div for the Calendar-->
					<div class="p-2 sm:p-4 bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-1/4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                            </svg>
                            <h2 class="text-xl font-bold underline ml-2">Deine Stats</h2>
                        </div>

                        <!-- 2 - This is the top Div for Progress, Credit Points, and Average Grade -->
                        <div class="bg-opacity-0 overflow-hidden shadow-sm sm:rounded-lg flex-col">

                            <!-- 2l - This is the Div for the Progress Bar-->
                            <div class="p-2 sm:p-4 bg-opacity-0">
                                <div class="progress-bar flex">
                                    <div class="progress-bar-fill" :style="{ width: completionPercentage + '%' }"></div>
                                    <div class="progress-text">{{ modules_done }} von {{ modules_total }} Modulen</div>
                                </div>
                            </div>



                            <!-- 2c - This is the Div for the Credit Points -->
                            <div class="p-2 sm:p-4 bg-opacity-0 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-8 h-8">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                    <h1 class="font-semibold text-xl ml-2">
                                        {{ credit_points_achieved }} / {{ credit_points_total }} Credit Points
                                    </h1>
                            </div>

                            <!-- 2r - This is the Div for the Average Grade -->
                            <div class="p-2 sm:p-4 bg-opacity-0 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                                </svg>

                                <h1 class="font-semibold text-xl ml-2">
                                    {{ grade_average }} Durschnittsnote
                                </h1>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            <h2 class="text-xl font-bold underline ml-2">Deine Events</h2>
                        </div>

                        <div class="scrollable-container" @click="redirectToEvent">
                            <div class="event" v-for="(event, index) in events" :key="index">
                                <div class="event-date">{{ event.date }}</div>
                                <div class="event-details">
                                    <div class="event-title">{{ event.title }}</div>
                                    <div class="event-description">{{ event.description }}</div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>

<script>
	import { Qalendar } from "qalendar";

	export default {
		components: {
			Qalendar,
		},
		methods: {
			showEventModal(props){
				this.event = props.clickedEvent;
				this.eventDialogVisible = true;
				props.closeEventDialog;
			},
			hideEventModal(){
				this.eventDialogVisible = false;
			},
            redirectToEvent(eventId) {
                window.location.href = `http://wbh.test/calendar`;
            },
		},

		computed: {
			qalendarEvents(){
				return this.events.map((event) => {
					event.with = null;
					return event;
				})
			},
            // Always return a little bit so that the bar is not invisible at 0 % progress
            completionPercentage(){
                return 1 + (this.modules_done / (this.modules_total)) * 99;
            }
		},
        data() {
            return {

                doneCount: 10,
                todoCount: 10,
                config: {
                    defaultMode: 'month',
                    disableModes: ['day'],
                },
            }
        },
	}
</script>

<style>
@import "qalendar/dist/style.css";

.progress-bar {
    height: 33px;
    border: 0px solid #ccc;
    position: relative;
    border-radius: 0px;
}

.progress-bar-fill {
    height: 100%;
    background-color: #4CAF50;
    border-radius: 5px;
    transition: width 0.5s ease-in-out;
}

.progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bold;
}

.scrollable-container {
    max-height: 300px; /* Set your desired height */
    overflow-y: auto;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.event {
    display: flex;
    margin-bottom: 16px;
    border-bottom: 1px solid #eee;
    padding-bottom: 8px;
}

.event-date {
    font-weight: bold;
    margin-right: 12px;
}

.event-details {
    flex-grow: 1;
}

.event-title {
    font-weight: bold;
}

.event-description {
    color: #666;
}

</style>


