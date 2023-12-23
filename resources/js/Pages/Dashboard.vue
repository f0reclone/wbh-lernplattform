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
		<div class="py-12">

			<!-- 1 - This is the second outermost Div-->
			<div class="max-w-7x1 mx-auto sm:px-6 lg:px-8 space-y-6">

				<!-- 2 - This is the top Div for Progress, Credit Points and Average Grade -->
				<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex gap-4 content-between justify-center">

					<!-- 2l - This is the Div for the Progress Bar-->
					<div class="p-4 sm:p-8 bg-green-800 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        </h1>
                        <div class="progress-bar">
                            <div class="progress-bar-fill" :style="{ width: completionPercentage + '%' }"></div>
                            <div class="progress-text">{{ modules_done }} von {{ modules_total }} Modulen</div>
                        </div>
					</div>

					<!-- 2c - This is the Div for the Credit Points Bar-->
                    <div class="p-4 sm:p-8 bg-green-800 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3 flex items-center justify-center">
                        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                            Du hast {{ credit_points_achieved }} von {{ credit_points_total }} CP erreicht.
                        </h1>
                    </div>

					<!-- 2r - This is the Div for the Average Grade Bar-->
                    <div class="p-4 sm:p-8 bg-green-800 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3 flex items-center justify-center">
                        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                            Deine Durschnittsnote: {{ grade_average }}
                        </h1>
                    </div>
				</div>

				<!-- 3 - This is the bottom Div for ToDo's and Calendar-->
				<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex gap-4 content-between justify-center">
					<!-- 3l - This is the bottom left Div for the ToDo title and the ToDo items-->
					<div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-3/4">
						<!-- 3lt - This is the bottom left top Div for ToDo title-->
						<div class="p-4 sm:p-8 bg-red-800 dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <h1 class="flex justify-center items-center font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
                                Deine ToDo's:
                            </h1>
						</div>

						<!-- 3lb - This is the bottom left bottom Div for ToDo items-->
						<div class="p-4 flex gap-4 content-between justify-center">

						<!-- 3lbl - This is the bottom left bottom left Div for the first ToDo item-->
                            <div v-if="tasks[0] != null" class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                {{ tasks[0].title }}<br>
                                <hr>
                                {{ tasks[0].description }}
                            </div>
                            <div v-else class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                Du hast keine offenen Tasks - Yay!
                            </div>

							<!-- 3lbl - This is the bottom left bottom center Div for the second ToDo item-->
                            <div v-if="tasks[1] != null" class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                {{ tasks[1].title }}<br>
                                <hr>
                                {{ tasks[1].description }}
                            </div>
                            <div v-else class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                Kein weiterer Task zum Anzeigen - Yay!
                            </div>

							<!-- 3blr - This is the bottom left bottom right Div for the third Todo item-->
                            <div v-if="tasks[2] != null" class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                {{ tasks[2].title }}<br>
                                <hr>
                                {{ tasks[2].description }}
                            </div>
                            <div v-else class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
                                Kein weiterer Task zum Anzeigen - Yay!
                            </div>

						</div>
					</div>

					<!-- 3r - This is the bottom left Div for the Calendar-->
					<div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-1/4">
                        <h2>Deine Events:</h2>
                        <div class="scrollable-container">
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

			}
		},

		computed: {
			qalendarEvents(){
				return this.events.map((event) => {
					event.with = null;
					return event;
				})
			},
            completionPercentage(){
                return (this.modules_done / (this.modules_total)) * 100;
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
    height: 75px;
    border: 1px solid #ccc;
    position: relative;
    border-radius: 5px;
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


