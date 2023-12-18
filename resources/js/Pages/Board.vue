<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import Checkbox from "@/Components/Checkbox.vue";

const tasks = [
            {
                id: 1,
                title: "Add discount code to checkout page",
                date: "Sep 14",
                type: "Feature Request"
            },
            {
                id: 2,
                title: "Provide documentation on integrations",
                date: "Sep 12"
            },
            {
                id: 3,
                title: "Design shopping cart dropdown",
                date: "Sep 9",
                type: "Design"
            },
            {
                id: 4,
                title: "Add discount code to checkout page",
                date: "Sep 14",
                type: "Feature Request"
            },
            {
                id: 5,
                title: "Test checkout flow",
                date: "Sep 15",
                type: "QA"
            }];

</script>

<template>
    <Head title="ToDo's" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>






        <div >
            <div class="mt-5 flex lg:ml-4 lg:mt-0">
            </div>
            <div class="mt-5 flex lg:ml-4 lg:mt-0">

            </div>
        </div>




        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-4 lg:flex lg:items-center lg:justify-between">
                <Dropdown id="semester" align="left">
                    <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                >
                                    Semesterauswahl:
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </span>
                    </template>

                    <template #content>
                        <div class="mt-2 ml-2">
                            <Checkbox checked="unchecked" class="mt-8 mb-3 flex lg:ml-4 lg:mt-0"></Checkbox>
                        </div>

                        <DropdownLink :href="route('user-manual')"> Hilfe </DropdownLink>
                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <div class="flex justify-between h-16">
                <div class="flex w-full h-full">
                    <div class="mt-4 w-1/3 h-full">
                        <div class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg">ToDo's</p>
                            <div v-for="task in tasks" :key="task.id" class="mt-2 p-3 bg-white-100 dark:bg-gray-700 rounded-lg">
                                <div class="list-group-item">
                                    {{task.title}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 w-1/3 h-full">
                        <div class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg">In Bearbeitung</p>
                            <div v-for="task in tasks" :key="task.id" class="mt-2 p-3 bg-white-100 dark:bg-gray-700 rounded-lg">
                                <div class="list-group-item">
                                    {{task.title}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 w-1/3 h-full">
                        <div class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg">Abgeschlossen</p>
                            <div v-for="task in tasks" :key="task.id" class="mt-2 p-3 bg-white-100 dark:bg-gray-700 rounded-lg">
                                <div class="list-group-item">
                                    {{task.title}}
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
export default {
    data() {
        return {
            selectedSemester: 1, // Default selected semester
            semesters: [1, 2, 3], // Replace with actual semester data
            tasksInSelectedSemester: [],
            openTasks: [],
            closedTasks: [],
            openTasksInPriorSemesters: [],
        };
    },
    methods: {
        async loadTasks() {
            // Fetch tasks based on selected semester and update data
            // You'll implement this logic in the next step
        },
    },
};
</script>
