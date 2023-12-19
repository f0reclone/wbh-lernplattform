<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({ events: Array })

</script>

<template>
	<Head title="Übersicht" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashbard</h2>
		</template>

		<!-- 0 - This is the outermost Div -->
		<div class="py-12">
		
			<!-- 1 - This is the second outermost Div-->
			<div class="max-w-7x1 mx-auto sm:px-6 lg:px-8 space-y-6">
			
				<!-- 2 - This is the top Div for Progress, Credit Points and Average Grade -->
				<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex gap-4 content-between justify-center">
					
					<!-- 2l - This is the Div for the Progress Bar-->
					<div class="p-4 sm:p-8 bg-green-800 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
						Hier steht der Fortschrittsbalken
					</div>

					<!-- 2c - This is the Div for the Credit Points Bar-->
					<div class="p-4 sm:p-8 bg-green-800 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
						Hier stehen die Credit Points
					</div>
					
					<!-- 2r - This is the Div for the Average Grade Bar-->
					<div class="p-4 sm:p-8 bg-green-800 dark:bg-green-800 overflow-hidden shadow-sm sm_rounded-lg w-1/3">
						Hier steht die Durchschnittsnote
					</div>
				</div>			
				
				<!-- 3 - This is the bottom Div for ToDo's and Calendar-->
				<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex gap-4 content-between justify-center">
					<!-- 3l - This is the bottom left Div for the ToDo title and the ToDo items-->
					<div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-3/4">
						<!-- 3lt - This is the bottom left top Div for ToDo title-->
						<div class="p-4 sm:p-8 bg-red-800 dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
							Dies ist der ToDo Titel
						</div>
						
						<!-- 3lb - This is the bottom left bottom Div for ToDo items-->
						<div class="p-4 flex gap-4 content-between justify-center">

						<!-- 3lbl - This is the bottom left bottom left Div for the first ToDo item-->
							<div class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
								Erstes ToDo
							</div>
							
							<!-- 3lbl - This is the bottom left bottom center Div for the second ToDo item-->
							<div class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
								Zweites ToDo
							</div>
							
							<!-- 3blr - This is the bottom left bottom right Div for the third Todo item-->
							<div class="p-4 sm:p-8 bg-green-200 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg w-1/3">
								Drittes ToDo
							</div>	
						</div>
					</div>

					<!-- 3r - This is the bottom left Div for the Calendar-->
					<div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-1/4">
						<Qalendar
							:events="qalendarEvents"
							:config="config"
							@event-was-clicked="showEventModal"
						>
						<template #eventDialog="props">
						</template>
						</Qalendar>
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
			}
		},
		    data() {
        return {
            events: [
                // ...
                {
                  title: "Advanced algebra",
                  with: "Chandler Bing",
                  time: { start: "2023-12-19 12:05", end: "2023-12-19 13:35" },
                  color: "yellow",
                  isEditable: true,
                  id: "753944708f0f",
                  description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda corporis doloremque et expedita molestias necessitatibus quam quas temporibus veritatis. Deserunt excepturi illum nobis perferendis praesentium repudiandae saepe sapiente voluptatem!"
                },
            ],
            config: {
		defaultMode: 'month',
		disableModes: ['day'],
	    }
        }
    },
	}
</script>

<style>
@import "qalendar/dist/style.css";
</style>


